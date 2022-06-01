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
        'year',
        'course_id',
        'job_field',
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

    public function sec_sch(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SecondaryEdu::class, 'cpf_id');
    }

    public function vocational_t(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(VocationalTraining::class, 'cpf_id');
    }

    public function higher_edu(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(HigherEdu::class, 'cpf_id');
    }

    public function work_exp(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(WorkExperience::class, 'cpf_id', 'cpf_id');
    }

    public function candidate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function course(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function potential(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Potential::class, 'cpf_id');
    }

    public function agent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
