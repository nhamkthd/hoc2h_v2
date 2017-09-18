<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendMessageNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $message;
    public $conversation;
    public function __construct($message,$conversation)
    {
        $this->conversation=$conversation;
        $this->message=$message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
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
            "conversation"=> $this->conversation,
            "message"=>$this->message,
            "kind"=>"gửi",
            "model"=>"tin nhắn",
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
            "conversation"=> $this->conversation,
            "message"=>$this->message,
            "kind"=>"gửi",
            "model"=>"tin nhắn",
            ]);
    }
}
