<?php

namespace App\Observers;

use App\Activities;
use App\Events\ModelActivityEvent;
use App\User;
use Illuminate\Contracts\Events\Dispatcher;

class ModelObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created($model)
    {
        $params = json_encode($model->getAttributes());
        $params = [
            'action' => 'created',
            'table_name' => $model->getTable(),
            'resource_id' => $model->id,
            'resource_params' => $params
        ];

        event(new ModelActivityEvent($params));
    }

    public function updated($model)
    {
        $params = json_encode($model->getAttributes());
        $params = [
            'action' => 'updated',
            'table_name' => $model->getTable(),
            'resource_id' => $model->id,
            'resource_params' => $params
        ];
        // dd($model->getAttributes());

        event(new ModelActivityEvent($params));
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting($model)
    {
        $params = json_encode($model->getAttributes());
        $params = [
            'action' => 'deleted',
            'table_name' => $model->getTable(),
            'resource_id' => $model->id,
            'resource_params' => $params
        ];
        event(new ModelActivityEvent($params));
    }
}
