<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use Auth;
class AnswerQuestionNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $answer;
    public function __construct($answer)
    {
        $this->answer=$answer;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            "user"=>Auth::user(),
            "comment"=>$this->answer,
            "type"=>"trả lời",
            "model"=>"câu hỏi",
            "link"=>"/questions/question/".$this->answer['question_id']
        ];
    }


    /**
 * Get the broadcastable representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return BroadcastMessage
 */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            "user"=>Auth::user(),
            "answer"=>$this->answer,
            "type"=>"trả lời",
            "model"=>"câu hỏi",
            "link"=>"/questions/question/".$this->answer['question_id']
            ]);
    }
}
