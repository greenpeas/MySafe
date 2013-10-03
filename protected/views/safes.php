<?php
$this->setTitle('Мои сейфы');
$this->regcss('/css/safes.css');
?>
<a href="#modal" class="btn btn-success" role="button" data-toggle="modal">Создать сейф</a><br /><br />

<?php
if (!empty($data['resourses']))
    foreach ($data['resourses'] AS $safe) {
        ?>
        <div class="safebox">
            <div class="safename">
                <a href="/safe?id=<?php echo $safe['id']; ?>"><?php echo Crypt::decode($this->user->loginKey, $safe['name'], $safe['iv']); ?>
                <br/>
                <img src="images/safe.jpg" style="height:180px;">
                </a>
                
            </div>
        </div>
        <?php
    }
else
    echo 'У Вас еще нет ни одного ресурса';
?>
<div id="modal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2>Создание сейфа</h2>
    </div>
    <form method="POST" action="" class="form-horizontal" style="padding: 0;">
        <div class="modal-body">
            <div class="control-group">
                <label for="res_name" class="control-label">Название</label>
                <div class="controls">
                    <input type="text" name="name" id="res_name" placeholder="Название сейфа" autocomplete="off" style="margin:0;">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" value="Создать" class="btn btn-success">
        </div>
    </form>
</div>

