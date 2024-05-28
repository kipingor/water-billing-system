<?php

use Laravel\Dusk\Browser;

it('has customerbrowser page', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/customerbrowser')
            ->assertSee('customerbrowser');
    });
});
