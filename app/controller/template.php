<?php

/**
 * retourne le header de la page web avec le menu
 * @return string
 */
function ctrl_head()
{
    $menu_a = get_menu_contents();
    return html_head($menu_a);
}

