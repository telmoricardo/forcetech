<?php

if(!$_SESSION["cod"] == 3):   
   header("Location: login");
endif;

$pedidoController = new PedidoController();
$pedido = new Pedido();
$helper = new Helper();

//iniciando as paginação
if (empty($_GET['pg'])):
else:
    $pg = $_GET['pg'];
endif;
if (isset($pg)):
    $pg = $_GET['pg'];
else:
    $pg = 1;
endif;

$cod = $_SESSION['cod'];
//quantidade de postagem para visualizar por pagina
$quantidade = 4;
$inicio = ($pg * $quantidade) - $quantidade;
$listaPedido = $pedidoController->ListarPedidosCliente($cod, $inicio, $quantidade);

?>


<div class="container">

    <div class="content minha-conta">
        
        <nav class="navegacao" >
            <a href="<?= HOME; ?>">Home</a>                
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>Minha Conta
            <span class="delimiter"><i class="fa fa-angle-right"></i></span>               
            <a href="<?= HOME ?>/logout">Sair</a>
        </nav>
        
        <main class="main-conta">             
            <header class="entry-header">
                <h1>ACOMPANHE SEU PEDIDO</h1>
                <p>Para acompanhar o seu pedido, selecione seu ID de pedido na tabela abaixo e pressione o botão "Detalhes".</p>
            </header>           
        </main>
        <hr>
        <table class="table table-responsive">
                <thead>
                <th>Código</th>
                <th>Cliente</th>
                <th>Valor do Pedido</th>
                <th>Status</th>
                <th>Atualizado em</th>                                    
                <th>Detalhes</th>
                </thead>

                <tbody>
                    <?php
                    if ($listaPedido == null):
                    else:
                        foreach ($listaPedido as $pedido):
                            ?>
                            <tr>
                                <td><?= $pedido->getPedidos_id_moip(); ?></td>
                                <td><?= $pedido->getPedidos_cliente()->getNome(); ?></td>                                        
                                <td>R$ <?= number_format($pedido->getPedidos_total(), 2, ",", "."); ?></td>
                                <td>
                                    <?php
                                    if ($pedido->getPedidos_status() == 1):
                                        echo "Pago";
                                    else:
                                        echo "Aguardando";
                                    endif;
                                    ?>
                                </td>                                        
                                <td><?= $helper->converteData($pedido->getPedidos_data()); ?></td>                                        
                                <td><a class="btn btn-blue" style="font-size: 0.9em; padding: 5px;" title="Detalhes do Pedido" href="<?= HOME; ?>/detalhes/<?= $pedido->getId(); ?>">Detalhes</a></td>
                            </tr>                                    
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        
    </div>


</div>

