<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $table = 'guardians';

    protected $primaryKey = 'guardian_id';

    protected $fillable = [
        'guardian_title',
        'guardian_firstName',
        'guardian_lastName',
        'guardian_email',
        'guardian_phoneNo',
        'guardian_mobileNo',
        'relationship',
        'occupation',
        'home_address',
        'candidate_id',
        'isComplete'
    ];

    public function candidate(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
}
