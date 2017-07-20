<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use Auth;
class CommentTestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $comment;
    public function __construct($comment)
    {
        $this->comment=$comment;
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
            "comment"=>$this->comment,
            "kind"=>"bình luận",
            "model"=>"bài test",
            "link"=>"/tests/show/".$this->comment['test_id']
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
            "comment"=>$this->comment,
            "kind"=>"bình luận",
            "model"=>"bài test",
            "link"=>"/tests/show/".$this->comment['test_id']
            ]);
    }
}
