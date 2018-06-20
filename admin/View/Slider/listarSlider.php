<?php
//intanciando os objetos
$sliderController = new SliderController();
$slider = new Slider();
$helper = new Helper();

//mostra a mensagem verdadeiro ou falso na hora do cadastro
$resultado = "";

/** Pegando o cod que esta vindo através da url del * */
$btnExcluir = filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT);
if($btnExcluir):    
    //pegando os dados do slider
    $retornoSlider = $sliderController->retornaSlider($btnExcluir);
    $thumbSlider = $retornoSlider->getSlider_thumb();    
    
    $capa = "../upload/" . $thumbSlider;    
    if (file_exists($capa) && !is_dir($capa)):
        unlink($capa);
    endif;

    if ($sliderController->Excluir($btnExcluir)):
        $resultado = "<div class=\"alert alert-success\">O slider </b> foi removido com sucesso</div>";
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao remover o slider</div>";
    endif;
endif;

/*
* Pegando o cod que esta vindo através da url active = 1
* o status vai receber o valor 2 = que é inativo
*/
$active = filter_input(INPUT_GET, "active", FILTER_SANITIZE_NUMBER_INT);
if ($active):
    //retorna o slider 
    $retornaStatus = $sliderController->retornaStatusSlider($active);
    $status = 2;
    if ($sliderController->AlterarStatus($active, $status)):
        echo '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
                alert ("O slider esta inativo!")
                </SCRIPT>';
    endif;

endif;

$inactive = filter_input(INPUT_GET, "inactive", FILTER_SANITIZE_NUMBER_INT);
if ($inactive):
    //retorna o slider 
    $retornaStatus = $sliderController->retornaStatusSlider($inactive);
    $status = 1;
    if ($sliderController->AlterarStatus($inactive, $status)):
        echo '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
            alert ("O slider esta Ativo!")
            </SCRIPT>';
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

$quantidade = 10;
$inicio = ($pg * $quantidade) - $quantidade;
//listando os usuarios
$listaSlider = $sliderController->ListarSlider($inicio, $quantidade);
?>

   <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Lista de Slider</h4>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Capa</th>
                                    <th>Titulo</th>
                                    <th>Link</th>
                                    <th>Slider</th>
                                    <th>Atualizar</th>
                                    <th>Excluir</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php
                                        if($listaSlider == null):
                                            echo '<td colspan="7">Não existe nenhum slider cadastrado nesse momento</td';
                                        else:
                                            foreach($listaSlider as $slider):
                                    ?>
                                    <tr>
                                        <td><?= $slider->getSlider_cod();?></td>
                                        <td><img src="../upload/<?= $slider->getSlider_thumb();?>" width="120"></td>
                                        <td><?= $slider->getSlider_titulo();?></td>
                                        <td><?= $slider->getSlider_link();?></td>
                                        <td><a class="btn btn-success" href="?pagina=editarImagem&cod=<?= $slider->getSlider_cod();?>"><i class="ti-camera"></i></a></td>
                                        <td><a href="?pagina=editarSlider&cod=<?= $slider->getSlider_cod();?>" class="btn btn-sm btn-info btn-icon"><i class="fa ti-slice"></i></a></td>
                                        <td><a href="?pagina=listarSlider&del=<?= $slider->getSlider_cod();?>" title="Excluir" class="btn btn-sm btn-danger btn-icon" onclick="return confirm('Deseja realmente excluir o produto <?= $slider->getSlider_titulo(); ?>');">
                                                <i class="fa ti-trash"></i></a>
                                        </td>
                                        
                                        <td>
                                            <?php
                                                if($slider->getSlider_status() == 1):
                                                    echo "<a class='btn btn-warning' href='?pagina=listarSlider&active={$slider->getSlider_cod()}'><i class='ti-check'></i>";
                                                else:
                                                    echo "<a class='btn btn-danger-outline' href='?pagina=listarSlider&inactive={$slider->getSlider_cod()}'><i class='ti-close'></i></a>";
                                                endif;
                                            ?>
                                        </td>
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
                    $totalRegistros = $sliderController->RetornaQtdSlider();
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
                            <li><a href="painel.php?pagina=listarSlider&pg=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                            <?php
                            if (isset($_GET['pg'])):
                                $num_pg = $_GET['pg'];
                            endif;

                            for ($i = $pg - $links; $i <= $pg - 1; $i++):
                                if ($i <= 0):
                                else:
                                    ?>                            
                                    <li class="active<?= $i; ?>">
                                        <a href="painel.php?pagina=listarSlider&pg=<?= $i; ?>"><?= $i; ?> 
                                            <span class="sr-only">(current)</span>
                                        </a>
                                    </li>
                                <?php
                                endif;
                            endfor;
                            ?>       
                            <li>
                                <a class="active<?= $i; ?>" href="painel.php?pagina=listarSlider&pg=<?= $i; ?>"><?= $pg; ?></a>
                            </li>
                            <?php
                            for ($i = $pg + 1; $i <= $pg = $links; $i++):
                                if ($i > $paginas):
                                else:
                                    ?>
                                    <li>
                                        <a class="active<?= $i; ?>" href="painel.php?pagina=listarSlider&pg=<?= $i; ?>"><?= $i; ?></a>
                                    </li>
                                <?php
                                endif;
                            endfor;
                            ?>                    
                            <li>
                                <a href="painel.php?pagina=listarSlider&pg=<?= $paginas; ?>" aria-label="Next">
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
    
   