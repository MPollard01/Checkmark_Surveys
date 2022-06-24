<?php

namespace App\Classes;

class Database
{
    private static $instance;
    private $dbConn;
    public $queryBuild = '';

    private final function  __construct() {
        $this->dbConn = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $_ENV['DB_NAME']);
        if ($this->dbConn->connect_errno)
	    {
		    die("Connection failed: " . mysqli_connect_error());
	    }	
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConn()
    {
        return $this->dbConn;
    }

    public function closeConn()
    {
        mysqli_close($this->dbConn);
    }

    public function query($sql)
    {
        $query = mysqli_query($this->dbConn, $sql);
       
        if (!$query) 
		{
			die(mysqli_error($this->dbConn));
		}
        
        return $query;
    }

    public function rows($query)
    {
        return mysqli_num_rows($query);
    }

    public function select($attr)
    {
        $this->queryBuild = '';
        $this->queryBuild.= "SELECT $attr ";
        return $this;
    }

    public function from($table)
    {
        $this->queryBuild.= "FROM $table ";
        return $this;
    }

    public function where($field, $search)
    {
        $this->queryBuild.= "WHERE $field='$search' ";
        return $this;
    }

    public function get()
    {
        $query = $this->query($this->queryBuild);
        $rows = $this->rows($query);
        $this->closeConn();
        if($rows > 0) return mysqli_fetch_assoc($query);

        return null;
    }

    public function get_where($table, $field, $search)
    {
        $query = $this->query("SELECT * FROM $table WHERE $field='$search'");
        $rows = $this->rows($query);
        //$this->closeConn();
        if($rows > 0) return mysqli_fetch_assoc($query);
        $this->closeConn();
        return null;
    }

    public function get_where_all($table, $field, $search)
    {
        $query = $this->query("SELECT * FROM $table WHERE $field='$search'");
        $rows = $this->rows($query);
        
        $res = mysqli_fetch_all($query);
        if($rows > 0) {
            mysqli_free_result($query);
            //$this->closeConn();
            return $res;
        }
        $this->closeConn();
        return null;
    }

    public function insert($table, $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        array_pop($keys);
        array_pop($values);
        
        $query = $this->query("INSERT INTO $table (". implode(", ", $keys) . ") VALUES ('". implode("', '", $values)."')");
        $this->closeConn();
        if($query) return $query;

        return null;
    }

    public function update($table, $data)
    {
        $keys = array_keys($data);
        $values = array_values($data);
        array_pop($keys);
        array_pop($values);

        $this->query("UPDATE $table SET ". implode(""));
    }

}