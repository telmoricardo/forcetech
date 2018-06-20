<?php

/*
 * provê uma interface que abstrai o acesso a dados; lê e grava a partir da origem de dados (banco de dados, arquivo, memória, etc.);
 * e encapsula o acesso aos dados, de forma que as demais classes não precisam saber sobre isso.
 * Cada método do DAO deve fazer uma única leitura ou gravação no banco de dados e não deve controlar transações ou 
 * realizar operações adicionais, tal como realizar alterações nos dados recebidos do serviço. 
 */

/**
 *  @TelmoRicardo
 */

class CategoriaDAO {
    private $debug;
    private $pdo;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }
    
    public function Cadastrar(Categoria $categoria){
        try {
            $sql = "INSERT INTO tb_categorias (categoria_nome, categoria_url, categoria_descricao, categoria_status, categoria_data) VALUES(:titulo, :url, :descricao, :status, :data)";
            $param = array(
                ":titulo" => $categoria->getCategoria_nome(),
                ":url" => $categoria->getCategoria_url(),
                ":descricao" => $categoria->getCategoria_descricao(),
                ":status" => $categoria->getCategoria_status(),            
                ":data" => $categoria->getCategoria_data()          
                        
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
    
    public function Atualizar(Categoria $categoria) {
        try {
            $sql = "UPDATE tb_categorias SET categoria_nome = :titulo, categoria_url = :url, categoria_descricao = :descricao, categoria_status = :status, categoria_data = :data WHERE categoria_cod = :cod";
            $param = array(
                ":cod" => $categoria->getCategoria_cod(),
                ":titulo" => $categoria->getCategoria_nome(),
                ":url" => $categoria->getCategoria_url(),
                ":descricao" => $categoria->getCategoria_descricao(),
                ":status" => $categoria->getCategoria_status(),
                ":data" => $categoria->getCategoria_data()
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
    
    public function ListarCategoria($inicio = null, $quantidade = null) {
        try {
            
            $sql = "SELECT * FROM tb_categorias ORDER BY categoria_cod ASC LIMIT :inicio, :quantidade";
            $param = array(
                ":inicio" => $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaCat = [];
            foreach ($dt as $pts) {
                $categoria = new Categoria();
                $categoria->setCategoria_cod($pts['categoria_cod']);
                $categoria->setCategoria_nome($pts['categoria_nome']);
                $categoria->setCategoria_status($pts['categoria_status']);
                $categoria->setCategoria_descricao($pts['categoria_descricao']);
                $categoria->setCategoria_views($pts['categoria_views']);              
                $categoria->setCategoria_data($pts['categoria_data']);              
                $categoria->setCategoria_url($pts['categoria_url']);            
                $listaCat[] = $categoria;
            }
            return $listaCat;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    public function ListarTodaCategoria() {
        try {
            
            $sql = "SELECT * FROM tb_categorias ORDER BY categoria_cod ASC";
            
            $dt = $this->pdo->ExecuteQuery($sql);

            $listaCat = [];
            foreach ($dt as $pts) {
                $categoria = new Categoria();
                $categoria->setCategoria_cod($pts['categoria_cod']);
                $categoria->setCategoria_nome($pts['categoria_nome']);
                $categoria->setCategoria_status($pts['categoria_status']);
                $categoria->setCategoria_descricao($pts['categoria_descricao']);
                $categoria->setCategoria_views($pts['categoria_views']);              
                $categoria->setCategoria_data($pts['categoria_data']);              
                $categoria->setCategoria_url($pts['categoria_url']);              
                
                $listaCat[] = $categoria;
            }
            return $listaCat;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
        
    public function retornaCategoria($cod){
        try {            
            $sql = "SELECT * FROM tb_categorias WHERE categoria_cod = :cod";
            $param = array(":cod" => $cod);            
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);            
            $categoria = new Categoria();
            $categoria->setCategoria_cod($dt['categoria_cod']);
            $categoria->setCategoria_nome($dt['categoria_nome']);
            $categoria->setCategoria_descricao($dt['categoria_descricao']);
            $categoria->setCategoria_status($dt['categoria_status']);
            $categoria->setCategoria_url($dt['categoria_url']);
            $categoria->setCategoria_data($dt['categoria_data']);           
            return $categoria;            
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    public function retornaCategoriaUrl($url){
        try {            
            $sql = "SELECT * FROM tb_categorias WHERE categoria_url = :url";
            $param = array(":url" => $url);            
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);            
            $categoria = new Categoria();
            $categoria->setCategoria_cod($dt['categoria_cod']);
            $categoria->setCategoria_nome($dt['categoria_nome']);
            $categoria->setCategoria_descricao($dt['categoria_descricao']);
            $categoria->setCategoria_status($dt['categoria_status']);
            $categoria->setCategoria_url($dt['categoria_url']);
            $categoria->setCategoria_data($dt['categoria_data']);           
            return $categoria;            
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    public function Excluir($cod) {
        try {
            $sql = "DELETE FROM categoria WHERE cod = :cod";
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
    
    public function RetornaQtdSubcategoria() {
        try {
            $sql = "SELECT count(tc.categoria_cod) as total FROM tb_categorias tc";
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
