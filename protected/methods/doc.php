<?php

if (empty($_GET['id']) OR !ctype_digit($_GET['id']))
    $this->page->render('docnotfound');

$db = new db;

// сохранение поля
if (!empty($_POST['name']) AND !empty($_POST['value'])) {
    $cryptedArray = Crypt::encode($this->user->loginKey, array('name'=>$_POST['name'],'value'=>$_POST['value']));
    $query = "INSERT INTO `documents_fields` (`id_document`,`name`,`value`,`iv`) VALUES
                    (" . $db->RealEscapeString($_GET['id']) . ",
                        '" . $db->RealEscapeString($cryptedArray['data']['name']) . "',
                        '" . $db->RealEscapeString($cryptedArray['data']['value']) . "',
                        '" . $db->RealEscapeString($cryptedArray['iv']) . "')";
    
    //Bug::show($query);
    $db->insert($query);
    $this->page->setFlash('info', 'Поле успешно создано');
    $this->page->redirect('/doc?id=' . $_GET['id']);
}


$query = "SELECT 
    `d`.`name`, 
    `d`.`iv`
    FROM `documents` `d`, `safes` `s`
    WHERE 
    `d`.`id_safe` = `s`.`id`
    AND `d`.`id` = " . $db->RealEscapeString($_GET['id']) . " 
    AND `s`.`id_user` = " . $this->user->id . "
            ;";
//Bug::show($query);
$doc = $db->select($query);

if (!empty($doc)) {
    
    $query = "
                SELECT 
                    `f`.`id`, 
                    `f`.`name`, 
                    `f`.`value`, 
                    `f`.`iv`
                FROM 
                    `documents_fields` `f`, `documents` `d`, `safes` `s`
                WHERE
                    `f`.`id_document` = `d`.`id`
                    AND `d`.`id_safe` = `s`.`id`
                    AND `f`.`id_document` = " . $db->RealEscapeString($_GET['id']) . "
                    AND `s`.`id_user` = " . $this->user->id . "
            ;";
    //Bug::show($query);
    $fields = $db->select($query);
    
    $this->page->render('doc', array(
        'doc_name' => Crypt::decode($this->user->loginKey, $doc[0]['name'], $doc[0]['iv']),
        'fields' => $fields,
    ));
} else {
    $this->page->setHeader('404');
    $this->page->render('docnotfound');
}