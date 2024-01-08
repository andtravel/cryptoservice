<?php

namespace App\Mail;

use App\Http\Controllers\ChartController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Mailing extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->chart = new ChartController();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(

            replyTo: [
                new Address($this->user->email, "$this->user->first_name $this->user->last_name")
            ],
            subject: 'Mailing',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
           view: 'mails.mailing',

            with: [
                'user' => $this->user,
                'data' => $this->chart->chartData($this->user)->getOriginalContent(),
                'chartKeys' => $this->user->currencies()->pluck('name')->all(),
            ],
        );
    }

    public function build()
    {
       return $this->chart->chartData($this->user);
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
