<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class Root extends Page
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        parent::assert($browser);
        $browser->visit($this->url())
                ->assertSee('Create. Collect. Customize.')
                ->assertSeeIn('section.cta','CREATE A SURVEY' )
                ->assertSeeIn('section.cta', 'BROWSE SURVEYS');
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
