<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    protected $table = 'work_experiences';

    protected $primaryKey = 'w_experience_id';

    protected $fillable = [
        'field',
        'duration',
        'candidate_id',
    ];
}
