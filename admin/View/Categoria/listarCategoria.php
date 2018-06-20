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

$quantidade = 8;
$inicio = ($pg * $quantidade) - $quantidade;
//listando os usuarios
$listaCategoria = $categoriaController->ListarCategoria($inicio, $quantidade);


?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Lista de Categoria</h4>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Descricao</th>
                                    <th>Data</th>
                                    <th>Atualizar</th>
                                    <th>Excluir</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php
                                        if($listaCategoria == null):
                                            echo '<td colspan="7">Não existe nenhuma categoria cadastrada nesse momento</td';
                                        else:
                                            foreach($listaCategoria as $cat):
                                    ?>
                                    <tr>
                                    
                                        <td><?= $cat->getCategoria_cod();?></td>
                                        <td><?= $cat->getCategoria_nome();?></td>
                                        <td><?= $cat->getCategoria_descricao();?></td>
                                        <td><?= $helper->converteData($cat->getCategoria_data());?></td>
                                        <td><a href="?pagina=editarCategoria&cod=<?= $cat->getCategoria_cod();?>" class="btn btn-sm btn-info btn-icon"><i class="fa ti-slice"></i></a></td>
                                        <td><a href="?pagina=editarCat&del=<?= $cat->getCategoria_cod();?>" title="Excluir" class="btn btn-sm btn-danger btn-icon"><i class="fa ti-trash"></i></a></td>
                                        <td><?= ($cat->getCategoria_status()) == 1 ? '<a title="Ativo" class="btn btn-fill btn-success btn-icon"><i class="fa ti-check"></i></a>' : '<a title="Bloqueado" class="btn btn-fill btn-danger btn-icon"><i class="fa ti-close"></i></a>'?></td>
                                    
                                    </tr>
                                    <?php
                                            endforeach;
                                        endif;
                                    ?>
                                    

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
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
                    
                    <nav aria-label="Page navigation">
                <?php
                $totalRegistros = $categoriaController->RetornaQtdSubcategoria();
                $totalRegistros;
                if ($totalRegistros <= $quantidade):
                    
                else:
                    $paginas = ceil($totalRegistros / $quantidade);
                    $links = 5;

                    if (isset($i)):
                    else:
                        $i = '1';
                    endif;
                ?>
                <!-- ativação da paginação-->
                    <style>
                    <?php
                    if (isset($_GET['pg'])):
                        $num_pg = $_GET['pg'];
                    endif;
                    ?>
                        .pagination a.active<?php echo $num_pg; ?>{background-color: #069; color: #fff; }
                    </style>
                <ul class="pagination">
                    <li><a href="dashboard.php?pagina=listCat&pg=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                    <?php
                    if (isset($_GET['pg'])):
                        $num_pg = $_GET['pg'];
                    endif;

                    for ($i = $pg - $links; $i <= $pg - 1; $i++):
                        if ($i <= 0):
                        else:
                            ?>                            
                            <li class="active<?= $i; ?>">
                                <a href="dashboard.php?pagina=listCat&pg=<?= $i; ?>"><?= $i; ?> 
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                        <?php
                        endif;
                    endfor;
                    ?>       
                    <li>
                        <a class="active<?= $i; ?>" href="dashboard.php?pagina=listCat&pg=<?= $i; ?>"><?= $pg; ?></a>
                    </li>
                    <?php
                    for ($i = $pg + 1; $i <= $pg = $links; $i++):
                        if ($i > $paginas):
                        else:
                            ?>
                            <li>
                                <a class="active<?= $i; ?>" href="dashboard.php?pagina=listCat&pg=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php
                        endif;
                    endfor;
                    ?>                    
                    <li>
                        <a href="dashboard.php?pagina=listCat&pg=<?= $paginas; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
                <?php
                endif;
                ?>
                
            </nav> 
                </div>
                

            </div>
        </div>
    </div>
    
   