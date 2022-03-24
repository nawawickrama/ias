<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class activityLog
{
    protected $userId;
    protected $activity;
    protected $model;
    protected $event;

    /**
     * @param $activity
     * @param $model
     * @param $event
     */
    public function __construct($activity, $model, $event)
    {
        $this->userId = Auth::user()->id;
        $this->activity = $activity;
        $this->model = $model;
        $this->event = $event;
    }

    /**
     * @return void
     */
    public function addLog(): void
    {
        \App\Models\ActivityLog::create([
            'model' => $this->model,
            'info' => $this->activity,
            'event' => $this->event,
            'user_id' => $this->userId,
        ]);
    }
}
