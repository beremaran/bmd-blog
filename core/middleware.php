<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 26.09.2017
 * Time: 17:56
 */

// Template globals
$app->add(function ($request, $response, $next) use ($app) {
    $settings = $app->getContainer()->get('settings');
    $view = $this->get('twig');
    $view->getEnvironment()->addGlobal('template', $settings['template_dir'] . '/' . $settings['template']);
    $view->getEnvironment()->addGlobal('site_url', $settings['site_url']);
    $view->getEnvironment()->addGlobal('categories', p_categories());
    $view->getEnvironment()->addGlobal('blogTitle', $settings['blogTitle']);

    return $next($request, $response);
});

// Latest posts
$app->add(function ($request, $response, $next) use ($app) {
    $view = $this->get('twig');
    $view->getEnvironment()->addGlobal('latestPosts', array_slice(f_getPosts(), 0, 5));
    $view->getEnvironment()->addGlobal('pages', p_get_pages());
    return $next($request, $response);
});