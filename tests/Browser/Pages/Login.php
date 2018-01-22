<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class Login extends BasePage
{
    protected static $asserted = false;
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        if (!static::$asserted) {
            $browser->visit($this->url())
                ->assertSeeIn('button[type=submit]', 'Login')
                ->assertSeeIn('#login a.button', 'Forgot Your Password?')
                ->assertSeeIn('#login h1.title', 'Login')
                ->assertSeeIn('#register h1.title', 'Need an Account?');
            static::$asserted = true;
        }
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@element' => '#selector',
        ];
    }
}
