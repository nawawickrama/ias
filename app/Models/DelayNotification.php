<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DelayNotification extends Model
{
    use HasFactory;

    protected $table = 'delay_notifications';

    protected $primaryKey = 'delay_notification_id';

    protected $fillable = [
        'cron_time',
        'status',
        'user_id',
        'lead_id',
        'note'
    ];
}
