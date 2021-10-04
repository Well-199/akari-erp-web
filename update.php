<?php
    // header('Content-Type: application/json');
    require './config.php';

    $id = filter_input(INPUT_GET, 'id');
    $data = json_decode(file_get_contents('php://input'), true);

    $quantidade = $data['quantidade'];
    $valor = $data['valor'];
    $trocas = $data['trocas'];
    $data_entrega = $data['data_entrega'];
    $vendedor = $data['vendedor'];
    $total = $data['total'];

    $sql = $pdo->prepare(
        "UPDATE pedidos SET quantidade = :quantidade, valor = :valor,
         trocas = :trocas, data_entrega = :data_entrega, 
         vendedor = :vendedor, total = :total WHERE id = :id"
        );

    $sql->bindValue(':quantidade', json_encode($quantidade));
    $sql->bindValue(':valor', json_encode($valor));
    $sql->bindValue(':trocas', json_encode($trocas));
    $sql->bindValue(':data_entrega', $data_entrega);
    $sql->bindValue(':vendedor', $vendedor);
    $sql->bindValue(':total', $total);
    $sql->bindValue(':id', $id);
    $sql->execute();

    header('Location: '.$base.'/pedido.php?id='.$id);
    // verificar se a alteracao foi concluida e retornar erroe ou sucess

    // echo json_encode("Atualizado com sucesso");