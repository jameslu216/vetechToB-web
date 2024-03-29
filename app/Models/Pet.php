<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'Pet';
    public $timestamps = false;
    protected $fillable = ['name', 'variety', 'age', 'gender'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id', 'id');
    }
}
