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
        'complete_year',
        'result_percentage',
        'duration',
        'cpf_id'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'cpf_id');
    }
}
