<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserControllerMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $view;
    public $user;
    public $pass;

    /**
     * Create a new message instance.
     * @param string $subject (Required): Subject of the email
     * @param string $view (Required): View that contains the body's message
     * @param object $user (Required): User with the personal data
     * @param string $pass (Optional): Show the password assigned
     */
    public function __construct($subject, $view, $user, $pass = '')
    {
        $this->subject  = $subject;
        $this->view     = $view;
        $this->user     = $user;
        $this->pass     = $pass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)->with([
            'user'  => $this->user,
        ]);
    }
}
