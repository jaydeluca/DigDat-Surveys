<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\Home;
use App\User;

class HomeTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function createSurveyButtonRedirectsUnauthenticatedUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Home)
                    ->click('#nav-create-survey')
                    ->assertPathIs('/login');
        });
    }

    /** @test */
    public function createSurveyButtonDoesNotRedirectIfAuthenticated()
    {
        $user = factory(User::class)->create();
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(new Home)
                ->assertSee('My Account')
                ->click('.my-account')
                ->waitForText($user->name)
                ->click('#nav-create-survey')
                ->assertPathIs('/surveys/create');
        });
    }

}
