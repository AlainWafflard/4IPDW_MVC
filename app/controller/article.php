<?php

function main_article()
{
    $id = $_GET['id'];

    $article_a = get_article($id);
    $html_article = html_article($article_a);

    return join( "\n", [
        ctrl_head( ),
        $html_article,
        html_foot(),
    ]);

}

function main_article_info_ajax()
{
    $id = $_POST['id'];

    $article_a = get_article_info($id);
    $html_article = html_article_info($article_a);

    return $html_article;
}
