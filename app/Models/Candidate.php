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

        'state',
        'zipcode',
        'whatsapp_no',
        'passport_no',
        'user_id'
    ];

    public function cpf()
    {
        return $this->hasOne(Cpf::class, 'candidate_id');
    }

    public function potential(){
        return $this->hasOne(Potential::class, 'candidate_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
