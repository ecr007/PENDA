<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppMail extends Mailable
{
	use Queueable, SerializesModels;

	public $subject;
	private $data;
	private $template;

	private $address;
	private $name;

	private $replyAddress;
	private $replyName;

	private $ccAddress;
	private $ccName;

	private $bccAddress;
	private $bccName;

	/**
	 * Create a new message instance.
	 *
	 * @param String $subject
	 * @param Array $data ['x' => y, 'body' => 'info']
	 * @param String $template
	 *
	 * @return void
	 */
	public function __construct($subject,$data,$template,$address = null,$name = null,$replyAddress = null,$replyName = null,$ccAddress = null, $ccName = null, $bccAddress = null, $bccName = null)
	{
		$this->subject = $subject;
		$this->data = $data;
		$this->template = $template;

		$this->address = $address;
		$this->name = $name;

		$this->replyAddress = $replyAddress;
		$this->replyName = $replyName;

		$this->ccAddress = $ccAddress;
		$this->ccName = $ccName;

		$this->bccAddress = $bccAddress;
		$this->bccName = $bccName;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		$headerData = [
			'category' => 'events',
			'unique_args' => [
				'type' => $this->template
			]
		];

		$header = $this->asString($headerData);

        $this->withSwiftMessage(function ($message) use ($header) {
            $message->getHeaders()->addTextHeader('X-SMTPAPI', $header);
        });
		
		$emial = $this->view('mails/'.$this->template);

		if(is_null($this->address) && is_null($this->name)){
			$emial->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
		}
		else{
			$emial->from($this->address, $this->name);	
		}

		if(!is_null($this->ccAddress) && !is_null($this->ccName)){
        	$emial->cc($this->ccAddress, $this->ccName);
        }

        if(!is_null($this->bccAddress) && !is_null($this->bccName)){
        	$emial->bcc($this->bccAddress, $this->bccName);
    	}

    	if(is_null($this->replyAddress) && is_null($this->replyName)){
        	$emial->replyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        }
        else{
        	$emial->replyTo($this->replyAddress, $this->replyName);
        }

        $emial->subject($this->subject);

        $emial->with($this->data);

        return $emial;
	}

	private function asJSON($data)
    {
        $json = json_encode($data);
        $json = preg_replace('/(["\]}])([,:])(["\[{])/', '$1$2 $3', $json);

        return $json;
    }


    private function asString($data)
    {
        $json = $this->asJSON($data);

        return wordwrap($json, 76, "\n   ");
    }
}
