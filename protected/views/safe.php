<?php
$this->setTitle('Сейф «' . $data['safe_name'] . '»');
$this->regcss('/css/safes.css');
?>
<a href="#modal2" class="btn btn-success" role="button" data-toggle="modal">Создать сейф</a>
<a href="#modal" class="btn btn-success" role="button" data-toggle="modal">Создать документ</a><br /><br />


<h3>Сейфы</h3>
<?php
if (!empty($data['safes'])) {
    foreach ($data['safes'] AS $safe) {
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
}
else
    echo 'В сейфе нет еще ни одного сейфа';
?>

<h3 style="clear:both;">Документы</h3>
<?php
if (!empty($data['documents'])) {
    foreach ($data['documents'] AS $doc) {
        ?>
        <div class="safebox">
            <div class="safename">
                <a href="/doc?id=<?php echo $doc['id']; ?>"><?php echo Crypt::decode($this->user->loginKey, $doc['name'], $doc['iv']); ?>
                <br/>
                <img src="images/doc.jpg" style="height:180px;">
                </a>
            </div>
        </div>
        <?php
    }
}
else
    echo 'В сейфе нет еще ни одного документа';
?>




<div id="modal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2>Создание документа</h2>
    </div>	
    <div class="modal-body">
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Название документа" style="margin:0;">
            <input type="submit" value="Создать" class="btn btn-success">
        </form>
    </div>
</div>


<div id="modal2" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h2>Создание сейфа</h2>
    </div>	
    <div class="modal-body">
        <form method="POST" action="">
            <input type="text" name="safe_name" placeholder="Название сейфа" style="margin:0;">
            <input type="submit" value="Создать" class="btn btn-success">
        </form>
    </div>
</div>
