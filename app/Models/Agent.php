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
}
