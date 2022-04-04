<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGuardian extends Model
{
    use HasFactory;

    protected $table = 'student_guardians';

    protected $primaryKey = 'student_guardian_id';

    protected $fillable = [
        'guardian_title',
        'guardian_firstName',
        'guardian_lastName',
        'guardian_email',
        'guardian_phoneNo',
        'guardian_mobileNo',
        'relationship',
        'income',
        'qualification',
        'occupation',
        'homeAddress',
        'officeAddress',
        'student_id'
    ];
}
