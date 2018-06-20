<?php
if (!$_SESSION["cod"] == 3):
    header("Location: login");
endif;

//instanciando os objetos
$prodController = new PedidoController();
$pedidoProdutoController = new PedidoProdutoController();
$helper = new Helper();

//verificando a url e esta voltando url[0] = single, url[1] = exemplo-do-post
$url = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$url = ($url ? $url : 'index');
$url = explode('/', $url);
$urlCod = $url[1];

$retornoPedido = $prodController->retornaPedidoId($urlCod);

if ($retornoPedido == null):
else:

//pedido
    $orderId = $retornoPedido->getPedidos_id_moip();
    $orderValor = $retornoPedido->getPedidos_total();
    $orderData = $retornoPedido->getPedidos_data();
    $orderStatus = $retornoPedido->getPedidos_status();
    $orderTipoFrete = $retornoPedido->getPedidos_frete_tipo();
    $orderCliente = $retornoPedido->getPedidos_cliente()->getNome();
    $orderCpf = $retornoPedido->getPedidos_cliente()->getDocumento();
    $orderTelefone = $retornoPedido->getPedidos_cliente()->getTelefone();
    $orderCelular = $retornoPedido->getPedidos_cliente()->getCelular();
    $orderNascimento = $retornoPedido->getPedidos_cliente()->getNascimento();
    $orderRua = $retornoPedido->getPedidos_cliente()->getRua();
    $orderNumero = $retornoPedido->getPedidos_cliente()->getNumero();
    $orderComplemento = $retornoPedido->getPedidos_cliente()->getComplemento();
    $orderCep = $retornoPedido->getPedidos_cliente()->getCep();
    $orderBairro = $retornoPedido->getPedidos_cliente()->getBairro();
    $orderCidade = $retornoPedido->getPedidos_cliente()->getCidade();
    $orderUf = $retornoPedido->getPedidos_cliente()->getUf();
    $orderEmail = $retornoPedido->getPedidos_cliente()->getEmail();

    $entregaEndereco = $retornoPedido->getPedidos_endereco();
    $entregaNumero = $retornoPedido->getPedidos_numero();
    $entregaCep = $retornoPedido->getPedidos_cep();
    $entregaComplemento = $retornoPedido->getPedidos_complemento();
    $entregaBairro = $retornoPedido->getPedidos_bairro();
    $entregaCidade = $retornoPedido->getPedidos_cidade();
    $entregaEstado = $retornoPedido->getPedidos_uf();
//pegando pedidoPorduto
    $retornarPedidoProduto = $pedidoProdutoController->produtoPedidoRelacionado($orderId);
    ?>

    <div class="container">

        <div class="content detalhes">

            <nav class="navegacao" >
                <a href="<?= HOME; ?>">Home</a>                
                <i class="fa fa-angle-right"></i><a href="<?= HOME; ?>/minha-conta">Minha Conta</a>   
                <i class="fa fa-angle-right"></i>               
                <a href="<?= HOME ?>/logout.php">Sair</a>
            </nav>

            <header class="entry-header">
                <h1>ACOMPANHE SEU PEDIDO</h1>
            </header><!-- .entry-header -->
            
            <div class="detalhes-descricao">
                <div class="row">
                    <div class="column column-6">
                        <div class="form-field">
                            <label>Ordem do Pedido:</label>
                            <input type="text" name="txtUsuario" value="<?= $orderId; ?>" disabled="disabled">
                        </div>
                    </div>
                    <div class="column column-3">
                        <div class="form-field">
                            <label>Valor do Pedido</label>
                            <input type="text" name="txtUsuario" value="R$ <?= number_format($orderValor, 2, ",", "."); ?>" disabled="disabled">
                        </div>
                    </div>
                    <div class="column column-3">
                        <div class="form-field">
                            <label>Data</label>
                            <input type="text" name="txtUsuario" value="<?= $helper->converteData($orderData); ?>" disabled="disabled">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Frete</label>
                            <input type="text" name="txtUsuario" value="<?= strtoupper($orderTipoFrete); ?>" disabled="disabled">
                        </div>
                    </div>
                    <div class="column column-2">                    
                        <div class="form-field">
                            <label>Status:</label>
                            <input type="text" name="txtUsuario" value="<?= ($orderStatus == 1) ? 'Pago' : 'Aguardando'; ?>" disabled="disabled">
                        </div>
                    </div>
                    <div class="column column-8">
                        <div class="form-field">
                            <label>Comprador</label>
                            <input type="text" name="txtUsuario" value="<?= $orderCliente; ?>" disabled="disabled">
                        </div>
                    </div>                
                </div>

                <hr> 
                <h3 style="font-size: 1.4em;" class="strong">Descritivo do Produto</h3>
                <?php
                if ($retornarPedidoProduto == null):
                    echo '<h4 class="title">Não existem produtos no pedido</h4>';
                else:
                    foreach ($retornarPedidoProduto as $pedidoproduto):
                        ?>
                        <div class="row">               
                            <div class="column column-2">
                                <div class="form-field">
                                    <label>Quant</label>
                                    <input type="text" name="txtUsuario" value="<?= $pedidoproduto->getPedidos_produto_quantidade(); ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="column column-8">
                                <div class="form-field">
                                    <label>Produtos</label>
                                    <input type="text" name="txtUsuario" value="<?= $pedidoproduto->getPedidos_produto_nome(); ?> " disabled="disabled">
                                </div>
                            </div>          
                            <div class="column column-2">
                                <div class="form-field">
                                    <label>Preço R$:</label>
                                    <input type="text" name="txtUsuario" value="<?= number_format($pedidoproduto->getPedidos_produto_subtotal(), 2, ",", "."); ?>" disabled="disabled">
                                </div>
                            </div>                 
                        </div>
                        <?php
                    endforeach;
                endif;
                ?>

                <hr>
                <h3 style="font-size: 1.4em; margin: 10px 0;" class="strong">Dados do Comprador</h3>
                <div class="row">               
                    <div class="column column-2">
                        <div class="form-field">
                            <label>CPF</label>
                            <input type="text" name="txtUsuario" value="<?= $orderCpf; ?>" disabled="disabled">
                        </div>
                    </div>
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Data de Nascimento</label>
                            <input type="text" name="txtUsuario" value="<?= $helper->converteData($orderNascimento); ?>" disabled="disabled">
                        </div>
                    </div>          
                    <div class="column column-4">
                        <div class="form-field">
                            <label>Preço R$:</label>
                            <input type="text" name="txtUsuario" value="<?= $orderEmail; ?>" disabled="disabled">
                        </div>
                    </div>                 
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Telefone:</label>
                            <input type="text" name="txtUsuario" value="<?= $orderTelefone; ?>" disabled="disabled">
                        </div>
                    </div>
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Celular</label>
                            <input type="text" name="txtUsuario" value="<?= $orderCelular; ?>" disabled="disabled">
                        </div>
                    </div>
                </div>            
                <div class="row">              
                    <div class="column column-8">
                        <div class="form-field">
                            <label>Endereço</label>
                            <input type="text" name="txtUsuario" value="<?= $orderRua; ?>" disabled="disabled">
                        </div>
                    </div>          
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Número:</label>
                            <input type="text" name="txtUsuario" value="<?= $orderNumero; ?>" disabled="disabled">
                        </div>
                    </div>                 
                    <div class="column column-2">
                        <div class="form-field">
                            <label>CEP:</label>
                            <input type="text" name="txtUsuario" value="<?= $orderCep; ?>" disabled="disabled">
                        </div>
                    </div>                 
                </div>
                <div class="row">              
                    <div class="column column-6">
                        <div class="form-field">
                            <label>Complemento</label>
                            <input type="text" name="txtUsuario" value="<?= $orderComplemento; ?>" disabled="disabled">
                        </div>
                    </div>          
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Bairro</label>
                            <input type="text" name="txtUsuario" value="<?= $orderBairro; ?>" disabled="disabled">
                        </div>
                    </div>          
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Cidade:</label>
                            <input type="text" name="txtUsuario" value="<?= $orderCidade; ?>" disabled="disabled">
                        </div>
                    </div>                 
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Estado:</label>
                            <input type="text" name="txtUsuario" value="<?= $orderUf; ?>" disabled="disabled">
                        </div>
                    </div>                 
                </div>
                <hr>
                <h3 style="font-size: 1.4em; margin: 10px 0;" class="strong">Dados da Entrega</h3>
                <div class="row">              
                    <div class="column column-8">
                        <div class="form-field">
                            <label>Endereço</label>
                            <input type="text" name="txtUsuario" value="<?= $entregaEndereco; ?>" disabled="disabled">
                        </div>
                    </div>          
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Número:</label>
                            <input type="text" name="txtUsuario" value="<?= $entregaNumero; ?>" disabled="disabled">
                        </div>
                    </div>                 
                    <div class="column column-2">
                        <div class="form-field">
                            <label>CEP:</label>
                            <input type="text" name="txtUsuario" value="<?= $entregaCep; ?>" disabled="disabled">
                        </div>
                    </div>                 
                </div>
                <div class="row">              
                    <div class="column column-5">
                        <div class="form-field">
                            <label>Complemento</label>
                            <input type="text" name="txtUsuario" value="<?= $entregaComplemento; ?>" disabled="disabled">
                        </div>
                    </div>          
                    <div class="column column-3">
                        <div class="form-field">
                            <label>Bairro</label>
                            <input type="text" name="txtUsuario" value="<?= $entregaBairro; ?>" disabled="disabled">
                        </div>
                    </div>          
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Cidade:</label>
                            <input type="text" name="txtUsuario" value="<?= $entregaCidade; ?>" disabled="disabled">
                        </div>
                    </div>                 
                    <div class="column column-2">
                        <div class="form-field">
                            <label>Estado:</label>
                            <input type="text" name="txtUsuario" value="<?= $entregaEstado; ?>" disabled="disabled">
                        </div>
                    </div>                 
                </div>
            </div>
            
        </div>
    </div>

<?php
endif;
?>
