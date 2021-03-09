<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Address extends Model
{
    protected $table = 'user_address';

    protected $visible = [
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'country',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
