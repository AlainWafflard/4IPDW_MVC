
/*
 * Mise à jour du panier à l'écran
 */
function display_cart(cart_data)
{
	console.log("display_cart");

	// on efface le panier actuel
	$("ul#favorite_summary").html("");

	// on recrée les balises <li>
	// boucle sur le panier avec string et méthode .html()
	s = '';
	// $.each(JSON.parse(cart_data), function( i, v ) {
	$.each(cart_data, function( i, v ) {
		s += "<li>" + v + "</li>"
	});
	$("ul#favorite_summary").html(s);

	// modifier apparence des boutons
	// 1) cacher tous les btn "del" et afficher tous les btn "add"
	$('button.del_favorite').css("display","none"); // ou visibility:hidden
	$('button.add_favorite').css("display","block"); // ou visibility:hidden
	// 2) afficher les btn "del" du panier, cacher les btn "add" ...
	$.each(cart_data, function( i, v ) {
		var sel = "button.del_favorite[for=\"" + v + "\"]";
		$(sel).css("display","block");
		var sel = "button.add_favorite[for=\"" + v + "\"]";
		$(sel).css("display","none");
	});
}

/*
 * au chargement de la page
 */
$( function() {

	// URL du serveur
	var server_url = '';

	// évènement associé aux boutons
	$('button.add_favorite').click(function() {
		// alert('button clicked' + $(this).attr('for') );
		var param = {
			page 		: "favorite_ajax",
			fav_id 		: $(this).attr('for') ,
			action		: "add_favorite"
		};
		$.post( server_url, param, display_cart, "json" );
		// modifie affichage des boutons
	});

	$('button.del_favorite').click(function() {
		// alert('button clicked' + $(this).attr('for') );
		var param = {
			page 		: "favorite_ajax",
			fav_id 		: $(this).attr('for') ,
			action		: "del_favorite"
		};
		$.post( server_url, param, display_cart, "json" );
	});

	$('button.delete_all_favorites').click(function() {
	   var param = {
		   page 		: "favorite_ajax",
		  action: "delete_all_favorites",
	   };
	   $.post( server_url, param, display_cart, "json" );
	});

	// afficher le panier au chargement de la page
	const param = {
		page 		: "favorite_ajax",
	};
	$.post( server_url, param, display_cart, "json" );

});

