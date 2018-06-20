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

class TipoDAO {
    private $debug;
    private $pdo;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }
    
    public function ListarTodaTipo() {
        try {            
            $sql = "SELECT * FROM tb_tipo ORDER BY cod_tipo ASC";            
            $dt = $this->pdo->ExecuteQuery($sql);
            $listaTipo = [];
            foreach ($dt as $pts) {
                $tipo = new Tipo();
                $tipo->setTipo_cod($pts['cod_tipo']);
                $tipo->setTipo_nome($pts['nome_tipo']);                         
                $listaTipo[] = $tipo;
            }
            return $listaTipo;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    public function ListarTipo($inicio = null, $quantidade = null) {
        try {            
            $sql = "SELECT * FROM tb_tipo ORDER BY cod_tipo ASC LIMIT :inicio, :quantidade";
            $param = array(
                ":inicio" => $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaTipo = [];
            foreach ($dt as $pts) {
                $tipo = new Tipo();
                $tipo->setTipo_cod($pts['cod_tipo']);
                $tipo->setTipo_nome($pts['nome_tipo']);                         
                $listaTipo[] = $tipo;
            }
            return $listaTipo;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
        
    
    
        
}
