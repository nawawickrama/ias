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
        'program',
        'dob',
        'nationality',
        'telephone',
        'email',
        'address',
        'ge_lang',
        'ge_lang_level',
        'how_to_know',
        'agent_name',
        'application_status'
    ];

    public function sec_sch()
    {
        return $this->hasMany(SecondaryEdu::class, 'secondary_edu_id');
    }
}
