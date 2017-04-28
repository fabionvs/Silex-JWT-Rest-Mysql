<?php

namespace MyApp\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Firebase\JWT\JWT;

class Parts implements ControllerProviderInterface {

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
        
        $books->get('/part/{id}', 'MyApp\\Controller\\PartsController::select');

        $books->get('/', 'MyApp\\Controller\\PartsController::index');

        $books->post('/new/{carro}', 'MyApp\\Controller\\PartsController::insert');

        $books->get('/{id}', 'MyApp\\Controller\\PartsController::show');

        $books->post('/edit/{id}', 'MyApp\\Controller\\PartsController::edit');

        $books->delete('/{id}', 'MyApp\\Controller\\PartsController::delete');

        return $books;
    }

}
