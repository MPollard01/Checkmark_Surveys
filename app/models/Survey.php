<?php

namespace App\Models;

use App\Classes\Session;

class Survey extends Model
{
    public $id;
    public $title;
    public $creator;
    public $questions;
    public $timestamp;

    public function __construct()
    {
        $this->id = md5(uniqid(rand(), true));
        $this->creator = Session::get('username');
        date_default_timezone_set('Europe/London');
        $this->timestamp = date('Y-m-d H:i:s', time());
    }

    public function rules()
    {
        return [];
    }

    public static function get()
    {
        return self::$db->get_where_all('survey', 'creator', Session::get('username'));
    }

    public static function getSingle($id)
    {
        $data = self::$db->get_where('survey', 'id', $id);
        if($data) {
            $data['questions'] = json_decode($data['questions']);
        
            return $data;
        }
        
        return null;
    }

    public function save()
    {
        $this->questions = json_encode($this->questions);
        $data = (array) $this;
        $query = self::$db->insert('survey', $data);
      
        return $query != null;
    }

    public function update()
    {
        $this->questions = json_encode($this->questions);
        echo var_dump($this);
        return self::$db->query("UPDATE survey SET title='{$this->title}', questions='{$this->questions}' WHERE id = '{$this->id}'");
    }

    public static function delete($id)
    {
        self::$db->query("DELETE FROM survey WHERE id='{$id}'");
    }
}