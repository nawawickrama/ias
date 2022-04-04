<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAddress extends Model
{
    use HasFactory;

    protected $table = 'student_addresses';

    protected $primaryKey = 'student_address_id';

    protected $fillable = [
        'currentAddress',
        'currentCountry',
        'currentState',
        'currentCity',
        'CurrentPincode',
        'permanentAddress',
        'permanentCountry',
        'permanentState',
        'permanentCity',
        'permanentPincode',
        'student_id'
    ];
}
