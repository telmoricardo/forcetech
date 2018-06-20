<?php
$upload = new Upload();
$sliderController = new SliderController();
$slider = new Slider();

$resultado = "";

$cod = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);                                
if(filter_input(INPUT_POST, "btnGaleria", FILTER_SANITIZE_STRING)):
    $retornoSlider = $sliderController->retornaSlider($cod);
    $thumbSlider = $retornoSlider->getSlider_thumb(); 
    $nomeSlider = $retornoSlider->getSlider_titulo();

    $capa = "../upload/" . $thumbSlider;    
    if (file_exists($capa) && !is_dir($capa)):
        unlink($capa);
    endif;

    //imagem esta recebendo files imagemArtigo
    $imagem = $_FILES['imagemArtigo'];
    //recebendo a imagem, nome do produto, tamanho da imagem, pasta
    $upload->Image($imagem, $nomeSlider, 2000, 'sliders');
    //setando a imagem
    $nomeImagem = $upload->getResult();
    $slider = new Slider();
    $slider->getSlider_thumb($nomeImagem);

    if ($sliderController->AlterarImagem($cod, $nomeImagem)):
        $resultado = "<div class=\"alert alert-success\">A imagem <b>{$nomeImagem} </b> foi alterado com sucesso</div>";
        $insertGoTo = '?pagina=listarSlider';
        header("refresh:2;url={$insertGoTo}");
    else:
        $resultado = "<div class=\"alert alert-danger\">Erro ao cadastrar </div>";
    endif;
endif;  

?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    
                    <div class="card">
                        <div class="row" id="image_preview">                               
                        </div>
                        <div class="content">                            
                            <?php
                                                              
                            ?>
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>CAPA (JPG 1920X466PX) ou CAPA (JPG 250X232PX):</label>
                                            <input type="file" class="form-control border-input uploader" id="imagemArtigo"  name="imagemArtigo">
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <?= $resultado; ?>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn btn-info btn-fill btn-wd" name='btnGaleria' value="ALTERAR SLIDER"/>
                                    </div>
                                </div>                           
                            </form>                              
                        </div>
                    </div>
                </div>
                
        </div>
    </div>

    

