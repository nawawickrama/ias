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
        'agent_tp',
        'agent_country',
        'agent_contact_person_name',
        'agent_whtaspp',
        'agent_web_site',
        'agent_status'
    ];
}
