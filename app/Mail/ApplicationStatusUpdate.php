<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $applicantName;
    public $referenceNumber;
    public $newStatus;
    public $adminNotes;
    public $locale;

    public function __construct($applicantName, $referenceNumber, $newStatus, $adminNotes = null, $locale = 'en')
    {
        $this->applicantName = $applicantName;
        $this->referenceNumber = $referenceNumber;
        $this->newStatus = $newStatus;
        $this->adminNotes = $adminNotes;
        $this->locale = $locale;
    }

    public function envelope(): Envelope
    {
        $subject = $this->locale === 'kh'
            ? "ការធ្វើបច្ចុប្បន្នភាពពាក្យ - {$this->referenceNumber}"
            : "Application Update - {$this->referenceNumber}";

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-status-update',
        );
    }
}
