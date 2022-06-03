<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidatePayment extends Model
{
    use HasFactory;

    protected $table = 'candidate_payments';

    protected $primaryKey = 'candidate_payment_id';

    protected $fillable = [
        'payment_category',
        'reference_no',
        'candidate_id',
        'candidate_form_id',
        'full_price',
        'dead_line',
        'status'
    ];

    public function candidate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Payment::class, 'candidate_payment_id');
    }
}
