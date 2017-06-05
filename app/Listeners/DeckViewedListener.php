<?php

namespace App\Listeners;

use App\Events\DeckViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeckViewedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DeckViewed  $event
     * @return void
     */
    public function handle(DeckViewed $event)
    {
        $deck = $event->deck;
        $deck->views = $deck->views + 1;
        $deck->save();
    }
}
