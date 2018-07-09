<?php
//chamando as classes
$produtoController = new ProdutoController();
$imagemController = new ImagemController();
$imagem = new Imagem();
$produto = new Produto();

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

/*
* Pegando o cod que esta vindo através da url active = 1
* o status vai receber o valor 2 = que é inativo
*/
$active = filter_input(INPUT_GET, "active", FILTER_SANITIZE_NUMBER_INT);
if ($active):
    //retorna o slider 
    $retornaStatus = $produtoController->retornaStatusProd($active);
    $status = 2;
    if ($produtoController->AlterarStatus($active, $status)):
        echo '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
                alert ("O produto esta inativo!")
                </SCRIPT>';
    endif;

endif;

$inactive = filter_input(INPUT_GET, "inactive", FILTER_SANITIZE_NUMBER_INT);
if ($inactive):
    //retorna o slider 
    $retornaStatus = $produtoController->retornaStatusProd($inactive);
    $status = 1;
    if ($produtoController->AlterarStatus($inactive, $status)):
        echo '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
            alert ("O produto esta Ativo!")
            </SCRIPT>';
    endif;
endif;

/** Pegando o cod que esta vindo através da url del * */
$btnExcluir = filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT);
if ($btnExcluir):
    //pegando os dados do slider
    $codExcluir = filter_input(INPUT_GET, 'del', FILTER_SANITIZE_NUMBER_INT);
    $retornaImagem = $produtoController->retornaProdutoImagem($codExcluir);
    $thumbProd = $retornaImagem->getProduto_thumb();
    $nomeProd = $retornaImagem->getProduto_nome();
    $capa = "../upload/" . $thumbProd;

    $listaImagem = $imagemController->CarregarImagensPost($codExcluir);
    foreach ($listaImagem as $imagens):
        $codImagem = $imagens->getCod();
        $nomeImagem = $imagens->getImagem();
        if ($imagemController->RemoverImagem($codImagem, $codExcluir)):
            unlink("../upload/galeria/{$nomeImagem}");
        endif;
    endforeach;

    if (file_exists($capa) && !is_dir($capa)):
        unlink($capa);
    endif;

    if ($produtoController->Excluir($btnExcluir)):
        $resultado = "<div class=\"alert alert-success\">O slider </b> foi removido com sucesso</div>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao remover o slider</div>";
    endif;
endif;

//quantidade de postagem para visualizar por pagina
$quantidade = 10;
$inicio = ($pg * $quantidade) - $quantidade;

$listaProduto = $produtoController->ListarProduto($inicio, $quantidade);


?>
                
                
  
<div class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-12">    
                <div class="card">  
                    <div class="header">
                        <h4 class="title">Listar Produtos</h4>                                

                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-striped">
                            <thead>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Titulo</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th>Galeria</th>
                            <th>Remover</th>
                            <th>Atualizar</th>
                            </thead>

                            <tbody>
                                <?php
                                if ($listaProduto == null):
                                    echo '<tr><td colspan="8">Não possui nenhum produto cadastrados no momento</td></tr>';
                                else:
                                    foreach ($listaProduto as $prod):
                                        ?>

                                        <tr>
                                            <td><?= $prod->getProduto_cod(); ?></td>
                                            <td><img src="../upload/<?= $prod->getProduto_thumb(); ?>" width="100"></td>
                                            <td><?= $prod->getProduto_nome(); ?></td>
                                            <td>R$ <?= number_format($prod->getProduto_preco(), 2, ",", ". "); ?></td>
                                            <td>
                                                <?php
                                                if ($prod->getProduto_status() == 1):
                                                    echo "<a class='btn btn-warning' href='?pagina=listarProdutos&active={$prod->getProduto_cod()}'><i class='ti-check'></i>";
                                                else:
                                                    echo "<a class='btn btn-danger-outline' href='?pagina=listarProdutos&inactive={$prod->getProduto_cod()}'><i class='ti-close'></i></a>";
                                                endif;
                                                ?>
                                            </td>                                        
                                            <td><a class="btn btn-success" href="?pagina=galeriaProdutos&cod=<?= $prod->getProduto_cod(); ?>"><i class="ti-camera"></i></a></td>
                                            <td><a class="btn btn-danger" href="?pagina=listarProdutos&del=<?= $prod->getProduto_cod(); ?>" onclick="return confirm('Deseja realmente excluir o produto <?= $prod->getProduto_nome(); ?>');">
                                                    <i class="ti-trash"></i></a>
                                            </td>                                        
                                            <td><a class="btn btn-info" href="?pagina=editarProdutos&cod=<?= $prod->getProduto_cod(); ?>"><i class="ti-pencil"></i></a></td>

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
        </div>

        <nav aria-label="Page navigation">
            <?php
            $totalRegistros = $produtoController->RetornaQtdProduto();
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
                    <li><a href="painel.php?pagina=listarProdutos&pg=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                    <?php
                    if (isset($_GET['pg'])):
                        $num_pg = $_GET['pg'];
                    endif;

                    for ($i = $pg - $links; $i <= $pg - 1; $i++):
                        if ($i <= 0):
                        else:
                            ?>                            
                            <li class="active<?= $i; ?>"><a href="painel.php?pagina=listarProdutos&pg=<?= $i; ?>"><?= $i; ?> <span class="sr-only">(current)</span></a></li>
                        <?php
                        endif;
                    endfor;
                    ?>       
                    <li><a class="active<?= $i; ?>" href="painel.php?pagina=listarProdutos&pg=<?= $i; ?>"><?= $pg; ?></a></li>
                    <?php
                    for ($i = $pg + 1; $i <= $pg = $links; $i++):
                        if ($i > $paginas):
                        else:
                            ?>
                            <li><a class="active<?= $i; ?>" href="painel.php?pagina=listarProdutos&pg=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php
                        endif;
                    endfor;
                    ?>                    
                    <li>
                        <a href="painel.php?pagina=listarProdutos&pg=<?= $paginas; ?>" aria-label="Next">
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


