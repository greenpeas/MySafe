<?php $this->setTitle('Авторизация пользователя'); ?>



    <div style="margin:100px auto; width:300px;">
      <div class="well">
        <legend>Вход в Веб приложение</legend>
        <form method="POST" action="" accept-charset="UTF-8">
            <?php if($this->flash) { ?>
				<div class="alert alert-error">
					<a class="close" data-dismiss="alert" href="#">x</a><?php echo $this->showFlash(); ?>
				</div> 
			<?php } ?>
            <input class="span3" id="username" placeholder="Логин" type="text" name="user[login]" autocomplete="off">
            <input class="span3" placeholder="Пароль" type="password" name="user[pass]">             
            <button class="btn-info btn" type="submit">Авторизоваться</button>      
        </form>  
        <a href="reg">Регистрация</a>
      </div>
    </div>





<!--
<div class="" id="loginModal" style="width:600px; margin:100px auto;">         
          <div class="modal-body">
            <div class="well">
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane active in" id="login">
                  <form class="form-horizontal" action='' method="POST">
                    <fieldset>
                      <div id="legend">
                        <legend class="">Вход</legend>
                      </div>    
                      <div class="control-group">
                        
                        <label class="control-label"  for="username">Логин</label>
                        <div class="controls">
                          <input type="text" id="username" name="user[login]" placeholder="" class="input-xlarge">
                        </div>
                      </div>
 
                      <div class="control-group">
                        
                        <label class="control-label" for="password">Пароль</label>
                        <div class="controls">
                          <input type="password" id="password" name="user[pass]" placeholder="" class="input-xlarge">
                        </div>
                      </div>
 
 
                      <div class="control-group">
                        
                        <div class="controls">
                          <button class="btn btn-success">Вход</button>
                        </div>
                      </div>
                    </fieldset>
                  </form>                
                </div>
            </div>
          </div>
        </div>
		-->
<script type="text/javascript">
	$( document ).ready(function(){
		$('#username').focus();
	});	
</script>