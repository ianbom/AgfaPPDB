<?php

namespace App\Mail;

use App\Models\Orangtua;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GmailSeleksiMail extends Mailable
{
    use Queueable, SerializesModels;

    public $orangtua;
    public $statusSeleksi;

    public function __construct(Orangtua $orangtua, $statusSeleksi)
    {
        $this->orangtua = $orangtua;
        $this->statusSeleksi = $statusSeleksi;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan Seleksi Agfa School - ' . $this->orangtua->nama_anak,
        );
    }

    /**
     * Get the message content definition.
     */


    public function content(): Content
    {
        return new Content(
            view: 'web.admin.seleksi.email.lolos',
            with: [
                'orangtua' => $this->orangtua,
                'statusSeleksi' => $this->statusSeleksi
            ]
        );


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
