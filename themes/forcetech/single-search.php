<?php
$produtoController = new ProdutoController();
$imagemController = new ImagemController();
$functions = new Functions();
$helper = new Helper();

$search = filter_input(INPUT_POST, "textoPesquisado", FILTER_SANITIZE_SPECIAL_CHARS);

$listarPesquisa = $produtoController->buscarProduto($search);
?>      
<!--------------------------------- MAIN PAGE -------------------------------->


<div class="category">
    <div class="content category-product">

        <?php
        if ($search == ''):
            ?>
            <section class="section-produto">
                <h1 class="titulo_produto">Opsss, não existe esse produto cadastrado!</h1> 
            </section>
            <?php
        else:                
            ?>
            <?php
                if($listarPesquisa == null):
            ?>
            <section class="section-produto">
                <h1 class="titulo_produto">Opsss, não existe esse produto cadastrado!</h1> 
                
            </section>
            <?php
            else:
            ?>
            <section class="section-produto">
                <h1 class="titulo_produto">Produtos Relacionados</h1>
                <?php
                foreach ($listarPesquisa as $produtos):
                    ?>
                    <article class="produto">   
                        <a href="<?= HOME; ?>/single-produto/<?= $produtos->getProduto_url(); ?>">
                            <p class="titulo_categoria"><?= $produtos->getProduto_subcategoria()->getSub_titulo(); ?></p>
                            <h1><?= $helper->limitarTexto($produtos->getProduto_nome(), 25); ?></h1>
                            <img src="<?= HOME; ?>/upload/<?= $produtos->getProduto_thumb(); ?>" alt="" title="">
                            <p class="product-price">R$ <?= number_format($produtos->getProduto_preco(), 2, ",", "."); ?></p>
                            <?php
                            $valorProd2 = $produtos->getProduto_preco();
                            $parcelas = $functions->Parcelas(5, $valorProd2);
                            $desconto = $functions->Descontos(10, $valorProd2);
                            ?>
                            <p>Em até 5x R$ <?= number_format($parcelas, 2, ",", ".") ?> s/ juros</p>
                            <p>ou</p>
                            <p class="price">R$ <?= number_format($desconto, 2, ",", ".") ?></p>
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
        <?php            
        endif;
        ?>
    </div>

    <div class="clear"></div>
</div>
