<?php include 'session.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Заказ блюд</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" media="screen" />
    <script type="text/javascript" src="js/tetris.js"></script>
 </head>

 <body>
    <div class="container-fluid">
        <div class="page-header">
            <h1>Вкусняшки для толстяшки</h1>
        </div>
        <div class="row-fluid">
            <div class="span2">
                <h5>Вкусняшки едут прямо к вам, надо лишь выбрать и заказать!</h5>
                <ul class="nav nav-list">
                    <li class="active"><a href="index.php">Всё меню</a></li>
                    <?php include 'menu.php'; ?>
                    <!--li class="divider"></li>     
                    <ul class="nav nav-list">
                        <li class="nav-header">Кухни</li>
                        <ul class="nav nav-list">
                            <li><a href="index.php?cat=3">Европейская</a></li>
                            <li><a href="index.php?cat=4">Азиатская</a></li>
                            <ul class="nav nav-list">
                                <li><a href="index.php?cat=5">Японская</a></li>
                                <li><a href="index.php?cat=6">Китайская</a></li>                            
                                <li><a href="index.php?cat=7">Корейская</a></li>
                            </ul> 
                        </ul>                       
                        <li class="divider"></li>     
                        <li class="nav-header">Блюда</li>
                        <ul class="nav nav-list">                            
                            <li><a href="index.php?cat=8">Суши и роллы</a></li>
                            <li><a href="index.php?cat=10">Пицца</a></li>
                            <li><a href="index.php?cat=11">Салаты и холодные закуски</a></li>
                            <li><a href="index.php?cat=12">Супы</a></li>
                            <li><a href="index.php?cat=13">Вторые блюда</a></li>
                            <li><a href="index.php?cat=14">Гарниры</a></li>                        
                        </ul-->
                        <li class="divider"></li>     
                        <?php                     
                            ////  check session  ////   
                            if (!$GLOBALS['login']):?>
                        <li><a href="reg.php">Зарегистрироваться</a></li>
                        <li><a href="auth.php">Войти</a></li>             
                        <?php else: ?>
                        <li>Здравствуйте, <?=$_SESSION['user']?></li>
                        <p><a href="index.php?logout=1" class="btn btn-default" role="button">Выйти</a></p>
                        <?php endif;?>
                        <li class="divider"></li>
                    </ul>
                </ul>
            </div>
            <div class="span9 offset1">
            <div><h3>Доставка еды</h3></div>
                <?php       
           
                include 'config.php';
                require 'functions.php';
                mysql_connect(DB_HOST, DB_USER, DB_PASS);
                mysql_select_db(DB_NAME);
                $cat = $_GET['cat'];
                if (is_null($cat)) $cat = 1;
                $page = $_GET['page'];
                if (is_null($page)) $page = 0;
                $perpage = 6;
                $start = $page * $perpage;
                
                
                $dishlist = genList($cat, $page, $start, $perpage);
                

                ////////////////////////////////////////////////////////
                echo $dishlist;
                                    // Table         //
                ////////////////////////////////////////////////////////

                ?>
        </div>
    </div>
</body>
</html>