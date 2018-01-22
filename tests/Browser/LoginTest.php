<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Login;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\User;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test - this should be unneccessary */
    public function checkPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login);
        });
    }

    /** @test */
    public function emailFails()
    {
        $user = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new Login)
                ->type('email', 'wrong@nothing.com')
                ->type('password', 'blah')
                ->click('#login-btn')
                ->assertSeeIn('#email + .help-block', 'These credentials do not match our records');
        });
    }

    /** @test */
    public function passwordFails()
    {
        $user = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new Login)
                ->type('email', $user->email)
                ->type('password', 'wrong')
                ->click('#login-btn')
                ->assertSeeIn('#password + .help-block', 'These credentials do not match our records');
        });
    }

    /** @test */
    public function loginSucceeds()
    {
        $user = factory(User::class)->create();
        $pass = 'testing!';
        $user->password = bcrypt($pass);
        $user->save();
        $this->browse(function (Browser $browser) use ($user, $pass) {
            $browser->visit(new Login)
                ->type('email', $user->email)
                ->type('password', $pass)
                ->click('#login-btn')
                ->assertPathIs('/home');
        });
    }

    /** @test */
    public function forgotPassword()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Login)
                ->click('#forgot-btn')
                ->assertPathIs('/password/reset');
        });
    }
}
