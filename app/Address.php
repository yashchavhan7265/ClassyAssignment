<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Address extends Model
{
    use Notifiable;

    protected $table = 'user_address';

    protected $fillable = [
        'address1',
        'address2',
        'city',
        'state',
        'zip',
        'country',
    ];

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
        return $this->belongsTo('App\User');
    }
}
