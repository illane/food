<?php 
                            include 'config.php';
                            require 'functions.php';
                            mysql_connect(DB_HOST, DB_USER, DB_PASS);
                            mysql_select_db(DB_NAME);
                            if ($GLOBALS['login'])
                            {
                            	header('Location: index.php');		
                            }

                            $pass = $_POST['password'];
                            $user = $_POST['username'];
                            if (!is_null($user))
                            {
                                $pass = md5($pass);
                                $result = mysql_query(
                                    'SELECT * from users
                                    WHERE username ="' . $user . '" AND pass = "' . $pass . '"');
                                $a_user = mysql_fetch_assoc($result);
                                if (empty($a_user))
                                {
                                	echo '<script>alert("Неправильное имя пользователя или пароль")</script>';       
                                }
                                else
                                {
                                	//// new session ////
                                	session_start();
                                	$_SESSION['user'] = $user;
                                	header('Location: index.php');	
                                }
                            }
                        ?>
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
	<form id="auth-form" action="auth.php" method="post">            
        <div class="input-bloc w1">
            <label for="username">Логин</label> <input id="username" name="username" size="25" type="text" />
            <div class="error-box">&nbsp;</div>
        </div>
        <div class="input-bloc w1">
            <label for="password">Пароль:</label> <input id="password" name="password" size="25" type="password" />
            <div class="error-box">&nbsp;</div>
        </div>    
        <div>
            <input id="send" type="submit" name="proceed" value="Войти" />
        </div>
    </form>
    </div>

</body>
</html>