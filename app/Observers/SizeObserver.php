<?php

namespace App\Observers;

use App\Size;

class SizeObserver
{
    /**
     * Listen to the Size creating event.
     *
     * @param  \App\Size  $size
     * @return void
     */
    public function creating(Size $size)
    {
        $size->slug = str_slug($size->name);
    }
}