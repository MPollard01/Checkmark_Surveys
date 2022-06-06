<?php

namespace App\Models;
use App\Classes\Mail;

class EmailForm extends Model
{
    public $subject = '';
    public $body = '';
    public $recipients = '';

    public function rules()
    {
        return [
            'recipients' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function send()
    {
        $email = new Mail();
        foreach($this->recipients as $to)
        {
            $email->getMail()->addAddress($to);
        }
        
        $email->getMail()->Subject = $this->subject;
        $email->getMail()->Body = make('email-template', array('data' => $this->body));
        return $email->getMail()->send();
    }
}