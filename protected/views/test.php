<select id="change_sem">
<option value="0">Все семестры</option>
<?php
$semesters = array();
foreach($data['semesters'] AS $itemsem){
	$semesters[$itemsem['sem']] = $itemsem['sem'];
}
foreach($semesters AS $sem){
	echo '<option value="'.$sem.'"'.(($_GET['sem'] == $sem)?' selected':'').'>'.$sem.'</option>';
}
unset($data['semesters']);
unset($itemsem);
?>
</select>



<?php
//Тест

if($data['tests']){
	$c = 0;
    ?><br /><br />
    <div class="monitor-row-head">
        <div class="monitor-td" style="width:50px;">id</div>
        <div class="monitor-td" style="width:300px;">Дисциплина</div>
        <div class="monitor-td" style="width:60px;">Семестр</div>
        <div class="monitor-td" style="width:70px;">Отчетность</div>
        <div class="monitor-td" style="width:60px;">Результат</div>
        <div class="monitor-td" style="width:60px;">Израсход попыток</div>
        <div class="monitor-td" style="width:60px;">Пройти</div>

        <div style="clear:both;"></div>
    </div>

    <?php
	foreach($data['tests'] AS $item){
		?>
		<div class="monitor-row<?php echo ($c%2)?' gray':''; ?>">
			<div class="monitor-td" style="width:50px; color:#c0c0c0;">#<?php echo $item['id']; ?></div>
            <div class="monitor-td" style="width:300px;"><?php echo $item['disc_name']; ?></div>
            <div class="monitor-td" style="width:60px; color:#c0c0c0;"><?php echo $item['sem']; ?> сем</div>
            <div class="monitor-td" style="width:70px; color:#c0c0c0;"><?php echo $item['otchetnost']; ?></div>
            <div class="monitor-td" style="width:60px; color:#c0c0c0;"><?php echo ($item['result'])?$item['result'].'/20':' - '; ?></div>
            <div class="monitor-td" style="width:60px; color:#c0c0c0;"><?php echo $item['popit']; ?></div>
            <div class="monitor-td" style="width:60px;">
                <a href="#" id="<?php echo $item['id']; ?>" dis="<?php echo $item['disc_id']; ?>" sem="<?php echo $item['sem']; ?>" class="gotest">пройти</a>
            </div>


			<div style="clear:both;"></div>
		</div>
		<?php
		$c++;
	}
	echo "Всего: ".count($data['tests']);
}

?>

<div class="g-hidden">
    <div class="box-modal" id="Modal">
        <div class="box-modal_close arcticmodal-close">закрыть</div>
        <div id="loading" style="display:none;"><img src="/images/load.gif"> Проверяется доступ к сессии по данной дисциплине</div>
        <div id="status" style="display: none;"></div>

        <div id="divform" style="display:none;">
        <form action="" method="post">
            <input type="text" name="ansdate" id="ansdate" readonly placeholder="Дата сдачи" style="cursor:pointer;"><br />
            Сколько нужно набрать баллов:
            <select name="prav">
                <?php for($i=1; $i<=20;$i++) echo '<option value="'.$i.'">'.$i.'</option>'; ?>
            </select>

            <input type="hidden" name="rasp_id" id="frasp_id">

            <br /><br />
            <input type="submit" class="btn btn-success" value="Начать автотестирование">
        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    var dis;
    var rasp;
    var sem;
    $('.gotest').click(function() {

        dis = $(this).attr('dis');
        sem = $(this).attr('sem');
        rasp = this.id;

        $('#frasp_id').val(rasp);

        $('#divform').hide();
        $('#status').hide();

        $('#Modal').arcticmodal({
            openEffect: { speed: 100 },
            closeEffect: { speed: 100 },
            closeOnEsc: true,
            closeOnOverlayClick: false,
            afterOpen:function(){
                $('#loading').show();

                $.ajax({
                    url: '/sessiya-dostup',
                    dataType : 'json',
                    data:{ 'user_id': <?php echo $_GET['user'] ?>,'dis_id':dis,'rasp_id':rasp},
                    success: function (data) {
                        $('#loading').hide();
                        if(data[0].text == 0){
                            $('#status').html('По данной дисциплине нет допуска. <a href="/seminar?user=<?php echo $_GET['user'] ?>&sem='+sem+'">Перейти к автозачетам</a>');
                            $('#status').show();
                            return false;
                        }
                        else {
                            $('#status').hide();
                            $('#divform').show();
                        }

                    }
                });

            }
        });
        return false;
    });

    Calendar.setup({
        trigger    : "ansdate",
        inputField : "ansdate",
        dateFormat: "%Y-%m-%d %H:%M:%S"
    });

	$('#change_sem').change(function(){
		//alert(this.value);
		location="/test?user=<?php echo $_GET['user']; ?>&sem="+this.value;
	});



    $('form').submit(function(){


        if($('#ansdate').val() == ''){
            alert('Поставьте дату');
            return false;
        }
    });


</script>