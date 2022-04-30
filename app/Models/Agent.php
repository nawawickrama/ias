<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $table = 'agents';

    protected $primaryKey = 'agent_id';

    protected $fillable = [
        'agent_name',
        'agent_email',
        'agent_tp_1',
        'agent_tp_2',
        'agent_country',
        'agent_contact_person_name',
        'agent_whtaspp',
        'agent_web_site',
        'agent_status',
        'reference_no',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'agent_country' , 'id');
    }

    public function leads()
    {
        return $this->hasMany(Lead::class, 'agent_id');
    }

    public function cpfs(){
        return $this->hasMany(Cpf::class, 'agent_id');
    }
}
