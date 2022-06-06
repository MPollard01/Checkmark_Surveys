<?php 

namespace App\Models;

class User extends Model
{
    public $firstname, $surname;
    public $dob;
    public $tel;
    public $username, $password;
    public $email;

    public function rules()
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'surname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'dob' => [self::RULE_REQUIRED],
            'tel' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 10]],
            'username' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4]]
        ];
    }

    public static function get($username)
    {
        $data = self::$db->get_where('users', 'username', $username);
        if($data) {
            $user = new User();
            $user->loadData($data);
            return $user;
        }
        
        return null;
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        $data = (array) $this;
        $query = self::$db->insert('users', $data);
      
        return $query != null;
    }
}