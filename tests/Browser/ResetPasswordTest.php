<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Notifications\MailResetPasswordToken;
use Tests\Browser\Pages\ResetPassword;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithoutMiddleware;


use App\User;

class ResetPasswordTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test - this should be unneccessary */
    public function checkPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new ResetPassword);
        });
    }

    /** @test - make sure an unregistered email can't reset a password */
    public function reset_email_invalid()
    {
        $user = factory(User::class)->create();
        $user->email = 'invalid@example.com';
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new ResetPassword)
                ->type('email', $user->email)
                ->click('#submit')
                ->assertSeeIn(".help-block", "can't find a user");
        });
    }

    /** @test - make sure a registered email can reset a password */
    public function reset_email_valid()
    {
        $user = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new ResetPassword)
                ->type('email', $user->email)
                ->click('#submit')
                ->assertSeeIn(".message.is-success", 'We have e-mailed your password reset link!');
        });
        return $user;
    }

    /** @brokentest - make sure we see reset email
     *  this doesn't work because Mocked things don't work via Dusk yet :(
     *  ie, https://github.com/laravel/dusk/issues/152
     */
    public function check_for_reset_email()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new ResetPassword)
                ->type('email', $user->email)
                ->click('#submit')
                ->assertSeeIn(".message.is-success", 'We have e-mailed your password reset link!');
        });

        Mail::assertSent(
            MailResetPasswordToken::class
        );


    }

}
