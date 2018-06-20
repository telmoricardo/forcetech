<?php
class PedidoDAO {

    private $debug;
    private $pdo;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    public function Cadastrar(Pedido $pedido) {
        try {
            $sql = "INSERT INTO tb_pedidos (tb_pedidos_cliente, tb_pedidos_id_moip, tb_pedidos_data, tb_pedidos_total, tb_pedidos_frete, tb_pedidos_frete_tipo, tb_pedidos_status,  
                    tb_pedidos_cep, tb_pedidos_endereco, tb_pedidos_numero, tb_pedidos_bairro, tb_pedidos_cidade, tb_pedidos_uf, tb_pedidos_complemento)                    
                    VALUES (:pedidos_cliente, :pedidos_id_moip, :pedidos_data, :pedidos_total, :pedidos_frete, :pedidos_frete_tipo, :pedidos_status, :pedidos_cep, 
                    :pedidos_endereco, :pedidos_numero, :pedidos_bairro, :pedidos_cidade, :pedidos_uf, :pedidos_complemento)";
            $param = array(
                ":pedidos_cliente" => $pedido->getPedidos_cliente(),
                ":pedidos_id_moip" => $pedido->getPedidos_id_moip(),
                ":pedidos_data" => $pedido->getPedidos_data(),
                ":pedidos_total" => $pedido->getPedidos_total(),
                ":pedidos_frete" => $pedido->getPedidos_frete(),
                ":pedidos_frete_tipo" => $pedido->getPedidos_frete_tipo(),
                ":pedidos_status" => $pedido->getPedidos_status(),
                ":pedidos_cep" => $pedido->getPedidos_cep(),
                ":pedidos_endereco" => $pedido->getPedidos_endereco(),
                ":pedidos_numero" => $pedido->getPedidos_numero(),
                ":pedidos_bairro" => $pedido->getPedidos_bairro(),
                ":pedidos_cidade" => $pedido->getPedidos_cidade(),
                ":pedidos_uf" => $pedido->getPedidos_uf(),
                ":pedidos_complemento" => $pedido->getPedidos_complemento(),
                
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

    public function ListarPedidos($inicio = null, $quantidade = null) {
        try {
//            $sql = "SELECT * FROM tb_pedidos ORDER BY id DESC LIMIT :inicio, :quantidade";
            $sql = "SELECT u.cod, u.user_nome, p.id, p.tb_pedidos_cliente, p.tb_pedidos_id_moip, p.tb_pedidos_data, p.tb_pedidos_total, p.tb_pedidos_frete, 
                p.tb_pedidos_status, p.tb_pedidos_cep, p.tb_pedidos_endereco, p.tb_pedidos_numero, p.tb_pedidos_bairro, p.tb_pedidos_cidade, p.tb_pedidos_uf, p.tb_pedidos_complemento FROM tb_pedidos p                
                INNER JOIN tb_usuarios u ON u.cod = p.tb_pedidos_cliente ORDER BY p.id DESC
                LIMIT :inicio, :quantidade";

            $param = array(
                ":inicio" => $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaPedidos = [];
            foreach ($dt as $pts) {
                $pedido = new Pedido();
                $pedido->setId($pts['id']);
                //pegando dados do cliente
                $pedido->getPedidos_cliente()->setCod($pts['cod']);
                $pedido->getPedidos_cliente()->setNome($pts['user_nome']);
                $pedido->setPedidos_id_moip($pts['tb_pedidos_id_moip']);
                $pedido->setPedidos_data($pts['tb_pedidos_data']);
                $pedido->setPedidos_total($pts['tb_pedidos_total']);
                $pedido->setPedidos_frete($pts['tb_pedidos_frete']);
                $pedido->setPedidos_status($pts['tb_pedidos_status']);
                $pedido->setPedidos_cep($pts['tb_pedidos_cep']);
                $pedido->setPedidos_endereco($pts['tb_pedidos_endereco']);
                $pedido->setPedidos_numero($pts['tb_pedidos_numero']);
                $pedido->setPedidos_bairro($pts['tb_pedidos_bairro']);
                $pedido->setPedidos_cidade($pts['tb_pedidos_cidade']);
                $pedido->setPedidos_uf($pts['tb_pedidos_uf']);
                $pedido->setPedidos_complemento($pts['tb_pedidos_complemento']);

                $listaPedidos[] = $pedido;
            }
            return $listaPedidos;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    //retorna lista Pedidos do cliente
    public function ListarPedidosCliente($cod, $inicio = null, $quantidade = null) {
        try {
//            $sql = "SELECT * FROM tb_pedidos ORDER BY id DESC LIMIT :inicio, :quantidade";
            $sql = "SELECT u.cod, u.user_nome, p.id, p.tb_pedidos_cliente, p.tb_pedidos_id_moip, p.tb_pedidos_data, p.tb_pedidos_total, p.tb_pedidos_frete, 
                p.tb_pedidos_status, p.tb_pedidos_cep, p.tb_pedidos_endereco, p.tb_pedidos_numero, p.tb_pedidos_bairro, p.tb_pedidos_cidade, p.tb_pedidos_uf, p.tb_pedidos_complemento FROM tb_pedidos p                
                INNER JOIN tb_usuarios u ON u.cod = p.tb_pedidos_cliente WHERE p.tb_pedidos_cliente = :cod ORDER BY p.id DESC
                LIMIT :inicio, :quantidade";

            $param = array(
                ":cod" => $cod,
                ":inicio" => $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaPedidos = [];
            foreach ($dt as $pts) {
                $pedido = new Pedido();
                $pedido->setId($pts['id']);
                //pegando dados do cliente
                $pedido->getPedidos_cliente()->setCod($pts['cod']);
                $pedido->getPedidos_cliente()->setNome($pts['user_nome']);
                $pedido->setPedidos_id_moip($pts['tb_pedidos_id_moip']);
                $pedido->setPedidos_data($pts['tb_pedidos_data']);
                $pedido->setPedidos_total($pts['tb_pedidos_total']);
                $pedido->setPedidos_frete($pts['tb_pedidos_frete']);
                $pedido->setPedidos_status($pts['tb_pedidos_status']);
                $pedido->setPedidos_cep($pts['tb_pedidos_cep']);
                $pedido->setPedidos_endereco($pts['tb_pedidos_endereco']);
                $pedido->setPedidos_numero($pts['tb_pedidos_numero']);
                $pedido->setPedidos_bairro($pts['tb_pedidos_bairro']);
                $pedido->setPedidos_cidade($pts['tb_pedidos_cidade']);
                $pedido->setPedidos_uf($pts['tb_pedidos_uf']);
                $pedido->setPedidos_complemento($pts['tb_pedidos_complemento']);
                

                $listaPedidos[] = $pedido;
            }
            return $listaPedidos;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //retorna o pedido pelo ID
    public function retornaPedidoId($id) {
        try {

            //$sql = "SELECT * FROM tb_produtos WHERE produto_cod = :cod";
            $sql = "SELECT pp.tb_pedidos_produto_cliente, u.cod, u.user_nome, u.user_documento, u.user_telefone, u.user_celular, u.user_nascimento, u.user_rua, u.user_numero, 
                    u.user_complemento, u.user_bairro, u.user_cidade, u.user_uf, u.user_cep, u.user_email, 
                    p.id, p.tb_pedidos_cliente, p.tb_pedidos_id_moip, p.tb_pedidos_data, p.tb_pedidos_total, p.tb_pedidos_frete, p.tb_pedidos_status, p.tb_pedidos_frete_tipo,
                    p.tb_pedidos_cep, p.tb_pedidos_endereco, p.tb_pedidos_numero, p.tb_pedidos_bairro, p.tb_pedidos_cidade, p.tb_pedidos_uf, p.tb_pedidos_complemento
                    FROM tb_pedidos p
                    INNER JOIN tb_pedidos_produto pp ON pp.tb_pedidos_produto_cliente = p.tb_pedidos_cliente
                    INNER JOIN tb_usuarios u ON u.cod = p.tb_pedidos_cliente WHERE p.id = :id";
            $param = array(":id" => $id);
            //Data Table

            $pts = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $pedido = new Pedido();
            $pedido->setId($pts['id']);
            //pegando dados do cliente
            $pedido->getPedidos_cliente()->setCod($pts['cod']);
            $pedido->getPedidos_cliente()->setNome($pts['user_nome']);
            $pedido->getPedidos_cliente()->setDocumento($pts['user_documento']);
            $pedido->getPedidos_cliente()->setTelefone($pts['user_telefone']);
            $pedido->getPedidos_cliente()->setCelular($pts['user_celular']);
            $pedido->getPedidos_cliente()->setNascimento($pts['user_nascimento']);
            $pedido->getPedidos_cliente()->setRua($pts['user_rua']);
            $pedido->getPedidos_cliente()->setNumero($pts['user_numero']);
            $pedido->getPedidos_cliente()->setComplemento($pts['user_complemento']);
            $pedido->getPedidos_cliente()->setBairro($pts['user_bairro']);
            $pedido->getPedidos_cliente()->setCidade($pts['user_cidade']);
            $pedido->getPedidos_cliente()->setUf($pts['user_uf']);
            $pedido->getPedidos_cliente()->setCep($pts['user_cep']);
            $pedido->getPedidos_cliente()->setEmail($pts['user_email']);
            
            //pegando dados do pedido
            $pedido->setPedidos_id_moip($pts['tb_pedidos_id_moip']);
            $pedido->setPedidos_data($pts['tb_pedidos_data']);
            $pedido->setPedidos_total($pts['tb_pedidos_total']);
            $pedido->setPedidos_frete($pts['tb_pedidos_frete']);
            $pedido->setPedidos_status($pts['tb_pedidos_status']);
            $pedido->setPedidos_frete_tipo($pts['tb_pedidos_frete_tipo']);
            $pedido->setPedidos_cep($pts['tb_pedidos_cep']);
            $pedido->setPedidos_endereco($pts['tb_pedidos_endereco']);
            $pedido->setPedidos_numero($pts['tb_pedidos_numero']);
            $pedido->setPedidos_bairro($pts['tb_pedidos_bairro']);
            $pedido->setPedidos_cidade($pts['tb_pedidos_cidade']);
            $pedido->setPedidos_uf($pts['tb_pedidos_uf']);            

            return $pedido;
            
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    public function Deletar($id) {
        try {
            $sql = "DELETE FROM tb_pedidos_produto WHERE id = :id";
            $param = array(":id" => $id);
            return $this->pdo->ExecuteNonQuery($sql, $param);
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    public function retornaStatusPedido($cod) {
        try {
            $sql = "SELECT id, tb_pedidos_status FROM tb_pedidos WHERE id = :cod";
            $param = array(":cod" => $cod);
            //Data Table
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $pedido = new Pedido();
            $pedido->setId($dt['id']);
            $pedido->setPedidos_status($dt['tb_pedidos_status']);
            return $pedido;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    public function AlterarStatusPedido($cod, $status) {
        try {
            $sql = "UPDATE tb_pedidos SET tb_pedidos_status = :status WHERE id = :cod";
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

    public function RetornaQtdPedido() {
        try {
            $sql = "SELECT count(pe.id) as total FROM tb_pedidos pe";
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
    

}
