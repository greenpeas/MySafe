<?php

if (empty($_GET['id']) OR !ctype_digit($_GET['id']))
    $this->page->render('safenotfound');

$db = new db;

// сохранение документа
if (!empty($_POST['name'])) {
    $cryptedArray = Crypt::encode($this->user->loginKey, $_POST['name']);
    $query = "INSERT INTO `documents` (`id_safe`,`name`,`iv`) VALUES
                    (" . $db->RealEscapeString($_GET['id']) . ",
                        '" . $db->RealEscapeString($cryptedArray['data']) . "',
                            '" . $db->RealEscapeString($cryptedArray['iv']) . "')";
    $db->insert($query);
    $this->page->setFlash('info', 'Документ успешно создан');
    $this->page->redirect('/safe?id=' . $_GET['id']);
}

if (!empty($_POST['safe_name'])) {
    $cryptedArray = Crypt::encode($this->user->loginKey, $_POST['safe_name']);
    $query = "INSERT INTO `safes` (`id_parent`,`id_user`,`name`,`iv`) VALUES
                    (" . $db->RealEscapeString($_GET['id']) . "," . $this->user->id . ",
                    '" . $db->RealEscapeString($cryptedArray['data']) . "',
                        '" . $db->RealEscapeString($cryptedArray['iv']) . "')";
    $db->insert($query);
    $this->page->setFlash('info', 'Сейф успешно создан');
    $this->page->redirect('/safe?id=' . $_GET['id']);
}


$query = "SELECT `s`.`name`, `s`.`iv` FROM `safes` `s` WHERE `s`.`id` = " . $db->RealEscapeString($_GET['id']) . " AND `s`.`id_user` = " . $this->user->id . ";";
$safe = $db->select($query);
//Stop::showarr($safe);
if (!empty($safe)) {
    $query = "
                SELECT `s`.`id`, `s`.`name`, `s`.`iv`
                FROM 
                    `safes` `s`
                WHERE
                    `s`.`id_parent` = " . $db->RealEscapeString($_GET['id']) . "
                        AND `id_user` = " . $this->user->id . "
            ";
    $safes = $db->select($query);

    $query = "
                SELECT `d`.`id`, `d`.`name`, `d`.`iv`
                FROM 
                    `documents` `d`
                WHERE
                    `d`.`id_safe` = " . $db->RealEscapeString($_GET['id']) . "
            ";
    $documents = $db->select($query);


    $this->page->render(
            'safe', array(
        'safe_name' => Crypt::decode($this->user->loginKey, $safe[0]['name'], $safe[0]['iv']),
        'documents' => $documents,
        'safes' => $safes,
            )
    );
} else {
    $this->page->setHeader('404');
    $this->page->render('safenotfound');
}