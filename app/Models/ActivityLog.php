<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $table = 'activity_logs';

    protected $primaryKey = 'activity_log_id';

    protected $fillable = [
        'model',
        'info',
        'event',
        'user_id',
    ];
}
