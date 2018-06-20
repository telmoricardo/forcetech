<?php
$sliderController = new SliderController();
$categoriaController = new CategoriaController();
$produtoController = new ProdutoController();
$tipoController = new TipoController();
$helper = new Helper();
$function = new Functions();

?>
<!--------------------------------- SLIDE SITE -------------------------------->
<main class="main_content container">
    <section class="slider">
        <h1 class="font-zero">Últimas do site:</h1>
        <div class="slider_controll">
            <div class="slide_nav back"><<</div>
            <div class="slide_nav go">>></div>
        </div>
        <?php
            $controle_active = 2;
            $tamMobile = "g";
            $sliderMobile = $sliderController->ListarTamanhoSlider($tamMobile);            
            foreach($sliderMobile as $sli):                            
                if($controle_active == 2):
        ?>
        <article class="slider_item first">
            <h1 class="font-zero"><?= $sli->getSlider_titulo(); ?></h1>
            <a href="<?= $sli->getSlider_link(); ?>"  title="<?= $sli->getSlider_titulo(); ?>">
                <picture alt="Fortaleza">
                    <source media="(min-width: 1280px)" srcset="tim.php?src=uploads/01.jpg&w=1366&h=400" />
                </picture> 
                <img src="<?= HOME;?>/upload/<?= $sli->getSlider_thumb(); ?>" alt="<?= $sli->getSlider_titulo(); ?>" title="<?= $sli->getSlider_titulo(); ?>">
            </a>
        </article>
        <?php
            $controle_active = 1;
            else:
        ?>
        <article class="slider_item">
            <h1 class="font-zero"><?= $sli->getSlider_titulo(); ?></h1>
            <a href="<?= $sli->getSlider_link(); ?>"  title="<?= $sli->getSlider_titulo(); ?>">
                <picture alt="Fortaleza">
                    <source media="(min-width:1600px)" srcset="tim.php?src=uploads/01.jpg&w=200&h=600">
                </picture>                                      
                <img src="<?= HOME;?>/upload/<?= $sli->getSlider_thumb(); ?>" alt="<?= $sli->getSlider_titulo(); ?>" title="<?= $sli->getSlider_titulo(); ?>">
            </a>
        </article>
        <?php
            endif;
            endforeach; 
        ?>

    </section>
</main>

<!--------------------------------- MAIN PAGE -------------------------------->
<main class="principal">
    <div class="container">
        <div class="content">
            <!----------------------------------------------INFORMAÇÃO DO SITE ----------------------------------- -->				
            <section class="outros">
                <div class="info_outros">
                    <div class="box_info">					 
                        <div class="box_fa box_one">
                            <h1> 10% de Desconto</h1>
                            <i class="icone fa fa-truck"></i>
                            <p class="txt_outros">Para pagamento a vista</p>
                        </div>	
                    </div>

                    <div class="box_info">
                        <div class="box_fa box_two">
                            <h1>Entrega Garantida</h1>	
                            <i class="icone fa fa-retweet"></i>
                            <p class="txt_outros">Para todo o Brasil</p>
                        </div>
                    </div>

                    <div class="box_info">
                        <div class="box_fa box_tree">								
                            <h1>Pague em até 12x</h1>
                            <i class="icone fa fa-handshake"></i>
                            <p class="txt_outros">5x sem Juros</p>
                        </div>
                    </div>

                    <div class="box_info">
                        <div class="box_fa box_for">
                            <h1>Site Protegido</h1>
                            <span class="icone fa fa-tags"></span>
                            <p class="txt_outros">Compra 100% Segura</p>
                        </div>
                    </div>
                </div>
            </section>

            <!----------------------------------------------PROMOÇÃO E OFERTAS ESPECIAIS ------------------------------------->		
            <section class="ofertas">
                <div class="box_banner">                
                    <div class="two_banner">
                        <h1>Ofertas Especiais</h1>
                        <div class="wrapper">                                                
                            <div class="jcarousel-wrapper">
                                <div class="jcarousel">
                                    <ul>
                                        <?php
                                        $tamMedium = "m";
                                        $sliderMedio = $sliderController->ListarTamanhoSlider($tamMedium);
                                        foreach ($sliderMedio as $sli):
                                            ?>
                                            <li>
                                                <a href="<?= $sli->getSlider_link(); ?>" title="<?= $sli->getSlider_titulo(); ?>">
                                                    <img src="<?= HOME; ?>/upload/<?= $sli->getSlider_thumb(); ?>" alt="<?= $sli->getSlider_titulo(); ?>" title="<?= $sli->getSlider_titulo(); ?>">
                                                </a>
                                            </li>
                                            <?php
                                        endforeach;
                                        ?>
                                    </ul>
                                </div>
                                <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
                                <a href="#" class="jcarousel-control-next">&rsaquo;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!---------------------------------------------- LISTANDO PRODUTOS POR TIPO ------------------------------------->	
            <?php            
                $listaTipo = $tipoController->ListarTipo(0, 2);
                if($listaTipo == null):
                    echo '<h1 class="product-text">Não existe tipo cadastrado nesse momento!</h1>';
                else:
                   foreach ($listaTipo as $tipo): 
                   $codTipo = $tipo->getTipo_cod();
                   $listarProdutos = $produtoController->ListProductType($codTipo);
                           
            ?>
            <section class="section-product">
                <h1 class="product-text"><?= $tipo->getTipo_nome()?></h1>                
                <div class="product-carrousel">
                    <div class="jcarousel-product">
                        <div class="pcarousel">
                            <ul>
                            <?php
                            foreach ($listarProdutos as $produtos):
                                ?>
                                <li>
                                    <article class="home-product">
                                        <a href="<?= HOME; ?>/single-produto/<?= $produtos->getProduto_url(); ?>">
                                            <p class="titulo_cat"><?= $produtos->getProduto_subcategoria()->getSub_titulo(); ?></p>
                                            <h1><?= $helper->limitarTexto($produtos->getProduto_nome(), 50); ?></h1>
                                            <img src="<?= HOME; ?>/upload/<?= $produtos->getProduto_thumb(); ?>" alt="" title="">
                                            <p class="product-price">R$ <?= number_format($produtos->getProduto_preco(), 2, ",", "."); ?></p>
                                            <?php
                                            $valorProd2 = $produtos->getProduto_preco();
                                            $parcelas = $function->Parcelas(5, $valorProd2);
                                            $desconto = $function->Descontos(10, $valorProd2);
                                            ?>
                                            <p>Em até 5x de R$ <?= number_format($parcelas, 2, ",", ".") ?> s/ juros</p>
                                            <p>ou</p>
                                            <p class="price">R$ <?= number_format($desconto, 2, ",", ".") ?></p>
                                            <p>À vista (boleto ou transferência)</p>
                                        </a>
                                        <a href="<?= HOME; ?>/carrinho/add/<?= $produtos->getProduto_cod(); ?>" class="btn btn-blue"><i class="fa fa-cart-plus"></i>  Comprar</a>
                                    </article>
                                </li>
                                <?php
                            endforeach;
                            ?>
                            </ul>
                        </div>
                        <a href="#" class="pcarousel-control-prev">&lsaquo;</a>
                        <a href="#" class="pcarousel-control-next">&rsaquo;</a>
                    </div>                    
                </div>                
            </section>
            
            <?php
                    endforeach;
                endif;
            ?>
        </div>
        <div class="clear"></div>
    </div>
</main>
<div class="container">                            
    <div class="content" style="margin-bottom: 2rem;">
        <img src="<?= INCLUDE_PATH; ?>/img/1.png" alt=""/>
    </div>
</div>

<main class="container">
    <div class="content">
        <?php            
                $listaTipo2 = $tipoController->ListarTipo(2, 2);
                if($listaTipo == null):
                    echo '<h1 class="product-text">Não existe tipo cadastrado nesse momento!</h1>';
                else:
                   foreach ($listaTipo2 as $tipo): 
                   $codTipo = $tipo->getTipo_cod();
                   $listarProdutos = $produtoController->ListProductType($codTipo);
                           
            ?>

            <section class="section-product">
                <h1 class="product-text"><?= $tipo->getTipo_nome()?></h1>                
                <div class="product-carrousel">
                    <div class="jcarousel-product">
                        <div class="pcarousel">
                            <ul>
                            <?php
                            foreach ($listarProdutos as $produtos):
                                ?>
                                <li>
                                    <article class="home-product">
                                        <a href="<?= HOME; ?>/single-produto/<?= $produtos->getProduto_url(); ?>">
                                            <p class="titulo_cat"><?= $produtos->getProduto_subcategoria()->getSub_titulo(); ?></p>
                                            <h1><?= $helper->limitarTexto($produtos->getProduto_nome(), 50); ?></h1>
                                            <img src="<?= HOME; ?>/upload/<?= $produtos->getProduto_thumb(); ?>" alt="" title="">
                                            <p class="product-price">R$ <?= number_format($produtos->getProduto_preco(), 2, ",", "."); ?></p>
                                            <?php
                                            $valorProd2 = $produtos->getProduto_preco();
                                            $parcelas = $function->Parcelas(5, $valorProd2);
                                            $desconto = $function->Descontos(10, $valorProd2);
                                            ?>
                                            <p>Em até 5x de R$ <?= number_format($parcelas, 2, ",", ".") ?> s/ juros</p>
                                            <p>ou</p>
                                            <p class="price">R$ <?= number_format($desconto, 2, ",", ".") ?></p>
                                            <p>À vista (boleto ou transferência)</p>
                                        </a>
                                        <a href="<?= HOME; ?>/carrinho/add/<?= $produtos->getProduto_cod(); ?>" class="btn btn-blue"><i class="fa fa-cart-plus"></i>  Comprar</a>
                                    </article>
                                </li>
                                <?php
                            endforeach;
                            ?>
                            </ul>
                        </div>
                        <a href="#" class="pcarousel-control-prev">&lsaquo;</a>
                        <a href="#" class="pcarousel-control-next">&rsaquo;</a>
                    </div>                    
                </div>                
            </section>
            
            <?php
                    endforeach;
                endif;
            ?>

        
    </div>
    <div class="clear"></div>
</main>

<main class="banner_alternativos container" style="margin-bottom: 2rem;">
    <div class="content">
        <div class="row">
            <div class="column column-6">
                <img src="<?= INCLUDE_PATH; ?>/img/3.png" alt=""/>
            </div>
            <div class="column column-6">
                <img src="<?= INCLUDE_PATH; ?>/img/3.png" alt=""/>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</main>