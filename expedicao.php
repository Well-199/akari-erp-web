<?php
    require './config.php';
    require './models/Auth.php';
    require './models/Pedido.php';

    $auth = new Auth($pdo, $base);
    $userInfo = $auth->checkToken();
    
    $pedidoPorData = new Pedido($pdo, $base);
    $pedidos = $pedidoPorData->getPedidosPorData();
    
    $pedidos ? $date = $pedidos[0]['data_entrega'] : $date = date('Y-m-d');

    require 'partials/header.php';
?>

<div class="container mt-3 pb-5">

    <div class="row">
        <form action="<?=$base;?>/expedicao.php" method="GET">
            <div class="col-md-12 d-flex justify-content-center">
                <input type="date" name="date" value="<?=$date?>" style="margin-right: 10px;"/>
                <button type="submit" class="btn buttonSearch">Buscar</button>    
            </div>
        </form>
    </div>

    <?php if ($pedidos): ?>

        <div class="row mt-3">
            <?php foreach($pedidos as $pedido): ?>
                <div class="col-md-3">
                    <div class="card mb-4" style="width: 16rem;">
                        <div class="card-body text-center">
                            <form method="GET" action="<?=$base;?>/pedido.php">
                                <input type="hidden" name="id" value="<?=$pedido['id'];?>"/>
                                <h5 class="card-title"><?=$pedido['cliente'];?></h5>

                                <?php if($pedido['separado']): ?>
                                <button href="subimit" class="btn btn-success mt-2 mb-2">Separado</button>
                                <?php else:?>
                                <button href="subimit" class="btn btn-danger mt-2 mb-2">Pendente</button>
                                <?php endif?>
                                
                                <p class="card-text">Entrega <?=date('d/m/Y', strtotime($pedido['data_entrega'])); ?></p>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?> 
    
        <div class="row mt-5">
            <div class="col-md-12 mt-5 d-flex justify-content-center">
                <button class="btn text-light" type="button" style="background-color: #34495e;">
                <span class="spinner-grow spinner-grow-sm text-light" role="status" aria-hidden="true"></span>
                Sem Pedidos Nessa Data 
                </button>
            </div>
        </div>

    <?php endif ?>
</div>

<?php require 'partials/footer.php' ?>
