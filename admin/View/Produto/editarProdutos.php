<?php
//chamando as classes
//instanciando os objetos
$produto = new Produto();
$produtoController = new ProdutoController();
$helper = new Helper();
$categoriaController = new CategoriaController();
$subcategoriaController = new SubcategoriaController();
$tipoController = new TipoController();
$upload = new Upload();

//mostra a mensagem verdadeiro ou falso na hora do cadastro
$resultado = "";
$retorno = "";

$dataInicial = "";
$dataFinal = "";

//alteração da imagem
$submitImage = filter_input(INPUT_POST, 'submitImage', FILTER_SANITIZE_STRING);
if ($submitImage):
    $cod = filter_input(INPUT_GET, 'cod', FILTER_VALIDATE_INT);
    $retornaImagem = $produtoController->retornaProdutoImagem($cod);
    $thumbProd = $retornaImagem->getProduto_thumb();
    $nomeProd = $retornaImagem->getProduto_nome();
    $capa = "../upload/" . $thumbProd;
    if (file_exists($capa) && !is_dir($capa)):
        unlink($capa);
    endif;

    //imagem esta recebendo files imagemArtigo
    $imagem = $_FILES['imagemArtigo'];
    //recebendo a imagem, nome do produto, tamanho da imagem, pasta
    $upload->Image($imagem, $nomeProd, 1000, 'produtos');
    //setando a imagem
    $nomeImagem = $upload->getResult();
    $produto->setProduto_thumb($nomeImagem);

    if ($produtoController->AlterarImagem($cod, $nomeImagem)):
        $resultado = "<div class=\"alert alert-success\">A imagem <b>{$nomeImagem} </b> foi alterado com sucesso</div>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao cadastrar </div>";
    endif;
endif;

 /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 //alteração do post                             
$btnCadastrar = filter_input(INPUT_POST, 'btnCadastrar', FILTER_SANITIZE_STRING);
if ($btnCadastrar):
    $cod = filter_input(INPUT_GET, 'cod', FILTER_VALIDATE_INT);
    $retornaProduto = $produtoController->retornaIdProduto($cod);
    
    $produto->setProduto_cod(filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT));
    $produto->setProduto_nome(filter_input(INPUT_POST, 'txtProduto', FILTER_SANITIZE_STRING));
    $nomeProd = $produto->getProduto_nome();
    $txtUrl = Helper::Name($produto->getProduto_nome());
    $produto->setProduto_url($txtUrl);
    $produto->setProduto_breve(filter_input(INPUT_POST, 'txtBreve', FILTER_SANITIZE_STRING));
    $produto->setProduto_codigo(filter_input(INPUT_POST, 'txtCodigo', FILTER_SANITIZE_STRING));
    $produto->setProduto_tipo(filter_input(INPUT_POST, 'slTipo', FILTER_VALIDATE_INT));
    $produto->setProduto_status(filter_input(INPUT_POST, 'slStatus', FILTER_VALIDATE_INT));
    $produto->setProduto_descricao(filter_input(INPUT_POST, 'txtDescricao', FILTER_SANITIZE_SPECIAL_CHARS));      
    $produto->setProduto_categoria(filter_input(INPUT_POST, 'slCategoria', FILTER_VALIDATE_INT));
    $produto->setProduto_subcategoria(filter_input(INPUT_POST, 'slSubcategoria', FILTER_VALIDATE_INT));    
    $produto_preco = filter_input(INPUT_POST, 'txtPreco', FILTER_SANITIZE_STRING);
    $number = str_replace(',', '.', $produto_preco);
    $produto->setProduto_preco($number);        
    $produto->setProduto_estoque(filter_input(INPUT_POST, 'txtEstoque', FILTER_VALIDATE_INT));    
    $produto_altura = filter_input(INPUT_POST, 'txtAltura', FILTER_SANITIZE_STRING);
    $p_altura = str_replace(',', '.', $produto_altura);
    $produto->setProduto_altura($p_altura);    
    $produto_largura = filter_input(INPUT_POST, 'txtLargura', FILTER_SANITIZE_STRING);
    $p_largura = str_replace(',', '.', $produto_largura);
    $produto->setProduto_largura($p_largura);     
    $produto->setProduto_profundidade(17);    
    $produto_peso = filter_input(INPUT_POST, 'txtPeso', FILTER_SANITIZE_STRING);
    $p_peso = str_replace(',', '.', $produto_peso);    
    $produto->setProduto_peso($p_peso);  
    
    //Alterar do produto
    if ($produtoController->Atualizar($produto)):
        $resultado = '<div class="alert alert-success">
                        <button type="button" aria-hidden="true" class="close">×</button>
                        <span><b> Atualizado efetuado com sucesso - </b></span>
                    </div>';
    else:
        $resultado = '<div class="alert alert-danger">
                        <button type="button" aria-hidden="true" class="close">×</button>
                        <span><b> Erro ao Atualizar - Favor preencha todos os campos</b></span>
                    </div>';
    endif;

endif;
////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//retornando os dados para o formulário - atraves do get COD
$cod = filter_input(INPUT_GET, 'cod', FILTER_VALIDATE_INT);
$retornaProduto = $produtoController->retornaIdProduto($cod);

if ($retornaProduto == NULL):
    
else:
    $nome = $retornaProduto->getProduto_nome();
    $breve = $retornaProduto->getProduto_breve();
    $codigo = $retornaProduto->getProduto_codigo();    
    $descricao = $retornaProduto->getProduto_descricao();
    $preco = $retornaProduto->getProduto_preco();
    $estoque = $retornaProduto->getProduto_estoque();
    $altura = $retornaProduto->getProduto_altura();
    $largura = $retornaProduto->getProduto_largura();
    $profundidade = $retornaProduto->getProduto_profundidade();
    $peso = $retornaProduto->getProduto_peso();
    $thumb = $retornaProduto->getProduto_thumb();
    $status = $retornaProduto->getProduto_status();    
    $dataInicial = $retornaProduto->getProduto_datainicial();
    $dataFinal = $retornaProduto->getProduto_datafinal();
    

    //pegando os dados da categoria
    $categCod = $retornaProduto->getProduto_categoria()->getCategoria_cod();
    $categTitle = $retornaProduto->getProduto_categoria()->getCategoria_nome();
    //pegando os dados da Subcategoria
    $subCod = $retornaProduto->getProduto_Subcategoria()->getSub_cod();
    $subTitle = $retornaProduto->getProduto_Subcategoria()->getSub_titulo();
    //pegando os dados da tipo
    $tipoCod = $retornaProduto->getProduto_tipo()->getTipo_cod();
    $tipoTitle = $retornaProduto->getProduto_tipo()->getTipo_nome();
    
    ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                
                <form method="post" enctype="multipart/form-data">
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Alterar Produto</h4>                                
                                <?php
                                
                                    
                                ?>
                                
                                <?php
                                    $btnPromocao = filter_input(INPUT_POST, "btnPromocao", FILTER_SANITIZE_STRING);
                                    if($btnPromocao):
                                        $produtoNovo = new Produto();
                                        $dataInicial = $helper->converteData(filter_input(INPUT_POST, "dataInicial", FILTER_SANITIZE_STRING));
                                        $produtoNovo->setProduto_datainicial($dataInicial);
                                        $dataFinal = $helper->converteData(filter_input(INPUT_POST, "dataFinal", FILTER_SANITIZE_STRING));
                                        $produtoNovo->setProduto_datafinal($dataFinal);
                                        
                                        if($produtoController->AlterarDataPromocao($cod, $dataInicial, $dataFinal)):
                                            $retorno = '<div class="alert alert-success">
                                                            <button type="button" aria-hidden="true" class="close">×</button>
                                                            <span><b> Atualizado com sucesso - </b></span>
                                                        </div>';
                                        else:
                                            $retorno = '<div class="alert alert-danger">
                                                            <button type="button" aria-hidden="true" class="close">×</button>
                                                            <span><b> Erro ao Atualizar - Favor preencha todos os campos</b></span>
                                                        </div>';
                                        endif;
                                    endif;
                                ?>
                            </div>
                            <div class="content">
                                <form>                                  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Produto</label>
                                                <input type="text" class="form-control border-input" name="txtProduto" placeholder="Produto" value="<?= $nome; ?>">
                                            </div>
                                        </div>                                    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Breve Descrição</label>
                                                <input type="text" class="form-control border-input" name="txtBreve" placeholder="Uma Breve descrição do produto" value="<?= $breve; ?>">
                                            </div>
                                        </div>                                    
                                    </div>

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Código do Produto</label>
                                                <input type="text" class="form-control border-input" name="txtCodigo" placeholder="Código do Produto" value="<?= $codigo; ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Tipo</label>
                                                <select id="slTipo" name="slTipo" class="form-control border-input">
                                                    <option value="<?= $tipoCod; ?>"><?= $tipoTitle; ?></option>
                                                    
                                                        <?php
                                                         $listaTipo = $tipoController->ListarTodaTipo();                                                     
                                                        foreach ($listaTipo as $tipo):
                                                            if ($tipo->getTipo_nome() == $tipoTitle):
                                                            else:
                                                                echo "<option value={$tipo->getTipo_cod()}>{$tipo->getTipo_nome()}</option>";
                                                            endif;
                                                        endforeach;
                                                        ?>
                                                </select>
                                            </div>
                                        </div>                                  
                                                                       
                                       <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select id="slStatus" name="slStatus" class="form-control border-input">                                                    
                                                    <?php
                                                        if ($status == 1):
                                                            ?>
                                                            <option value="1" selected='selected'>Ativo</option>
                                                            <?php
                                                        else:
                                                            ?>
                                                            <option value="2" selected='selected'>Bloqueado</option>
                                                        <?php
                                                        endif;
                                                        if ($status != 1):
                                                            ?>
                                                            <option value="1" <?php $status == 1 ? "selected='selected'" : "" ?>>Ativo</option>
                                                            <?php
                                                        else:
                                                            ?>
                                                            <option value="2" <?php $status == 2 ? "selected='selected'" : "" ?>>Bloqueado</option>
                                                        <?php
                                                        endif;
                                                        ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="slCategoria">Categoria</label>
                                                <select id="slCategoria" name="slCategoria" class="form-control border-input">
                                                    <option value="<?= $categCod; ?>"><?= $categTitle;?></option>                                                   
                                                    
                                                    <?php
                                                        $listaCategoria = $categoriaController->ListarTodaCategoria();

                                                        if ($listaCategoria == NULL):
                                                            echo '<option value="">Não existem categoria cadastradas</option>';
                                                        else:                                                            
                                                            foreach ($listaCategoria as $cat):
                                                                if($cat->getCategoria_nome() == $categTitle):
                                                                
                                                                 else:                                                                    
                                                                    echo "<option value={$cat->getCategoria_cod()}>{$cat->getCategoria_nome()}</option>";
                                                                endif;
                                                            endforeach;                                                            
                                                        endif;
//                                                    ?>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="slSubcategoria">Subcategoria</label>
                                                <select id="slSubcategoria" name="slSubcategoria" class="form-control border-input">
                                                    <option value="<?= $subCod; ?>"><?= $subTitle;?></option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Descrição do Produto</label>
                                                <textarea rows="10" name="txtDescricao" class="form-control border-input" placeholder="Descrição do produto" >
                                                    <?= $descricao; ?>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Preço R$ 1000,00</label>
                                                <input type="text" class="form-control border-input" name="txtPreco" placeholder="Código do Produto" value="<?= number_format($preco, 2, ",", ""); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Estoque</label>
                                                <input type="text" class="form-control border-input" name="txtEstoque" placeholder="Código do Produto" value="<?= $estoque;?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="title">DIMENSÕES DO PRODUTO:</h4>
                                        </div>
                                    </div>

                                    <div class="row">                                    
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>ALTURA EM CENTÍMETROS</label>
                                                <input type="text" class="form-control border-input" name="txtAltura" placeholder="ALTURA EM CENTÍMETROS" value="<?= number_format($altura, 2, ",", "."); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label>LARGURA EM CENTÍMETROS:</label>
                                                <input type="text" class="form-control border-input" name="txtLargura" placeholder="LARGURA EM CENTÍMETROS" value="<?= number_format($largura, 2, ",", "."); ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label>PESO EM GRAMAS:</label>
                                                <input type="text" class="form-control border-input" name="txtPeso" placeholder="PESO EM GRAMAS" value="<?= number_format($peso, 3, ",", "."); ?>">
                                                <small>OBS: 0,200 PARA 200gr</small>
                                            </div>
                                        </div>
                                    </div>

<!--                                    <div class="row">                                    
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>PROFUNDIDADE EM CENTÍMETROS:</label>
                                                <input type="text" class="form-control border-input" name="txtProfundidade" placeholder="PROFUNDIDADE EM CENTÍMETROS" value="<?= $profundidade;?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label>PESO EM GRAMAS:</label>
                                                <input type="text" class="form-control border-input" name="txtPeso" placeholder="PESO EM GRAMAS" value="<?= $peso;?>">
                                            </div>
                                        </div>
                                    </div>-->
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $resultado; ?>
                                        </div>                                    
                                    </div>    


                                    <div class="text-center">
                                        <input type="submit" class="btn btn-success btn-fill btn-wd" name="btnCadastrar" value="Alterar Produto">
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="col-lg-4 col-md-5">
                    <div class="card card-user">
                        <div class="image">
                            <?php                            
                                if($thumb== null):
                                    echo '<img id="img-uploaded" src="assets/img/no_image.jpg" alt="Sua imagem">';
                                else:
                                    echo "<img id='img-uploaded' src='../upload/{$thumb}' alt='Sua imagem'>";
                                endif;
                            ?>                            
                        </div>                        
                    </div>
                    
                    
                    <div class="card">
                        <div class="row" id="image_preview">                               
                        </div>
                        <div class="content">                            
                            <div class="row">                                 
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label>CAPA (JPG 800X1000PX):</label>
                                        <input type="file" class="form-control border-input uploader" id="imagemArtigo"  name="imagemArtigo">
                                    </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn btn-success btn-fill btn-wd" name='submitImage' value="Alterar Capa"/>
                                    </div>
                                </form>                              
                            </div>
                        </div>
                    </div>

                    <div class="card">                       
                        <div class="header">
                            <h4 class="title">Oferta:</h4>
                        </div>
                        <div class="content">                            
                            <div class="row">
                                <form action="" method="post">
                                    <div class="col-md-12">                                    
                                        <div class="form-group">
                                            <label>INÍCIO DA PROMOÇÃO:</label>
                                            <input type="text" name="dataInicial" class="form-control border-input" value="<?= $helper->converteData($dataInicial); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>FIM DA PROMOÇÃO:</label>
                                            <input type="text" name="dataFinal" class="form-control border-input" value="<?= $helper->converteData($dataFinal); ?>">
                                        </div>                                    
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <?php echo $retorno; ?>
                                    </div>                                    
                                    
                                    <div class="text-center">
                                        <input type="submit" class="btn btn-info btn-fill btn-wd" name="btnPromocao" value="Cadastrar Promoção">
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    endif;
?>
    <script type="text/javascript">
        function preview_images()
        {
            var total_file = document.getElementById("images").files.length;
            for (var i = 0; i < total_file; i++)
            {
                $('#image_preview').append("<div class='col-md-3'><img class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
            }
        }
    </script>


