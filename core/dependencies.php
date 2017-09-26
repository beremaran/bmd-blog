<?php
/**
 * Created by PhpStorm.
 * User: beremaran
 * Date: 26.09.2017
 * Time: 17:45
 */

$container = $app->getContainer();

$container['template'] = function ($c) {
    $settings = $c->get('settings');
    return $settings['template'];
};

$container['twig'] = function ($c) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../templates/' . $c['template'], [
        'cache' => false
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $c['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};