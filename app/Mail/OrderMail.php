<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data, $course;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $course)
    {
        $this->data = $data;
        $this->course = $course;
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
            ->view('web.components.mail.order')
            ->subject('Email đăng ký mua khóa học từ '.$value['full_name'].' - IELTS Trainer')
            ->with(['data' => $this->data,'course' => $this->course]);
    }
}
