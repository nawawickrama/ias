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
        'paid_amount',
        'form_type',
        'pcrl_id',
        'candidate_id',
        'full_payment',
        'status',
        'reject_reason',
        'reference_no'
    ];


    public function candidate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

}
