<?php

if ($this->user->is_guest)
    $this->page->render('main');
else {
    $db = new db;
    // Создание сейфа
    if (!empty($_POST['name'])) {

        $cryptedArray = Crypt::encode(
                        $this->user->loginKey, $_POST['name']);


        $query = "INSERT INTO `safes` (`id_user`,`name`,`iv`) VALUES
                    (                    
                    " . $this->user->id . ",
                    '" . $db->RealEscapeString($cryptedArray['data']) . "',
                    '" . $db->RealEscapeString($cryptedArray['iv']) . "'
                    );";
        $db->insert($query) or die($db->error);
        $this->page->redirect('/index.php');
    }

    $query = "SELECT * FROM `safes` WHERE `id_user` = " . $this->user->id . " AND `id_parent` IS NULL";
    $db->select($query);
    $resourses = $db->result;

    $this->page->render('safes', array('resourses' => $resourses));
}