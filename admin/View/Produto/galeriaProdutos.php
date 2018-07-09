<?php
$uploadMultipleFile = new UploadMultipleFile();
$imagemController = new ImagemController();

$resultado = "";

if(filter_input(INPUT_POST, "btnGaleria", FILTER_SANITIZE_STRING)) {
    $arquivos = $uploadMultipleFile->LoadFile("../upload/galeria/", $_FILES["images"]);
    $codPost = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
    
    $listaImagem = [];
    foreach ($arquivos as $nome) {
        //     
        $imagem = new Imagem();
        $imagem->getProduto()->setProduto_cod($codPost);
        $imagem->setImagem($nome);

        $listaImagem[] = $imagem;
    }
    
    if ($imagemController->CadastrarImagens($listaImagem)) {
        ?>
        <script>
            document.location.href = "?pagina=galeriaProdutos&cod=<?= $codPost; ?>";
        </script>
        <?php
    } else {
        foreach ($arquivos as $nome) {
            unlink("../upload/galeria/{$nome}");
        }
        $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar cadastrar as imagens.</div>";
    }
    
    if ($uploadMultipleFile->ValidaImagens($_FILES["images"], "img", 2, 10)) {
        
    } else {
        $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar carregar imagens, por favor, verifique o tamanho, extensão e a quantidade dos arquivos.</div>";
    }
}

if (filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT)) {
    $nomeImagem = $imagemController->VerificarArquivoExiste(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT));
    if ($nomeImagem != "" || $nomeImagem != null) {
        if ($imagemController->RemoverImagem(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT), filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT))) {
            unlink("../upload/galeria/{$nomeImagem}");
            ?>
            <script>
               document.location.href = "?pagina=galeriaProdutos&cod=<?= filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT); ?>";
            </script>
            <?php
        } else {
            $resultado = "<div class=\"alert alert-danger\" role=\"alert\">Houve um erro ao tentar remover a imagem.</div>";
        }
    } else {
        $resultado = "<div class=\"alert alert-danger\" role=\"alert\">O arquivo informado não pode ser localizado.</div>";
    }
}

$listaImagem = $imagemController->CarregarImagensPost(filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT));



?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-6">
                    
                    <div class="card">
                        <div class="row" id="image_preview">                               
                        </div>
                        <div class="content">                            
                            <div class="row">                                 
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="col-md-12">
                                        <label>FOTOS ADICIONAIS (800X1000PX) NO MAXIMO (6):</label>
                                        <input type="file" class="form-control border-input" id="images" name="images[]" multiple="multiple" onchange="preview_images();" multiple/>
                                    </div>
                                    
                                    <div class="col-md-12 text-center">
                                        <input type="submit" class="btn btn-info btn-fill btn-wd" name='btnGaleria' value="ADICIONAIS IMAGENS"/>
                                    </div>
                                    
                                </form>                              
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12 col-md-7">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Galeria de Fotos</h4>
                        </div>
                        <div class="content">
                            <div class="row">

                                <div class="gallery">
                                    <?php
                                    $codPost = filter_input(INPUT_GET, "cod", FILTER_SANITIZE_NUMBER_INT);
                                    $listaImagem = $imagemController->CarregarImagensPost($codPost);                                    
                                    if ($listaImagem == null) :
                                        else:                                        
                                        foreach ($listaImagem as $imagem) :
                                            ?>
                                            <img style="margin-bottom:15px; margin-left: 25px;" src="../upload/galeria/<?= $imagem->getImagem()?>" width="220" title="<?= $imagem->getCod()?>"/>
                                            <a title='Excluir Imagem!'  href='?pagina=galeriaProdutos&cod=<?= $codPost; ?>&del=<?= $imagem->getCod(); ?>'<i class="fa fa-times-circle" style="font-size: 1.4em; padding: 0; position: relative; top: -20px; right: 30px;"></i></a>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>                            
                        </div>

                    </div>
                </div>
        </div>
    </div>

    <script type="text/javascript">
        function preview_images()
        {
            var total_file = document.getElementById("images").files.length;
            for (var i = 0; i < total_file; i++)
            {
                $('#image_preview').append("<div class='col-md-2'><img class='img-responsive' src='" + URL.createObjectURL(event.target.files[i]) + "'></div>");
            }
        }
    </script>


