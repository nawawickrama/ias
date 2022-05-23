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
        'candidate_id',
        'isComplete',
        'reference_no',
        'dead_line',
    ];

    public function candidate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function list(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RequirementList::class, 'requirement_list_id');
    }
}
