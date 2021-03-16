<?php

namespace App\Listeners;

use App\Events\ModelActivityEvent;
use App\Activities;
use App\Observers\ModelObserver;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModelActivityListener
{
    /**
     * Handle the event.
     *
     * @param  ModelActivityEvent  $event
     * @return void
     */
    public function handle(ModelActivityEvent $event)
    {
        $action = $event->getAction();
        $table =  $event->getTable();
        $id = $event->getResourceId();
        $resourceParams = $event->getResourceParams();

        Activities::create([
            'action' => $action,
            'table_name' => $table,
            'resource_id' => $id,
            'resource_params' => $resourceParams
        ]);
    }
}
