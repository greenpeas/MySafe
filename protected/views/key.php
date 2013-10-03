<?php $this->setTitle('Редактирование секретного ключа'); ?>

<p>
<i>Имейте в виду, что ключ применяется как для шифрования, так и для расшифровки.
Если Вы зашифруете данные ключем «бла-бла», то и расшифровывать данные нужно именно этим ключем «бла-бла».
Во время сессии, ключ может быть изменен. Разные сейфы и документы можно шифровать разными ключами.
</i>
</p>

    
        <form method="POST" action="" accept-charset="UTF-8">
            <input class="span3" id="key" placeholder="Секретный ключ" type="text" name="key" style="margin: 0"
                   value="<?php echo ($this->user->key) ? $this->user->key : ''; ?>">
            <button class="btn-info btn" type="submit">Применить</button>      
        </form>  
        



<script type="text/javascript">
	$( document ).ready(function(){
		$('#key').focus();
	});	
</script>