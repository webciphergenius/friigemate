<?php namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailSync extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('New Contact Message from ' . ($this->contact['username'] ?? 'Website'))
                    ->from(config('mail.from.address'), config('mail.from.name'))
                    ->replyTo($this->contact['email'] ?? config('mail.from.address'), $this->contact['username'] ?? 'Website User')
                    ->view('contact')
                    ->with('contact', $this->contact);
    }
}

