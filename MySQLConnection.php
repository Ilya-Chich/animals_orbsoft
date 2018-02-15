<?php

/**
 * Created by PhpStorm.
 * User: Mikhail
 * Date: 05.02.201  8
 * Time: 13:47
 */
class MySQLConnection
{
    protected static $_instance;

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self("127.0.0.1", "root", "", "project2");
        }
        return self::$_instance;
    }

    protected $link;

    private function __construct($ip, $name, $password, $base)
    {
        $this->link = mysqli_connect($ip, $name, $password);
        mysqli_select_db($this->link, $base);
    }

    public function query($select)
    {
        $this->dolog($select);
        return mysqli_fetch_all(mysqli_query($this->link, $select), $resulttype = MYSQLI_ASSOC);

    }

    public function getFirst($select)
    {
        $this->dolog($select);
        return $this->query($select)[0];

    }

    public function execute($insert)
    {
        mysqli_query($this->link, $insert);
        $this->dolog($insert);
    }

//    public function query($select)
//    {
//        return mysqli_fetch_array(mysqli_query($this->link, $select));
//    }

    public function escape($string)
    {

        return mysqli_escape_string($this->link, $string);
    }

    private function dolog($str)
    {
        file_put_contents("logs/logfile.txt",  date("r")." ".$str ."\n\n", FILE_APPEND);
    }

}