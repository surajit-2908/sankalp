<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderTrackingEmail extends Mailable
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
        $data['tracking'] = $this->request;
        return $this->view('mail.order-tracking', $data)
        ->to(env('ADMIN_EMAIL'))
        ->subject('Order Tracking Details')
        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
    }
}
