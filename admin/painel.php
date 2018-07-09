<?php 
require_once '../app/Config.inc.php';
$nivel = $_SESSION['nivel'];
$usuarioController = new UsuarioController();
$usuarioLogado = $usuarioController->IsLogginIn();


if ($nivel == 3):
    header("location: index.php");
endif;


if ($usuarioLogado == true):    
 ?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Painel Administrativo</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />


        <!-- Bootstrap core CSS     -->
        <link href="<?= BASEADMIN?>/assets/css/bootstrap.min.css" rel="stylesheet" />

        <!-- Animation library for notifications   -->
        <link href="<?= BASEADMIN?>/assets/css/animate.min.css" rel="stylesheet"/>

        <!--  Paper Dashboard core CSS    -->
        <link href="<?= BASEADMIN?>/assets/css/paper-dashboard.css" rel="stylesheet"/>

        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="<?= BASEADMIN?>/assets/css/demo.css" rel="stylesheet" />

        <!--  Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/themify-icons.css" rel="stylesheet">

    </head>
    <body>

        <div class="wrapper">
            <div class="sidebar" data-background-color="black" data-active-color="info">

                <!--
                    Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
                    Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
                -->

                <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="#" class="simple-text">
                            Painel Administrativo
                        </a>
                    </div>

                    <nav class="navigation">
                        <ul class="mainmenu">
                            <li><a href="#"><i class="ti-panel"></i> Painel Administrativo</a></li>
                            <li><a href="#"><i class="ti-user"></i> Usuário</a>
                                <ul class="submenu">
                                    <li><a href="?pagina=user"> <i class="ti-plus"></i> Novo Usuário</a></li>
                                    <li><a href="?pagina=listarUser"> <i class="ti-view-list-alt"></i> Listar Usuários</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="#"><i class="ti-package"></i> Produto</a>
                                <ul class="submenu">
                                    <li><a href="?pagina=produto"> <i class="ti-plus"></i> Novo Produto</a></li>
                                    <li><a href="?pagina=listarProdutos"> <i class="ti-view-list-alt"></i> Listar Produtos</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="#"><i class="ti-layers"></i> Categoria</a>
                                <ul class="submenu">
                                    <li><a href="?pagina=categoria"> <i class="ti-plus"></i> Nova Categoria</a></li>
                                    <li><a href="?pagina=listarCategoria"> <i class="ti-view-list-alt"></i> Listar Categorias</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="#"><i class="ti-layers-alt"></i> Subcategoria</a>
                                <ul class="submenu">
                                    <li><a href="?pagina=subcategoria"> <i class="ti-plus"></i> Nova Subcategoria</a></li>
                                    <li><a href="?pagina=listaSubcategoria"> <i class="ti-view-list-alt"></i> Listar Subcategorias</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="#"><i class="ti-image"></i> Slider</a>
                                <ul class="submenu">
                                    <li><a href="?pagina=slider"> <i class="ti-plus"></i> Novo Slider</a></li>
                                    <li><a href="?pagina=listarSlider"> <i class="ti-view-list-alt"></i> Listar Slider</a></li>
                                </ul>
                            </li>
                            
                            <li><a href="logout.php"> <i class="ti-export"></i> Sair</a></li>
                        </ul>
                    </nav>

                    
                </div>
            </div>

            <div class="main-panel">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar bar1"></span>
                                <span class="icon-bar bar2"></span>
                                <span class="icon-bar bar3"></span>
                            </button>
                            <a class="navbar-brand" href="#">Dashboard</a>
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="ti-panel"></i>
                                        <p>Stats</p>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="ti-user"></i>
                                        <p><?= $_SESSION["nome"];?></p>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="?pagina=editarUser&cod=<?= $_SESSION["cod"];?>">Editar Perfil</a></li>
                                        <li><a href="logout.php">Sair</a></li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="ti-settings"></i>
                                        <p>Configurações</p>
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>


                <!-----------------------conteudo----------------------->

                <?php
                $pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);
                $arrayPaginas = array(
                    "painel" => "View/painel.php",
                    "user" => "View/User/user.php",
                    "listarUser" => "View/User/listarUser.php",
                    "editarUser" => "View/User/editarUser.php",
                    "categoria" => "View/Categoria/categoria.php",
                    "listarCategoria" => "View/Categoria/listarCategoria.php",
                    "editarCategoria" => "View/Categoria/editarCategoria.php",
                    "subcategoria" => "View/Subcategoria/subcategoria.php",
                    "listaSubcategoria" => "View/Subcategoria/listarSubcategoria.php",
                    "editarSubcategoria" => "View/Subcategoria/editarSubcategoria.php",
                    "produto" => "View/Produto/produto.php",
                    "listarProdutos" => "View/Produto/listarProdutos.php",
                    "editarProdutos" => "View/Produto/editarProdutos.php",
                    "galeriaProdutos" => "View/Produto/galeriaProdutos.php",
                    "fabricante" => "View/Fabricante/fabricante.phtml",
                    "listarFabricante" => "View/Fabricante/listarFabricante.phtml",
                    "pedido_list" => "View/Pedido/pedido_list.phtml",
                    "pedido_detalhes" => "View/Pedido/pedido_detalhes.phtml",
                    "slider" => "View/Slider/slider.php",
                    "listarSlider" => "View/Slider/listarSlider.php",
                    "editarSlider" => "View/Slider/editarSlider.php",
                    "editarImagem" => "View/Slider/editarImagem.php"
                );

                if ($pagina) {
                    $encontrou = false;
                    foreach ($arrayPaginas as $page => $key) {
                        if ($pagina == $page) {
                            $encontrou = true;
                            require_once($key);
                        }
                    }
                    if (!$encontrou) {
                        require_once("View/painel.php");
                    }
                } else {
                    require_once("View/painel.php");
                }
                ?>

                <!-----------------------conteudo----------------------->




                <footer class="footer">
                    <div class="container-fluid">                        
                        <div class="copyright pull-right">
                            &copy; <script>document.write(new Date().getFullYear());</script>, feito com <i class="fa fa-heart heart"></i> da <a href="inovepublicidade.com">Inove Publicidade</a>
                        </div>
                    </div>
                </footer>

            </div>
        </div>


    </body>

    <!--   Core JS Files   -->
    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="assets/js/bootstrap-checkbox-radio.js"></script>
    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>
    <!--SELECIOEN A SUBCATEGORIA-->
    <script src="assets/js/filtroCategoria.js" type="text/javascript"></script>

    <!--FUNÇÃO PARA PERSONALIZAÇÃO OS TEXTOS-->
    <script src="assets/js/tinymce/tinymce.min.js" type="text/javascript"></script>
    <script src="assets/js/tinymce_funcao.js" type="text/javascript"></script>

    <!--FUNÇÃO PREVIEW IMAGEM -->
    <script src="assets/js/previewImagem.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            demo.initChartist();

//            .notify({
//             icon: 'ti-gift',
//             message: "Welcome to <b>Paper Dashboard</b> - a beautiful Bootstrap freebie for your next project."
//
//             }, {
//             type: 'success',
//             timer: 4000
//             });

                                });
    </script>
</html>
<?php
else:
    header("location: index.php");
endif;