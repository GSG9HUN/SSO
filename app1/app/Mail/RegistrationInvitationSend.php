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
    private string $roleId;
    private string $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitationToken, $roleId,$email)
    {
        $this->invitationToken = $invitationToken;
        $this->roleId = $roleId;
        $this->email = $email;

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
            ->with(['invitationToken' => $this->invitationToken])
            ->with(['encoding' => 'Base64'])
            ->with(['details' => base64_encode(serialize(['client_id' => env('CLIENT_ID'), 'role_id' => $this->roleId,'email'=>$this->email]))]);
    }
}
