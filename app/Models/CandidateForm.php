<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateForm extends Model
{
    use HasFactory;

    protected $table = 'candidate_forms';

    protected $primaryKey = 'candidate_form_id';

    protected $fillable = [
        'reference_no',
        'dead_line',
        'full_amount',

        'candidate_id',
        'form_id',
        'sub_form_id',

        'file_path',
        'status',
        'reject_reason',
        'submit_date',
    ];

    public function candidate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function form(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Form::class, 'form_id');
    }

    public function candidatePayment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(CandidatePayment::class, 'candidate_form_id');
    }
}
