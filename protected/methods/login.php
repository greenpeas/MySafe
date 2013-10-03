<?php
// если юзер не гость, то уводим его отсюда
        if (!$this->user->is_guest)
            $this->page->redirect('/index.php');
        // если прислана форма авторизации
        if (!empty($_POST['user'])) {
            if ($this->user->authUser($_POST['user']['login'], $_POST['user']['pass']))
                if (!$this->user->key)
                    $this->page->redirect('/key');
                else
                    $this->page->redirect('/index.php');
            else
                $this->page->setFlash('error', 'Неверная пара логина и пароля');
        }
        //$this->page->setLayout('login');
        $this->page->render('login');