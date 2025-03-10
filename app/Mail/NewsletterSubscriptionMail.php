<?php 
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;

    /**
     * Create a new message instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Newsletter Subscription Confirmation')
                    ->view('newsletter_subscription')
                    ->with(['email' => $this->email]);
    }
}
?>