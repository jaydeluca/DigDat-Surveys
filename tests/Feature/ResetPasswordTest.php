<?php

namespace Tests\Feature;

use App\PasswordReset;
use Tests\TestCase;
use App\User;
use App\Notifications\MailResetPasswordToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;


class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    protected $url = null;
    protected $user = null;
    protected $userNo = null;
    protected $token = null;

    protected function setUp()
    {
        parent::setUp();
        //don't actually send notifications (hurts a bit later)
        Notification::fake();
        $this->token = Str::random(60);
        //user we want to play with
        $this->user = factory(User::class)->create();
        $this->user->sendPasswordResetNotification($this->token);
        //user we want to not play with
        $this->userNo = factory(User::class)->create();
    }

    protected function generic_sent()
    {
        //yay, mail notification send
        Notification::assertSentTo($this->user, MailResetPasswordToken::class, function ($reset) {
            $data = $reset->toMail($this->user)->toArray();
            $this->url = $data['actionUrl'];
            return true;
        });
    }

    /*
     * boo. since we fake the notification, no db record is created, so do that.
     * @param $opts takes and key/value pair of what we want to override
     */
    protected function create_record($opts = [])
    {
        $fields = ['email','token','created_at'];
        //defaults
        $data = [
            'email' => $this->user->getEmailForPasswordReset(),
            'token' => Hash::make($this->token),
            'created_at' => Carbon::now()
        ];
        foreach($opts as $k=>$v){
            if (array_key_exists($k, $data)){
                $data[$k] = $v;
            }
        }
        //boo. since we fake the notification, no db record is created, so do that.
        create(PasswordReset::class, $data);

    }

    /** @test - make sure we see reset email correctly */
    public function check_for_reset_email()
    {
        //yay, mail notification send
        Notification::assertSentTo($this->user, MailResetPasswordToken::class, function ($reset) {
            //and we'll validate things
            $this->assertEquals($reset->email, $this->user->getEmailForPasswordReset());
            $this->assertEquals($reset->token, $this->token);

            $data = $reset->toMail($this->user)->toArray();
            $this->assertEquals($data['subject'], config('app.name') . ': Reset Password');
            $this->assertEquals($data['actionText'], 'Reset Password');
            $url = url(route('password.reset', [$reset->getObfuscatedEmail(), $this->token]));
            $this->assertEquals($data['actionUrl'], $url);
            return true;
        });

        //just to be sure...
        Notification::assertNotSentTo($this->userNo, MailResetPasswordToken::class);
    }

    /** @test - check that an invalid email address doesn't work */
    public function reset_password_from_email_fails_for_email()
    {
        $this->generic_sent();
        
        $this->create_record(['email'=>'invalid@test.com']);
        $r = $this->followingRedirects();
        $r->get($this->url)
                ->assertSee('Unknown email address')
                ->assertSee('Send Password Reset Link');
    }

    /** @test - check that expired tokens don't work */
    public function reset_password_from_email_fails_for_expired()
    {
        $this->generic_sent();
        $this->create_record(['created_at' => Carbon::now()->subYear()]);
        $r = $this->followingRedirects();
        $r->get($this->url)
                ->assertSee('Unknown or expired reset token')
                ->assertSee('Send Password Reset Link');
    }

    /** @test - check that invalid tokens don't work */
    public function reset_password_from_email_fails_for_token()
    {
        $this->generic_sent();
        $this->create_record(['token' => 'hahahaNO']);
        $r = $this->followingRedirects();
        $r->get($this->url)
            ->assertSee('Unknown or expired reset token')
            ->assertSee('Send Password Reset Link');
    }

    /** @test - make sure valid params get us to the reset page */
    public function reset_password_from_email_succeeds()
    {
        $this->generic_sent();
        $this->create_record();
        $r = $this->followingRedirects();
        $r->get($this->url)->assertSeeText('Confirm Password');
        
    }
    
}