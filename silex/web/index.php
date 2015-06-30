<?php
require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Response;
require 'person_store.php';


$app = new Silex\Application();
$app['debug'] = true;


$app->get('/', function() {
    $output = 'person microservice (silex)';

    return $output;
});


$app->get('/people', function() use($app) {
	$ps     = new PersonStore;
	$people = $ps->people();

    return new Response($app->json($people), 201);
});


$app->get('/person/{id}', function() use($app) {
	$ps     = new PersonStore;
	$person = $ps->person($app['request']->get('id'));

    return new Response($app->json($person), 201);
});


$app->run();
