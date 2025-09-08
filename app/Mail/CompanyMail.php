<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompanyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    private $body;
    private $name;
    private $fromEmail;
    private $forWho;
    public function __construct($subject,$body,$fromEmail,$name=null,$forWho)
    {
        $this->subject=$subject;
        $this->body=$body;
        $this->fromEmail=$fromEmail;
        $this->name=$name;
        $this->forWho=$forWho;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from:$this->fromEmail,
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        if($this->forWho =="forOwner"){
            
            return new Content(
                view: 'partials.ownermail',
                with: [
                    "messageContent" => $this->body,
                    "name" => $this->name
                ]
            );

        }else{
            return new Content(
                view: 'partials.passreset',
                with: [
                    "password" => $this->body,
                    "subject" => $this->subject
                ]
            );
        }
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
