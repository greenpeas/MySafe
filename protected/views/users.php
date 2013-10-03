<form id="custom-search-form" class="form-search form-horizontal pull-right" method="post" action="">
    <div class="input-append span12" style="margin-left:0;">
        <input type="text" style="width: 250px;" class="search-query" placeholder="Поиск по ID, логину, ФИО, группе" name="search[name]" value="<?php echo ($_POST['search']['name'])?$_POST['search']['name']:''; ?>">
        <button type="submit" class="btn"><i class="icon-search"></i></button>
    </div>
</form>
<br /><br />
    <div class="monitor-row-head">
        <div class="monitor-td" style="width:50px;">id</div>
        <div class="monitor-td" style="width:300px;">Пользователь</div>
        <div class="monitor-td" style="width:120px;">Группа</div>
        <div class="monitor-td" style="width:360px;">Действия</div>

        <div style="clear:both;"></div>
    </div>

<?php

if($data){
	$c = 0;
	foreach($data AS $item){
		
		?>
		<div class="monitor-row<?php echo ($c%2)?' gray':''; ?>">
			<div class="monitor-td" style="width:50px;color:#c0c0c0;">#<?php echo $item['id']; ?></div>			
			<div class="monitor-td" style="width:300px;"><?php echo $item['name']; ?></div>
			<div class="monitor-td" style="width:120px;"><?php echo $item['group']; ?></div>
			
			<div class="monitor-td" style="width:120px;"><a href="/seminar?user=<?php echo $item['id']; ?>" title="Семинары">Семинары</a></div>
			
			<div class="monitor-td" style="width:120px;"><a href="/testresults?user=<?php echo $item['id']; ?>" title="Результаты тестирований">Результаты тест</a></div>

			<div class="monitor-td" style="width:120px;"><a href="/test?user=<?php echo $item['id']; ?>" title="Пройти тест">Пройти тест</a></div>	

			
			<div style="clear:both;"></div>
		</div>
		<?php	
		$c++;
	}
	echo "Всего: ".$c;
	
}