<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<base href="/">
		<title><?php echo $this->title; ?> :: Безопасное хранение паролей онлайн</title>
		
		<link rel="icon" href="/ico.png" type="image/x-icon">
		<link rel="shortcut icon" href="/ico.png" type="image/x-icon">
		
                <script src="js/jquery-1.10.2.min.js" type="text/javascript"></script>
		
		<!-- Bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<script src="bootstrap/js/bootstrap.min.js"></script>

		<!-- CSS files -->
		<link href="/css/style.css?v=2" rel="stylesheet" type="text/css">
                
                <?php echo $this->getcss(); ?>

	</head>
	<body>
    <div style="height:40px;"></div>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target="#yii_bootstrap_collapse_0">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a href="/" class="brand">Мой сейф</a>
                <div class="nav-collapse" id="yii_bootstrap_collapse_0">
                    <ul id="yw0" class="nav">
                        
                        
                        <?php
                                if($this->user->is_guest) echo '<li class="active"><a href="/">Главная</a></li>';
                                else echo '
                                    <li class="active"><a href="/">Мои сейфы</a></li>
                                    ';
                        ?>
                        
                        
                        
                        <li><a href="/page?view=about">О проекте</a></li>
                        <li><a href="/contact">Обратная связь</a></li>
                    </ul>
                    <ul class="pull-right nav" id="yw1">
                        <?php
                                if($this->user->is_guest) echo '<li><a tabindex="-1" href="/login">Вход</a></li>';
                                else echo '
                                    <li><a tabindex="-1" href="/key">Изменить ключ</a></li>
                                    <li><a tabindex="-1" href="/logout">Выход</a></li>
                                    ';
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>


<!-- user panel -->

<!-- user panel end -->

<!-- flash -->
<?php if($this->flash) { ?>
	<div class="error_flash"><?php echo $this->showFlash(); ?></div>
<?php } ?>		
<!-- flash  end -->

<!-- content layout -->
<div class="content-layout">
	<div class="content">
		<h2><?php echo $this->title; ?></h2>
		<?php echo $this->html; ?>
		
	</div>
	<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
<!-- content layout end-->

		<div class="footer"><footer><hr>Powered by <a href="http://artyomovanton.ru" target="_blank">Artyomov Anton</a><br>© 2013-<?php echo date('Y');?> <br><?php echo $this->gentime; ?> сек. / Скушано памяти: <?php echo round(memory_get_peak_usage()/(1024*1024),2)."MB"?></footer></div>
    <script type="text/javascript">
        /*<![CDATA[*/
        $(function($) {
            $('#yii_bootstrap_collapse_0').collapse({'parent':false,'toggle':false});
            $('body').tooltip({'selector':'a[rel=tooltip]'});
            $('body').popover({'selector':'a[rel=popover]'});
        });
        /*]]>*/
    </script>
    <script src="js/footer.js"></script>
    </body>
</html>