<?php
class Bug{
    public static function show($data=null,$echo=false){
        if($data === null) return false;
        ob_start();
        var_dump($data);
        echo '<pre>
'.ob_get_clean().'<pre>';
        if(!$echo) exit;
    }
}
