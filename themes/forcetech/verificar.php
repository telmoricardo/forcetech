<?php
//incluindo a classe usuarioController
$usuarioController = new UsuarioController();
$usuario = new Usuario();

$userLogado = $usuarioController->IsLogginIn();

//validando os dados 
$mail = "";
$pass = "";
$resultado = "";

if ($userLogado == true):
    header("location: checkout");
else:
    if (filter_input(INPUT_POST, 'btnEntrar', FILTER_SANITIZE_STRING)):
        $mail = filter_input(INPUT_POST, 'txtUsuario', FILTER_SANITIZE_STRING);
        $pass = filter_input(INPUT_POST, 'txtSenha', FILTER_SANITIZE_STRING);
        $nivel = 3;
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
            $insertGoTo = 'checkout';
            header("refresh:3;url={$insertGoTo}");

            $resultado = "<div class='amsg-succes' style='margin-top: 12px;'>                            
                            <span><b> Sucesso - </b> Olá <strong>{$_SESSION["nome"]}</strong>, estamos redirecionando para checkout </span>
                         </div>";
        else:
            $resultado = '<div class="msg-error" style="margin-top: 12px;">                            
                            <span><b> Error - </b> Usuário ou senha inválidos </span>
                         </div>';

        endif;
    endif;
    ?>
    <div class="container">
        <div class="content">
            <div class="row verificar">                
                <div class="column column-6 verificar-cadastro">
                    <h1>Ainda não é cadastrado?</h1>
                    <p>Se você ainda não é cadastrado na loja, por favor, cadastre-se para prosseguir com o progresso de compra do seu produto!</p>
                    <p>É rapidinho!</p>
                    <a href="<?= HOME;?>/cadastre" class="btn btn-blue" >Clicando Aqui</a>
                </div>
                
                <div class="column column-6 verificar-entrar"> 
                    <h1>Já é cadastrado? Faça login!</h1>
                    <form method="post">                        
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" name="txtUsuario" class="form-field" placeholder="email@dominio.com.br">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" name="txtSenha" class="form-field">
                        </div>

                        <input type="submit" name="btnEntrar" class="btn btn-green btn-entrar" value="Entrar"/>
                        <a href="#" class="btn btn-red" style="color: #fff;">Esqueceu a Senha?</a>

                        <div class="form-group">
                            <?= $resultado; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
endif;
?>