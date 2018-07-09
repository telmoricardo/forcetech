<?php
//intanciando os objetos
$usuarioController = new UsuarioController();
$helper = new Helper();

//mostra a mensagem verdadeiro ou falso na hora do cadastro
$resultado = "";
$titulo = "";
$status = "";
$descricao = "";
$data = "";

$btnExcluir = filter_input(INPUT_GET, "del", FILTER_SANITIZE_NUMBER_INT);
if($btnExcluir):    
    if ($usuarioController->Excluir($btnExcluir)):
        echo '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
                alert ("Removido com sucesso!")
                </SCRIPT>';
    else:
       echo '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
                alert ("Erro ao remover!")
                </SCRIPT>';
    endif;
endif;

/*
* Pegando o cod que esta vindo através da url active = 1
* o status vai receber o valor 2 = que é inativo
*/
$active = filter_input(INPUT_GET, "active", FILTER_SANITIZE_NUMBER_INT);
if ($active):
    //retorna o slider 
    $retornaStatus = $usuarioController->retornaStatusUser($active);
    $status = 2;
    if ($usuarioController->AlterarStatusUser($active, $status)):
        echo '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
                alert ("O status do usuário está mudando para Bloqueado!")
                </SCRIPT>';
    endif;

endif;

$inactive = filter_input(INPUT_GET, "inactive", FILTER_SANITIZE_NUMBER_INT);
if ($inactive):
    //retorna o slider 
    $retornaStatus = $usuarioController->retornaStatusUser($active);
    $status = 1;
    if ($usuarioController->AlterarStatusUser($inactive, $status)):
        echo '<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
            alert ("O status do usuário está mudando para Ativo!")
            </SCRIPT>';
    endif;
endif;

//iniciando as paginação
if (empty($_GET['pg'])):
else:
    $pg = $_GET['pg'];
endif;
if (isset($pg)):
    $pg = $_GET['pg'];
else:
    $pg = 1;
endif;

$quantidade = 8;
$inicio = ($pg * $quantidade) - $quantidade;
//listando os usuarios
$listarUsuario = $usuarioController->ListarUsuario($inicio, $quantidade);

?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Lista de Usuários</h4>
                            <?php
                              
                            ?>

                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Celular</th>
                                    <th>Último Log</th>
                                    <th>Atualizar</th>
                                    <th>Excluir</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    <?php
                                        if($listarUsuario == null):
                                            echo '<td colspan="8">Não existe nenhuma categoria cadastrada nesse momento</td';
                                        else:
                                            foreach($listarUsuario as $user):
                                    ?>
                                    <tr>
                                    
                                        <td><?= $user->getCod();?></td>
                                        <td><?= $user->getNome();?></td>
                                        <td><?= $user->getEmail();?></td>
                                        <td><?= $user->getCelular();?></td>
                                        <td><?= $helper->converteData($user->getData_log());?></td>
                                        <td><a href="?pagina=editarUser&cod=<?= $user->getCod();?>" class="btn btn-sm btn-info btn-icon"><i class="fa ti-slice"></i></a></td>
                                        <td><a href="?pagina=listarUser&del=<?= $user->getCod();?>" title="Excluir" class="btn btn-sm btn-danger btn-icon"><i class="fa ti-trash"></i></a></td>
                                        <td>
                                            <?php
                                                if($user->getStatus() == 1):
                                                    echo "<a class='btn btn-success' title='Pago' href='?pagina=listarUser&active={$user->getCod()}'><i class='ti-check'></i>";
                                                else:
                                                    echo "<a class='btn btn-danger' title='Aguardando' href='?pagina=listarUser&inactive={$user->getCod()}'><i class='ti-close'></i></a>";
                                                endif;
                                            
                                            ?>
                                        </td>  
                                        
                                    
                                    </tr>
                                    <?php
                                            endforeach;
                                        endif;
                                    ?>
                                    

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-7">
                   <nav aria-label="Page navigation">
                <?php
                $totalRegistros = $usuarioController->RetornaQtdUser();
                $totalRegistros;
                if ($totalRegistros <= $quantidade):
                    
                else:
                    $paginas = ceil($totalRegistros / $quantidade);
                    $links = 5;

                    if (isset($i)):
                    else:
                        $i = '1';
                    endif;
                ?>
                <!-- ativação da paginação-->
                    <style>
                    <?php
                    if (isset($_GET['pg'])):
                        $num_pg = $_GET['pg'];
                    endif;
                    ?>
                        .pagination a.active<?php echo $num_pg; ?>{background-color: #069; color: #fff; }
                    </style>
                <ul class="pagination">
                    <li><a href="painel.php?pagina=listarUser&pg=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                    <?php
                    if (isset($_GET['pg'])):
                        $num_pg = $_GET['pg'];
                    endif;

                    for ($i = $pg - $links; $i <= $pg - 1; $i++):
                        if ($i <= 0):
                        else:
                            ?>                            
                            <li class="active<?= $i; ?>">
                                <a href="painel.php?pagina=listarUser&pg=<?= $i; ?>"><?= $i; ?> 
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                        <?php
                        endif;
                    endfor;
                    ?>       
                    <li>
                        <a class="active<?= $i; ?>" href="painel.php?pagina=listarUser&pg=<?= $i; ?>"><?= $pg; ?></a>
                    </li>
                    <?php
                    for ($i = $pg + 1; $i <= $pg = $links; $i++):
                        if ($i > $paginas):
                        else:
                            ?>
                            <li>
                                <a class="active<?= $i; ?>" href="painel.php?pagina=listarUser&pg=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php
                        endif;
                    endfor;
                    ?>                    
                    <li>
                        <a href="painel.php?pagina=listarUser&pg=<?= $paginas; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
                <?php
                endif;
                ?>
                
            </nav>                  
                    
                </div>
                

            </div>
        </div>
    </div>
    
   