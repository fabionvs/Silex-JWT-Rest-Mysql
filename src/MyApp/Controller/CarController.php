<?php

namespace MyApp\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CarController {

    public function index(Application $app) {
        $conn = $app['db'];

        $sql = "SELECT * FROM car";
        $cars = $conn->fetchAll($sql);

        return new JsonResponse(
                $cars, 200
        );
    }

    public function edit(Application $app, Request $request, $id) {
        $conn = $app['db'];
        $nome = $request->get('nome');
        $ano = $request->get('ano');
        $aro = $request->get('aro');
        try {
            $conn->update('car', array('nome' => $nome, 'ano' => $ano, 'aro' => $aro), array('parent_id' => $id));
        } catch (\Exception $e) {
            return new JsonResponse(
                    array('message' => 'Não foi!'), 500
            );
        }

        return new JsonResponse(
                array('message' => 'Alterado com sucesso!'), 200
        );
    }

    public function show(Application $app, $id) {
        $conn = $app['db'];

        $sql = "SELECT * FROM car WHERE parent_id = ?";
        $statement = $conn->executeQuery($sql, array($id));
        $car = $statement->fetch();
        
        $sql = "SELECT * FROM parts WHERE car_id = ?";
        $statement = $conn->executeQuery($sql, array($id));
        $parts = $statement->fetchAll();
        return new JsonResponse(
                array('car' => $car, 'parts' => $parts), 200
        );
    }

    public function insert(Application $app, Request $request) {
        $conn = $app['db'];
        $nome = $request->get('nome');
        $ano = $request->get('ano');
        $aro = $request->get('aro');
        $conn->insert('car', array('nome' => $nome, 'ano' => $ano, 'aro' => $aro));
        try {
            
        } catch (\Exception $e) {
            return new JsonResponse(
                    array('message' => 'Não foi!'), 500
            );
        }
        return new JsonResponse(
                array('message' => "Inserido com sucesso!"), 200
        );
    }

    public function delete(Application $app, $id) {
        $conn = $app['db'];
        $sql = "SELECT * FROM parts WHERE car_id = ?";
        $statement = $conn->executeQuery($sql, array($id));
        $parts = $statement->fetchAll();
        foreach($parts as $valor){
             $conn->delete('parts', array('part_id' => $valor['part_id']));
        }
        try {
            $conn->delete('car', array('parent_id' => $id));
        } catch (\Exception $e) {
            return new JsonResponse(
                    array('message' => 'Não foi!'), 500
            );
        }
        return new JsonResponse(
                array('message' => "Deletado com sucesso!"), 200
        );
    }

}
