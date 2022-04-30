<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potential extends Model
{
    use HasFactory;

    protected $table = 'potentials';

    protected $primaryKey = 'potential_id';

    protected $fillable = [
        'cpf_id',
        'candidate_id',
        'potential_status',
    ];

    public function candidate(){
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function cpf(){
        return $this->belongsTo(Cpf::class, 'cpf_id');
    }
}
