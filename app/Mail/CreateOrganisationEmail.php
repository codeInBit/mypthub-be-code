<?php

declare(strict_types=1);

namespace App\Mail;

use App\Organisation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreateOrganisationEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * The organisation instance.
     * 
     * @var \App\Organisation
     */
    public $organisation;

    /**
     * Create a new message instance.
     * 
     *
     * @param  \App\Organisation  $organisation
     * @return void
     */
    public function __construct(Organisation $organisation)
    {
        $this->organisation = $organisation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Organisation Created')
                    ->markdown('emails.create-organisation');
    }
}
