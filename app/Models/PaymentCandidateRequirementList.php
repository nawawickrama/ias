<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCandidateRequirementList extends Model
{
    use HasFactory;

    protected $table = 'payment_candidate_requirement_lists';

    protected $primaryKey = 'pcrl_id';

    protected $fillable = [
        'form_id',
        'crl_id',
        'candidate_id',
    ];

    public function form(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Form::class, 'form_id');
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Payment::class, 'pcrl_id');
    }



}
