<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HigherEdu extends Model
{
    use HasFactory;

    protected $table = 'higher_edus';

    protected $primaryKey = 'higher_edu_id';

    protected $fillable = [
        'university',
        'major_subject',
        'year',
        'result_percentage',
        'higher_edu_type',
        'cpf_id'
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'cpf_id');
    }
}
