<?php

namespace MyApp\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Firebase\JWT\JWT;

class Car implements ControllerProviderInterface {

    public function connect(Application $app) {
        $books = $app['controllers_factory'];


        $books->before(function (Request $request) use ($app) {
            $conn = $app['db'];

            // Strip out the bearer
            $rawHeader = $request->headers->get('Authorization');
            if ($rawHeader) {
                if (strpos($rawHeader, 'Bearer ') === false) {
                    return new JsonResponse(
                            array('message' => 'Unauthorized'), 401
                    );
                }
                $jwt = str_replace('Bearer ', '', $rawHeader);
                $sql = "SELECT * FROM usuario WHERE token = ?";
                $user = $conn->fetchAssoc($sql, array($jwt));
                if (!$user) {
                    return new JsonResponse(
                            array('message' => 'Unauthorized'), 401
                    );
                }

                $secretKey = base64_decode($app['secret']);

                try {
                    $token = JWT::decode($jwt, $secretKey, [$app['algorithm']]);
                } catch (Exception $e) {
                    return new JsonResponse(
                            array('message' => 'Unauthorized'), 401
                    );
                }
            } else {
                return new JsonResponse(
                        array('message' => 'Bad Request'), 400
                );
            }
        });

        $books->get('/', 'MyApp\\Controller\\CarController::index');

        $books->post('/new', 'MyApp\\Controller\\CarController::insert');

        $books->get('/{id}', 'MyApp\\Controller\\CarController::show');

        $books->post('/edit/{id}', 'MyApp\\Controller\\CarController::edit');

        $books->delete('/{id}', 'MyApp\\Controller\\CarController::delete');

        return $books;
    }

}
