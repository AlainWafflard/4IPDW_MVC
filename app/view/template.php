<?php

function html_select_theme()
{
    ob_start();
    ?>
    <form method="post">
        <label>Choisissez votre theme</label>
        <select name="theme">
            <option value="default" selected>Sable</option>
            <option value="sky">Ciel</option>
        </select>
        <button name="b_select_theme">Envoyer</button>
    </form>
    <?php
    return ob_get_clean();
}


function html_head($menu_a=[], $theme="default")
{
    $debug = false;
    $theme_fn = "theme_{$theme}.css";
	ob_start();
	?>
	<html lang="fr">
	<head>
		<title>Press MVC</title>
        <link rel="stylesheet" href="bootstrap.css" />  <!-- lib externe -->
        <link rel="stylesheet" href="asset/css/main.css" /> <!-- lib interne / perso -->
        <link rel="stylesheet" href="asset/css/<?=$theme_fn?>" /> <!-- custom CSS -->
        <script
         src="https://code.jquery.com/jquery-3.4.1.js"
         integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
         crossorigin="anonymous"></script>
        <script src="asset/js/favorite.js"></script>
        <script src="asset/js/article_info.js"></script>
	</head>
	<body>
    <h1>
        France 24 (MVC)
        <!--<img src="./asset/media_general/icon3.png">-->
    </h1>
	<?php
    echo html_menu($menu_a);
    ?>
    <aside id="article_info">blabla</aside>
    <?php

	if($debug)
	{
        var_dump($_COOKIE);
		// var_dump($_SESSION);
        var_dump($_GET);
        //        var_dump($_POST);
	}
	return ob_get_clean();
}

function html_foot()
{
	ob_start();
	?>
        <hr />
    Favoris : <ul id="favorite_summary"></ul>
	</body>
	</html>
	<?php
	return ob_get_clean();
}

