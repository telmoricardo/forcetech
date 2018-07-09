<?php

require_once 'Banco.php';

class UsuarioDAO {

    private $debug;
    private $pdo;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Usuario $usuario) {
        try {
            $sql = "INSERT INTO tb_usuarios (user_nome, user_nascimento, user_documento, user_nivel, user_email, user_telefone, user_celular, user_rua, user_numero, user_complemento, "
                    . "user_bairro, user_cidade, user_uf, user_cep, user_email_log, user_senha_cod, user_senha_log, user_data_log, user_status) "
                    . "VALUES(:nome, :nascimento, :documento, :nivel, :email, :telefone, :celular, :rua, :numero, :complemento, :bairro, :cidade, "
                    . ":uf, :cep, :email_log, :senha_cod, :senha_log, :data_log, :status)";
            $param = array(
                ":nome" => $usuario->getNome(),
                ":nascimento" => $usuario->getNascimento(),
                ":documento" => $usuario->getDocumento(),
                ":nivel" => $usuario->getNivel(),
                ":email" => $usuario->getEmail(),
                ":telefone" => $usuario->getTelefone(),
                ":celular" => $usuario->getCelular(),
                ":rua" => $usuario->getRua(),
                ":numero" => $usuario->getNumero(),
                ":complemento" => $usuario->getComplemento(),
                ":bairro" => $usuario->getBairro(),
                ":cidade" => $usuario->getCidade(),
                ":uf" => $usuario->getUf(),
                ":cep" => $usuario->getCep(),
                ":email_log" => $usuario->getEmail_log(),
                ":senha_cod" => $usuario->getSenha_cod(),
                ":senha_log" => $usuario->getSenha_log(),
                ":data_log" => $usuario->getData_log(),
                ":status" => $usuario->getStatus()
            );
            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //
    public function Atualizar(Usuario $usuario) {
        try {
            $sql = "UPDATE tb_usuarios SET user_nome = :nome, user_nascimento = :nascimento, user_documento = :documento, user_nivel = :nivel, user_email = :email, user_telefone = :telefone, 
                    user_celular = :celular, user_rua = :rua, user_numero = :numero, user_complemento = :complemento, user_bairro = :bairro, user_cidade = :cidade, user_uf = :uf, user_cep = :cep, 
                    user_email_log = :email_log, user_senha_cod = :senha_cod, user_senha_log = :senha_log, user_data_log = :data_log
                    WHERE cod = :cod";

            $param = array(
                ":cod" => $usuario->getCod(),
                ":nome" => $usuario->getNome(),
                ":nascimento" => $usuario->getNascimento(),
                ":documento" => $usuario->getDocumento(),
                ":nivel" => $usuario->getNivel(),
                ":email" => $usuario->getEmail(),
                ":telefone" => $usuario->getTelefone(),
                ":celular" => $usuario->getCelular(),
                ":rua" => $usuario->getRua(),
                ":numero" => $usuario->getNumero(),
                ":complemento" => $usuario->getComplemento(),
                ":bairro" => $usuario->getBairro(),
                ":cidade" => $usuario->getCidade(),
                ":uf" => $usuario->getUf(),
                ":cep" => $usuario->getCep(),
                ":email_log" => $usuario->getEmail_log(),
                ":senha_cod" => $usuario->getSenha_cod(),
                ":senha_log" => $usuario->getSenha_log(),
                ":data_log" => $usuario->getData_log()
            );

            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    //excluir usuario
    public function Excluir($cod) {
        try {
            $sql = "DELETE FROM tb_usuarios WHERE cod = :cod";
            $param = array(":cod" => $cod);
            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //listar todos os usuarios
    public function ListarUsuario($inicio = null, $quantidade = null) {
        try {
            $sql = "SELECT * FROM tb_usuarios WHERE user_nivel = 3 ORDER BY cod DESC LIMIT :inicio, :quantidade";
            $param = array(
                ":inicio" => $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);

            $listaUsuario = [];
            foreach ($dt as $pts) {
                $usuario = new Usuario();
                $usuario->setCod($pts['cod']);
                $usuario->setNome($pts['user_nome']);
                $usuario->setNascimento($pts['user_nascimento']);
                $usuario->setDocumento($pts['user_documento']);
                $usuario->setNivel($pts['user_nivel']);
                $usuario->setEmail($pts['user_email']);
                $usuario->setTelefone($pts['user_telefone']);
                $usuario->setCelular($pts['user_celular']);
                $usuario->setRua($pts['user_rua']);
                $usuario->setNumero($pts['user_numero']);
                $usuario->setComplemento($pts['user_complemento']);
                $usuario->setBairro($pts['user_bairro']);
                $usuario->setCidade($pts['user_cidade']);
                $usuario->setUf($pts['user_uf']);
                $usuario->setCep($pts['user_cep']);
                $usuario->setSenha_cod($pts['user_senha_cod']);
                $usuario->setData_log($pts['user_data_log']);
                $usuario->setStatus($pts['user_status']);

                $listaUsuario[] = $usuario;
            }
            return $listaUsuario;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //autenticação de usuario
    public function AutenticarUsuario($email, $senha, $nivel) {
        try {

            if ($nivel == 1) {

                $sql = "SELECT cod, user_nome, user_nivel FROM tb_usuarios WHERE user_email_log = :email AND user_senha_log = :senha AND user_nivel = :nivel";

                $param = array(
                    ":nivel" => $nivel,
                    ":email" => $email,
                    ":senha" => $senha
                );
            } elseif ($nivel == 3) {
                $sql = "SELECT cod, user_nome, user_nivel FROM tb_usuarios WHERE user_email_log = :email AND user_senha_log = :senha AND user_nivel = :nivel";

                $param = array(
                    ":nivel" => $nivel,
                    ":email" => $email,
                    ":senha" => $senha
                );
            } else {
                $sql = "SELECT cod, user_nome, user_nivel FROM tb_usuarios WHERE user_email_log =: email AND user_senha_log = :senha";

                $param = array(
                    ":email" => $email,
                    ":senha" => $senha
                );
            }

            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            if ($dt != null) {
                $usuario = new Usuario();
                $usuario->setCod($dt["cod"]);
                $usuario->setNome($dt["user_nome"]);
                $usuario->setNivel($dt["user_nivel"]);

                return $usuario;
            } else {
                return null;
            }
        } catch (PDOException $ex) {
            if ($this->debug) {
                echo "ERRO: {$ex->getMessage()} LINE: {$ex->getLine()}";
            }
            return null;
        }
    }

    /* verificar se o usuario esta logado */

    public function IsLogginIn() {
        if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
            return false;
        } else {
            return true;
        }
    }

    public function retornaUsuario($cod) {
        try {
            $sql = "SELECT * FROM tb_usuarios WHERE cod = :cod";
            $param = array(":cod" => $cod);
            //Data Table

            $pts = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $usuario = new Usuario();
            $usuario->setCod($pts['cod']);
            $usuario->setNome($pts['user_nome']);
            $usuario->setNascimento($pts['user_nascimento']);
            $usuario->setDocumento($pts['user_documento']);
            $usuario->setEmail($pts['user_email']);
            $usuario->setTelefone($pts['user_telefone']);
            $usuario->setCelular($pts['user_celular']);
            $usuario->setRua($pts['user_rua']);
            $usuario->setNumero($pts['user_numero']);
            $usuario->setComplemento($pts['user_complemento']);
            $usuario->setBairro($pts['user_bairro']);
            $usuario->setCidade($pts['user_cidade']);
            $usuario->setUf($pts['user_uf']);
            $usuario->setCep($pts['user_cep']);
            $usuario->setSenha_cod($pts['user_senha_cod']);
            return $usuario;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //retornando o status do usuario
    public function retornaStatusUser($cod) {
        try {
            $sql = "SELECT cod, user_status FROM tb_usuarios WHERE cod = :cod";
            $param = array(":cod" => $cod);
            //Data Table
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $usuario = new Usuario();
            $usuario->setCod($dt['cod']);
            $usuario->setStatus($dt['user_status']);
            return $usuario;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //alterar o status do usuario
    public function AlterarStatusUser($cod, $status) {
        try {
            $sql = "UPDATE tb_usuarios SET user_status = :status WHERE cod = :cod";
            $param = array(
                ":cod" => $cod,
                ":status" => $status
            );
            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //retorna quantidade de usuarios
    public function RetornaQtdUser() {
        try {
            $sql = "SELECT count(us.cod) as total FROM tb_usuarios us";
            $dr = $this->pdo->ExecuteQueryOneRow($sql);
            if ($dr["total"] != null):
                return $dr["total"];
            else:
                return 0;
            endif;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    /*verificar sem possui usuario ja cadastrado*/
    public function verificarUsuario($cpf) {
        try {
            $sql = "SELECT * FROM tb_usuarios WHERE user_documento = :cpf";
            $param = array(":cpf" => $cpf);
            //Data Table

            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            if ($dt != null) {
                $usuario = new Usuario();
                $usuario->setCod($dt["cod"]);
                $usuario->setNome($dt["user_nome"]);
                $usuario->setNivel($dt["user_nivel"]);
                return $usuario;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
}
