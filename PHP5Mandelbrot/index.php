<?php
set_time_limit(0);
header("Location: mandelbrot.php");
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Макет 3 колонки</title>
        <link href="css/style.css" rel="stylesheet"> 
        <!-- <script src="js/scrypt.js"></script> -->
    </head>
    <body>
    <header class="header">Гончаров Федор, ПИН-31</header>
	<div class="layout">
		<aside class="leftCol"><Br></aside>
		<aside class="rightCol"><Br></aside>
		<div class="centerCol">
            <form method="post">
                Логин: <input type="text" name="user" /><br />
                Пароль: <input type="password" name="pass" /><br />
                <input type="submit" name="submit" value="Войти" />
            </form>
                </div>
        </div>
        <footer class="footer">НИУ МИЭТ</footer>	
	</body>
</html>