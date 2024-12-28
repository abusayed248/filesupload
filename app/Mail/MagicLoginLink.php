<?php
use Illuminate\Mail\Mailable;
use App\Models\User;

class MagicLoginLink extends Mailable
{
    public $user;
    public $token;

    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        return $this->subject('Your Magic Login Link')
                    ->view('emails.magic-login-link')
                    ->with([
                        'url' => route('login.token', ['token' => $this->token]),
                    ]);
    }
}
