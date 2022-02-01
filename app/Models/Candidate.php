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
    ];

    public function cpf()
    {
        return $this->hasMany(Cpf::class, 'candidate_id');
    }
}
