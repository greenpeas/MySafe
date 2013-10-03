<?php

class user {

    public $id;
    public $user;
    public $create_at;
    public $lastvisit_at;
    public $key;
    public $is_guest;
    public $loginKey;
    public $login;

    function __construct() {
        $this->id = (!empty($_SESSION['user']['id'])) ? $_SESSION['user']['id'] : 0;
        $this->user = (!empty($_SESSION['user']['user'])) ? $_SESSION['user']['user'] : 0;
        $this->create_at = (!empty($_SESSION['user']['create_at'])) ? $_SESSION['user']['create_at'] : 0;
        $this->lastvisit_at = (!empty($_SESSION['user']['lastvisit_at'])) ? $_SESSION['user']['lastvisit_at'] : 0;
        $this->key = (!empty($_SESSION['user']['key'])) ? $_SESSION['user']['key'] : 0;
        $this->loginKey = (!empty($_SESSION['user']['loginKey'])) ? $_SESSION['user']['loginKey'] : 0;
        $this->login = (!empty($_SESSION['user']['login'])) ? $_SESSION['user']['login'] : 0;
        $this->is_guest = (isset($_SESSION['user']['is_guest']) && !$_SESSION['user']['is_guest']) ? $_SESSION['user']['is_guest'] : 1;
    }

    public function authUser($login, $pass) {


        $db = new db;

        $sha256 = hash('sha256', hash('sha256', $login) . hash('sha256', $pass));

        $db->select("SELECT * FROM `users`
			WHERE `user` = '" . $sha256 . "';");
        if ($db->result) {
            foreach ($db->result AS $usr) {

                $this->id = $usr['id'];
                $_SESSION['user']['id'] = $usr['id'];

                $this->user = $usr['user'];
                $_SESSION['user']['user'] = $usr['user'];
                
                $this->login = $login;
                $_SESSION['user']['login'] = $login;

                $this->create_at = $usr['create_at'];
                $_SESSION['user']['create_at'] = $usr['create_at'];

                $this->lastvisit_at = $usr['lastvisit_at'];
                $_SESSION['user']['lastvisit_at'] = $usr['lastvisit_at'];

                $db->update("UPDATE `users` SET `lastvisit_at` = NOW() WHERE `id` = " . $usr['id'] . ";");

                $this->is_guest = 0;
                $_SESSION['user']['is_guest'] = 0;

                return true;
            }
        }
        else
            return false;
    }

    public function unAuthUser() {
        $this->id = 0;
        unset($_SESSION['user']['id']);

        $this->user = 0;
        unset($_SESSION['user']['user']);

        $this->create_at = 0;
        unset($_SESSION['user']['create_at']);

        $this->lastvisit_at = 0;
        unset($_SESSION['user']['lastvisit_at']);

        $this->key = 0;
        unset($_SESSION['user']['key']);

        $this->loginKey = null;
        unset($_SESSION['user']['loginKey']);
        
        $this->login = null;
        unset($_SESSION['user']['login']);

        $this->is_guest = 1;
        unset($_SESSION['user']['is_guest']);
        unset($_SESSION['user']);
    }

    public function setkey($key) {
        $this->key = $key;
        $this->loginKey = $key.$this->login;
        $_SESSION['user']['key'] = $key;
        $_SESSION['user']['loginKey'] = $this->loginKey;
        return true;
    }

}