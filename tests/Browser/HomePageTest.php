<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomePageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function seeHeading()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Create. Collect. Customize.');
        });
    }

    /** @test */
    public function createSurveyButtonRedirectsUnauthenticatedUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('#nav-create-survey')
                    ->assertPathIs('/login');
        });
    }

    /** @test */
    public function createSurveyButtonDoesNotRedirectIfAuthenticated()
    {
        $this->browse(function (Browser $browser) {
            $user = factory('App\User')->create();
            $browser->loginAs($user)
                ->visit('/')
                ->click('#nav-create-survey')
                ->assertPathIs('/surveys/create');
        });
    }

}
