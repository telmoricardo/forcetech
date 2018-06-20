<?php

class FabricanteDAO {
     private $debug;
     private $pdo;
     
     public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }
    
    
     public function Cadastrar(Fabricante $fabricante){
        try {
            $sql = "INSERT INTO fabricante (fab_titulo, fab_url, fab_data) VALUES(:titulo, :url, :data)";
            $param = array(
                ":titulo" => $fabricante->getTitulo(),
                ":url" => $fabricante->getUrl(),
                ":data" => $fabricante->getData()
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
    
    public function ListaFabricante() {
        try {
            $sql = "SELECT * FROM fabricante";
            $dt = $this->pdo->ExecuteQuery($sql);
            
            $listaFabricante = [];
            foreach ($dt as $row):
                $fabricante = new Fabricante();
                $fabricante->setCod($row['fab_cod']);
                $fabricante->setTitulo($row['fab_titulo']);
                $fabricante->setUrl($row['fab_url']);
                $fabricante->setData($row['fab_data']);
            
                $listaFabricante[] = $fabricante;
            endforeach;
            
            return $listaFabricante;
            
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    public function retornaFabricante($cod) {
        try {
            
           $sql = "SELECT * FROM fabricante WHERE fab_cod = :fab_cod";
            $param = array(":fab_cod" => $cod);
            //Data Table
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);

            $fabricante = new Fabricante();
            $fabricante->setCod($dt['fab_cod']);
            $fabricante->setTitulo($dt['fab_titulo']);
            $fabricante->setUrl($dt['fab_url']);
            $fabricante->setData($dt['fab_data']);            
            
            return $fabricante;
            
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
     
    
}
