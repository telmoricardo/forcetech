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
    $statusSlider = $retornoSlider->getSlider_status();
    $link = $retornoSlider->getSlider_link();
    $tamanhoSlider = $retornoSlider->getSlider_tamanho();

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
                                                    $status = array('1' => 'Ativo', '2' => 'Bloqueado');                                                    
                                                    foreach ($status as $key => $value):                                                      
                                                        $esseEhOStatus = $statusSlider == $key;
                                                        $selecao = $esseEhOStatus ? "selected='selected'" : ''; 
                                                ?>
                                                    <option value="<?= $key; ?>" <?= $selecao?>><?= $value ?></option>
                                                <?php
                                                   endforeach;
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
                                                $tamanhos = array("Pequeno", "Médio", "Grande", "Promoção");
                                                foreach ($tamanhos as $tamanho):
                                                    $esseEhOTamanho = $tamanhoSlider  == $tamanho;
                                                    $selecao = $esseEhOTamanho ? "selected='selected'" : '';                                                
                                                ?>
                                                <option value="<?= $tamanho; ?>" <?= $selecao?>><?= $tamanho ?></option>
                                                <?php
                                                    endforeach;
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