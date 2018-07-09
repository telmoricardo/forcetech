<?php
//verificando a url e esta voltando url[0] = single, url[1] = exemplo-do-post
$url = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$url = ($url ? $url : 'index');
$url = explode('/', $url);
$urlCod = $url[1];


$produtoController = new ProdutoController();
$imagemController = new ImagemController();
$functions = new Functions();
$helper = new Helper();

//alteração views
if($urlCod):    
    $viewAlterar = $produtoController->AlterarViews($urlCod);   
endif;

$listarProdutoUrl = $produtoController->retornaProdutoUrl($urlCod);

if($listarProdutoUrl == null):
    echo 'Não existe produto cadastrado';

else:
    $codProd = $listarProdutoUrl->getProduto_cod();
    $catProd = $listarProdutoUrl->getProduto_categoria()->getCategoria_nome();
    $codCategoria = $listarProdutoUrl->getProduto_categoria()->getCategoria_cod();
    $urlCategoria = $listarProdutoUrl->getProduto_categoria()->getCategoria_url();
    $subcatProd = $listarProdutoUrl->getProduto_subcategoria()->getSub_titulo();
    $nomeProd = $listarProdutoUrl->getProduto_nome();
    $codigoProd = $listarProdutoUrl->getProduto_codigo();
    $breveProd = $listarProdutoUrl->getProduto_breve();
    $precoProd = $listarProdutoUrl->getProduto_preco();
    $descricaoProd = $listarProdutoUrl->getProduto_descricao();
    $thumbProd = $listarProdutoUrl->getProduto_thumb();

?>      
<!--------------------------------- MAIN PAGE -------------------------------->
<main class="single_produto">
    <div class="container">
        <div class="content">
            <section class="main-galeria">
                <h3 class="titulo_menu">
                    <a href="<?= HOME?>/categoria/<?= $urlCategoria; ?>"><?= $catProd; ?></a> <span class="fa fa-angle-right"></span> <?= $subcatProd; ?></h3>
                <div class="row">
                    <div class="column column-6">
                        <article class="product_images">
                            <div class="cover">                                        
                                <img src="<?= HOME;?>/upload/<?= $thumbProd; ?>" alt="" />
                            </div>
                            
                            <?php                            
                                $listaImagem = $imagemController->CarregarImagensPost($codProd);                                    
                                if ($listaImagem == null) :
                                else:
                            ?>
                            <div class="thumbs">
                                <?php
                                    foreach ($listaImagem as $imagem) :                                   
                                ?>
                                <img src="../upload/galeria/<?= $imagem->getImagem()?>" class="active" alt="[Xperia 23]" title="Xperia z3"/>                                        
                                 <?php
                                    endforeach;
                                ?>
                            </div>
                            <?php
                                endif;
                            ?>
                        </article>                                
                    </div>
                    <article class="column column-6">
                        <div class="box_desc_galery">
                            <h1 class="titulo_galery"> <?= $nomeProd; ?></h1>
                            <h5 class="codigo_galery">CÓDIGO: <?= $codigoProd; ?></h5>                            
                            <p class="valor_galery">R$ <?= number_format($precoProd, 2, ",", ".");?></p>
                            <?php
                                $valorProd2 = $precoProd; 
                                $parcelas = $functions->Parcelas(5, $valorProd2);
                                $desconto = $functions->Descontos(10, $valorProd2);
                            ?>
                            <p class="qtd_galery">Em até 5x de R$ <?= number_format($parcelas, 2, ",", ".");?> s/ juros</p>
                            <p class="tipo_galery">ou</p>                            
                            <p class="price_galery"><b>R$</b> <?= number_format($desconto, 2, ",", ".");?></p>
                            <p class="tipo_galery">À vista (Boleto ou Transferêcia)</p>
                            <a href="<?= HOME; ?>/carrinho/add/<?= $codProd; ?>" class="btn btn-blue"><i class="fa fa-cart-plus"></i>  COMPRAR</a>
                        </div>
                        
                    </article>
                    <article class="column column-12">
                        <div class="box_desc_pdr">
                            <h1 class="titulo_desc_pdr">Descrição</h1>                                    
                            <p class="txt_desc">
                                <?= html_entity_decode($descricaoProd); ?>
                            </p>
                        </div>
                    </article>
                </div>

            </section>
            <!-- --------------------------------------------BANNER TWO  ------------------------------------->	
            <?php
                $produtoRelacionado = $produtoController->produtosRelacionados($codCategoria, 0, 8);
                if($produtoRelacionado == null):
                    echo 'Não existe produto relacionado com esta categoria';
                else:
            ?>
            <section class="section-produto">
                <h1 class="titulo_produto">Produtos Relacionados</h1>                                            
                <?php            
                    foreach ($produtoRelacionado as $produtos):
                    ?>
                    <article class="produto">   
                        <a href="<?= HOME; ?>/single-produto/<?= $produtos->getProduto_url(); ?>">
                            <p class="titulo_categoria"><?= $produtos->getProduto_subcategoria()->getSub_titulo();?></p>
                            <h1><?= $helper->limitarTexto($produtos->getProduto_nome(), 25);?></h1>
                            <img src="<?= HOME; ?>/upload/<?= $produtos->getProduto_thumb(); ?>" alt="" title="">
                            <p class="product-price">R$ <?= number_format($produtos->getProduto_preco(), 2, ",", ".");?></p>
                            <?php
                                $valorProd2 = $produtos->getProduto_preco(); 
                                $parcelas = $functions->Parcelas(5, $valorProd2);
                                $desconto = $functions->Descontos(10, $valorProd2);
                            ?>
                            <p>Em até 5x de R$ <?= number_format($parcelas, 2, ",", ".")?> s/ juros</p>
                            <p>ou</p>                            
                            <p class="price">R$ <?= number_format($desconto, 2, ",", ".")?></p>
                            <p>À vista (Boleto ou Transferêcia)</p>
                        </a>
                        <a href="<?= HOME; ?>/carrinho/add/<?= $produtos->getProduto_cod(); ?>" class="btn btn-blue"><i class="fa fa-cart-plus"></i>  Comprar</a>
                       
                    </article>
                    <?php
                    endforeach;
                ?>
            </section>
            <?php
                endif;
            ?>
        </div>

        <div class="clear"></div>
    </div>
</main>
<?php
    endif;
?>
