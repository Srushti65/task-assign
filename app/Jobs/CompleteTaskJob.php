<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
// use Illuminate\Console\View\Components\Task;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Notifications\taskCompletedNotification;
use App\Models\FormData;
use App\Models\task;
use Illuminate\Support\Facades\Notification;

class CompleteTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $task, $user;
    public function __construct(Task $task, FormData $user)

    {
        $this->task = $task;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$task->taskIsCompletedNotification($task->owner_id);
        Notification::send($this->user, new taskCompletedNotification($this->task));
    }
}
