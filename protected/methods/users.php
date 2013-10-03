<?php

if ($this->user->is_guest) {
    $this->page->setFlash('error', 'Доступ запрещен');
    $this->page->setHeader('403');
    $this->page->redirect('/index.php');
}
$this->page->setTitle('Пользователи');
// если пришла форма поиска
if ($_POST['search']['name'] && $_POST['search']['name'] != '') {

    $rdb = new rdb;

    $query = "SELECT
			`u`.`id` AS `id`,
			`u`.`name` AS `name`,
			`g`.`name` AS `group`
			FROM `users` `u`, `groups` `g`			
			WHERE `u`.`grp` = `g`.`id`
			AND 
			(
				`u`.`name` LIKE '%" . addslashes($_POST['search']['name']) . "%'
			OR
				`u`.`id` = '" . addslashes($_POST['search']['name']) . "'
			OR
				`u`.`login` LIKE '%" . addslashes($_POST['search']['name']) . "%'
			OR
				`g`.`name` LIKE '%" . addslashes($_POST['search']['name']) . "%'
			)
			;";
    $rdb->query($query);

    $this->page->render('users', $rdb->result);
}
else
    $this->page->render('users');