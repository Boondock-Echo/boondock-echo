<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KeywordAlert extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $keywords;
    public $audioFileUrl;
    public $ownerName;
    public $dockName;
    /**
     * Create a new message instance.
     *
     * @param  array  $keywords
     * @param  string  $ownerName
     * @param  string  $dockName
     * @return void
     */
    public function __construct(array $keywords, string $audioFileUrl,  $ownerName, $dockName)
    {
        $this->keywords = $keywords;
        $this->audioFileUrl = $audioFileUrl;
        $this->ownerName = $ownerName;
        $this->dockName = $dockName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Keyword Alert')
                    ->view('emails.keyword-alert')
                    ->attach($this->audioFileUrl);
    }
}
