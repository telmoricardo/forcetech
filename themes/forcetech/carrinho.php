<?php
$carrinho = new Carrinho();
$produtoController = new ProdutoController();
$correios = new CalcularFrete();

//adicionando no carrinho
if (isset($Url[1]) && $Url[1] == 'add' && isset($Url[2]) && $Url[2] != '0'):
    $id = (int) $Url[2];
    $carrinho->adicionarAoCarrinho($id);
    header("Location: " . HOME . "/carrinho");
endif;

//limpando um item do carrinho
if (isset($Url[1]) && $Url[1] == 'del' && isset($Url[2]) && $Url[2] != '0'):
    $id = (int) $Url[2];
    $carrinho->removerDoCarrinho($id);
    header("Location: " . HOME . "/carrinho");
endif;

//LIMPAR SESSÃO SE APARCER CARRINHO COM VALOR 0
if (isset($_SESSION['carrinho'][0])):
    unset($_SESSION['carrinho'][0]);
endif;

//deletando carrinho
if (isset($Url[1]) && $Url[1] == 'clear'):
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $carrinho->limparCarrinho();
endif;

//pegando produto do carrinho e valor do carrinho
$produtosNoCarrinho = $carrinho->pegarProdutosDoCarrinho();
$total = $carrinho->totalDoPedido($produtoController);

//verificando se tem produto no carrinho e vai redirecionar para pagina checkout
//if (isset($Url[1]) && $Url[1] == 'check'):
//    //pegando produto do carrinho e valor do carrinho
//    $produtosNoCarrinho = $carrinho->pegarProdutosDoCarrinho();
//    if ($produtosNoCarrinho == null):
//        $insertGoTo = HOME . '/carrinho';
//        header("refresh:2;url={$insertGoTo}");
//        echo"<script language='javascript' type='text/javascript'>alert('Não existe produto no carrinho!');</script>";
//    else:
//        $insertGoTo = HOME . '/checkout';
//        header("refresh:2;url={$insertGoTo}");
//        echo"<script language='javascript' type='text/javascript'>alert('Estamos redirecionando para o checkout!');</script>";
//    endif;
//endif;



$frete = 0;
$_SESSION['valor_Frete'] = 0;

//pegando as os valores do formulario
$btnFrete = filter_input(INPUT_POST, 'calcularFrete', FILTER_SANITIZE_STRING);
$pegarCep = filter_input(INPUT_POST, 'txtCep', FILTER_SANITIZE_STRING);
$pegarTipo = filter_input(INPUT_POST, 'slTipo', FILTER_SANITIZE_STRING);

$_SESSION['pegarCep'] = $pegarCep;
$_SESSION['pegarTipo'] = $pegarTipo;

if ($btnFrete):
    switch ($pegarTipo):
        case 'pac':
            $pegarTipo = '04510';
            $peso = 0;
            foreach ($produtosNoCarrinho as $idProd => $qtd):
                $produto = $produtoController->retornaIdProduto($idProd);
                //pegando o peso do produto
                $peso += $produto->getProduto_peso();
                $frete = $correios->Frete("71950904", $pegarCep, $pegarTipo, $peso);
                $valor = $frete->Valor;                
                $valor = str_replace(',', '.', str_replace('.', '', $valor));
                $_SESSION['valor_Frete'] = $valor;
            endforeach;
        break;

        case 'sedex':
            $pegarTipo = 40010;
            $peso = 0;
            foreach ($produtosNoCarrinho as $idProd => $qtd):
                $produto = $produtoController->retornaIdProduto($idProd);
                //pegando o peso do produto
                $peso += $produto->getProduto_peso();
                $frete = $correios->Frete("71950904", $pegarCep, $pegarTipo, $peso);
                $valor = $frete->Valor;                
                $valor = str_replace(',', '.', str_replace('.', '', $valor));
                $_SESSION['valor_Frete'] = $valor;
            endforeach;
            break;
    endswitch;
endif;
?>
<div class="container">

    <div class="content">

        <div class="cart">
            <h1>Carrinho de Compras</h1>

            <!-- RESPONSIVE TABLE -->
            <table class="table table-responsive">
                <thead> 
                    <tr>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Preço</th>	
                        <th>Quant</th>	
                        <th>Subtotal</th>	
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (empty($produtosNoCarrinho)):
                        ?>
                        <tr><td colspan="6">Nenhum produto no carrinho</td></tr>
                        <?php
                    else:
                        foreach ($produtosNoCarrinho as $produtoId => $quantidade):
                            $produtoCarrinho = $produtoController->retornaIdProduto($produtoId)
                            ?>
                            <tr>
                                <td><img src="<?= HOME; ?>/upload/<?= $produtoCarrinho->getProduto_thumb(); ?> " style="width: 100px;"/></td>	
                                <td><?= $produtoCarrinho->getProduto_nome(); ?></td>
                                <td>R$ <?= number_format($produtoCarrinho->getProduto_preco(), 2, ',', '.'); ?></td>	
                                <td><input type="text" id="qtd" style="width: 45px; font-size: 1em;" value="<?php echo $quantidade; ?>" length="3"> <a href="#" data-id="<?php echo $produtoCarrinho->getProduto_cod(); ?>"> </td>	
                                <td>R$ <?php echo number_format(( $produtoCarrinho->getProduto_preco() * $quantidade), 2, ',', '.'); ?></td>	
                                <td><a href="<?= HOME; ?>/carrinho/del/<?= $produtoCarrinho->getProduto_cod(); ?>"><i class="fa fa-times" aria-hidden="true"></i></a></td>	

                            </tr>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
            <?php if ($produtosNoCarrinho): ?>
                <a href="<?= HOME; ?>/carrinho/clear" class="btn btn-red">Limpar Carrinho</a>
            <?php endif; ?>
            <!-- END RESPONSIVE TABLE -->

            <div class="cart-footer" style="width: 100%;">

                <div class="row">
                    <div class="column column-6">
                        <form method="post">
                            <div class="form-group">
                                <label style="text-align: left; margin-bottom: 5px;">Seu Cep:</label>
                                <input type="text" id="cep" name="txtCep" maxlength="8" placeholder="72260000">
                            </div>
                            <div class="form-group">
                                <label style="text-align: left; margin-bottom: 5px;">Tipo de Frete:</label>
                                <select class="form-select" name="slTipo">
                                    <option value="">Tipo...</option>
                                    <option value="pac">PAC</option>
                                    <option value="sedex">SEDEX</option>
                                </select>
                            </div>
                            <input type="submit" name="calcularFrete" value="Calcular Frete" style="margin-top: 8px;">
                        </form>
                    </div>

                    <div class="column column-6">
                        <p style="margin: 15px 0; font-size: 1.2em;">SubTotal: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
                        <p style="margin: 15px 0; font-size: 1.2em;">
                            <?php 
                            if ($_SESSION['valor_Frete'] == 0):
                                $_SESSION['valor_Frete'] = 0;
                                ?>
                                Frete: R$ <?= $_SESSION['valor_Frete'] ?>
                                <?php
                            elseif ($_SESSION['valor_Frete'] <= 20):
                                $_SESSION['valor_Frete'] = 'gratis';
                                echo "Frete Grátis";
                            else:
                                $frete = $_SESSION['valor_Frete'];
                                $frete = $frete - 20;
                                $_SESSION['valor_Frete'] = $frete;
                                echo "Frete R$: " . number_format($_SESSION['valor_Frete'], 2, ',', '.'); 
                                
                            endif;
                            ?>
                        </p>
                        <p style="margin: 15px 0; font-size: 1.2em;">Total: R$ 
                            <?php 
                            $Ttotal = $total + $frete;                            
                            echo number_format($Ttotal, 2, ',', '.'); 
                            $_SESSION['total_pedido'] = $Ttotal;
                            ?>
                        </p>
                        <a href="<?= HOME; ?>" class="btn btn-blue">Continuar Comprando</a>
                        <a href="<?= HOME; ?>/checkout" class="btn btn-green" id="finalizarPedido">Finalizar Pedido</a>
                    </div>
                    
                </div>                

            </div>
        </div>

    </div>
</div>

