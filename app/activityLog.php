<?php

namespace App;

use Illuminate\Support\Facades\Auth;

class activityLog
{
    protected $userId;
    protected $activity;
    protected $model;
    protected $event;
    protected $property_id;

    /**
     * @param $activity
     * @param $model
     * @param $event
     * @param $property_id
     */
    public function __construct($activity, $model, $event, $property_id)
    {
        $this->userId = Auth::user()->id;
        $this->activity = $activity;
        $this->model = $model;
        $this->event = $event;
        $this->property_id = $property_id;
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
            'property_id' => $this->property_id
        ]);
    }
}
