<?php
// генератор IP адресов

class ip{
	public static function ipgen(){
		return rand(30,250).'.'.rand(30,250).'.'.rand(1,250).'.'.rand(1,250);
	}
}
