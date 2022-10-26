<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OnlineTrainingBookingSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $request;
    public function __construct($request)
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
        $data['booking'] = $this->request;

        return $this->view('mail.onlne_training_booking_success', $data)
        ->to($this->request['email'])
        ->subject($this->request['mail_subject'])
        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    }
}
