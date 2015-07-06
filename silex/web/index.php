<?php
require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ParameterBag;
require 'person_store.php';


$app = new Silex\Application();
$app['debug'] = true;


$app->before(function (Request $request) {
	if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
		$request->request = json_decode($request->getContent());
	}
});


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
	$person = $ps->read_person($app['request']->get('id'));

	return new Response($app->json($person), 201);
});


$app->post('/person', function(Request $request) use($app) {
	$ps          = new PersonStore();
	$person_data = $request->request;
	$person      = $ps->create_person($person_data);

	return new Response($app->json($person), 201);
});


$app->put('/person/{id}', function(Request $request) use($app) {
	$ps              = new PersonStore();
	$person_data     = $request->request;
	$person_data->id = (int)$app['request']->get('id');
	$person          = $ps->update_person($person_data);

	return new Response($app->json($person), 201);
});


$app->delete('/person/{id}', function() use($app) {
	$ps = new PersonStore;

	if ($ps->delete_person($app['request']->get('id'))) {
		return 201;
	} else {
		return 403;
	}

});


$app->run();
