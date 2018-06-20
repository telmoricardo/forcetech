<?php

class PedidoProdutoDAO {
    private $debug;
    private $pdo;
    
    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }
    
    public function Cadastrar(PedidoProduto $pedidoProduto) {
        try {
            $sql = "INSERT INTO tb_pedidos_produto  "
                . "(tb_pedidos_produto_cliente, tb_pedidos_produto_id_moip, tb_pedidos_produto_quantidade, tb_pedidos_produto_subtotal, tb_pedidos_produto_id, tb_pedidos_produto_nome, tb_pedidos_produto_data) "
         . "VALUES (:pedidos_produto_cliente, :pedidos_produto_id_moip, :pedidos_produto_quantidade, :pedidos_produto_subtotal, :pedidos_produto_id, :pedidos_produto_nome, :pedidos_produto_data)";
            $param = array(
                ":pedidos_produto_cliente" => $pedidoProduto->getPedidos_produto_cliente(),
                ":pedidos_produto_id_moip" => $pedidoProduto->getPedidos_produto_id_moip(),
                ":pedidos_produto_quantidade" => $pedidoProduto->getPedidos_produto_quantidade(),
                ":pedidos_produto_subtotal" => $pedidoProduto->getPedidos_produto_subtotal(),
                ":pedidos_produto_id" => $pedidoProduto->getPedidos_produto_id(),
                ":pedidos_produto_nome" => $pedidoProduto->getPedidos_produto_nome(),
                ":pedidos_produto_data" => $pedidoProduto->getPedidos_produto_data()
                
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
    
    public function Deletar($id){
        try {
            $sql = "DELETE FROM tb_pedidos_produto WHERE tb_pedidos_produto_id_moip = :id";
            $param = array(":id" => $id);
            return $this->pdo->ExecuteNonQuery($sql, $param);
            
        }catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    //retorna uma lista de subcategoria quando existe $cod
    public function produtoPedidoRelacionado($cod) {
        try {
            //$sql = "SELECT * FROM tb_produtos WHERE produto_cod = :cod";
            $sql = "SELECT * FROM tb_pedidos_produto WHERE tb_pedidos_produto_id_moip = :cod";
            $param = array(":cod" => $cod);
            
            $dt = $this->pdo->ExecuteQuery($sql, $param);        
            
            
            $listaPedidoProduto = [];
            
            foreach ($dt as $pts):
                $pedidoProduto = new PedidoProduto();
                $pedidoProduto->setId($pts['id']);
                $pedidoProduto->setPedidos_produto_id_moip($pts['tb_pedidos_produto_id_moip']);
                $pedidoProduto->setPedidos_produto_quantidade($pts['tb_pedidos_produto_quantidade']);
                $pedidoProduto->setPedidos_produto_nome($pts['tb_pedidos_produto_nome']);
                $pedidoProduto->setPedidos_produto_subtotal($pts['tb_pedidos_produto_subtotal']);
                
                $listaPedidoProduto[] = $pedidoProduto;
            endforeach;
            
            return $listaPedidoProduto;
            
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    public function AlterarBoleto($cod, $boleto) {
        try {
            $sql = "UPDATE tb_pedidos_produto SET tb_pedidos_produto_boleto = :boleto WHERE tb_pedidos_produto_id_moip = :cod";
            $param = array(
                ":cod" => $cod,
                ":boleto" => $boleto
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
    
    
}
