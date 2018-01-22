<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Page as BasePage;
use Laravel\Dusk\Browser;

abstract class Page extends BasePage
{
    /**
     * Get the global element shortcuts for the site.
     *
     * @return array
     */
    public static function siteElements()
    {
        return [
            '@nav' => '.nav',
            '@navl' => '.nav-left',
            '@navr' => '.nav-right,nav.menu',
            '@logo' => '.header-logo',
            '@footer' => '.footer'
        ];
    }

    /**
     * Basically test that the layout is consistent/valid
     *
     * @return void
     */
    public function assert(Browser $browser)
    {
        parent::assert($browser);
        //dumb, but let's make sure we're (at least mostly) on the correct path
        $browser->assertPathBeginsWith($this->url());
        //now common layout things any page should
        $browser->assertVisible('@nav');
        $browser->assertVisible('@navl');
        $browser->assertVisible('@navr');
        $browser->assertVisible('@logo');
        $browser->assertVisible('@footer');
    }
}
