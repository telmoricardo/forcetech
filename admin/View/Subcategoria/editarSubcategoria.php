<?php

//chamando as classes
//intanciando os objetos
$subcategoriaController = new SubcategoriaController();
$categoriaController = new CategoriaController();
$categoria = new Categoria();
$subcategoria = new Subcategoria();
$helper = new Helper();

//mostra a mensagem verdadeiro ou falso na hora do cadastro
$resultado = "";
$titulo = "";
$status = "";
$descricao = "";
$data = "";

$btnCadastrar = filter_input(INPUT_POST, "btnCadastrar", FILTER_SANITIZE_STRING);
if ($btnCadastrar):
    $subcategoria->setSub_cod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    $subcategoria->setSub_titulo(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));
    $txtUrl = Helper::Name($subcategoria->getSub_titulo());
    $subcategoria->setSub_url($txtUrl);
    $subcategoria->setSub_status(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $subcategoria->setSub_descricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING));    
    $subcategoria->setSub_data(date('Y-m-d H:i:s'));
    
    $subcategoria->setCategoria(filter_input(INPUT_POST, "slCategoria", FILTER_SANITIZE_NUMBER_INT));      
    
    if ($subcategoriaController->Atualizar($subcategoria)):
        $resultado = '<div class="alert alert-info">
        <button type="button" aria-hidden="true" class="close">×</button>
        <span><b> Atualizado com sucesso - </b></span>
        </div>';
        $insertGoTo = '?pagina=listsub';
        header("refresh:2;url={$insertGoTo}");
    else:
        $resultado = '<div class="alert alert-danger">
        <button type="button" aria-hidden="true" class="close">×</button>
        <span><b> Erro ao atualizar, tente mais tarde - </b></span>
        </div>';
    endif; 
endif;


//listando os usuarios
$listaSubcategoria = $subcategoriaController->ListaSubcategoria();


?>


    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-7" id="listarSub">
                <?php
                    //retorna dado da Categoria
                    $cod = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);

                    $retornaSubcategoria = $subcategoriaController->retornaSubcategoria($cod);               
                    
                    if($retornaSubcategoria == null):                        
                    else:
                        $titulo = $retornaSubcategoria->getSub_titulo();
                        $status = $retornaSubcategoria->getSub_status();
                        $descricao = $retornaSubcategoria->getSub_descricao();
                        $categoriaCod = $retornaSubcategoria->getCategoria()->getCategoria_cod();
                        $categoriaTitulo = $retornaSubcategoria->getCategoria()->getCategoria_nome();                          
                        
                    ?>   
                    

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
                                                <input type="text" name="txtTitulo" class="form-control border-input" placeholder="Título da Categoria" value="<?=$titulo ?>">
                                            </div>
                                        </div>    
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Categoria</label>
                                                <select name="slCategoria" class="form-control border-input">
                                                    <option value="<?= $categoriaCod; ?>"><?= $categoriaTitulo; ?></option>
                                                    <option>--------------------------------------</option>
                                                    <?php
                                                        $listaCategoria = $categoriaController->ListarCategoria();
                                                        foreach ($listaCategoria as $cat):
                                                            if($cat->getCategoria_nome() == $categoriaTitulo):
                                                                else:
                                                                echo "<option value=\"{$cat->getCategoria_cod()}\">{$cat->getCategoria_nome()}</option>";
                                                            endif;
                                                        endforeach;
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Status</label>
                                                <select name="slStatus" class="form-control border-input">                                                   
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
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Breve Descrição </label>                                            
                                            <input type="text" name="txtDescricao" class="form-control border-input" placeholder="Breve Descrição" value="<?= $descricao; ?>">
                                        </div>
                                    </div>                                  
                                </div>   
                                    

                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $resultado; ?>
                                        </div>
                                    </div>                              

                                    <div class="text-center">
                                        <input type="submit" class="btn btn-success btn-fill btn-wd" name="btnCadastrar" value="Atualizar">
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>


            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#btn_atualizar').on('click', function(){
                $('#listar_categoria').show();
            }) ;
         });
    </script>
  