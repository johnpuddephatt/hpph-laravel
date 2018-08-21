<?php

namespace App\Observers;
use App\Models\Screening;

class ScreeningObserver
{
    /**
     * Listen to the Screening created event.
     *
     * @param  \App\Models\Screening $screening
     * @return void
     */
    public function created(Screening $screening)
    {
        //
    }

    /**
     * Listen to the Screening deleting event.
     *
     * @param  \App\Models\Screening $screening
     * @return void
     */
    public function deleting(Screening $screening)
    {
      $screening->tags()->detach();
    }
}
