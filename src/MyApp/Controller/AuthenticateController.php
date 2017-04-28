<?php

namespace MyApp\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Firebase\JWT\JWT;

class AuthenticateController {

    public function authenticate(Application $app, Request $request) {
        $username = $request->get('user');
        $password = $request->get('pass');
        $conn = $app['db'];

        if ($username && $password) {
            $sql = "SELECT * FROM public.usuario WHERE username = ? AND pass = ?";
            $user = $conn->fetchAssoc($sql, array($username, $password));

            if ($user) {
                $tokenId = base64_encode(mcrypt_create_iv(32));
                $issuedAt = time();
                $notBefore = $issuedAt; //Adding 10 seconds
                $expire = $notBefore + 604800; // Adding 1 week
                $serverName = $app['serverName']; // Retrieve the server name from config file

                $id = 1; //TODO: da cambiare

                $data = [
                    'iat' => $issuedAt, // Issued at: time when the token was generated
                    'jti' => $tokenId, // Json Token Id: an unique identifier for the token
                    'iss' => $serverName, // Issuer
                    'nbf' => $notBefore, // Not before
                    'exp' => $expire, // Expire
                    'data' => [                  // Data related to the signer user
                        'userId' => $user['id'], // userid from the users table
                        'userName' => $user['username'], // User name
                    ]
                ];
                // Get the secret key for signing the JWT from an environment variable
                $secretKey = base64_decode($app['secret']);

                $algorithm = $app['algorithm'];
                // Sign the JWT with the secret key
                $jwt = JWT::encode(
                                $data, $secretKey, $algorithm
                );
                $conn->update('public.usuario', array('token' => $jwt), array('id' => $user['id']));

                return new JsonResponse(
                        array('token' => $jwt), 200
                );
            } else {
                return new JsonResponse(
                        array('message' => 'Failed to Authenticate'), 403
                );
            }
        } else {
            return new JsonResponse(
                    array('message' => 'Failed to Authenticate'), 403
            );
        }
    }

    public function index(Application $app, Request $request) {
        return $app['twig']->render('index.html', array());
    }
}
