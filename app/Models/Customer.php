<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Customer extends User
{
    use HasFactory, Notifiable;

    protected $table = 'customer';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function name()
    {
        return $this->user()->first()->name;
    }

    public function pets()
    {
        return $this->hasMany('App\Models\Pet', 'customer_id', 'user_id');
    }
}
