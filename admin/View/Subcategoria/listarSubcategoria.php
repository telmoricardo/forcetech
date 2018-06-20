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
    else:
        $resultado = '<div class="alert alert-danger">
        <button type="button" aria-hidden="true" class="close">×</button>
        <span><b> Erro ao atualizar, tente mais tarde - </b></span>
        </div>';
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
$listaSubcategoria = $subcategoriaController->ListaSubcategoria($inicio, $quantidade);


?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Lista de Subcategoria</h4>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Subcategoria</th>
                                    <th>Descricao</th>
                                    <th>Categoria</th>
                                    <th>Data</th>
                                    <th>Atualizar</th>
                                    <th>Excluir</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php
                                        if($listaSubcategoria == null):
                                            echo '<td colspan="7">Não existe nenhuma subcategoria cadastrada nesse momento</td';
                                        else:
                                            foreach($listaSubcategoria as $subcat):
                                    ?>
                                    <tr>
                                    
                                        <td><?= $subcat->getSub_cod();?></td>
                                        <td><?= $subcat->getSub_titulo();?></td>
                                        <td><?= $subcat->getSub_descricao();?></td>
                                        <td><?= $subcat->getCategoria()->getCategoria_nome();?></td>
                                        <td><?= $helper->converteData($subcat->getSub_data());?></td>                                        
                                        <td><a id="btn_atualizar" href="?pagina=editarSubcategoria&cod=<?= $subcat->getSub_cod();?>" class="btn btn-sm btn-info btn-icon"><i class="fa ti-slice"></i></a></td>
                                        <td><a href="?pagina=listaSubcategoria&del=<?= $subcat->getSub_cod();?>" title="Excluir" class="btn btn-sm btn-danger btn-icon"><i class="fa ti-trash"></i></a></td>
                                        <td><?= ($subcat->getSub_status()) == 1 ? '<a title="Ativo" class="btn btn-fill btn-success btn-icon"><i class="fa ti-check"></i></a>' : '<a title="Bloqueado" class="btn btn-fill btn-danger btn-icon"><i class="fa ti-close"></i></a>'?></td>
                                    
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
                
             <nav aria-label="Page navigation">
                <?php
                $totalRegistros = $subcategoriaController->RetornaQtdSubcategoria();
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
                    <li><a href="painel.php?pagina=listaSubcategoria&pg=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                    <?php
                    if (isset($_GET['pg'])):
                        $num_pg = $_GET['pg'];
                    endif;

                    for ($i = $pg - $links; $i <= $pg - 1; $i++):
                        if ($i <= 0):
                        else:
                            ?>                            
                            <li class="active<?= $i; ?>">
                                <a href="painel.php?pagina=listaSubcategoria&pg=<?= $i; ?>"><?= $i; ?> 
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                        <?php
                        endif;
                    endfor;
                    ?>       
                    <li>
                        <a class="active<?= $i; ?>" href="painel.php?pagina=listaSubcategoria&pg=<?= $i; ?>"><?= $pg; ?></a>
                    </li>
                    <?php
                    for ($i = $pg + 1; $i <= $pg = $links; $i++):
                        if ($i > $paginas):
                        else:
                            ?>
                            <li>
                                <a class="active<?= $i; ?>" href="painel.php?pagina=listaSubcategoria&pg=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php
                        endif;
                    endfor;
                    ?>                    
                    <li>
                        <a href="painel.php?pagina=listaSubcategoria&pg=<?= $paginas; ?>" aria-label="Next">
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
    
    
    