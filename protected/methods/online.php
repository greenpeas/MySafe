<?php

if ($this->user->is_guest) {
    $this->page->setFlash('error', 'Доступ запрещен');
    $this->page->setHeader('403');
    $this->page->redirect('/index.php');
}
$this->page->setTitle('Мониторинг пользователей в реальном времени');
$this->page->render('online');