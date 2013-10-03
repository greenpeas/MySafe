<?php

if ($this->user->is_guest) {
    $this->page->setFlash('error', 'Доступ запрещен');
    $this->page->setHeader('403');
    $this->page->redirect('/index.php');
}

if (!empty($_POST['key'])) {
    $this->user->setkey($_POST['key']);
    $this->page->redirect('/index.php');
}


$this->page->render('key');