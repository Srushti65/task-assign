<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\task;
use App\Models\FormData;

class newTaskNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     * 
     * 
     */
    public $task;
        
    public function __construct(task $task)
    {
        //
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $url = url('/tasks/', $this->task->id);
        $env = env('APP_URL');
        $url = ($env . 'view/' . $this->task->t_id);
        // dd($url);
        return (new MailMessage)
                    ->subject('New task created')
                    ->greeting('Hello, ' . $notifiable->name)
                    ->line('A new task has been assigned to you on '. $this->task->created_at .' please complete it before '. $this->task->due_date)
                    ->line('Task name: ' . $this->task->title)
                    ->action('View Task', $url)
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
