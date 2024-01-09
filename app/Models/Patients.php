<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'dob',
        'sex',
        'user_type',
        'phone',
        'mrd_no',
        'address'
    ];

    // public function billing()
    // {
    //     return $this->hasMany(Bills::class);
    // }
    public function bookAppointment(){

        return $this->hasMany(BookAppointments::class);
    }
    public function opbill(){

        return $this->hasMany(OPBill::class);
    }
    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['dob'])->age;
    }
}
