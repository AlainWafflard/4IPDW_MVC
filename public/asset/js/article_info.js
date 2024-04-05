$( function() {

    // URL du serveur
    var server_url = '';

    // évènements permettant l'affichage d'info complémentaire sur l'article
    $('article.side').mouseover(function() {
        // console.log("mouseover");
        const param = {
            page 		: "article_info_ajax",
            id 		    : $(this).attr('for') ,
        };
        $.post( server_url, param, function(html_code) {
            $('aside#article_info').html(html_code);
        }, "html" );
    } );

    $('article.side').mouseout(function() {
        $('aside#article_info').html("");
    } );

});
