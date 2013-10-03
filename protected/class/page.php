<?php
class page {
	public $header;
	public $html;
	private $layout;
	private $view;
	public $title;
	private $gentime;
	public $flash;	
	public $controller;
	public $user;
        public $locss;
                
	function __construct($userobj=null) {
		$this->layout = 'default';
		$this->html = '';
		$this->title = '';
                $this->locss = array();
		$this->flash = (!empty($_SESSION['flash']))? 1 : 0;
		if(!$userobj)$this->user = new user;
                else $this->user = $userobj;
	}
	
	public function setHeader($string){			
		switch($string){
			case '404': $this->header = 'HTTP/1.0 404 Not Found';break;
			case '403': $this->header = 'HTTP/1.0 403 Forbidden';break;
			default : $this->header = $string; break;
		}
	}
	
	public function setTitle($string){	
		$this->title = $string;
	}
	
	public function setLayout($string){	
		$this->layout = $string;
	}
	
	public function render($view,$data=null,$returnstr=0){
		// метод рендеринга страницы
		$mtime = microtime();
		$mtime = explode(" ",$mtime);
		$mtime = $mtime[1] + round($mtime[0],3);
		$tend = $mtime;
		$tpassed = ($tend - TSTART);
		$this->gentime = round($tpassed,3);
		
		if(!file_exists('protected/views/'.$view.'.php')) die('Невозможно найти вьюшку '.$view);	
		
		// выполняем вьюшку
		ob_start();
		include 'protected/views/'.$view.'.php';
		$output = ob_get_contents();
		ob_end_clean();
		
		// если выводим через лейоут
		if(!$returnstr){
			$this->html = $output;
			if($this->header)header($this->header);
			include 'protected/views/layouts/'.$this->layout.'.php';
                        exit;
		}
		else return $output;
	}
	
	public function redirect($addr){
		header('Location: '.$addr);
		exit;
	}
	
	public function setFlash($type='error',$text=''){
		$_SESSION['flash'] = $text;
		$this->flash = 1;
	}
	
	public function showFlash(){
		$tmp_flash = (!empty($_SESSION['flash']))?$_SESSION['flash']:false;
		if(!empty($_SESSION['flash']))unset($_SESSION['flash']);
		return $tmp_flash;
	}
        
        public function regcss($css_path){            
            $this->locss[] = $css_path;
            return true;
        }
        
        public function getcss(){
            $link = '';
            foreach ($this->locss AS $css){
                $link .= '<link href="'.$css.'" rel="stylesheet" media="screen">
';
            }
            return $link;
        }
	
}
