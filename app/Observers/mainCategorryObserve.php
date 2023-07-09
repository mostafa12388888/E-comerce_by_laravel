<?php

namespace App\Observers;

use App\Models\main_catagorie;

class mainCategorryObserve
{
    /**
     * Handle the main_catagorie "created" event.
     */
    public function created(main_catagorie $main_catagorie): void
    {
       
    }

    /**
     * Handle the main_catagorie "updated" event.
     */
    public function updated(main_catagorie $main_catagorie): void
    {
        $main_catagorie->vendors()->update(['active'=>$main_catagorie->active]);
    }

    /**
     * Handle the main_catagorie "deleted" event.
     */
    public function deleted(main_catagorie $main_catagorie): void
    {
        //
    }

    /**
     * Handle the main_catagorie "restored" event.
     */
    public function restored(main_catagorie $main_catagorie): void
    {
        //
    }

    /**
     * Handle the main_catagorie "force deleted" event.
     */
    public function forceDeleted(main_catagorie $main_catagorie): void
    {
        //
    }
}
