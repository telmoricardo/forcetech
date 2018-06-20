<?php
//intanciando os objetos
$categoriaController = new CategoriaController();
$categoria = new Categoria();
$helper = new Helper();

//mostra a mensagem verdadeiro ou falso na hora do cadastro
$resultado = "";
$titulo = "";
$status = "";
$descricao = "";
$data = "";

$btnExcluir = filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT);
if($btnExcluir):    
    if ($categoriaController->Excluir($btnExcluir)):
        $resultado = "<div class=\"alert alert-success\">A categoria </b> foi removido com sucesso</div>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao remover a categoria</div>";
    endif;
endif;

$btnCadastrar = filter_input(INPUT_POST, "btnCadastrar", FILTER_SANITIZE_STRING);
if ($btnCadastrar):
    $categoria->setCategoria_cod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    $categoria->setCategoria_nome(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));
    $txtUrl = Helper::Name($categoria->getCategoria_nome());
    $categoria->setCategoria_url($txtUrl);
    $categoria->setCategoria_status(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $categoria->setCategoria_descricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING));    
    $categoria->setCategoria_data(date('Y-m-d H:i:s'));
    

    if ($categoriaController->Atualizar($categoria)):
        $resultado = '<div class="alert alert-info">
        <button type="button" aria-hidden="true" class="close">×</button>
        <span><b> Atualizado com sucesso - </b></span>
        </div>';        
        $insertGoTo = '?pagina=listarCategoria';
        header("refresh:2;url={$insertGoTo}");
    else:
        $resultado = '<div class="alert alert-danger">
        <button type="button" aria-hidden="true" class="close">×</button>
        <span><b> Erro ao atualizar, tente mais tarde - </b></span>
        </div>';
    endif; 
endif;



?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-lg-12 col-md-7">
                <?php
                    //retorna dado da Categoria
                    $cod = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);

                    $retornaCategoria = $categoriaController->retornaCategoria($cod);
                    if($retornaCategoria == null):
                        else:
                         $titulo = $retornaCategoria->getCategoria_nome();
                        $status = $retornaCategoria->getCategoria_status();
                        $descricao = $retornaCategoria->getCategoria_descricao();
                    
                    ?>    
                    

                        <div class="card">
                            <div class="header">
                                <h4 class="title">Categoria</h4>
                               
                            </div>
                            <div class="content">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Título</label>
                                                <input type="text" name="txtTitulo" class="form-control border-input" placeholder="Título da Categoria" value="<?=$titulo ?>">
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
    
   