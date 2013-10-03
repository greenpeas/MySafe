<?php

// класс для работы с локальной БД

class db {

    public $link;
    public $result;
    public $error;

    function __construct() {
        $this->link = mysqli_connect('127.0.0.1', 'safe', 'safe', 'safe');
        mysqli_query($this->link, "SET NAMES 'utf8'");
        $this->result = false;
        $this->error = false;
    }

    // Выборка из БД. Возвращается ассоциативный массив
    public function select($query) {
        $res = mysqli_query($this->link, $query);
        //die($query);
        $result = array();
        if ($res) {
            if (mysqli_num_rows($res))
                while ($item = mysqli_fetch_assoc($res))
                    $result[] = $item;
            $this->result = $result;
            return $result;
        }
        else return false;
    }

    // Обновление записи. Возвращает кол-во затронутых строк
    public function update($query) {
        mysqli_query($this->link, $query);
        return mysqli_affected_rows($this->link);
    }

    // Вставка записи. Возвращает id вставленной записи
    public function insert($query) {
        
        if(mysqli_query($this->link, $query)) return mysqli_insert_id($this->link);
        else {
            $this->error = $this->link->error;
            return false;
        }
    }
    
    public function RealEscapeString($string){
        return mysqli_real_escape_string($this->link,$string);
        
    }

}