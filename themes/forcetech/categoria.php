<?php
//verificando a url e esta voltando url[0] = single, url[1] = exemplo-do-post
$url = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$url = ($url ? $url : 'index');
$url = explode('/', $url);
$urlCod = $url[1];

//chamando as classes
$categoriaController = new CategoriaController();
$produtoController = new ProdutoController();
$functions = new Functions();
$helper = new Helper();

$listaCategoria = $categoriaController->retornaCategoriaUrl($urlCod);

if ($listaCategoria == null):

else:
    $categoria = $listaCategoria->getCategoria_cod();
    $title = $listaCategoria->getCategoria_nome();
    ?>

    <!--------------------------------- MAIN PAGE -------------------------------->
    <div class="category">
        <div class="content category-product">
            <h1 class="product-text"><?= $title; ?></h1>
            
            <?php
                $listarProdutos = $produtoController->ListProductCategory($categoria);
                
                $totalRegistros = $produtoController->qtdProdCat($categoria);
                
                if($totalRegistros == 0):                   
                    echo '<div class="msg-error">Não existem produtos cadastrados nessa categoria, volte mais tarde!</div>';
                else:
                foreach ($listarProdutos as $produtos):                    
                
            ?>
            <article class="product-item">
                <a href="<?= HOME; ?>/single-produto/<?= $produtos->getProduto_url();?>">
                    <p class="titulo_cat"><?= $produtos->getProduto_subcategoria()->getSub_titulo();?></p>
                    <h1><?= $helper->limitarTexto($produtos->getProduto_nome(), 25);?></h1>
                    <img src="<?= HOME; ?>/upload/<?= $produtos->getProduto_thumb(); ?>" alt="" title="">
                    <p class="product-price">R$ <?= number_format($produtos->getProduto_preco(), 2, ",", ".");?></p>
                    <?php
                        $valorProd2 = $produtos->getProduto_preco(); 
                        $parcelas = $functions->Parcelas(5, $valorProd2);
                        $desconto = $functions->Descontos(10, $valorProd2);
                    ?>
                    <p>Em até 5x R$ <?= number_format($parcelas, 2, ",", ".")?> s/ juros </p>
                    <p>ou</p>                    
                    <p class="price">R$ <?= number_format($desconto, 2, ",", ".")?></p>
                    <p>À vista (Boleto ou transferência)</p>
                </a>
                <a href="<?= HOME; ?>/carrinho/add/<?= $produtos->getProduto_cod(); ?>" class="btn btn-blue"><i class="fa fa-cart-plus"></i>  Comprar</a>
            </article>
            
            <?php
                               
                endforeach;
            endif;
            ?>
        </div>
    </div>
<?php
endif;