<?php

namespace MyApp\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class PartsController {

    public function edit(Application $app, Request $request, $id) {
        $conn = $app['db'];
        $nome = $request->get('nome');
        $opcional = $request->get('opcional');
        $conn->update('parts', array('nome' => $nome, 'opcional' => $opcional), array('part_id' => $id));
        try {
            
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

        $sql = "SELECT * FROM parts WHERE car_id = ?";
        $statement = $conn->executeQuery($sql, array($id));
        $parts = $statement->fetchAll();
        return new JsonResponse(
                array('parts' => $parts), 200
        );
    }

    public function select(Application $app, $id) {
        $conn = $app['db'];

        $sql = "SELECT * FROM parts WHERE part_id = ?";
        $statement = $conn->executeQuery($sql, array($id));
        $parts = $statement->fetch();
        return new JsonResponse(
                array('parts' => $parts), 200
        );
    }

    public function insert(Application $app, Request $request, $carro) {
        $conn = $app['db'];
        $nome = $request->get('nome');
        $opcional = $request->get('opcional');
        try {
            $conn->insert('parts', array('nome' => $nome, 'opcional' => $opcional, 'car_id' => $carro));
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
        try {
            $conn->delete('parts', array('part_id' => $id));
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
