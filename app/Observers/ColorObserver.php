<?php

namespace App\Observers;

use App\Color;

class ColorObserver
{
    /**
     * Listen to the Color creating event.
     *
     * @param  \App\Color  $color
     * @return void
     */
    public function creating(Color $color)
    {
        $color->slug = str_slug($color->name);
    }
}