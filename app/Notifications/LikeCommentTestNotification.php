<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Auth;
class LikeCommentTestNotification extends Notification
{
    use Queueable;
   
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $likeCommentTest;
    public function __construct($likeCommentTest)
    {
        $this->likeCommentTest=$likeCommentTest;
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
            "link"=>"/tests/show/".$this->likeCommentTest->comment->test->id.'/'.$this->likeCommentTest->comment->id
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
            "link"=>"/tests/show/".$this->likeCommentTest->comment->test->id.'/'.$this->likeCommentTest->comment->id
            ]);
    }
}
