<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function agent()
    {
        return $this->hasMany(Agent::class, 'agent_country' , 'id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'lead_country_id', 'id');
    }

    public function users(){
        return $this->hasMany(User::class, 'country', 'id');
    }

    public function natianalities(){
        return $this->hasMany(Candidate::class, 'nationality', 'id');
    }


}
