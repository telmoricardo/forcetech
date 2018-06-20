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

class SubcategoriaDAO {
    private $debug;
    private $pdo;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }
    
    public function Cadastrar(Subcategoria $subcategoria){
        try {
            $sql = "INSERT INTO tb_subcategorias (sub_titulo, sub_url, sub_descricao, sub_status, sub_data, categoria_cod) VALUES(:titulo, :url, :descricao, :status, :data, :categoria_cod)";
            $param = array(
                ":titulo" => $subcategoria->getSub_titulo(),
                ":url" => $subcategoria->getSub_url(),
                ":descricao" => $subcategoria->getSub_descricao(),
                ":status" => $subcategoria->getSub_status(),            
                ":data" => $subcategoria->getSub_data(),            
                ":categoria_cod" => $subcategoria->getCategoria()->getCategoria_cod()    
                        
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
    
    public function Atualizar(Subcategoria $subcategoria) {
        try {
            $sql = "UPDATE tb_subcategorias SET sub_titulo = :titulo, sub_url = :url, sub_descricao = :descricao, sub_status = :status, sub_data = :data, categoria_cod = :categoria_cod WHERE sub_cod = :cod";
            $param = array(
                ":cod" => $subcategoria->getSub_cod(),
                ":titulo" => $subcategoria->getSub_titulo(),
                ":url" => $subcategoria->getSub_url(),
                ":descricao" => $subcategoria->getSub_descricao(),
                ":status" => $subcategoria->getSub_status(),
                ":data" => $subcategoria->getSub_data(),
                ":categoria_cod" => $subcategoria->getCategoria()
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
    
    public function ListaSubcategoria($inicio = null, $quantidade = null) {
        try {
            $sql = "SELECT s.sub_cod, s.sub_titulo, s.sub_url, s.sub_descricao, s.sub_status, s.sub_data, s.categoria_cod, c.categoria_cod, c.categoria_nome 
                    FROM tb_subcategorias s INNER JOIN tb_categorias c ON s.categoria_cod = c.categoria_cod LIMIT :inicio, :quantidade";
            $param = array(
                ":inicio" => $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaSubcategoria = [];
            foreach ($dt as $sb):
                $subcategoria = new Subcategoria();
                $subcategoria->setSub_cod($sb['sub_cod']);
                $subcategoria->setSub_titulo($sb['sub_titulo']);
                $subcategoria->setSub_url($sb['sub_url']);
                $subcategoria->setSub_descricao($sb['sub_descricao']);
                $subcategoria->setSub_status($sb['sub_status']);
                $subcategoria->setSub_data($sb['sub_data']);                
                $subcategoria->getCategoria()->setCategoria_cod($sb['categoria_cod']);  
                $subcategoria->getCategoria()->setCategoria_nome($sb['categoria_nome']);  
                
                $listaSubcategoria[] = $subcategoria;
            endforeach;
            return $listaSubcategoria;
            
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    //retorna um registro de subcategoria
    public function retornaSubcategoria($cod){
        try {
            
            $sql = "SELECT s.sub_cod, s.sub_titulo, s.sub_url, s.sub_descricao, s.sub_status, s.sub_data, s.categoria_cod, c.categoria_cod, c.categoria_nome FROM tb_subcategorias s INNER JOIN tb_categorias c ON s.categoria_cod = c.categoria_cod WHERE sub_cod = :cod";
            $param = array(":cod" => $cod);
            
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            
            $subcategoria = new Subcategoria();
            $subcategoria->setSub_cod($dt['sub_cod']);
            $subcategoria->setSub_titulo($dt['sub_titulo']);
            $subcategoria->setSub_url($dt['sub_url']);
            $subcategoria->setSub_descricao($dt['sub_descricao']);
            $subcategoria->setSub_status($dt['sub_status']);
            $subcategoria->setSub_data($dt['sub_data']);                
            $subcategoria->getCategoria()->setCategoria_cod($dt['categoria_cod']);  
            $subcategoria->getCategoria()->setCategoria_nome($dt['categoria_nome']);  
            
            return $subcategoria;
            
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    //retorna um registro de subcategoria através da URL
    public function retornaSubUrl($url){
        try {
            
            $sql = "SELECT s.sub_cod, s.sub_titulo, s.sub_url, s.sub_descricao, s.sub_status, s.sub_data, s.categoria_cod, c.categoria_cod, c.categoria_nome FROM tb_subcategorias s INNER JOIN tb_categorias c ON s.categoria_cod = c.categoria_cod WHERE s.sub_url = :url";
            $param = array(":url" => $url);
            
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            
            $subcategoria = new Subcategoria();
            $subcategoria->setSub_cod($dt['sub_cod']);
            $subcategoria->setSub_titulo($dt['sub_titulo']);
            $subcategoria->setSub_url($dt['sub_url']);
            $subcategoria->setSub_descricao($dt['sub_descricao']);
            $subcategoria->setSub_status($dt['sub_status']);
            $subcategoria->setSub_data($dt['sub_data']);                
            $subcategoria->getCategoria()->setCategoria_cod($dt['categoria_cod']);  
            $subcategoria->getCategoria()->setCategoria_nome($dt['categoria_nome']);  
            
            return $subcategoria;
            
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    //retorna uma lista de subcategoria quando existe $cod
    public function listarSub($cod){
        try {
            //$sql = "SELECT s.sub_cod, s.sub_titulo, s.sub_url, s.sub_descricao, s.sub_status, s.sub_data, s.categoria_cod, c.categoria_cod, c.categoria_nome FROM tb_subcategorias s INNER JOIN tb_categorias c ON s.categoria_cod = c.categoria_cod WHERE s.categoria_cod = :cod";
            $sql = "SELECT * FROM tb_subcategorias WHERE categoria_cod = :cod";
            $param = array(":cod" => $cod);
            
            $dt = $this->pdo->ExecuteQuery($sql, $param);        
            
            
            $listaSubcategoria = [];
            
            foreach ($dt as $sb):
                $subcategoria = new Subcategoria();
                $subcategoria->setSub_cod($sb['sub_cod']);
                $subcategoria->setSub_titulo($sb['sub_titulo']);
                $subcategoria->setSub_url($sb['sub_url']);
                $subcategoria->setSub_descricao($sb['sub_descricao']);
                $subcategoria->setSub_status($sb['sub_status']);
                $subcategoria->setSub_data($sb['sub_data']);               
                $subcategoria->setCategoria($sb['categoria_cod']);             
                
                $listaSubcategoria[] = $subcategoria;
            endforeach;
            
            return $listaSubcategoria;
            
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
            $sql = "SELECT count(ts.sub_cod) as total FROM tb_subcategorias ts";
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
