<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondaryEdu extends Model
{
    use HasFactory;

    protected $table = 'secondary_edus';

    protected $primaryKey = 'secondary_edu_id';

    protected $fillable = [
        'years_level',
        'duration',
        'result_percentage',
        'sec_edu_type',
        'candidate_id'

    ];
}
