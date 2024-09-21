<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalPengurusMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public string $nama_pengurus;
    public string $role;
    public string $password;
    /**
     * Create a new message instance.
     */
    public function __construct(string $nama_pengurus, string $password, string $role)
    {
        $this->nama_pengurus = $nama_pengurus;
        $this->password = $password;
        $this->role = $role;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Informasi Akun Pengurus',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.mail.pengurus',
            with: [
                'nama_pengurus' => $this->nama_pengurus,
                'password' => $this->password,
                'role' => $this->role,
            ],
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
