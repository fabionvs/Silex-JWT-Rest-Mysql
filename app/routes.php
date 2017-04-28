<?php

$app->mount($app['api'].'/api/v1/cars', new \MyApp\Provider\Car());
$app->mount($app['api'].'/api/v1/parts', new \MyApp\Provider\Parts());

$app->match($app['api'].'/api/v1/login', "\MyApp\Controller\AuthenticateController::authenticate");

$app->match($app['api'].'/', "\MyApp\Controller\AuthenticateController::index");
