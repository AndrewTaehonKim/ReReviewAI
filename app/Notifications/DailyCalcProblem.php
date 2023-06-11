<?php

namespace App\Notifications;

use App\Models\CalcEmail;
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
    // initialize variables
    protected $question;
    protected $A;
    protected $B;
    protected $C;
    protected $D;
    protected $answer_letter;
    protected $answer;
    protected $difficulty;
    protected $tutorial_video;
    protected $collegeboard_unit;
    protected $tags;

    public function __construct(CalcEmail $calcEmail)
    {
        $this->question = $calcEmail->question;
        $this->A = $calcEmail->A;
        $this->B = $calcEmail->B;
        $this->C = $calcEmail->C;
        $this->D = $calcEmail->D;
        $this->answer_letter = $calcEmail->answer_letter;
        $this->answer = $calcEmail->answer;
        $this->difficulty = $calcEmail->difficulty;
        $this->tutorial_video = $calcEmail->tutorial_video;
        $this->collegeboard_unit = $calcEmail->collegeboard_unit;
        $this->tags = $calcEmail->tags;
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
                        'question' => $this->question,
                        'A' => $this->A,
                        'B' => $this->B,
                        'C' => $this->C,
                        'D' => $this->D,
                        'answer_letter' => $this->answer_letter,
                        'answer' => $this->answer,
                        'difficulty' => $this->difficulty,
                        'tutorial_video' => $this->tutorial_video,
                        'collegeboard_unit' => $this->collegeboard_unit,
                        'tags' => $this->tags,
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
