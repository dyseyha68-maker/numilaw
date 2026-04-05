<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $applicantName;
    public $referenceNumber;
    public $programName;
    public $locale;

    public function __construct($applicantName, $referenceNumber, $programName, $locale = 'en')
    {
        $this->applicantName = $applicantName;
        $this->referenceNumber = $referenceNumber;
        $this->programName = $programName;
        $this->locale = $locale;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->locale === 'kh' 
                ? "ការទទួលពាក្យ - {$this->referenceNumber}"
                : "Application Received - {$this->referenceNumber}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-confirmation',
        );
    }
}
