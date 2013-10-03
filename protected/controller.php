<?php

// Контроллер
class controller {

    protected $user;
    protected $page;

    function __construct() {
        $this->user = new user();
        $this->page = new page($this->user);
    }

    public function index() {
        require 'methods/'.__FUNCTION__.'.php';
    }

    public function key() {
        require 'methods/'.__FUNCTION__.'.php';        
    }

    public function reg() {
        require 'methods/'.__FUNCTION__.'.php';  
    }

    public function users() {
        require 'methods/'.__FUNCTION__.'.php'; 
    }

    public function login() {
        require 'methods/'.__FUNCTION__.'.php';
    }

    public function logout() {
        require 'methods/'.__FUNCTION__.'.php';
    }

    public function notfound() {
        require 'methods/'.__FUNCTION__.'.php';
    }

    public function online() {
        require 'methods/'.__FUNCTION__.'.php';
    }

    public function getonline() {
        require 'methods/'.__FUNCTION__.'.php';
    }

    public function haskey() {
        require 'methods/'.__FUNCTION__.'.php';
    }

    public function safe() {
        require 'methods/'.__FUNCTION__.'.php';
    }
    
    public function doc() {
        require 'methods/'.__FUNCTION__.'.php';
    }

}