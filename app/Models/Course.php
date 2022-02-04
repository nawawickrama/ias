<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table ='courses';

    protected $primaryKey = 'course_id';

    protected $fillable = [
        'course_name',
        'course_code',
        'course_status',
        'course_description',
    ];

    public function cpf()
    {
        return $this->hasMany(Cpf::class, 'course_id');
    }
}
