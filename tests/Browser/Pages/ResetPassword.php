<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class ResetPassword extends BasePage
{
    protected static $asserted = false;
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/password/reset';
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
                ->assertSeeIn('h1.title', 'Reset Password')
                ->assertVisible('#email')
                ->assertSeeIn('button[type="submit"]', 'Send Password Reset Link');
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
