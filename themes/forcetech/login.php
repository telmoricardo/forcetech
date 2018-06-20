<?php
//incluindo a classe usuarioController
//criando objeto usuario
$usuarioController = new UsuarioController();
$usuario = new Usuario();

$userLogado = $usuarioController->IsLogginIn();

//validando os dados 
$mail = "";
$pass = "";
$resultado = "";

if ($userLogado == true):
    header("location: my-conta");
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
            $insertGoTo = 'minha-conta';            
            header( "refresh:3;url={$insertGoTo}" );
            
            $resultado = "<div class='msg-succes' style='margin-top: 12px;'>                            
                            <span><b> Sucesso - </b> Olá <strong>{$_SESSION["nome"]}</strong>, estamos redirecionando para sua conta </span>
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
                    <h1>Painel de Usuário</h1>
                    <ul>
                        <li><p>Verificar seu pedido foi aprovado.</p></li>
                        <li><p>Pedido com as informações sobre o produto, quantidade e valor.</p></li>
                        <li><p>Atualização dos dados do usuário</p></li>
                    </ul>                    
                </div>
                
                <div class="column column-6 verificar-entrar">
                    <h1>Acesse sua conta, faça login!</h1>
                    <form method="post">
                        <div class="form-field">
                            <label>Login</label>
                            <input type="text" name="txtUsuario" placeholder="email@dominio.com.br">
                        </div>
                        <div class="form-group">
                            <label>Senha</label>
                            <input type="password" name="txtSenha" placeholder="*************">
                        </div>

                        <input type="submit" name="btnEntrar" class="btn btn-blue" value="Entrar" style="width: 150px; margin-right: 8px;"/>
                        <a href="<?= HOME?>/cadastre" class="btn btn-green" style="width: 150px; margin-right: 8px; text-align: center; padding: 11px;">Cadastre</a>

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