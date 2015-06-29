<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;


$app->get('/', function() {
    $output = 'person microservice (silex)';

    return $output;
});

$app->run();
