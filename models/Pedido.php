<?php

class Pedido {

    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }
   
    public function getPedidosPorData(){

        $listaPedidos = [];

        $date = filter_input(INPUT_GET, 'date');

        if($date){
            $sql = $this->pdo->prepare("SELECT * FROM pedidos WHERE data_emissao = :data_emissao");
            $sql->bindValue(':data_emissao', $date);
            $sql->execute();
        }
        else{
            $date = date('Y-m-d');
            $sql = $this->pdo->prepare("SELECT * FROM pedidos WHERE data_emissao = :data_emissao");
            $sql->bindValue(':data_emissao', $date);
            $sql->execute();
        }
        
        if($sql->rowCount() > 0){

            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            foreach($data as $item){
                $listaPedidos[] = [
                    'id' => $item['id'],
                    'cliente' => $item['cliente'],
                    'data_emissao' => $item['data_emissao'],
                    'data_entrega' => $item['data_entrega'],
                    'separado' => $item['separado']
                ];
            }

        }

        return $listaPedidos;  
    }

    public function getPedidoPorId(){

        $id = filter_input(INPUT_GET, 'id');
        
        if($id){
            $sql = $this->pdo->prepare("SELECT * FROM pedidos WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
        }

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            
        }

        return $data;  
    }

    public function updatePedidoPorItem(){

        $id = filter_input(INPUT_GET, 'id');
        
        if($id){
            $sql = $this->pdo->prepare("SELECT * FROM pedidos WHERE quantidade = :id");
            $sql->bindValue(':id', $id);
            $sql->execute();
        }
    }
}