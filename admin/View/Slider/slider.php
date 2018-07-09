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
    $slider->setSlider_titulo(filter_input(INPUT_POST, "txtTitulo", FILTER_SANITIZE_STRING));
    $slider->setSlider_status(filter_input(INPUT_POST, "slStatus", FILTER_SANITIZE_NUMBER_INT));
    $slider->setSlider_link(filter_input(INPUT_POST, "txtLink", FILTER_SANITIZE_STRING));
    $slider->setSlider_tamanho(filter_input(INPUT_POST, "slSlider", FILTER_SANITIZE_STRING));

    $nomeSlider = $slider->getSlider_titulo();
    //imagem esta recebendo files imagemArtigo
    $imagem = $_FILES['imagemArtigo'];
    //recebendo a imagem, nome do produto, tamanho da imagem, pasta
    $upload->Image($imagem, $nomeSlider, 2000, 'sliders');

    //setando a imagem
    $nomeImagem = $upload->getResult();
    $slider->setSlider_thumb($nomeImagem);

    if ($sliderController->Cadastrar($slider)):
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
                            <h4 class="title">Cadastrar Slider</h4>
                        </div>
                        <div class="content">
                            <form method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>Título</label>
                                            <input type="text" name="txtTitulo" class="form-control border-input" placeholder="Título do Slider">
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
                                            <label>Link</label>                                            
                                            <input type="text" name="txtLink" class="form-control border-input" placeholder="Link">
                                        </div>
                                    </div> 
                                </div>                                
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>CAPA (JPG 1920X466PX) ou CAPA (JPG 250X232PX):</label>
                                            <input type="file" class="form-control border-input uploader" id="imagemArtigo"  name="imagemArtigo">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Slider</label>
                                            <select name="slSlider" class="form-control border-input">
                                                <option value="">Selecione o slider</option>
                                                <option value="Promoção">Promoção</option>
                                                <option value="Grande">Grande</option>
                                                <option value="Médio">Médio</option>
                                                <option value="Pequeno">Pequeno</option>                                                
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
                                    <input type="submit" class="btn btn-success btn-fill btn-wd" name="btnCadastrar" value="Cadastrar">                                    
                                </div>
                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

