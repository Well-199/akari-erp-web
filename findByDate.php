<?php

require './config.php';
require './models/Pedido.php';

$date = filter_input(INPUT_GET, 'date');

    $pedidosPorData = new Pedido($pdo, $base);

    if($date){
        
        $pedidosPorData->getPedidosPorData($date);

        header('Location: '.$base.'/expedicao.php');
        exit;
    }

    header('Location: '.$base.'/expedicao.php');
    exit;