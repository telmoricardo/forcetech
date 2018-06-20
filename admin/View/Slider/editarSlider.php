<?php
//chamandoos objetos
//intanciando os objetos
$sliderController = new SliderController();
$slider = new Slider();
$helper = new Helper();
$upload = new Upload();

//mostra a mensagem verdadeiro ou falso na hora do cadastro
$resultado = "";

$btnCadastrar = filter_input(INPUT_POST, "btnCadastrar", FILTER_SANITIZE_STRING);
if ($btnCadastrar):
    $slider->setSlider_cod(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));
    $slider->setSlider_titulo(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));
    $slider->setSlider_status(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $slider->setSlider_link(filter_input(INPUT_POST, "txtLink", FILTER_SANITIZE_STRING));
    $slider->setSlider_tamanho(filter_input(INPUT_POST, "slSlider", FILTER_SANITIZE_STRING));
    
    if ($sliderController->Atualizar($slider)):
        $insertGoTo = '?pagina=listarSlider';
        header("refresh:2;url={$insertGoTo}");
        $resultado = '<div class="alert alert-success">
                        <button type="button" aria-hidden="true" class="close">×</button>
                        <span><b> Atualizado com sucesso - </b></span>
                    </div>';
    else:
        $resultado = '<div class="alert alert-danger">
                        <button type="button" aria-hidden="true" class="close">×</button>
                        <span><b> Erro ao atualizar - Favor preencha todos os campos</b></span>
                    </div>';
    endif;
endif;

$codUpdate = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
$retornoSlider = $sliderController->retornaSlider($codUpdate);
if($retornoSlider == null):
    echo '';
else:
    $titulo = $retornoSlider->getSlider_titulo();
    $status = $retornoSlider->getSlider_status();
    $link = $retornoSlider->getSlider_link();
    $tipo = $retornoSlider->getSlider_tamanho();

?>

   <div class="content">
        <div class="container-fluid">
            <div class="row">              

                    
                <div class="col-lg-12 col-md-7">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Atualizar Slider</h4>
                        </div>
                        <div class="content">
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" name="txtTitulo" class="form-control border-input" placeholder="Título do Slider" value="<?= $titulo; ?>">
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
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Link</label>                                            
                                            <input type="text" name="txtLink" class="form-control border-input" placeholder="Link" value="<?= $link?>">
                                        </div>
                                    </div>                                 
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Slider</label>
                                            <select name="slSlider" class="form-control border-input">
                                                <?php
                                                    if ($tipo == "p"):
                                                        ?>
                                                        <option value="p" selected='selected'>Slider Pequeno</option>
                                                        <?php
                                                    else:
                                                        ?>
                                                        <option value="g" selected='selected'>Slider Grande</option>
                                                    <?php
                                                    endif;
                                                    if ($tipo != "p"):
                                                        ?>
                                                        <option value="p" <?php $tipo == "p" ? "selected='selected'" : "" ?>>Slider Pequeno</option>
                                                        <?php
                                                    else:
                                                        ?>
                                                        <option value="g" <?php $tipo == "g" ? "selected='selected'" : "" ?>>Slider Grande</option>
                                                    <?php
                                                    endif;
                                                    
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>                              
                                                           
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php echo $resultado; ?>
                                    </div>                                    
                                </div>                              


                                <div class="text-center">
                                    <input type="submit" class="btn btn-info btn-fill btn-wd" name="btnCadastrar" value="Atualizar">                                    
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

<?php
endif;
?>