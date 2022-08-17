<?php

declare(strict_types=1);

use App\Model\Person\PersonRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->addErrorMiddleware(true, true, true);

PersonRepository::getInstance()->create('jdoe@gmail.com', 'John', 'Doe');
PersonRepository::getInstance()->create('eormeno@gmail.com', 'Emilio', 'Ormeño');
PersonRepository::getInstance()->create('lolguin@gmail.com', 'Lola', 'Guin');
PersonRepository::getInstance()->create('mscheffer@unsj.edu.ar', 'Maru', 'Scheffer');


function getHello(ServerRequestInterface $request, ResponseInterface $response) {
	$name = $request->getAttribute('name');
	$response->getBody()->write("Hello, $name");
	return $response;
}

function getPersons(ServerRequestInterface $request, ResponseInterface $response) {
	$persons = PersonRepository::getInstance()->findAll();
	$response->getBody()->write(json_encode($persons));
	return $response;
}

function getPersonById(ServerRequestInterface $request, ResponseInterface $response) {
	$id = intval($request->getAttribute('id')) ?? 0;
	$person = PersonRepository::getInstance()->find($id);
	$response->getBody()->write(json_encode($person));
	return $response;
}

$app->get('/hello/{name}', "getHello");
$app->get('/persons', "getPersons");
$app->get('/persons/{id}', "getPersonById");

$app->run();
