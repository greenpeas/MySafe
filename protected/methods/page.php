<?php

if (!empty($_GET['view'])) {

    $db = new db;
    $query = "
        SELECT * FROM `pages` WHERE `alias` LIKE '" . $db->RealEscapeString($_GET['view']) . "'
;";
    
    $page = $db->select($query);

    if (!empty($page)) {

        $this->page->render('page', array(
            'page' => $page,
                )
        );
    }
} else {
    $this->page->setHeader('404');
    $this->page->render('404');
}