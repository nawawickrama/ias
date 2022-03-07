<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';

    protected $primaryKey = 'lead_id';

    protected $fillable = [
        'lead_random_number',
        'lead_first_name',
        'lead_sur_name',
        'lead_email',
        'lead_couse_id',
        'lead_intake_year',
        'lead_city',
        'lead_country_id',
        'lead_source',
        'lead_comment',
        'lead_contact',
        'lead_whatsapp',
        'status',//2-> pending,     0->reject,     1->potential,   3->assigned lead,   4->deleted
        'agent_id',
        'assign_by',
        'assign_at',
        'deleted_at',
        'deleted_by',
        'delete_reason'
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'lead_couse_id', 'course_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'lead_country_id', 'id');
    }
}
