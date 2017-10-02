<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 26.09.2017
 * Time: 21:53
 */

$app->get('[/]', function ($req, $res, $args) use ($app) {
    return $this->twig->render($res, 'home.html.twig', [
        'posts' => f_getPosts(),
        'pageTitle' => 'Home'
    ]);
})->setName('blog.home');

$app->post('/search[/]', function ($req, $res, $args) use ($app) {
    $q = $req->getParsedBody()['q'];
    $posts = s_search($q);

    return $this->twig->render($res, 'search.html.twig', [
        'posts' => $posts,
        'pageTitle' => "Search results for '$q''",
        'q' => $q
    ]);
});

$app->get('/p/{page-name}[/]', function ($req, $res, $args) use ($app) {
    $page = p_get_page($args['page-name']);

    return $this->twig->render($res, 'page.html.twig', [
        '_page' => $page,
        'pageTitle' => $page['name']
    ]);
})->setName('blog.pages');

$app->get('/category/{category-name}[/]', function ($req, $res, $args) use ($app) {
    $posts = f_getPosts($args['category-name']);

    return $this->twig->render($res, 'home.html.twig', [
        'posts' => $posts,
        'pageTitle' => $posts[0]['category']
    ]);
})->setName('blog.categories');

$app->get('/{post-name}[/]', function ($req, $res, $args) use ($app) {
    $post = f_getPost($args['post-name'], true);

    return $this->twig->render($res, 'single_post.html.twig', [
        'posts' => f_getPosts(),
        'post' => $post,
        'pageTitle' => $post['meta']['title']
    ]);
})->setName('blog.name');