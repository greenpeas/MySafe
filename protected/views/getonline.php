<div class="monitor-row-head">
        <div class="monitor-td" style="width:50px;">id</div>
        <div class="monitor-td" style="width:300px;">Пользователь</div>
        <div class="monitor-td" style="width:120px;">Группа</div>
        <div class="monitor-td" style="width:300px;">Положение</div>
		<div class="monitor-td" style="width:100px;">ip</div>
        
		<div style="clear:both;"></div>
    </div>
<?php
if(count($data)){
	$c = 0;
	foreach($data AS $item){
		
		?>
		<div class="monitor-row<?php echo ($c%2)?' gray':'';?>"
			style="
			<?php echo ($item['group_id'] == 1 || $item['group_id'] == 6)?'color:#FF0000;':'' ?>
			<?php echo ($item['group_id'] == 3)?'color:#3399ff;':'' ?>
			<?php echo ($item['group_id'] == 2)?'color:#00aa2b;':'' ?>
			">
			<div class="monitor-td" style="width:50px;color:#c0c0c0;">#<?php echo $item['user_id']; ?></div>			
			<div class="monitor-td" style="width:300px;"><?php echo $item['name']; ?></div>
			<div class="monitor-td" style="width:120px;"><?php echo $item['group_name']; ?></div>
			<div class="monitor-td" style="width:300px;"><?php echo $item['location']; ?></div>
			<div class="monitor-td" style="width:100px;"><a href="http://ipgeobase.ru/?address=<?php echo $item['ip']; ?>" target="_blank"><?php echo ip_to_city($item['ip']); ?></a></div>
			<div style="clear:both;"></div>
		</div>
		<?php	
		$c++;
	}
	echo '<div style="padding:5px; color:#acacac;">Всего: '.$c.'</div>';
}

function ip_to_city($ip) {

	switch($ip)	{
		case '83.239.114.250': $city = "<b>Черкесск</b>"; break;
		case '85.173.189.86': $city = "<b>Черкесск</b>"; break;
		case '212.96.114.50': $city = "<b>Невинномысск</b>"; break;
		case '85.172.186.122': $city = "<b>Зеленчук</b>"; break;
		case '85.172.186.31': $city = "<b>Зеленчук</b>"; break;
		case '212.176.49.193': $city = "<b>Михайловск</b>"; break;
		case '62.183.49.74': $city = "<b>Михайловск</b>"; break;
		case '62.183.91.235': $city = "<b>Садовое</b>"; break;
		case '195.161.7.26': $city = "<b>Донское</b>"; break;
		case '84.54.199.213': $city = "<b>Красногвардейское</b>"; break;
		case '192.168.60.52': $city = "<b>Фоменко Т.В.</b>"; break;
		case '192.168.60.51': $city = "<b>Марченко Н.П.</b>"; break;
		case '192.168.60.53': $city = "<b>Рахманина Ю.А.</b>"; break;
		case '192.168.60.54': $city = "<b>Дулина А.В.</b>"; break;
		case '192.168.60.56': $city = "<b>Артемов А.Ю.</b>"; break;
		case '84.54.247.102': $city = "<b>КАНДАУРОВА Н.В.</b>"; break;
        case '94.255.111.158': $city = "<b>Кандаурова (домашний)</b>"; break;
		case '77.39.119.156': $city = "<b>Вова (Экситон)</b>"; break;


		
		
		case '195.209.244.7': $city = "<b>СевКавГТУ</b>"; break;
		case '192.168.65.65': $city = "<b>Уважаемый и горяче любимый Админ Лихачев С.А.</b>"; break;
		case '192.168.65.40': $city = "<b>Лихачев С.А.</b>"; break;
		case '192.168.65.31': $city = "<b>Лихачев С.А. с линукса</b>"; break;
		case '192.168.65.11': $city = "<b>Савченко Е.П.</b>"; break;
		case '192.168.65.75': $city = "<b>Савченко Е.П.</b>"; break;
        case '213.222.234.50': $city = "<b>ЗЕЛЕНАЯ ТОЧКА СевКавГТИ</b>"; break;
		
		default: $city = $ip;
	}
	
	if(substr_count($ip, '192.168.61')) $city = "<b>Компьютерные классы</b>";
	elseif(substr_count($ip, '192.168.64')) $city = "<b>Приемная комиссия</b>";
	
	

	return $city;
}