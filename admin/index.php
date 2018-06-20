<?php
//criando objeto usuario
require_once '../app/Config.inc.php';

$usuarioController = new UsuarioController();
$usuario = new Usuario();

$userLogado = $usuarioController->IsLogginIn();

//validando os dados 
$mail = "";
$pass = "";
$resultado = "";

//if ($nivel == 3):
//    header("location: index");
//endif;
$_SESSION['nivel'] = '';
$nivel = $_SESSION['nivel'];

if ($userLogado == true && $nivel == 1):
    header("location: dashboard");

elseif ($userLogado == true && $nivel == 3):
    header("location: index");
else:
    if (filter_input(INPUT_POST, 'btnLogar', FILTER_SANITIZE_STRING)):

        $mail = filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, 'txtSenha', FILTER_SANITIZE_STRING);
        $nivel = 1;
        $retornoUsuario = $usuarioController->AutenticarUsuario($mail, $pass, $nivel);


        //retornando os dados se usuário não forem nulos
        if ($retornoUsuario != null):
            //$nome = $retornoUsuario->getNome();
            //criando a sessões, esses valores estão retornando do banco de dados
            $_SESSION["cod"] = $retornoUsuario->getCod();
            $_SESSION["nome"] = $retornoUsuario->getNome();
            $_SESSION["nivel"] = $retornoUsuario->getNivel();
            $_SESSION["logado"] = true;

            //se usuário existir, redirecionamento para pagina checkout
            $insertGoTo = 'painel.php';
            header("refresh:3;url={$insertGoTo}");

            $resultado = "<div class='alert alert-success' style='margin-top: 12px;'>                            
                            <span><b> Sucesso - </b> Olá <strong>{$_SESSION["nome"]}</strong>, estamos redirecionando para o Painel de Administrativo </span>
                         </div>";
        else:
            $resultado = '<div class="alert alert-danger" style="margin-top: 12px;">                            
                            <span><b> Error - </b> Usuário ou senha inválidos </span>
                         </div>';

        endif;
    endif;
    ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Página de Login</title>
        <link href="assets/css/login.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="text-center">Bem-Vindo</h1>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="txtEmail" class="form-control input-lg" placeholder="E-mail"/>
                        </div>

                        <div class="form-group">
                            <input type="password" name="txtSenha" class="form-control input-lg" placeholder="Senha"/>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="btnLogar" class="btn btn-block btn-lg btn-primary" value="Entrar"/>
                            <span><a href="#">Esquece a Senha?</a></span>
                        </div>

                        <div class="form-group">
                            <?= $resultado; ?>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </body>
</html>

<?php
endif;
?>
