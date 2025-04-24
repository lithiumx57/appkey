<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendProfileEmailAuthenticationCode extends Mailable
{
  use Queueable, SerializesModels;

  public $code;

  /**
   * Create a new message instance.
   */
  public function __construct($code)
  {
    $this->code = $code;
  }


  public function build()
  {
    return $this->subject('آزمایش Mailtrap')
      ->view('pages.emails.email-authentication');
  }

}
