<?php $this->setTitle('Регистрация пользователя'); ?>
<div style="text-align:center; width:100%;">
    Имейте в виду, сестема не имеет возможности восстановления пароля. Система не хранит ваш логин и пароль.

    <div style="margin:10px auto; width:300px;">
        <div class="well">
            <legend>Регистрация</legend>
            <form method="POST" action="" accept-charset="UTF-8">
                <?php if ($this->flash) { ?>
                    <div class="alert alert-error">
                        <a class="close" data-dismiss="alert" href="#">x</a><?php echo $this->showFlash(); ?>
                    </div>
                <?php } ?>
                <input class="span3" id="username" placeholder="Логин" type="text" name="user[login]">
                <input class="span3" placeholder="Пароль" type="password" name="user[pass]">
                <input class="span3" placeholder="Повтор пароля" type="password" name="user[pass_confirm]">
                <button class="btn-info btn" type="submit">Зарегистрироваться</button>
            </form>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#username').focus();
    });
</script>