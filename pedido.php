<?php

    require './config.php';
    require './models/Auth.php';
    require './models/Pedido.php';

    $auth = new Auth($pdo, $base);
    $userInfo = $auth->checkToken();

    $pedido_id = new Pedido($pdo, $base);
    $pedido = $pedido_id->getPedidoPorId();

    $id = $pedido['id'];
    $cliente = $pedido['cliente'];
    $produtos = json_decode($pedido['produto']);
    $quantidades = json_decode($pedido['quantidade']);
    $trocas = json_decode($pedido['trocas']);
    $valor_unitario = json_decode($pedido['valor_unitario']);
    $valores = json_decode($pedido['valor']);
    $pendente = json_decode($pedido['pendente']);
    $data_emissao = $pedido['data_emissao'];
    $data_entrega = $pedido['data_entrega'];
    $vendedor = $pedido['vendedor'];
    $separado = $pedido['separado'];
    $total = $pedido['total'];

    require 'partials/header.php';
?>

    <div class="container pb-5">
        <div class="row pt-3">
            <div class="col-md-12 d-flex justify-content-center">
                <h3><?=$cliente;?></h3>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-md-3 mb-3" style="display: inline-block;">
                <div class="pt-1 pl-2 d-flex justify-content-start border">
                    <h6 class="text-center">PRODUTO</h6>
                </div>
            </div>
            <div class="col-md-2 mb-3" style="display: inline-block;">
                <div class="pt-1 pl-2 d-flex justify-content-center border">
                    <h6 class="text-center">QUANT</h6>
                </div>
            </div>
            <div class="col-md-2 mb-3" style="display: inline-block;">
                <div class="pt-1 pl-2 d-flex justify-content-center border">
                    <h6 class="text-center">TROCAS</h6>
                </div>
            </div>
            <div class="col-md-2 mb-3" style="display: inline-block;">
                <div class="pt-1 pl-2 d-flex justify-content-center border">
                    <h6 class="text-center">VALOR</h6>
                </div>
            </div>
            <div class="col-md-1 mb-3" style="display: inline-block;">
                <div class="pt-1 pl-2 d-flex justify-content-center border">
                    <h6 class="text-center">EDITAR</h6>
                </div>
            </div>
            <div class="col-md-1 mb-3" style="display: inline-block;">
                <div class="pt-1 pl-2 d-flex justify-content-center border">
                    <h6 class="text-center">EXCLUIR</h6>
                </div>
            </div>
            <div class="col-md-1 mb-3" style="display: inline-block;">
                <div class="pt-1 pl-2 d-flex justify-content-center border">
                    <h6 class="text-center">OK</h6>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3" style="display: inline-block;">

                <?php foreach($produtos as $chave => $produto): ?>

                    <?php if ($separado): ?>
                        <div class="pt-1 pl-2 d-flex justify-content-start border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden; background: #bdc3c7;">
                            <h6 id="produto<?=$chave;?>" class="produto-item"><?=$produto;?></h6>
                        </div>
                    <?php else:?>
                        <div class="pt-1 pl-2 d-flex justify-content-start border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden;">
                            <h6 id="produto<?=$chave;?>" class="produto-item"><?=$produto;?></h6>
                        </div>
                    <?php endif?>

                <?php endforeach; ?>

            </div>
            
            <div class="col-md-2" style="display: inline-block;">
                <?php foreach($quantidades as $chave => $quantidade): ?>

                    <?php if($separado):?>
                        <div class="pt-1 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden; background: #bdc3c7;">
                            <h6 id="quantidade<?=$chave;?>" class="quantidade-item"><?=intval($quantidade);?></h6>
                        </div>
                    <?php else:?>
                        <div class="pt-1 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden;">
                            <h6 id="quantidade<?=$chave;?>" class="quantidade-item"><?=intval($quantidade);?></h6>
                        </div>
                    <?php endif?>

                <?php endforeach; ?>
            </div>

            <div class="col-md-2" style="display: inline-block;">
                <?php foreach($trocas as $chave => $troca): ?>

                    <?php if($separado):?>
                        <div class="pt-1 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden; background: #bdc3c7;">
                            <h6 id="troca<?=$chave;?>" class="troca-item"><?=intval($troca);?></h6>
                        </div>
                    <?php else:?>
                        <div class="pt-1 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden;">
                            <h6 id="troca<?=$chave;?>" class="troca-item"><?=intval($troca);?></h6>
                        </div>
                    <?php endif?>

                <?php endforeach; ?>
            </div>

            <div class="col-md-2" style="display: inline-block;">
                <?php foreach($valores as $chave => $valor): ?>

                    <?php if($separado):?>
                        <div class="pt-1 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden; background: #bdc3c7;">
                            <h6>R$ <span id="valor<?=$chave;?>" class="valor-item"><?=number_format((float)$valor, 2, '.', '');?></span></h6>
                        </div>
                    <?php else:?>
                        <div class="pt-1 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden;">
                            <h6>R$ <span id="valor<?=$chave;?>" class="valor-item"><?=number_format((float)$valor, 2, '.', '');?></span></h6>
                        </div>
                    <?php endif?>

                <?php endforeach; ?>
            </div>

            <div class="col-md-1 d-none">
                <?php foreach($valor_unitario as $chave => $valor): ?>
                    <h2 id="valor-unitario<?=$chave;?>" class="valorUnitario-item"><?=$valor;?></h2>
                <?php endforeach; ?>
            </div>

            <div class="col-md-1" style="display: inline-block;">
                <?php foreach($produtos as $chave => $valor): ?>

                    <?php if($separado):?>
                        <div class="pt-1 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden; background: #bdc3c7;">
                            <a onclick="edit(<?=$chave;?>)" id="valor<?=$chave;?>" data-bs-toggle="modal" 
                            data-bs-target="#exampleModal" style="cursor:pointer;"><i class="fas fa-edit" style="color: #34495e;"></i></a>
                        </div>
                    <?php else:?>
                        <div class="pt-1 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden;">
                            <a onclick="edit(<?=$chave;?>)" id="valor<?=$chave;?>" data-bs-toggle="modal" 
                            data-bs-target="#exampleModal" style="cursor:pointer;"><i class="fas fa-edit" style="color: #34495e;"></i></a>
                        </div>
                    <?php endif?>

                <?php endforeach; ?>
            </div>

            <div class="col-md-1" style="display: inline-block;">
                <?php foreach($produtos as $chave => $valor): ?>

                    <?php if($separado):?>
                        <div class="pt-1 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden; background: #bdc3c7;">
                            <a onclick="deleteAlert(<?=$chave;?>);" id="valor<?=$chave;?>" data-bs-toggle="modal" data-bs-target="#modalDelete" 
                            style="cursor:pointer;"><i class="fas fa-trash-alt text-danger"></i></i></a>
                        </div>
                    <?php else:?>
                        <div class="pt-1 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden;">
                            <a onclick="deleteAlert(<?=$chave;?>);" id="valor<?=$chave;?>" data-bs-toggle="modal" data-bs-target="#modalDelete" 
                            style="cursor:pointer;"><i class="fas fa-trash-alt text-danger"></i></i></a>
                        </div>
                    <?php endif ?>

                <?php endforeach; ?>
            </div>

            <div class="col-md-1" style="display: inline-block;">
                <?php foreach($pendente as $chave => $valor): ?>
                    <div class="pt-2 d-flex justify-content-center border line<?=$chave;?>" style="height: 30px; max-height: 30px; overflow: hidden;">
                    <?php if($valor === 'False'):?>
                        <input type="checkbox" class="check" id="checkbox<?=$chave;?>" value="<?=$valor;?>" onclick="inputCheckedDisable();" checked/>
                    <?php else:?>
                        <input type="checkbox" class="check" id="checkbox<?=$chave;?>" value="<?=$valor;?>" onclick="isCheck(changeChecked);"/>
                    <?php endif ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>  
        
        <div class="row mt-5">
            <div class="col-md-3 pt-2 pb-1">
                <h6>Entrega: <span id="data-entrega"><?=date('d/m/Y', strtotime($data_entrega)); ?></span></h6>
            </div>
            <div class="col-md-3 pt-2 pb-1">
                <h6>Vendedor: <span id="vendedor"><?=$vendedor; ?></span></h6>
            </div>
            <div class="col-md-3 pt-2 pb-1">
                <h6>Total - R$ <span id="valor-total"><?=number_format((float)$total, 2, '.', ''); ?></span></h6>
            </div>
            <div class="col-md-3 pt-2 pb-1">

                <?php if($separado):?>
                    <h5 class="text-danger">*Pedido Separado não Alterar</h5>
                <?php else:?>
                    <button type="submit" class="btn btn-success" style="width: 180px;" data-bs-toggle="modal" data-bs-target="#modalConfirmStatusTrue">Pedido Separado ?</button>
                <?php endif?>

            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" 
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?=$cliente;?></h5>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row pt-3">
                            <div class="col-md-6 mb-3" style="display: inline-block;">
                                <div class="pt-1 pl-2 d-flex justify-content-start border">
                                    <h6 class="text-center">PRODUTO</h6>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3" style="display: inline-block;">
                                <div class="pt-1 pl-2 d-flex justify-content-center border">
                                    <h6 class="text-center">QUANT</h6>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3" style="display: inline-block;">
                                <div class="pt-1 pl-2 d-flex justify-content-center border">
                                    <h6 class="text-center">TROCAS</h6>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3" style="display: inline-block;">
                                <div class="pt-1 pl-2 d-flex justify-content-center border">
                                    <h6 class="text-center">VALOR</h6>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-6 pt-1" style="display: inline-block;">
                                <div class="pt-1 pl-2 d-flex justify-content-start border">
                                    <h6 class="produto"></h6>
                                </div>
                            </div>
                        
                            <div class="col-md-2" style="display: inline-block;">
                                <div class="pt-1 d-flex justify-content-center">
                                    <input type="number" class="text-center quantidade" onkeyup="calcOrders();" name="quantidade" value=""/>
                                </div>
                            </div>

                            <div class="col-md-2" style="display: inline-block;">
                                <div class="pt-1 d-flex justify-content-center">
                                    <input type="number" class="text-center troca" onkeyup="calcOrders();" name="troca" value=""/>
                                </div>
                            </div>

                            <div class="col-md-1 d-none">
                                <h6 class="valor-unitario"></h6>
                            </div>

                            <div class="col-md-1 d-none">
                                <h6 class="chave-key"></h6>
                            </div>

                            <div class="col-md-2 pt-1" style="display: inline-block;">
                                <div class="pt-1 d-flex justify-content-center border">
                                    <h6>R$ <span class="valor"></span></h6>
                                </div>
                            </div>
                        </div> 
                    
                        <div class="row mt-5">
                            <div class="col-md-4 pt-2 pb-1">
                            Entrega: <input type="date" class="data-entrega text-center" name="date" value="<?=$data_entrega;?>"/>
                            </div>
                            <div class="col-md-4 pt-2 pb-1">
                                Vendedor: <input type="text" class="vendedor text-center" name="vendedor" value=""/>
                            </div>
                            <div class="col-md-4 pt-3 pb-1">
                                <h6>Total - R$ <span class="valor-total"><?=number_format((float)$total, 2, '.', ''); ?></span></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeUpdateItens" data-bs-dismiss="modal" style="width: 180px;">Fechar</button>
                    <button type="button" class="btn btn-success" id="updateItens" onclick="confirm(changeItens);" style="width: 180px;">Confirmar</button>
                    <button class="btn btn-danger d-none spinnerUpdateItens" type="button" style="width: 180px;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Atualizando...
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL PEDIDO SEPARADO -->
    <div class="modal fade" id="modalConfirmStatusTrue" data-bs-backdrop="static" data-bs-keyboard="false" 
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-danger"></i> Atenção</h5>
                <h6 class="id-delete d-none"></h6>
            </div>
            <div class="modal-body">
                Deseja realmente alterar o status do pedido para separado? Esta ação não poderá ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeUpdateStatusTrue" data-bs-dismiss="modal" style="width: 120px;">Cancelar</button>
                <button type="button" class="btn btn-danger" id="updateStatusTrue" style="width: 120px;" onclick="updateStatus();">Confirmar</button>
                <button class="btn btn-danger d-none spinnerStatusTrue" type="button" style="width: 180px;">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Atualizando...
                </button>
            </div>
            </div>
        </div>
    </div>

    <!-- MODAL DELETE ITEM  -->
    <div class="modal fade" id="modalDelete"  data-bs-backdrop="static" data-bs-keyboard="false" 
        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-danger"></i> Atenção</h5>
                <h6 class="id-delete d-none"></h6>
            </div>
            <div class="modal-body">
                Deseja realmente excluir este item do pedido? Esta ação não poderá ser desfeita.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeDeleteItens" data-bs-dismiss="modal" style="width: 120px;" onclick="notDelete();">Cancelar</button>
                <button type="button" class="btn btn-danger" id="deleteItens" style="width: 120px;" onclick="deleteItem(deleteItemAction);">Excluir</button>
                <button class="btn btn-danger d-none spinnerDeleteItens" type="button" style="width: 150px;">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Excluindo...
                </button>
            </div>
            </div>
        </div>
    </div>

<?php require 'partials/script_pedido.php' ?>
<?php require 'partials/footer.php' ?>