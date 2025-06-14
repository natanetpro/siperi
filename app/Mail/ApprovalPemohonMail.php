<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalPemohonMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nama_pemohon;
    public string $pesan;
    public string $approval;
    public string $nama;
    public string $password;

    /**
     * Create a new message instance.
     */
    public function __construct(string $nama_pemohon, string $approval,  string $pesan, string $nama, string $password)
    {
        $this->nama_pemohon = $nama_pemohon;
        $this->pesan = $pesan;
        $this->approval = $approval;
        $this->nama = $nama;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permohonan Anda Telah ' . $this->approval,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'pages.mail.approval',
            with: [
                'nama_pemohon' => $this->nama_pemohon ?? '',
                'approval' => $this->approval ?? '',
                'message' => $this->pesan ?? '',
                'nama' => $this->nama ?? '',
                'password' => $this->password ?? '',
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
