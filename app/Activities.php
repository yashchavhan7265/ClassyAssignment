<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use Notifiable;

    protected $fillable = ['table_name', 'action', 'resource_id', 'resource_params'];

    protected $table = 'activities';
}
