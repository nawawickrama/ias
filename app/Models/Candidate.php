<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $table = 'candidates';

    protected $primaryKey = 'candidate_id';

    protected $fillable = [
        'first_name',
        'sur_name',
        'sex',
        'dob',
        'nationality',
        'telephone',
        'email',
        'address',
        'country',
    ];

    public function sec_sch()
    {
        return $this->hasMany(SecondaryEdu::class, 'candidate_id');
    }

    public function vocational_t()
    {
        return $this->hasOne(VocationalTraining::class, 'candidate_id');
    }

    public function higher_edu()
    {
        return $this->hasMany(HigherEdu::class, 'candidate_id');
    }

    public function work_exp()
    {
        return $this->hasMany(WorkExperience::class, 'candidate_id');
    }
}
