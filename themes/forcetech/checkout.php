<?php
$carrinho = new Carrinho();
$helper = new Helper();
$produtoController = new ProdutoController();
$usuarioController = new UsuarioController();
$pedidoProdutoController = new PedidoProdutoController();
$pedidoController = new PedidoController();
$pedidoProduto = new PedidoProduto();
$pedido = new Pedido();
$functions = new Functions();

if (!$_SESSION["cod"] == 3):
    header("Location: verificar");
endif;

//verifica se valor do frete é zero ou vazio
//if ($_SESSION['valor_Frete'] == '0' || $_SESSION['valor_Frete'] == ''):
//    $insertGoTo = HOME . '/carrinho';
//    echo"<script language='javascript' type='text/javascript'>alert('Fazer calculo do Frete!');</script>";
//    header("refresh:0;url={$insertGoTo}");
//endif;

$produtosNoCarrinho = $carrinho->pegarProdutosDoCarrinho();
//pegando o total do carrinho
$total = $carrinho->totalDoPedido($produtoController);
if ($produtosNoCarrinho == null):
    header("Location: carrinho");
endif;


/* * ****************************** PEGANDO DADOS DO CARRINHO *********************************************** */
$frete = $_SESSION['valor_Frete'];
$tipoFrete = $_SESSION['pegarTipo'];
$totalPedido = $_SESSION['total_pedido'];


/* * ************** retorno dos dados do usuario ************************* */
$sessaoCod = $_SESSION["cod"];
$retornoUsuario = $usuarioController->retornaUsuario($sessaoCod);
$cliente_nome = $retornoUsuario->getNome();
$cliente_nascimento = $retornoUsuario->getNascimento();
$cliente_documento = $retornoUsuario->getDocumento();
$cliente_email = $retornoUsuario->getEmail();

//// pega os primeiros 2 dígitos
//$dd = substr($cleanPhone, 0, 2);
//// pegas os 9 próximos dígitos
//$telefone = substr($cleanPhone, 2, 9);
//pegar o cep
$pegarCep = $_SESSION['pegarCep'];
//id do Usuário
$idCli = $_SESSION['cod'];


/* * ******************************METHODOS DE PAGAMENTO YAPAY *********************************************** */
/** Se quiser continuar com os dados do seu cliente e salvar mais tarde, agora é hora de criá-lo.
 * DICA: Não se esqueça de gerar o `ownId` ou usar o que você já possui,
 * Aqui nós ajustamos usando a função uniqid ().* */
$idYapay = substr(md5(uniqid()), 0, 20);
//token SANDBOX
//$token = 'eb5b74ca9f17cbf';
//o token da forecetech para produção é 4bc08287f3700be
$token = '4bc08287f3700be';

/* * **********************************PEGANDO DADOS NO FORMULARIO DETALHES*********************************** */
$numeroTelefone = filter_input(INPUT_POST, "telephone_booking", FILTER_SANITIZE_STRING);
//limpando as formatação do telefone
$entTelephone = $helper->limpaTelefone($numeroTelefone);
$entLogradouro = filter_input(INPUT_POST, "endereco_endereco", FILTER_SANITIZE_STRING);
$entNumero = filter_input(INPUT_POST, "endereco_n", FILTER_SANITIZE_NUMBER_INT);
$entBairro = filter_input(INPUT_POST, "endereco_bairro", FILTER_SANITIZE_STRING);
$entCidade = filter_input(INPUT_POST, "endereco_cidade", FILTER_SANITIZE_STRING);
$entUf = filter_input(INPUT_POST, "endereco_uf", FILTER_SANITIZE_STRING);
$entComplemento = filter_input(INPUT_POST, "endereco_complemento", FILTER_SANITIZE_STRING);

/* * **********************************PEGANDO DADOS CARTÃO DE CRÉDTIO*********************************** */
$cartaoParcelas = filter_input(INPUT_POST, "txtParcela", FILTER_SANITIZE_STRING);
$cartaoNome = filter_input(INPUT_POST, "name_card_bookign", FILTER_SANITIZE_STRING);
$cartaoCpf = filter_input(INPUT_POST, "name_card_cpf", FILTER_SANITIZE_STRING);
$cartaoBandeira = filter_input(INPUT_POST, "slBandeira", FILTER_SANITIZE_STRING);
$cartaoNumber = filter_input(INPUT_POST, "name_card_number", FILTER_SANITIZE_STRING);
$cartaoMonth = filter_input(INPUT_POST, "name_card_month", FILTER_SANITIZE_STRING);
$cartaoYear = filter_input(INPUT_POST, "name_card_year", FILTER_SANITIZE_STRING);
$cartaoCvc = filter_input(INPUT_POST, "name_card_cvc", FILTER_SANITIZE_STRING);

$data['token_account'] = $token;
//$data["customer"]["contacts"][0]["type_contact"] = "H";
//$data["customer"]["contacts"][0]["number_contact"] = "";
$data["customer"]["contacts"][1]["type_contact"] = "M";
$data["customer"]["contacts"][1]["number_contact"] = "$entTelephone";

$data["customer"]["addresses"][0]["type_address"] = "B";
$data["customer"]["addresses"][0]["postal_code"] = "$pegarCep";
$data["customer"]["addresses"][0]["street"] = $entLogradouro;
$data["customer"]["addresses"][0]["number"] = $entNumero;
$data["customer"]["addresses"][0]["completion"] = $entComplemento;
$data["customer"]["addresses"][0]["neighborhood"] = $entBairro;
$data["customer"]["addresses"][0]["city"] = $entCidade;
$data["customer"]["addresses"][0]["state"] = $entUf;

//RETORNANDO DADOS DO USUARIO
$data["customer"]["name"] = $cliente_nome;
$data["customer"]["birth_date"] = $helper->converteData($cliente_nascimento);
$data["customer"]["cpf"] = $cliente_documento;
$data["customer"]["email"] = $cliente_email;

//RETORNANDO DADOS DO CARRINHO
foreach ($produtosNoCarrinho as $idProduto => $quantidade):
    $produto = $produtoController->retornaIdProduto($idProduto);
    $codProd = (int) $produto->getProduto_cod();
    $titutoProd = $produto->getProduto_nome();
    $precoProd = $produto->getProduto_preco();
    $data["transaction_product"][$codProd]["description"] = $titutoProd;
    $data["transaction_product"][$codProd]["quantity"] = $quantidade;
    $data["transaction_product"][$codProd]["price_unit"] = $precoProd;
    $data["transaction_product"][$codProd]["code"] = "$codProd";
    $data["transaction_product"][$codProd]["sku_code"] = "0001";
    $data["transaction_product"][$codProd]["extra"] = "Informaçã extra";
endforeach;

$data["transaction"]["available_payment_methods"] = "2,3,4,5,6,7,14,15,16,18,19,21,22,23";
$data["transaction"]["customer_ip"] = "127.0.0.1";
$data["transaction"]["shipping_type"] = strtoupper($tipoFrete);
$data["transaction"]["shipping_price"] = $frete;
$data["transaction"]["url_notification"] = "";
$data["transaction"]["free"] = "Campo livre";


$btnFinalizar = filter_input(INPUT_POST, 'btnFinalizar', FILTER_SANITIZE_STRING);
if ($btnFinalizar):
    //cadastrar na tabela de pedido no banco
    $pedidoNovo = new Pedido();
    $pedidoNovo->setPedidos_cliente($idCli);
    $pedidoNovo->setPedidos_id_moip($idYapay);
    $pedidoNovo->setPedidos_data(date('Y-m-d'));
    $valorFrete = str_replace(',', '.', $_SESSION['valor_Frete']);
    $pedidoNovo->setPedidos_total($totalPedido);
    $pedidoNovo->setPedidos_status(2);
    $pedidoNovo->setPedidos_frete($frete);
    $pedidoNovo->setPedidos_frete_tipo($tipoFrete);
    $pedidoNovo->setPedidos_cep($pegarCep);
    $shipping_cep = $pedidoNovo->getPedidos_cep();
    $pedidoNovo->setPedidos_endereco(filter_input(INPUT_POST, "endereco_endereco", FILTER_SANITIZE_STRING));
    $shipping_rua = $pedidoNovo->getPedidos_endereco();
    $pedidoNovo->setPedidos_numero(filter_input(INPUT_POST, "endereco_n", FILTER_SANITIZE_NUMBER_INT));
    $shipping_numero = $pedidoNovo->getPedidos_numero();
    $pedidoNovo->setPedidos_bairro(filter_input(INPUT_POST, "endereco_bairro", FILTER_SANITIZE_STRING));
    $shipping_bairro = $pedidoNovo->getPedidos_bairro();
    $pedidoNovo->setPedidos_cidade(filter_input(INPUT_POST, "endereco_cidade", FILTER_SANITIZE_STRING));
    $shipping_cidade = $pedidoNovo->getPedidos_cidade();
    $pedidoNovo->setPedidos_complemento(filter_input(INPUT_POST, "endereco_complemento", FILTER_SANITIZE_STRING));
    $shipping_complemento = $pedidoNovo->getPedidos_complemento();
    $pedidoNovo->setPedidos_uf(filter_input(INPUT_POST, "endereco_uf", FILTER_SANITIZE_STRING));
    $shipping_estado = $pedidoNovo->getPedidos_uf();
    $pedidoController->Cadastrar($pedidoNovo);

    //cadastro do PedidoProduto no banco
    foreach ($produtosNoCarrinho as $idProduto => $quantidade):
        $prod = $produtoController->retornaIdProduto($idProduto);
        $dadosPedidos[] = [
            'id' => $prod->getProduto_cod(),
            'produto' => $prod->getProduto_nome(),
            'qtd' => $quantidade,
            'preco' => $prod->getProduto_preco() * 100
        ];
        //cadastrar no banco na tabela pedidos produtos
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->setPedidos_produto_cliente($idCli);
        $pedidoProduto->setPedidos_produto_id_moip($idYapay);
        $pedidoProduto->setPedidos_produto_quantidade($quantidade);
        $pedidoProduto->setPedidos_produto_subtotal($quantidade * $prod->getProduto_preco());
        $pedidoProduto->setPedidos_produto_id($prod->getProduto_cod());
        $pedidoProduto->setPedidos_produto_nome($prod->getProduto_nome());
        $pedidoProduto->setPedidos_produto_data(date('Y-m-d'));

        $pedidoProdutoController->Cadastrar($pedidoProduto);
    endforeach;
    //cadastro do PedidoProduto no banco

    $data["transaction"]["price_discount"] = "0";
    //cadastro do PedidoProduto no banco
    //METHOD ID DO PAGAMENTO EQUIVALE AO CARTÃO DE CREDITO    
    $data["payment"]["payment_method_id"] = "$cartaoBandeira";
    $data["payment"]["card_name"] = "$cartaoNome";
    $data["payment"]["card_number"] = "$cartaoNumber";
    $data["payment"]["card_expdate_month"] = "$cartaoMonth";
    $data["payment"]["card_expdate_year"] = "$cartaoYear";
    $data["payment"]["card_cvv"] = "$cartaoCvc";
    $data["payment"]["split"] = "$cartaoParcelas";
        

    //SANDBOX URL
//    $url = "https://api.intermediador.sandbox.yapay.com.br/api/v3/transactions/payment";
    //PRODUCT URL
    $url = "https://api.intermediador.yapay.com.br/api/v3/transactions/payment";

    ob_start();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_exec($ch);
    // JSON de retorno  
    $resposta = json_decode(ob_get_contents());
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    ob_end_clean();
    curl_close($ch);     

    if ($resposta) {
        $redirect = "minha-conta";
        echo "<script>alert('Pagamento efetuado com sucesso')</script>";
        header("refresh:1;url={$redirect}");
        
    } else {
        $redirect = 'login';
        header("refresh:1;url={$redirect}");
    }
endif;

//PAGAMENTO VIA BOLETO
$btnBoleto = filter_input(INPUT_POST, 'checkout_boleto', FILTER_SANITIZE_STRING);
if ($btnBoleto):
    //cadastrar na tabela de pedido no banco
    $pedidoNovo = new Pedido();
    $pedidoNovo->setPedidos_cliente($idCli);
    $pedidoNovo->setPedidos_id_moip($idYapay);
    $pedidoNovo->setPedidos_data(date('Y-m-d'));
    $valorFrete = str_replace(',', '.', $_SESSION['valor_Frete']);
    $pedidoNovo->setPedidos_total($totalPedido);
    $pedidoNovo->setPedidos_status(2);
    $pedidoNovo->setPedidos_frete($valorFrete);
    $pedidoNovo->setPedidos_frete_tipo($tipoFrete);
    $pedidoNovo->setPedidos_cep($pegarCep);
    $shipping_cep = $pedidoNovo->getPedidos_cep();
    $pedidoNovo->setPedidos_endereco(filter_input(INPUT_POST, "endereco_endereco", FILTER_SANITIZE_STRING));
    $shipping_rua = $pedidoNovo->getPedidos_endereco();
    $pedidoNovo->setPedidos_numero(filter_input(INPUT_POST, "endereco_n", FILTER_SANITIZE_NUMBER_INT));
    $shipping_numero = $pedidoNovo->getPedidos_numero();
    $pedidoNovo->setPedidos_bairro(filter_input(INPUT_POST, "endereco_bairro", FILTER_SANITIZE_STRING));
    $shipping_bairro = $pedidoNovo->getPedidos_bairro();
    $pedidoNovo->setPedidos_cidade(filter_input(INPUT_POST, "endereco_cidade", FILTER_SANITIZE_STRING));
    $shipping_cidade = $pedidoNovo->getPedidos_cidade();
    $pedidoNovo->setPedidos_complemento(filter_input(INPUT_POST, "endereco_complemento", FILTER_SANITIZE_STRING));
    $shipping_complemento = $pedidoNovo->getPedidos_complemento();
    $pedidoNovo->setPedidos_uf(filter_input(INPUT_POST, "endereco_uf", FILTER_SANITIZE_STRING));
    $shipping_estado = $pedidoNovo->getPedidos_uf();
    $pedidoController->Cadastrar($pedidoNovo);

    //cadastro do PedidoProduto no banco
    foreach ($produtosNoCarrinho as $idProduto => $quantidade):
        $prod = $produtoController->retornaIdProduto($idProduto);
        $dadosPedidos[] = [
            'id' => $prod->getProduto_cod(),
            'produto' => $prod->getProduto_nome(),
            'qtd' => $quantidade,
            'preco' => $prod->getProduto_preco() * 100
        ];
        //cadastrar no banco na tabela pedidos produtos
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->setPedidos_produto_cliente($idCli);
        $pedidoProduto->setPedidos_produto_id_moip($idYapay);
        $_SESSION['idYapay'] = $pedidoProduto->getPedidos_produto_id_moip();
        $pedidoProduto->setPedidos_produto_quantidade($quantidade);
        $pedidoProduto->setPedidos_produto_subtotal($quantidade * $prod->getProduto_preco());
        $pedidoProduto->setPedidos_produto_id($prod->getProduto_cod());
        $pedidoProduto->setPedidos_produto_nome($prod->getProduto_nome());
        $pedidoProduto->setPedidos_produto_data(date('Y-m-d'));
        

        $pedidoProdutoController->Cadastrar($pedidoProduto);
    endforeach;
    //cadastro do PedidoProduto no banco    
    //METHOD ID DO PAGAMENTO EQUIVALE AO BOLETO
    $data["payment"]["payment_method_id"] = "6";

    //DESCONTO DE 10%
    $valorTotalPedido = $_SESSION['total_pedido'];
    $calculoDesconto = $functions->Descontos(10, $valorTotalPedido);
    $_SESSION['calculoDesconto'] = $calculoDesconto;
    $descontoBoleto = $valorTotalPedido - $calculoDesconto;

    //PEGANDO DESCONTO
    $data["transaction"]["price_discount"] = "$descontoBoleto";

//    $url = "https://api.intermediador.sandbox.yapay.com.br/api/v3/transactions/payment";
    //PRODUCT URL
    $url = "https://api.intermediador.yapay.com.br/api/v3/transactions/payment";
    ob_start();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_exec($ch);

    // JSON de retorno
    $resposta = json_decode(ob_get_contents());
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    ob_end_clean();
    curl_close($ch);
    if ($resposta) {
        $pedidoProduto2 = new PedidoProduto();
        $pedidoProdutoController = new PedidoProdutoController();
        $redirect = $resposta->data_response->transaction->payment->url_payment;
        
        $pedidoProduto2->setPedidos_produto_boleto($redirect);
        $gerarBoleto = $pedidoProduto2->getPedidos_produto_boleto();
        $codYapay = $_SESSION['idYapay'];
        
        $pedidoProdutoController->AlterarBoleto($codYapay, $gerarBoleto);       
        
        echo "<script>alert('Boleto gerado com sucesso, estamos redirecionando para impressão do boleto!')</script>";
        header("refresh:1;url={$redirect}");        
    } else {
        $redirect = 'login';
        header("refresh:1;url={$redirect}");
    }
endif;

//PAGAMENTO TRANSFERENCIA ONLINE
$debito_instituicao = filter_input(INPUT_POST, 'debito_instituicao', FILTER_SANITIZE_NUMBER_INT);
$btnDebito = filter_input(INPUT_POST, 'checkout_debito', FILTER_SANITIZE_STRING);
if ($btnDebito):
    //cadastrar na tabela de pedido no banco
    $pedidoNovo = new Pedido();
    $pedidoNovo->setPedidos_cliente($idCli);
    $pedidoNovo->setPedidos_id_moip($idYapay);
    $pedidoNovo->setPedidos_data(date('Y-m-d'));
    $valorFrete = str_replace(',', '.', $_SESSION['valor_Frete']);
    $pedidoNovo->setPedidos_total($totalPedido);
    $pedidoNovo->setPedidos_status(2);
    $pedidoNovo->setPedidos_frete($valorFrete);
    $pedidoNovo->setPedidos_frete_tipo($tipoFrete);
    $pedidoNovo->setPedidos_cep($pegarCep);
    $shipping_cep = $pedidoNovo->getPedidos_cep();
    $pedidoNovo->setPedidos_endereco(filter_input(INPUT_POST, "endereco_endereco", FILTER_SANITIZE_STRING));
    $shipping_rua = $pedidoNovo->getPedidos_endereco();
    $pedidoNovo->setPedidos_numero(filter_input(INPUT_POST, "endereco_n", FILTER_SANITIZE_NUMBER_INT));
    $shipping_numero = $pedidoNovo->getPedidos_numero();
    $pedidoNovo->setPedidos_bairro(filter_input(INPUT_POST, "endereco_bairro", FILTER_SANITIZE_STRING));
    $shipping_bairro = $pedidoNovo->getPedidos_bairro();
    $pedidoNovo->setPedidos_cidade(filter_input(INPUT_POST, "endereco_cidade", FILTER_SANITIZE_STRING));
    $shipping_cidade = $pedidoNovo->getPedidos_cidade();
    $pedidoNovo->setPedidos_complemento(filter_input(INPUT_POST, "endereco_complemento", FILTER_SANITIZE_STRING));
    $shipping_complemento = $pedidoNovo->getPedidos_complemento();
    $pedidoNovo->setPedidos_uf(filter_input(INPUT_POST, "endereco_uf", FILTER_SANITIZE_STRING));
    $shipping_estado = $pedidoNovo->getPedidos_uf();
    $pedidoController->Cadastrar($pedidoNovo);

    //cadastro do PedidoProduto no banco
    foreach ($produtosNoCarrinho as $idProduto => $quantidade):
        $prod = $produtoController->retornaIdProduto($idProduto);
        $dadosPedidos[] = [
            'id' => $prod->getProduto_cod(),
            'produto' => $prod->getProduto_nome(),
            'qtd' => $quantidade,
            'preco' => $prod->getProduto_preco() * 100
        ];
        //cadastrar no banco na tabela pedidos produtos
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->setPedidos_produto_cliente($idCli);
        $pedidoProduto->setPedidos_produto_id_moip($idYapay);
        $pedidoProduto->setPedidos_produto_quantidade($quantidade);
        $pedidoProduto->setPedidos_produto_subtotal($quantidade * $prod->getProduto_preco());
        $pedidoProduto->setPedidos_produto_id($prod->getProduto_cod());
        $pedidoProduto->setPedidos_produto_nome($prod->getProduto_nome());
        $pedidoProduto->setPedidos_produto_data(date('Y-m-d'));

        $pedidoProdutoController->Cadastrar($pedidoProduto);
    endforeach;
    //cadastro do PedidoProduto no banco
    //METHOD ID DO PAGAMENTO EQUIVALE AO BOLETO
    $data["payment"]["payment_method_id"] = "$debito_instituicao";

    //DESCONTO DE 10%
    $valorTotalPedido = $_SESSION['total_pedido'];
    $calculoDesconto = $functions->Descontos(10, $valorTotalPedido);
    $_SESSION['calculoDesconto'] = $calculoDesconto;
    $descontoDebito = $valorTotalPedido - $calculoDesconto;

    //PEGANDO DESCONTO
    $data["transaction"]["price_discount"] = "$descontoDebito";

//    $url = "https://api.intermediador.sandbox.yapay.com.br/api/v3/transactions/payment";
    //PRODUCT URL
    $url = "https://api.intermediador.yapay.com.br/api/v3/transactions/payment";
    ob_start();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_exec($ch);

    // JSON de retorno
    $resposta = json_decode(ob_get_contents());
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    ob_end_clean();
    curl_close($ch);
    if ($resposta) {
        $redirect = $resposta->data_response->transaction->payment->url_payment;
        echo "<script>alert('Estamos redirecionando para finalização do pedido!')</script>";
        header("refresh:1;url={$redirect}");
        
    } else {
        $redirect = 'login';
        header("refresh:1;url={$redirect}");
    }
endif;
?>
<div class="container">
    <div class="content">
        <div class="row checkout-row">
            <div class="column column-8">
                <form class="form" method="post">
                    <div class="form_title">
                        <h3><strong>1</strong>Detalhes Importantes</h3>
                        <p>Alguns dados básicos- <?php echo $cliente_documento;?></p>
                        
                    </div>

                    <div class="step">                        
                        <div class="row">
                            <div class="column column-12">
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text" id="telephone_booking" name="telephone_booking" maxlength="15" class="form-control" placeholder="(61) 99999-9999">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="step_2" style="margin-top: 2rem;">
                        <div class="form_title">
                            <h3><strong>2</strong>Informações entrega</h3>
                            <p>Precisamos de mais alguns dados de preenchimento, é bem rápido</p>
                        </div>

                        <div class="step">
                            <div class="row">
                                <div class="column column-4">
                                    <div class="form-group">
                                        <label>CEP</label>
                                        <input type="text" id="endereco_cep" name="endereco_cep" maxlength="8" class="form-control" placeholder="CEP sem traços" value="<?= $pegarCep; ?>">
                                    </div>
                                </div>
                                <div class="column column-8">
                                    <div class="form-group">
                                        <label>Endereço</label>
                                        <input type="text" id="endereco_endereco" name="endereco_endereco"  class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="column column-2">
                                    <div class="form-group">
                                        <label>Nº</label>
                                        <input type="text" id="endereco_n" name="endereco_n" maxlength="15" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="column column-4">
                                    <div class="form-group">
                                        <label>Bairro</label>
                                        <input type="text" id="endereco_bairro" name="endereco_bairro" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="column column-4">
                                    <div class="form-group">
                                        <label>Cidade</label>
                                        <input type="text" id="endereco_cidade" name="endereco_cidade"  class="form-control" value="">
                                    </div>
                                </div>
                                <div class="column column-2">
                                    <div class="form-group">
                                        <label>UF</label>
                                        <input type="text" id="endereco_uf" name="endereco_uf"  class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="column column-12">
                                    <div class="form-group">
                                        <label>Complemento</label>
                                        <input type="text" id="endereco_complemento" name="endereco_complemento"  class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="step">
                        <div class="row">
                            <div class="column column-12">
                                <div class="cc-selector">
                                    <input id="payment_card" class="payment_card" name="radio_pagamento" type="radio"/>
                                    <label class="drinkcard-cc visa" for="payment_card"></label>

                                    <input id="payment_boleto" class="payment_boleto" name="radio_pagamento" type="radio"/>
                                    <label class="drinkcard-cc boleto"  for="payment_boleto"></label>

                                    <input id="payment_debito" class="payment_debito" name="radio_pagamento"  type="radio"/>
                                    <label class="drinkcard-cc debito" for="payment_debito"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="tipo_pagamento_selecionado" name="tipo_pagamento_selecionado" class="form-control" placeholder="">

                    <!-----------------------------------------------------PAGAMENTO CARTÃO------------------------------------------------------------------------->
                    <div id="step_pagamento_cartao_credito" style="display:none; margin-top: 2rem;">
                        <div class="form_title">
                            <h3><strong>3</strong>Informações de Pagamento</h3>
                            <p>Você está em um ambiente seguro</p>
                        </div>
                        <div class="step">
                            <div class="row">
                                <div class="column column-12">
                                    <div class="form-group">
                                        <label>Parcelas no Cartão </label>
                                        <select name="txtParcela" id="parcelas" class="form-select" style="border: 1px solid #ccc;">
                                            <option value="">Selecione as Parcelas</option>                                    
                                            <?php
                                            for ($i = 1; $i <= 5; $i++):
                                                if ($i <= 5):
                                                    $retorno = $functions->Parcelas($i, $totalPedido);
                                                    ?>
                                                    <option value="<?= $i; ?>"><?= $i; ?>X Parcelas sem Juros de R$ <?= number_format($retorno, 2, ',', '.'); ?> - Valor do Pedido R$ <?php echo number_format($totalPedido, 2, ',', '.'); ?></option>
                                                    <?php
                                                endif;
                                            endfor;

                                            for ($i = 6; $i <= 12; $i++):
                                                if ($i <= 12 || $i >= 5):
                                                    switch ($i):
                                                        case '6':
                                                            $retorno = $functions->Juros(7.08, $totalPedido);
                                                            $parcelas = $functions->Parcelas($i, $retorno);
                                                            break;

                                                        case '7':
                                                            $retorno = $functions->Juros(8.12, $totalPedido);
                                                            $parcelas = $functions->Parcelas($i, $retorno);
                                                            break;
                                                        case '8':
                                                            $retorno = $functions->Juros(9.16, $totalPedido);
                                                            $parcelas = $functions->Parcelas($i, $retorno);
                                                            break;
                                                        case '9':
                                                            $retorno = $functions->Juros(10.21, $totalPedido);
                                                            $parcelas = $functions->Parcelas($i, $retorno);
                                                            break;
                                                        case '10':
                                                            $retorno = $functions->Juros(11.27, $totalPedido);
                                                            $parcelas = $functions->Parcelas($i, $retorno);
                                                            break;
                                                        case '11':
                                                            $retorno = $functions->Juros(12.33, $totalPedido);
                                                            $parcelas = $functions->Parcelas($i, $retorno);
                                                            break;
                                                        case '12':
                                                            $retorno = $functions->Juros(13.40, $totalPedido);
                                                            $parcelas = $functions->Parcelas($i, $retorno);
                                                            break;

                                                    endswitch;
                                                    ?>
                                                    <option value="<?= $i; ?>"><?= $i; ?>X Parcelas com Juros  de R$ <?= number_format($parcelas, 2, ',', '.'); ?> - Valor do Pedido R$ <?php echo number_format($retorno, 2, ',', '.'); ?></option>
                                                    <?php
                                                endif;
                                            endfor;
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="column column-7">
                                    <div class="form-group">
                                        <label>Nome igual ao que está no Cartão</label>
                                        <input type="text" class="form-control" id="name_card_bookign" name="name_card_bookign" placeholder="José da Silva">
                                    </div>
                                </div>
                                <div class="column column-5">
                                    <div class="form-group">
                                        <label>CPF:</label>
                                        <input type="text" maxlength="14" class="form-control" id="name_card_cpf" name="name_card_cpf" placeholder="999.999.999-99">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="column column-6">
                                    <div class="form-group">
                                        <label>Número do Cartão</label>
                                        <input type="text" placeholder="5555666677778884" name="name_card_number" id="number" class="form-control"/>
                                    </div>
                                </div>

                                <div class="column column-6">
                                    <div class="form-group">
                                        <label>Selecione o Cartão de Crédito</label>
                                        <select name="slBandeira" id="slBandeira" class="form-select" style="border: 1px solid #ccc;">
                                            <option value="">Selecione</option>
                                            <option value="2">Diners Club</option>
                                            <option value="3">Visa</option>
                                            <option value="4">Mastercard</option>
                                            <option value="5">American Express</option>
                                            <option value="15">Discover</option>
                                            <option value="16">Elo</option>
                                            <option value="18">Aura</option>
                                            <option value="19">JCB</option>
                                            <option value="20">Hipercard</option>
                                            <option value="25">Hiper (Itaú)</option>                                            
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="column column-3">                                    
                                    <div class="form-group">
                                        <label>Data expiração</label>
                                        <input type="text" id="month" name="name_card_month" maxlength="2"  class="form-control" placeholder="05">
                                    </div>
                                </div>
                                <div class="column column-3">                                    
                                    <div class="form-group">
                                        <label>Mês expiração</label>
                                        <input type="text" id="year" name="name_card_year" maxlength="4"  class="form-control" placeholder="2018">
                                    </div>
                                </div>
                                <div class="column column-3">                                    
                                    <div class="form-group">
                                        <label>CCV</label>
                                        <input type="text" id="cvc" name="name_card_cvc" maxlength="5" class="form-control" placeholder="123">
                                    </div>
                                </div>
                                <div class="column column-3">                                    
                                    <div class="form-group">
                                        <labe>Últimos 3 digitos</label>
                                            <img style="margin-top: 8px; width: 40%; height: 30px;" src="<?= INCLUDE_PATH; ?>/img/pagamento/icon_ccv.gif" width="50" height="29" alt="ccv">

                                            </div>
                                            </div>
                                            </div> 
                                            <div class="col-md-12" id="bt_continue" >                                    
                                                <input type="submit" value="Finalizar Compra" id="encrypt" class="btn btn-blue"/>                                    
                                                <input type="submit" value="Fechar Pedido" name="btnFinalizar" id="btnFinalizar" class="btn btn-green" style="display: none;"/>
                                            </div>
                                    </div><!--End row -->

                                </div>
                                <!-----------------------------------------------------FINAL PAGAMENTO CARTÃO------------------------------------------------------------------------->

                                <input type="hidden" name="erros_pagamento" class="form-control" id="erros_pagamento" value="0">

                                <!-----------------------------------------------------PAGAMENTO BOLETO------------------------------------------------------------------------->
                                <div id="step_pagamento_boleto" style="display:none">
                                    <div class="form_title">
                                        <h3><strong>3</strong>Informações de Pagamento</h3>
                                        <p>Você está em um ambiente seguro</p>
                                    </div>
                                    <div class="step">
                                    <?php
                                    $sessionDesconto = $functions->Descontos(10, $totalPedido);
                                    $sessionDesconto = number_format($sessionDesconto, 2, ',', '.');
                                    echo "<p style='font-size:1.2em; font-weight: 700'>Pagamento no Boleto com 10% desconto: R$ {$sessionDesconto}</p>";
                                    ?>
                                        <div class="row">

                                            <input type="submit" name="checkout_boleto" id="checkout_boleto" class="btn_1 green medium checkout_boleto" value="Concluir">                                
                                            <br><br><h5 id="checkout_finish_loading"></h5>
                                        </div><!--End row -->
                                    </div><!--End step -->
                                </div>
                                <!-----------------------------------------------------FINAL PAGAMENTO BOLETO------------------------------------------------------------------------->

                                <!-----------------------------------------------------PAGAMENTO DÉBITO------------------------------------------------------------------------->
                                <div id="step_pagamento_debito" style="display:none">
                                    <div class="form_title">
                                        <h3><strong>3</strong>Informações de Pagamento</h3>
                                        <p>Você está em um ambiente seguro</p>
                                    </div>
                                    <div class="step">
                                        <label>Selecione sua Instituicão Bancária</label>
                                        <div class="row">
                                            <select class="form-select" id="debito_instituicao" name="debito_instituicao" style="border: 1px solid #ccc;">
                                                <option value="7">Itaú Shopline</option>
                                                <option value="14">Peela</option>
                                                <option value="22">Bradesco</option>
                                                <option value="23">Banco do Brasil</option>
                                            </select>
                                        </div><!--End row -->
                                        <div id="policy" style="display:none">
                                            <!--<input type="submit" name="checkout_boleto" id="checkout_boleto" class="btn_1 green medium checkout_boleto" value="Concluir">-->   
                                            <!--<input type="button" style="margin-left: -15px; margin-top: 20px" name="checkout_debito" id="checkout_debito" class="btn_1 green medium" value="Concluir"></button>-->
                                            <input type="submit" style="margin-left: -15px; margin-top: 20px" name="checkout_debito" id="checkout_debito" class="btn_1 green medium" value="Concluir">
                                        </div>
                                    </div><!--End step -->
                                </div>

                                </form>

                            </div>

                            <aside class="column column-4">                             
                                <table class="table table-responsive">
                                    <thead>
                                        <th>Quant</th>
                                        <th>Produto</th>
                                        <th>Valor</th>
                                    </thead>

                                    <tbody>
                                       <?php
                                        foreach ($produtosNoCarrinho as $produtoId => $quantidade):
                                            $produtoCarrinho = $produtoController->retornaIdProduto($produtoId);
                                        ?>
                                        <tr>
                                            <td><?= $quantidade; ?></td>
                                            <td><?= $helper->limitarTexto($produtoCarrinho->getProduto_nome(), 40); ?></td>
                                            <td>R$ <?= number_format($produtoCarrinho->getProduto_preco(), 2, ",", "."); ?></td>
                                        </tr>                                    
                                       <?php endforeach; ?>    
                                    </tbody>
                                </table>
                                
                                 <table class="table table-responsive">
                                    <thead> 
                                        <tr>                                            
                                            <th>Frete</th>
                                            <th>Tipo Frete</th>
                                            <th>Valor do Pedido</th>                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr>
                                            <td>R$ <?= number_format($_SESSION['valor_Frete'], 2, ",", "."); ?></td>
                                            <td><?= strtoupper($tipoFrete); ?></td>
                                            <td>
                                                <?php
                                                $_SESSION['TotalPedido'] = $total + $_SESSION['valor_Frete'];
                                                $pedidoFinal = $_SESSION['TotalPedido'];
                                                ?>
                                                R$ <?= number_format($pedidoFinal, 2, ",", "."); ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </aside> 
                        </div>
                    </div>
</div>
<script src="<?= HOME;?>/_cdn/jquery-3.2.1.min.js"></script> 
<!--check boleto-->
<script src="<?= HOME;?>/_cdn/checkBoleto.js" type="text/javascript"></script>
<!--check cartão-->
<script src="<?= HOME;?>/_cdn/checkCartao.js" type="text/javascript"></script>
<!--check cartão-->
<script src="<?= HOME;?>/_cdn/checkDebito.js" type="text/javascript"></script>                
<script src="<?= HOME;?>/_cdn/validarPagamentoCartao.js"></script>

