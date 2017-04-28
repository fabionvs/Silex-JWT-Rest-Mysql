<?php

// PARAMETERS
$app['driver'] = 'pdo_mysql';
$app['host'] = '127.0.0.1';
$app['port'] = '';
$app['dbname'] = '';
$app['user'] = '';
$app['password'] = '';

// SECURITY
$app['serverName'] = "localhost:8000";
// Key for signing the JWT's, I suggest generate it with base64_encode(openssl_random_pseudo_bytes(64))
$app['secret'] =  base64_encode("secret");
$app['algorithm'] = "HS512";
