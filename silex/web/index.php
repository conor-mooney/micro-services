<?php
require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Response;


$people = [
    [
        "first name" =>  "Bart",
        "id"         =>  1,
        "last name"  =>  "Simpson"
    ],
    [
        "first name" =>  "Homer",
        "id"         =>  2,
        "last name"  =>  "Simpson"
    ],
    [
        "first name" =>  "Marge",
        "id"         =>  3,
        "last name"  =>  "Simpson"
    ],
    [
        "first name" =>  "Lisa",
        "id"         =>  4,
        "last name"  =>  "Simpson"
    ],
    [
        "first name" =>  "Maggy",
        "id"         =>  5,
        "last name"  =>  "Simpson"
    ],
    [
        "first name" =>  "Donald",
        "id"         =>  6,
        "last name"  =>  "Duck"
    ],
    [
        "first name" =>  "Daffy",
        "id"         =>  7,
        "last name"  =>  "Duck"
    ]
];


$app = new Silex\Application();
$app['debug'] = true;


$app->get('/', function() {
    $output = 'person microservice (silex)';
    return $output;
});


$app->get('/people', function() use($people, $app) {
    return new Response($app->json($people), 201);
});


$app->run();
