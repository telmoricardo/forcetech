<?php
//chamandoos objetos
$categoriaController = new CategoriaController();
$categoria = new Categoria();
$helper = new Helper();

//mostra a mensagem verdadeiro ou falso na hora do cadastro
$resultado = "";

$btnCadastrar = filter_input(INPUT_POST, "btnCadastrar", FILTER_SANITIZE_STRING);
if ($btnCadastrar):
    $categoria->setCategoria_nome(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));
    $txtUrl = Helper::Name($categoria->getCategoria_nome());
    $categoria->setCategoria_url($txtUrl);
    $categoria->setCategoria_status(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $categoria->setCategoria_descricao(filter_input(INPUT_POST, "txtDescricao", FILTER_SANITIZE_STRING)); 
    $categoria->setCategoria_data(date('Y-m-d H:i:s'));   
    
     
    if ($categoriaController->Cadastrar($categoria)):
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
                            <h4 class="title">Categoria</h4>   
                            
                        </div>
                        <div class="content">
                            <form method="post">
                                <div class="row">
                                    <div class="col-md-9">
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
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Breve Descrição </label>                                            
                                            <input type="text" name="txtDescricao" class="form-control border-input" placeholder="Breve Descrição">
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
                                    <a href="?pagina=listarCategoria" class="btn btn-info btn-fill btn-wd">Listar Categoria</a>
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

