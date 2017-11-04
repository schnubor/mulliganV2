<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $user )
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('/verifyemail/'.$this->user->email_token);

        $message = (new MailMessage)
            ->greeting('Hey, '.$this->user->name.'!')
            ->line('Thanks for signing up on Mulligan. Please verify your account by clicking the following link:')
            ->action('Verify Account', $url)
            ->line('Have fun building and sharing your decks :)');

        return $this->markdown('vendor.notifications.email', $message->data());
    }
}
