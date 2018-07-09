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

$btnCadastrar = filter_input(INPUT_POST, 'btnCadastrar', FILTER_SANITIZE_STRING);
if($btnCadastrar):
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
    $produto->setProduto_view(1);
    
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
    
    //imagem esta recebendo files imagemArtigo
    $imagem = $_FILES['imagemArtigo'];                        

    //recebendo a imagem, nome do produto, tamanho da imagem, pasta
    $upload->Image($imagem, $nomeProd, 1000, 'produtos'); 

    //setando a imagem
    $nomeImagem = $upload->getResult();
    $produto->setProduto_thumb($nomeImagem);  
    
    

   //cadastro do produto
    if ($produtoController->Cadastrar($produto)):
        $resultado = '<div class="alert alert-success">
            <button type="button" aria-hidden="true" class="close">×</button>
            <span><b> Cadastro efetuado com sucesso - </b></span>
        </div>';
    else:
        $resultado = '<div class="alert alert-danger">
            <button type="button" aria-hidden="true" class="close">×</button>
            <span><b> Erro ao cadastrar - Favor preencha todos os campos</b></span>
        </div>';
    endif;

endif;
?>



<div class="content">
    <div class="container-fluid">
        <div class="row">
            <form method="post" enctype="multipart/form-data" id="frmProduto" name="frmProduto" onSubmit="return validaCadastro();">
                <div class="col-lg-8 col-md-7">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Cadastrar Novo Produto</h4>                              
                        </div>
                        <div class="content">
                            <form>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>CAPA (JPG 800X1000PX):</label>
                                            <input type="file" class="form-control border-input uploader" id="imagemArtigo"  name="imagemArtigo">
                                            <span class="msg-error msg-thumb"></span>
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Produto</label>
                                            <input type="text" class="form-control border-input" id="txtProduto" name="txtProduto" placeholder="nome do produto">
                                            <span class="msg-error msg-titulo"></span>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Breve Descrição</label>
                                            <input type="text" class="form-control border-input" name="txtBreve" placeholder="Uma Breve descrição do produto" value="">
                                        </div>
                                    </div>                                    
                                </div>

                                <div class="row">

                                    <div class="col-md-5">

                                        <div class="form-group">
                                            <label>Código do Produto</label>
                                            <input type="text" class="form-control border-input" name="txtCodigo" placeholder="Código do Produto" value="">
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tipo</label>
                                            <select id="slTipo" name="slTipo" class="form-control border-input">
                                                <?php
                                                $listaTipo = $tipoController->ListarTodaTipo();

                                                if ($listaTipo == NULL):
                                                    echo '<option value="">Não existem tipos cadastradas</option>';
                                                else:
                                                    echo '<option value="">Selecione o tipo</option>';
                                                    foreach ($listaTipo as $t):
                                                        echo "<option value={$t->getTipo_cod()}>{$t->getTipo_nome()}</option>";
                                                    endforeach;
                                                endif;
                                                ?>                                                  
                                            </select>
                                            <span class="msg-error msg-tipo"></span>
                                        </div>
                                    </div>                                        


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select id="slStatus" name="slStatus" class="form-control border-input">                                                    
                                                <option value="">Selecione o Status</option>
                                                <option value="1">Ativo</option>
                                                <option value="2">Bloqueado</option>
                                            </select>
                                            <span class="msg-error msg-status"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slCategoria">Categoria</label>
                                            <select id="slCategoria" name="slCategoria" class="form-control border-input">
                                            <?php
                                            $listaCategoria = $categoriaController->ListarTodaCategoria();

                                            if ($listaCategoria == NULL):
                                                echo '<option value="">Não existem categoria cadastradas</option>';
                                            else:
                                                echo '<option value="">Selecione a categoria</option>';
                                                foreach ($listaCategoria as $cat):
                                                    echo "<option value={$cat->getCategoria_cod()}>{$cat->getCategoria_nome()}</option>";
                                                endforeach;
                                            endif;
                                            ?>
                                            </select>
                                            <span class="msg-error msg-categoria"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="slSubcategoria">Subcategoria</label>
                                            <select id="slSubcategoria" name="slSubcategoria" class="form-control border-input">
                                                <option value="">Selecione a Subcategoria</option>
                                            </select>
                                            <span class="msg-error msg-subcategoria"></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Descrição do Produto</label>
                                            <textarea rows="3" name="txtDescricao" class="form-control border-input" placeholder="Descrição do produto" value="">
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Preço R$ 1000,00</label>
                                            <input type="text" class="form-control border-input" id="txtPreco" name="txtPreco" placeholder="1000,00" value="">
                                            <span class="msg-error msg-preco"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Estoque</label>
                                            <input type="text" class="form-control border-input" name="txtEstoque" placeholder="Código do Produto" value="Quantidade em Estoque">
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
                                            <label>ALTURA EM CM</label>
                                            <input type="text" class="form-control border-input" id="txtAltura" name="txtAltura" placeholder="11,9" value="">
                                            <span class="msg-error msg-altura"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>LARGURA EM CM:</label>
                                            <input type="text" class="form-control border-input" id="txtLargura" name="txtLargura" placeholder="11,9" value="">
                                            <span class="msg-error msg-largura"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label>PESO EM GRAMAS:</label>
                                            <input type="text" class="form-control border-input" id="txtPeso" name="txtPeso" placeholder="0,200" value="">
                                            <span class="msg-error msg-peso"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                    <?php echo $resultado; ?>
                                    </div>                                    
                                </div>    


                                <div class="text-center">
                                    <input type="submit" class="btn btn-info btn-fill btn-wd" name="btnCadastrar" value="Cadastrar Produto">
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
                        <img id="img-uploaded" src="assets/img/no_image.jpg" alt="Sua imagem">
                    </div>                        
                </div>                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
   //pegando o formulario pelo id
    var form = document.getElementById('frmProduto');

    //verificando os browsers
    if (form.addEventListener) {
        form.addEventListener("submit", validaCadastro);
    } else if (form.attachEvent) {
        form.attachEvent("onsubmit", validaCadastro);
    }

    //validando os elementos titulo e descrição
    function validaCadastro(evt) {
        var thumb = document.getElementById('imagemArtigo');
        var titulo = document.getElementById('txtProduto');
        var tipo = document.getElementById('slTipo');
        var status = document.getElementById('slStatus');
        var categoria = document.getElementById('slCategoria');
        var subcategoria = document.getElementById('slSubcategoria');
        var preco = document.getElementById('txtPreco');
        var altura = document.getElementById('txtAltura');
        var largura = document.getElementById('txtLargura');
        var peso = document.getElementById('txtPeso');



        var contErro = 0;

        caixa_thumb = document.querySelector('.msg-thumb');
        if (thumb.value == "" ) {
            caixa_thumb.innerHTML = "*Favor adicione a imagem";
            caixa_thumb.style.display = 'block';
            contErro += 1;
        } else {
            caixa_thumb.style.display = 'none';
        }
        caixa_titulo = document.querySelector('.msg-titulo');
        if (titulo.value == "" || titulo.value.length < 5) {
            caixa_titulo.innerHTML = "*Favor preencher o titulo";
            caixa_titulo.style.display = 'block';
            contErro += 1;
        } else {
            caixa_titulo.style.display = 'none';
        }
        
        caixa_tipo = document.querySelector('.msg-tipo');
        if (tipo.value == "") {
            caixa_tipo.innerHTML = "*Selecione o tipo";
            caixa_tipo.style.display = 'block';
            contErro += 1;
        } else {
            caixa_tipo.style.display = 'none';
        }
        
        caixa_status = document.querySelector('.msg-status');
        if (status.value == "") {
            caixa_status.innerHTML = "*Selecione o status";
            caixa_status.style.display = 'block';
            contErro += 1;
        } else {
            caixa_status.style.display = 'none';
        }
        
        caixa_categoria = document.querySelector('.msg-categoria');
        if (categoria.value == "") {
            caixa_categoria.innerHTML = "*Selecione a categoria";
            caixa_categoria.style.display = 'block';
            contErro += 1;
        } else {
            caixa_categoria.style.display = 'none';
        }
        
        caixa_subcategoria = document.querySelector('.msg-subcategoria');
        if (subcategoria.value == "") {
            caixa_subcategoria.innerHTML = "*Selecione a subcategoria";
            caixa_subcategoria.style.display = 'block';
            contErro += 1;
        } else {
            caixa_subcategoria.style.display = 'none';
        }
        
        caixa_preco = document.querySelector('.msg-preco');
        if (preco.value == "") {
            caixa_preco.innerHTML = "*Informe o preço do produto";
            caixa_preco.style.display = 'block';
            contErro += 1;
        } else {
            caixa_preco.style.display = 'none';
        }
        caixa_altura = document.querySelector('.msg-altura');
        if (altura.value == "") {
            caixa_altura.innerHTML = "*Informe altura";
            caixa_altura.style.display = 'block';
            contErro += 1;
        } else {
            caixa_altura.style.display = 'none';
        }
        caixa_largura = document.querySelector('.msg-largura');
        if (largura.value == "") {
            caixa_largura.innerHTML = "*Informe largura";
            caixa_largura.style.display = 'block';
            contErro += 1;
        } else {
            caixa_largura.style.display = 'none';
        }
        
        caixa_peso = document.querySelector('.msg-peso');
        if (peso.value == "") {
            caixa_peso.innerHTML = "*Informe peso";
            caixa_peso.style.display = 'block';
            contErro += 1;
        } else {
            caixa_peso.style.display = 'none';
        }
        
//        
//        caixa_texto = document.querySelector('.msg-descricao');
//        if (texto.value == "") {
//            caixa_texto.innerHTML = "Favor preencher a Descricão do Imóvel";
//            caixa_texto.style.display = 'block';
//            contErro += 1;
//        } else {
//            caixa_texto.style.display = 'none';
//        }
//        
//        caixa_endereco = document.querySelector('.msg-endereco');
//        if (endereco.value == "") {
//            caixa_endereco.innerHTML = "Favor preencher o endereço";
//            caixa_endereco.style.display = 'block';
//            contErro += 1;
//        } else {
//            caixa_endereco.style.display = 'none';
//        }
//        
//        caixa_tipo = document.querySelector('.msg-tipo');
//        if (tipo.value == "") {
//            caixa_tipo.innerHTML = "Favor Selecione o tipo de Imóvel";
//            caixa_tipo.style.display = 'block';
//            contErro += 1;
//        } else {
//            caixa_tipo.style.display = 'none';
//        }
//        
//        caixa_thumb = document.querySelector('.msg-thumb');
//        if (thumb.value == "") {
//            caixa_thumb.innerHTML = "Favor Selecione o tipo de Imóvel";
//            caixa_thumb.style.display = 'block';
//            contErro += 1;
//        } else {
//            caixa_thumb.style.display = 'none';
//        }
//        
//        caixa_area = document.querySelector('.msg-area');
//        if (area.value == "") {
//            caixa_area.innerHTML = "Favor Selecione o tipo de Imóvel";
//            caixa_area.style.display = 'block';
//            contErro += 1;
//        } else {
//            caixa_area.style.display = 'none';
//        }

        
        if (contErro > 0) {
            evt.preventDefault();
        }
    }
</script>


