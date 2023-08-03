<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $product, $user, $mailsubject;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $product, $mailsubject)
    {
        $this->user = $user;
        $this->product = $product;
        $this->mailsubject = $mailsubject;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user = $this->user;
        $product = $this->product;

        return (new MailMessage)->view('notification.productcreate', compact('user', 'product'))
            ->subject($this->mailsubject);
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
            'user_id' => $this->user['id'],
            'product_id' => $this->product->id,
            'product_name' => 'New ' . $this->product->product_name . ' have been added to your membership ',
            'time' => time()
        ];
    }
}
