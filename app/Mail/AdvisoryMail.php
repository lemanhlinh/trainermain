<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdvisoryMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $value = $this->data;
        return $this->from($value['email'])
            ->view('web.components.mail.advisory')
            ->subject('Email đăng ký học thử từ '.$value['full_name'].' - IELTS Trainer')
            ->with(['data' => $this->data]);
    }
}
