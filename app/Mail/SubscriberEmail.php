<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriberEmail extends Mailable
{

    use Queueable, SerializesModels;

        public $emailContent;
        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct($emailContent)
        {
            $this->emailContent = $emailContent;
        }

        /**
         * Build the message.
         *
         * @return $this
         */
        public function build()
        {
            return $this->subject('Test Email')->view('admin.email_tamplate.subscriber_email');
        }
}
