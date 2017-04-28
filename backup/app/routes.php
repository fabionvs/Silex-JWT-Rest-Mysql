<?php

$app->mount($app['api'].'/books', new Controller\Provider\Book());

$app->match($app['api'].'/login', "\MyApp\Controller\AuthenticateController::authenticate");
