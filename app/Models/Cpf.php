<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cpf extends Model
{
    use HasFactory;

    protected $table = 'cpfs';

    protected $primaryKey = 'cpf_id';

    protected $fillable = [
        'program',
        'job_feild',
        'ge_lang',
        'ge_lang_level',
        'how_to_know',
        'agent_id',
        'comment',
        'application_status',
        'status_date',
        'comment_institute',
        'candidate_id'
    ];
}
