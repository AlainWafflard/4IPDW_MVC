<?php

function html_menu($data_a)
{
    //    ob_start();
    // var_dump($data_a);
    $out = "<ul>";
    foreach( $data_a as $menu_item )
    {
        $title = $menu_item[0];
        $component = $menu_item[1];
        $subcomponent = $menu_item[2];
        $url = <<< HTML
            <li>
                <a href="?page=$component&subpage=$subcomponent">$title</a>            
            </li>
HTML;
        $out .= $url;
    }
    $out .= "</ul>";
    //    ob_get_clean();
    return $out;
}
