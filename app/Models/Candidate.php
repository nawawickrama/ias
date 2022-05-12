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

        'city',
        'state',
        'zipcode',
        'whatsapp_no',
        'passport_no',
        'user_id',
        'isComplete'
    ];

    public function cpf(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Cpf::class, 'candidate_id');
    }

    public function potential(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Potential::class, 'candidate_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function documents(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CandidateDocument::class, 'candidate_id');
    }

    public function countryInfo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class, 'country', 'id');
    }

    public function nationalityInfo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class, 'nationality', 'id');
    }

    public function guardian(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Guardian::class, 'candidate_id');
    }
}
