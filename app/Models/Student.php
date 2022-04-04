<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'name',
        'mobile_no',
        'dob',
        'gender',
        'blood_group',
        'city',
        'country_id',
        'nationality',
        'birth_place',
        'passport_no',
        'skype_id',
        'whatsapp_no',
    ];
}
