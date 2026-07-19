<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PromotionMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Customer $customer,
        public string $promoTitle,
        public string $promoContent
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->promoTitle,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.promotion',
        );
    }
}
