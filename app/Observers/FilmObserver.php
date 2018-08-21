<?php

namespace App\Observers;
use App\Models\Film;

class FilmObserver
{
    /**
     * Listen to the Film created event.
     *
     * @param  \App\Models\Film $film
     * @return void
     */
    public function created(Film $film)
    {
        //
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\Models\Film $film
     * @return void
     */
    public function deleting(Film $film)
    {
      $film->screenings()->delete();
      $film->strands()->detach();
      $film->seasons()->detach();
    }
}
