<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class Doctor extends User
{
    use HasFactory, Notifiable;

    protected $table = 'Doctor';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function name()
    {
        return $this->user()->first()->name;
    }

    public function diagnosisTimes()
    {
        return $this->hasMany('App\Models\DiagnosisTime', 'doctor_id', 'user_id');
    }

    public function clinic()
    {
        return $this->belongsTo('App\Models\Clinic', 'clinic_id', 'id');
    }

    public function reservations()
    {
        return $this->hasMany('App\Models\Reservation', 'doctor_id', 'user_id');
    }
}
