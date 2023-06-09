<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class DailyCalcProblem extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    protected $problem;
    public function __construct($problem)
    {
        $this->problem = json_encode($problem);
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): Mailable
    {
        return (new Mailable)
                    ->to($notifiable->email)
                    ->subject("Re:Review AI - Today's Review")
                    ->markdown('calcProblem.email', [
                        'problem' => $this->problem,
                    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
