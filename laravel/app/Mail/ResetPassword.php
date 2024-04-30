<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    /**
     * Create a new message instance.
     *
     * @param string $token The reset token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Assuming your API endpoint for password reset is '/api/reset-password'
        $resetUrl = Config::get('app.url') . '/auth/reset-password';

        // Append the token as a query parameter
        $resetLink = $resetUrl . '?token=' . $this->token;

        return $this->subject('Reset Password')
            ->view('emails.reset_password_api', ['reset_link' => $resetLink]);
    }
}
