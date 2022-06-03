<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'candidate_id',
        'reference_no',
        'full_amount',
        'paid_amount',
        'remaining_amount',
        'paid_date',
        'status',
        'reject_reason',
        'candidate_payment_id'
    ];

    public function candidate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function candidatePayment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CandidatePayment::class, 'candidate_payment_id');
    }



}
