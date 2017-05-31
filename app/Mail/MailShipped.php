<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Http\Request;

class MailShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * メール情報
     * @var Request
     */
    protected $request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Request $request)
     {
         $this->request = $request;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('sideBar.mail')
                    ->subject('mailTest')
                    ->with([
                        'contactName' => $this->request->sender,
                        'contactMessage' => $this->request->mailBody,
                    ]);
    }
}
