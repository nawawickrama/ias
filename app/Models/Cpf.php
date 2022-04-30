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

    public function sec_sch()
    {
        return $this->hasMany(SecondaryEdu::class, 'cpf_id');
    }

    public function vocational_t()
    {
        return $this->hasOne(VocationalTraining::class, 'cpf_id');
    }

    public function higher_edu()
    {
        return $this->hasMany(HigherEdu::class, 'cpf_id');
    }

    public function work_exp()
    {
        return $this->hasMany(WorkExperience::class, 'cpf_id', 'cpf_id');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function potential(){
        return $this->hasOne(Potential::class, 'cpf_id');
    }

    public function agent(){
        return $this->belongsTo(Agent::class, 'agent_id');
    }
}
