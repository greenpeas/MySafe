<?php

if (!$this->user->is_guest AND !$this->user->key AND $_SERVER['REQUEST_URI'] != '/key' AND $_SERVER['REQUEST_URI'] != '/logout'
)
    $this->page->redirect('/key');
else
    return true;