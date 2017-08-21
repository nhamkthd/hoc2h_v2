<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;
class LikeAnswerComentQuestionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $question_id;
    public function __construct($question_id)
    {
        $this->question_id=$question_id;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
     public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [
            "user"=>Auth::user(),
            "kind"=>"thích",
            "model"=>"bình luận",
            "link"=>"/questions/question/".$this->question_id
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            "user"=>Auth::user(),
            "kind"=>"Thích",
            "model"=>"bình luận",
            "link"=>"/questions/question/".$this->question_id
            ]);
    }
}
