<?php

namespace App\Models;
use App\Classes\Mail;

class EmailForm extends Model
{
    public $subject = '';
    public $body = '';
    public $id = '';
    public $token = '';
    public $recipients = '';
    public $error = '';

    public function rules()
    {
        return [
            'recipients' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            // 'body' => [self::RULE_REQUIRED],
        ];
    }

    public function send()
    {
        $email = new Mail();
        foreach($this->recipients as $to)
        {
            $email->getMail()->addAddress($to);
        }
        
        $user_activation_hash = sha1(uniqid(mt_rand(), true));
        $this->token = $user_activation_hash;
        $this->body .= "<br><br>Click the link to take the survey <a href='http://localhost/checkmarksurveys/public/surveys/respond/".$this->id.$this->token."'>Take Survey</a>";
        $email->setSubject($this->subject);
        $email->setBody(make('email-template', array('data' => $this->body)));

        return $email->send();
    }

    public function save()
    {
        self::$db->query("INSERT INTO email_token (id) VALUES ('{$this->token}')");
    }

    public static function get($id)
    {
        $data = self::$db->get_where('email_token', 'id', $id);
        if($data) {
            return $data;
        }
        
        return null;
    }

    public static function delete($id)
    {
        self::$db->query("DELETE FROM email_token WHERE id='{$id}'");
    }
}