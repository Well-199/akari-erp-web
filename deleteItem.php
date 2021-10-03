<?php
    // header('Content-Type: application/json');
    require './config.php';

    $id = filter_input(INPUT_GET, 'id');
    $data = json_decode(file_get_contents('php://input'), true);

    $produto = $data['produto'];
    $quantidade = $data['quantidade'];
    $trocas = $data['trocas'];
    $valor = $data['valor'];
    $valor_unitario = $data['valor_unitario'];
    $total = $data['total'];

    $sql = $pdo->prepare(
        "UPDATE pedidos SET 
        produto = :produto, 
        quantidade = :quantidade, 
        trocas = :trocas, 
        valor = :valor,
        valor_unitario = :valor_unitario,
        total = :total WHERE id = :id"
    );

    $sql->bindValue(':produto', json_encode($produto));
    $sql->bindValue(':quantidade', json_encode($quantidade));
    $sql->bindValue(':trocas', json_encode($trocas));
    $sql->bindValue(':valor', json_encode($valor));
    $sql->bindValue(':valor_unitario', json_encode($valor_unitario));
    $sql->bindValue(':total', $total);
    $sql->bindValue(':id', $id);
    $sql->execute();

    header('Location: '.$base.'/pedido.php?id='.$id);
    // verificar se a alteracao foi concluida e retornar error ou sucess

    // echo json_encode("Excluido com sucesso");