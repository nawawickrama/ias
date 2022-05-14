<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateRequirementList extends Model
{
    use HasFactory;

    protected $table = 'candidate_requirement_lists';

    protected $primaryKey = 'candidate_requirement_list_id';

    protected $fillable = [
        'requirement_list_id',
        'user_id',
        'isComplete'
    ];
}
