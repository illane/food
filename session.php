<?php

	include 'config.php';
	mysql_connect(DB_HOST, DB_USER, DB_PASS);
    mysql_select_db(DB_NAME);
	session_start();

	if ($_GET['logout'] == 1)
	{
		unset($_SESSION['user']);
	}
	else
	{
		$GLOBALS['login'] = false;
		if ($_SESSION['user'] != NULL)
		{
			$string = 'SELECT * from users WHERE username = "' . $_SESSION['user'] . '"';
			$result = mysql_query($string);
			$a_user = mysql_fetch_assoc($result);
		    $GLOBALS['login'] = !empty($a_user);
		}
	}
?>