<?php

/**
 * build <body>
 * @param $user
 * @param $role
 */
function html_body($user="inconnu", $role="inconnu")
{
	ob_start();
	?>
    <h2>
        HOME
    </h2>
    <p>
        Ceci est la home page
    </p>
    <p>
        Identification : user:<?=$user?>, rôle:<?=$role?>
    </p>
    <p>
        <form method="get">
            <input type="hidden" name="page" value="search">
            <input type="text" name="search_kw">
            <button type="submit" name="b_search">
                Chercher
            </button>
        </form>
    </p>
    <?php
	return ob_get_clean();
}

