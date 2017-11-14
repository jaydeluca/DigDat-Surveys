<?php

namespace Tests\Browser;

use function foo\func;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

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
            $user = User::create([
                'name' => 'Joe Smith',
                'email' => 'joesmith@aol.com',
                'slug' => 'joes-surveys',
                'password' => 'supasecret',
                'password_confirmation' => 'supasecret'
            ]);
            $browser->loginAs($user)
                ->visit('/')
                ->click('#nav-create-survey')
                ->assertPathIs('/surveys/create');
        });
    }

}
