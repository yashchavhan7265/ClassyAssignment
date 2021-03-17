<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use Notifiable, SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'id', 'first_name', 'last_name'
    ];

    protected $visible = [
        'first_name', 'last_name', 'full_name'
    ];

    protected $appends = ['full_name'];

    protected $dates = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
