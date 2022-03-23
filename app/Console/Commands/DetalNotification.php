<?php

namespace App\Console\Commands;

use App\Models\DelayNotification;
use App\Models\User;
use App\Notifications\SetReminderNotify;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class DetalNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lead set reminder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $notification_details = DelayNotification::where([['status', 1], ['cron_time', '<', date('Y-m-d H:i:s')]])->get();

        foreach ($notification_details as $notification) {
            $user = User::find($notification->user_id);
            $user->notify(new SetReminderNotify($notification));

            $notification->update([
                'status' => '0'
            ]);
        }
    }
}
