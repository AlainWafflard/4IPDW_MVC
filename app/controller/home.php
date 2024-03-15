<?php

/**
 * paramétrage de l'identification : soit déjà identifié, soit non identifié
 * @return array
 */
function get_identification()
{
	// identification par défaut
	$user = $role = "inconnu";
	$login_display = true;// true : afficher lien pour login (false : logout)

	// Quoi afficher en rapport avec le login
	if (isset($_SESSION['id']))
	{
		// l'utilisateur est déjà identifié
		// login_print($_SESSION['id']);
		$user = $_SESSION['id'];
		$role = @$_SESSION['role'];
		$login_display = false;
	}

	return array( $user, $role, $login_display );
}

function main_home()
{
	list( $user, $role, $login_display ) = get_identification();

	return join( "\n", [
		ctrl_head( ),
		html_body($user, $role),
		$login_display ? html_login_button() : html_logout_button(),
		html_foot(),
	]);

}

function main_search()
{
    // traitement éventuel des favoris
    $fav_l = ctrl_process_fav_form();

    // listing des articles favoris
    $search_art = get_searched_article($_GET['search_kw']);
    $side_art_html = html_listing_article( $search_art, $fav_l, "main" );

    return join( "\n", [
        ctrl_head(),
        $side_art_html,
        html_foot(),
    ]);
}

