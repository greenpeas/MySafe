<?php

if ($this->user->is_guest) {
    $this->page->setFlash('error', 'Доступ запрещен');
    $this->page->setHeader('403');
    $this->page->redirect('/index.php');
}

$rdb = new rdb;

$query = "SELECT
                        `session`.`login` AS `login`,
                        `session`.`loc` AS `location`,
                        `session`.`ip` AS `ip`,
                        `users`.`name` AS `name`,
                        `users`.`id` AS `user_id`,
                        `users`.`grp` AS `group_id`,
                        `groups`.`name` AS `group_name`
                  FROM `session`,`users`,groups
                  WHERE
                        `session`.`login` = `users`.`login`
                        AND `groups`.`id` = `users`.`grp`
		";

$rdb->query($query);
$json[] = array(
    'text' => $this->page->render('getonline', $rdb->result, 1),
);
echo json_encode($json);