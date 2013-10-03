<?php
$this->setTitle('Документ «' . $data['doc_name'] . '»');
$this->regcss('/css/safes.css');
?>
<a href="#modal" class="btn btn-success" role="button" data-toggle="modal">Создать поле</a>



<h3>Поля</h3>
<?php
if (!empty($data['fields'])) {
    foreach ($data['fields'] AS $field) {
        ?>
        
            <div class="safename">
                <b><?php echo Crypt::decode($this->user->loginKey, $field['name'], $field['iv']); ?>:</b>
                <?php echo Crypt::decode($this->user->loginKey, $field['value'], $field['iv']); ?>
            </div>
        
        <?php
    }
}
else
    echo 'Поля в данном документе отстутствуют. Вы можете <a href="#modal" role="button" data-toggle="modal">создать</a> поле.';
?>



<div id="modal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2>Создание поля</h2>
    </div>	
    <div class="modal-body">
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Название поля" style="margin:0;">
            <input type="text" name="value" placeholder="Значение поля" style="margin:0;">
            <input type="submit" value="Создать" class="btn btn-success">
        </form>
    </div>
</div>


