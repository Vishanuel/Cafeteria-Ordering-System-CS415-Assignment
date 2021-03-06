<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
	
    /**
     * Create a new message instance.
     *
     * @return void
     */
	protected $data = array();
	
    public function __construct(array $data)
    {
        //
		
		$this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {	
        return $this->view('patron.orderemail')
					->subject('Order Information')
					->with($this->data);
    }
}
