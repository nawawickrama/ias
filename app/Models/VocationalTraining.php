<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VocationalTraining extends Model
{
    use HasFactory;

    protected $table = 'vocational_trainings';

    protected $primaryKey = 'v_training_id';

    protected $fillable = [
        'field',
        'compleate_year',
        'result_percentage',
        'duration',
        'candidate_id'
    ];
}
