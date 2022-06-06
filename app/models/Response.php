<?php

namespace App\Models;

class Response extends Model
{
    public $id;
    public $surveyId;
    public $answers;
    public $timestamp;

    public function __construct()
    {
        $this->id = md5(uniqid(rand(), true));
        $this->timestamp = date('Y-m-d H:i:s', time());
    }

    public function rules()
    {
        return [];
    }

    public function save()
    {
        $this->answers = json_encode($this->answers);
        $data = (array) $this;
        $query = self::$db->insert('responses', $data);
      
        return $query != null;
    }

    public static function getResponseCount($id)
    {
        $query = self::$db->query("SELECT COUNT(*) FROM responses WHERE surveyId ='{$id}'");
        return $query->fetch_row();
    }

    public static function fetchResponses($id)
    {
        $data = self::$db->get_where_all('responses', 'surveyId', $id);
        if($data) {
            foreach($data as $key => $value)
            {
                $data[$key][2] = json_decode($value[2]);
            }
            return $data;
        }

        return null;
    }
}