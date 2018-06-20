<?php
//intanciando os objetos
$categoriaController = new CategoriaController();
$subcategoriaController = new SubcategoriaController();
$categoria = new Categoria();
$helper = new Helper();


//mostra a mensagem verdadeiro ou falso na hora do cadastro
$resultado = "";

//listando categoria
$listaCategoria = $categoriaController->ListarTodaCategoria();

$btnCadastrar = filter_input(INPUT_POST, "btnCadastrar", FILTER_SANITIZE_STRING);
if ($btnCadastrar):
    $subcategoria = new Subcategoria();
    $subcategoria->setSub_titulo(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));
    $txtUrl = Helper::Name($subcategoria->getSub_titulo());
    $subcategoria->setSub_url($txtUrl);
    $subcategoria->setSub_status(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $subcategoria->setSub_descricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING));
    $subcategoria->setSub_data(date('Y-m-d H:i:s'));
    
    $codCat = filter_input(INPUT_POST, "slCategoria", FILTER_SANITIZE_NUMBER_INT);
    $subcategoria->getCategoria()->setCategoria_cod($codCat);
    //$subcategoria->getCategoria()->setCod(filter_input(INPUT_POST, "slCategoria", FILTER_SANITIZE_NUMBER_INT)); pode ser assim 
    
    
    if ($subcategoriaController->Cadastrar($subcategoria)):
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

                    
                <div class="col-lg-12 col-md-7">                    
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Subcategoria</h4>                           
                        </div>
                        <div class="content">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" name="txtTitulo" class="form-control border-input" placeholder="Título da Categoria">
                                        </div>
                                    </div>                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status</label>
                                            <select name="slStatus" class="form-control border-input">
                                                <option value="">Selecione o status</option>
                                                <option value="1">Ativo</option>
                                                <option value="2">Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Categoria</label>
                                            <select name="slCategoria" class="form-control border-input">
                                                <?php
                                                    if($listaCategoria == null):
                                                        echo '<option>não existe categoria cadastrada</option>';
                                                    else:
                                                        echo "<option value=''>Selecione uma categoria</option>";  
                                                        foreach($listaCategoria as $cat):
                                                            echo "<option value='{$cat->getCategoria_cod()}'>{$cat->getCategoria_nome()}</option>";                                                      
                                                        endforeach;
                                                    endif;
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Breve Descrição </label>
                                            <input type="text" name="txtDescricao" class="form-control border-input" placeholder="Breve descrição">
                                        </div>
                                    </div>                                   
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo $resultado; ?>
                                    </div>
                                    
                                </div>                               


                                <div class="text-center">
                                    <input type="submit" class="btn btn-success btn-fill btn-wd" name="btnCadastrar" value="Cadastrar">
                                    <a href="?pagina=listaSubcategoria" class="btn btn-info btn-fill btn-wd">Listar subcategoria</a>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

