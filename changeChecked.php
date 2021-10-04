<?php
    // header('Content-Type: application/json');
    require './config.php';

    $id = filter_input(INPUT_GET, 'id');
    $data = json_decode(file_get_contents('php://input'), true);

    $pendente = $data['pendente'];

    $sql = $pdo->prepare("UPDATE pedidos SET pendente = :pendente WHERE id = :id");

    $sql->bindValue(':pendente', json_encode($pendente));
    $sql->bindValue(':id', $id);
    $sql->execute();

    header('Location: '.$base.'/pedido.php?id='.$id);
    // verificar se a alteracao foi concluida e retornar erroe ou sucess

    // echo json_encode("Separado com sucesso");