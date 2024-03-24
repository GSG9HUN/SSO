<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationInvitationSend extends Mailable
{
    use Queueable, SerializesModels;

    private string $invitationToken;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitationToken)
    {
        $this->invitationToken = $invitationToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): RegistrationInvitationSend
    {
        return $this->from('virtualismenhely99@gmail.com')
            ->view('Emails.RegistrationInvitation')
            ->with(['invitationToken' => $this->invitationToken]);
    }
}
