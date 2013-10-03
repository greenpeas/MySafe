<?php

if (!$this->user->is_guest)
    $this->page->redirect('/main');

if (!empty($_POST['user'])) {

    $errors = array();

    if (empty($_POST['user']['login']))
        $errors[] = 'Не заполнено поле логина';
    if (empty($_POST['user']['pass']))
        $errors[] = 'Не заполнено поле пароля';
    if ($_POST['user']['pass'] != $_POST['user']['pass_confirm'])
        $errors[] = 'Пароль и подтверждение пароля не совпадают';
    
    $sha256 = hash('sha256', hash('sha256', $_POST['user']['login']) . hash('sha256', $_POST['user']['pass']));
    
    $db = new db;
    $query = "SELECT `id` FROM `users` WHERE `user` LIKE '" . $sha256 . "';";
    if($db->select($query)) $errors[] = 'Что то не так, но это большой секрет.';

    if ($errors) {
        $this->page->setFlash('error', implode($errors, '<br>'));
        $this->page->redirect('/reg');
    } else {
        
        
        $query = "INSERT INTO `users` (`user`) VALUES ('" . $sha256 . "');";
        $db->insert($query);

        $this->page->setFlash('info', 'Вы успешно зарегистрировались');
        $this->page->redirect('/login');
    }
}


$this->page->render('reg');