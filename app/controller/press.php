<?php


/**
 * traiter (GET...) et retourner la liste de favoris
 * @return array
 */
function ctrl_process_fav_form()
{
    $sep = '|';
    switch(APP_FAVORITE_ARCH) {
        case "form":
            $fav_s = $_COOKIE['favorite'] ?? "";
            $fav_l = explode( $sep, $fav_s);
            break;
        case "ajax":
            $fav_l = $_SESSION['favorite'];
            break;
    }

    if(isset($_GET['add_favorite']))
    {
        // on ajoute un article aux favoris
        //        $_SESSION['favorite'][] = $_GET["art_id"];
        $fav_l[] = $_GET["art_id"];
    }
    elseif (isset($_GET['del_favorite']))
    {
        // foreach( $_SESSION['favorite'] as $i =>  $fav )
        foreach( $fav_l as $i =>  $fav )
        {
            if( $fav == $_GET["art_id"] )
            {
                // unset($_SESSION['favorite'][$i]);
                unset($fav_l[$i]);
            }
        }
    }
    // $_SESSION['favorite'] = array_unique($_SESSION['favorite']);

    $fav_l = array_unique($fav_l);

    switch(APP_FAVORITE_ARCH) {
        case "form":
            $fav_s = implode( $sep, $fav_l);
            setcookie('favorite', $fav_s, time()+3600*24*30 );
            break;
        case "ajax":
            $_SESSION['favorite'] = $fav_l;
            break;
    }

    return $fav_l;
}

function main_press()
{
    // traitement éventuel des favoris
    $fav_l = ctrl_process_fav_form();

    // traitement du thème
    // $_SESSION['theme'] = $_SESSION['theme'] ?? 'default';
    if(isset($_POST['b_select_theme']))
    {
        $_SESSION['theme'] = $_POST['theme'];
    }

    // étape 2 : breaking news
    $breaking_art = get_breaking_article();
    $breaking_art_html = html_breaking_article($breaking_art);

    // étape 3 : articles sur le côté
    $side_art = get_side_article();
    $side_art_html = html_listing_article($side_art, $fav_l);

    return join( "\n", [
        ctrl_head(),
        $breaking_art_html,
        $side_art_html,
        html_foot(),
    ]);
}


function main_favorite()
{
    // traitement éventuel des favoris
    $fav_l = ctrl_process_fav_form();

    // listing des articles favoris
    $fav_art = get_fav_article($fav_l);
    $side_art_html = html_listing_article($fav_art, $fav_l, "main", "favorite");

    return join("\n", [
        ctrl_head(),
        $side_art_html,
        html_foot(),
    ]);
}


function main_favorite_ajax()
{
    // créer panier par défaut (vide, évidemment)
    if (empty($_SESSION['favorite'])) {
        $_SESSION['favorite'] = array();
    }

    if (isset($_POST['action']) and $_POST['action'] == "delete_all_favorites") {
        $_SESSION['favorite'] = array();
    }

// on enlève un élément du panier
    if (isset($_POST['action']) and
        $_POST['action'] == "del_favorite" and
        !empty($_POST['fav_id']) and
        in_array($_POST['fav_id'], $_SESSION['favorite'])) {
        foreach ($_SESSION['favorite'] as $i => $v) {
            if ($v == $_POST['fav_id']) {
                unset($_SESSION['favorite'][$i]);
            }
        }
    }

// si action = ajouter un produit au panier
// ajouter un élément au panier
    if (isset($_POST['action']) and
        $_POST['action'] == "add_favorite" and
        ! empty($_POST['fav_id'])) {
        // on ajoute $_POST['product_id'] à SESSION
        $_SESSION['favorite'][] = $_POST['fav_id'];

        // si l'utilisateur a cliqué deux fois sur le même produit
        // alors SESSION ne dédouble pas le nom du produit.
        $_SESSION['favorite'] = array_unique($_SESSION['favorite']);
    }

    // et puis le tableau est trié
    sort($_SESSION['favorite']);
    // conversion JSON
    $favorite_json = json_encode($_SESSION['favorite']);
    return $favorite_json;
}

