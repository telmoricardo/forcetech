<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ProdutoDAO {

    private $debug;
    private $pdo;

    public function __construct() {
        $this->pdo = new Banco();
        $this->debug = true;
    }

    //cadastro de produtos
    public function Cadastrar(Produto $produto) {
        try {

            $sql = "INSERT INTO tb_produtos (produto_nome, produto_url, produto_breve, produto_codigo, produto_descricao, produto_categoria, produto_subcategoria, produto_preco, produto_tipo, produto_thumb, produto_peso, produto_estoque, produto_altura, produto_largura, produto_profundidade, produto_status)"
                    . "VALUES(:nome, :url, :breve, :codigo, :descricao, :categoria, :subcategoria, :preco, :tipo, :thumb, :peso, :estoque, :altura, :largura, :profundidade, :status)";

            $param = array(
                ":nome" => $produto->getProduto_nome(),
                ":url" => $produto->getProduto_url(),
                ":breve" => $produto->getProduto_breve(),
                ":codigo" => $produto->getProduto_codigo(),
                ":descricao" => $produto->getProduto_descricao(),
                ":categoria" => $produto->getProduto_categoria(),
                ":subcategoria" => $produto->getProduto_subcategoria(),
                ":preco" => $produto->getProduto_preco(),
                ":tipo" => $produto->getProduto_tipo(),
                ":thumb" => $produto->getProduto_thumb(),
                ":peso" => $produto->getProduto_peso(),
                ":estoque" => $produto->getProduto_estoque(),
                ":altura" => $produto->getProduto_altura(),
                ":largura" => $produto->getProduto_largura(),
                ":profundidade" => $produto->getProduto_profundidade(),
                ":status" => $produto->getProduto_status()
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

    //ATUALIZAÇÃO DE PRODUTOS
    public function Atualizar(Produto $produto) {
        try {

            $sql = "UPDATE tb_produtos SET produto_nome = :nome, produto_url = :url, produto_breve = :breve, produto_codigo = :codigo, produto_descricao = :descricao, 
                produto_categoria = :categoria, produto_subcategoria = :subcategoria, produto_preco = :preco, produto_tipo = :tipo, produto_peso = :peso, produto_estoque = :estoque, produto_altura = :altura, produto_largura = :largura, produto_profundidade = :profundidade, produto_status = :status 
                WHERE produto_cod = :cod";

            $param = array(
                ":cod" => $produto->getProduto_cod(),
                ":nome" => $produto->getProduto_nome(),
                ":url" => $produto->getProduto_url(),
                ":breve" => $produto->getProduto_breve(),
                ":codigo" => $produto->getProduto_codigo(),
                ":descricao" => $produto->getProduto_descricao(),
                ":categoria" => $produto->getProduto_categoria(),
                ":subcategoria" => $produto->getProduto_subcategoria(),
                ":preco" => $produto->getProduto_preco(),
                ":tipo" => $produto->getProduto_tipo(),
                ":peso" => $produto->getProduto_peso(),
                ":estoque" => $produto->getProduto_estoque(),
                ":altura" => $produto->getProduto_altura(),
                ":largura" => $produto->getProduto_largura(),
                ":profundidade" => $produto->getProduto_profundidade(),
                ":status" => $produto->getProduto_status()
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

    //LISTAR PRODUTOS COM LIMITE    
    public function ListarProduto($inicio = null, $quantidade = null) {
        try {
            $sql = "SELECT * FROM tb_produtos ORDER BY produto_cod DESC LIMIT :inicio, :quantidade";
            $param = array(
                ":inicio" => $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaProd = [];
            foreach ($dt as $pts) {
                $produto = new Produto();
                $produto->setProduto_cod($pts['produto_cod']);
                $produto->setProduto_nome($pts['produto_nome']);
                $produto->setProduto_breve($pts['produto_breve']);
                $produto->setProduto_thumb($pts['produto_thumb']);
                $produto->setProduto_codigo($pts['produto_codigo']);
                $produto->setProduto_tipo($pts['produto_tipo']);
                $produto->setProduto_descricao($pts['produto_descricao']);
                $produto->setProduto_preco($pts['produto_preco']);
                $produto->setProduto_estoque($pts['produto_estoque']);
                $produto->setProduto_altura($pts['produto_altura']);
                $produto->setProduto_largura($pts['produto_largura']);
                $produto->setProduto_profundidade($pts['produto_profundidade']);
                $produto->setProduto_peso($pts['produto_peso']);
                $produto->setProduto_status($pts['produto_status']);
                $produto->setProduto_url($pts['produto_url']);

                $listaProd[] = $produto;
            }
            return $listaProd;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //RETORNA A QUANTIDADE DE PRODUTOS PAGINAÇÃO 
    public function RetornaQtdProduto() {
        try {
            $sql = "SELECT count(pr.produto_cod) as total FROM tb_produtos pr";
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

    //EXCLUIR
    public function Excluir($cod) {
        try {
            $sql = "DELETE FROM tb_produtos WHERE produto_cod = :cod";
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

    //retorno Produto pelo Id
    public function retornaIdProduto($cod) {
        try {
            $sql = "SELECT c.categoria_cod, c.categoria_nome, 
                    s.sub_cod, s.sub_titulo, 
                    t.cod_tipo, t.nome_tipo, 
                    p.produto_cod, p.produto_url, p.produto_nome, p.produto_breve, p.produto_thumb, p.produto_codigo, 
                    p.produto_tipo, p.produto_descricao, p.produto_preco, p.produto_estoque, p.produto_altura, 
                    p.produto_largura, p.produto_profundidade, p.produto_peso, p.produto_status, 
                    p.produto_inicial, p.produto_final FROM tb_produtos p                    
                    INNER JOIN tb_subcategorias s ON s.sub_cod = p.produto_subcategoria 
                    INNER JOIN tb_tipo t ON t.cod_tipo = p.produto_tipo
                    INNER JOIN tb_categorias c ON p.produto_categoria = c.categoria_cod WHERE p.produto_cod = :cod";
            $param = array(":cod" => $cod);
            //Data Table

            $pts = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $produto = new Produto();
            $produto->setProduto_cod($pts['produto_cod']);
            $produto->setProduto_nome($pts['produto_nome']);
            $produto->setProduto_breve($pts['produto_breve']);
            $produto->setProduto_thumb($pts['produto_thumb']);
            $produto->setProduto_codigo($pts['produto_codigo']);
            $produto->setProduto_descricao($pts['produto_descricao']);
            $produto->setProduto_preco($pts['produto_preco']);
            $produto->setProduto_estoque($pts['produto_estoque']);
            $produto->setProduto_altura($pts['produto_altura']);
            $produto->setProduto_largura($pts['produto_largura']);
            $produto->setProduto_profundidade($pts['produto_profundidade']);
            $produto->setProduto_peso($pts['produto_peso']);
            $produto->setProduto_status($pts['produto_status']);
            $produto->setProduto_url($pts['produto_url']);
            $produto->setProduto_datainicial($pts['produto_inicial']);
            $produto->setProduto_datafinal($pts['produto_final']);

            $produto->getProduto_categoria()->setCategoria_cod($pts['categoria_cod']);
            $produto->getProduto_categoria()->setCategoria_nome($pts['categoria_nome']);

            $produto->getProduto_subcategoria()->setSub_cod($pts['sub_cod']);
            $produto->getProduto_subcategoria()->setSub_titulo($pts['sub_titulo']);

            $produto->getProduto_tipo()->setTipo_cod($pts['cod_tipo']);
            $produto->getProduto_tipo()->setTipo_nome($pts['nome_tipo']);


            return $produto;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //retorna uma lista de tipo quando existe $cod
    public function groupByTipo() {
        try {
            //$sql = "SELECT * FROM tb_produtos WHERE produto_cod = :cod";
            $sql = "SELECT produto_cod, produto_destaque FROM tb_produtos GROUP by produto_destaque";

            $dt = $this->pdo->ExecuteQuery($sql);
            $listaProduto = [];
            foreach ($dt as $pts):
                $produto = new Produto();
                $produto->setProduto_cod($pts['produto_cod']);
                $produto->setProduto_destaque($pts['produto_destaque']);
                $listaProduto[] = $produto;
            endforeach;
            return $listaProduto;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    public function AlterarImagem($cod, $thumb) {
        try {
            $sql = "UPDATE tb_produtos SET produto_thumb = :thumb WHERE produto_cod = :cod";
            $param = array(
                ":cod" => $cod,
                ":thumb" => $thumb
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

    public function AlterarViews($url) {
        try {
            $sql = "UPDATE tb_produtos SET produto_view = produto_view + 1 WHERE produto_url = :url";
            $param = array(
                ":url" => $url
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

    public function AlterarDataPromocao($cod, $dataInicial, $dataFinal) {
        try {
            $sql = "UPDATE tb_produtos SET produto_inicial = :inicial, produto_final = :final WHERE produto_cod = :cod";
            $param = array(
                ":cod" => $cod,
                ":inicial" => $dataInicial,
                ":final" => $dataFinal,
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

    public function retornaProdutoImagem($cod) {
        try {
            $sql = "SELECT produto_cod, produto_nome, produto_thumb FROM tb_produtos WHERE produto_cod = :cod";
            $param = array(":cod" => $cod);
            //Data Table
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $produto = new Produto();
            $produto->setProduto_cod($dt['produto_cod']);
            $produto->setProduto_nome($dt['produto_nome']);
            $produto->setProduto_thumb($dt['produto_thumb']);
            return $produto;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    public function retornaStatusProd($cod) {
        try {
            $sql = "SELECT produto_cod, produto_status FROM tb_produtos WHERE produto_cod = :cod";
            $param = array(":cod" => $cod);
            //Data Table
            $dt = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $produto = new Produto();
            $produto->setProduto_cod($dt['produto_cod']);
            $produto->setProduto_status($dt['produto_status']);
            return $produto;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    public function AlterarStatus($cod, $status) {
        try {
            $sql = "UPDATE tb_produtos SET produto_status = :status WHERE produto_cod = :cod";
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

    /*     * ************************** SITE ******************************************* */

    public function ListProductCategory($categoria) {
        try {
            $sql = "SELECT c.categoria_cod, c.categoria_nome, c.categoria_url, s.sub_cod, s.sub_titulo, p.produto_cod, p.produto_url, p.produto_nome, p.produto_breve, p.produto_thumb,
                   p.produto_codigo, p.produto_tipo, p.produto_descricao, p.produto_preco, p.produto_estoque, p.produto_altura, 
                   p.produto_largura, p.produto_profundidade, p.produto_peso, p.produto_status FROM tb_produtos p                  
                   INNER JOIN tb_categorias c ON p.produto_categoria = c.categoria_cod
                   INNER JOIN tb_subcategorias s ON p.produto_subcategoria = s.sub_cod 
                   WHERE p.produto_categoria = :categoria
                  ";
            $param = array(
                ":categoria" => $categoria
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaProd = [];
            foreach ($dt as $pts) {
                $produto = new Produto();
                $produto->setProduto_cod($pts['produto_cod']);
                $produto->setProduto_nome($pts['produto_nome']);
                $produto->setProduto_breve($pts['produto_breve']);
                $produto->setProduto_thumb($pts['produto_thumb']);
                $produto->setProduto_codigo($pts['produto_codigo']);
                $produto->setProduto_tipo($pts['produto_tipo']);
                $produto->setProduto_descricao($pts['produto_descricao']);
                $produto->setProduto_preco($pts['produto_preco']);
                $produto->setProduto_estoque($pts['produto_estoque']);
                $produto->setProduto_altura($pts['produto_altura']);
                $produto->setProduto_largura($pts['produto_largura']);
                $produto->setProduto_profundidade($pts['produto_profundidade']);
                $produto->setProduto_peso($pts['produto_peso']);
                $produto->setProduto_status($pts['produto_status']);
                $produto->setProduto_url($pts['produto_url']);

                $produto->getProduto_categoria()->setCategoria_cod($pts['categoria_cod']);
                $produto->getProduto_categoria()->setCategoria_nome($pts['categoria_nome']);
                $produto->getProduto_categoria()->setCategoria_url($pts['categoria_url']);

                $produto->getProduto_subcategoria()->setSub_cod($pts['sub_cod']);
                $produto->getProduto_subcategoria()->setSub_titulo($pts['sub_titulo']);

                $listaProd[] = $produto;
            }
            return $listaProd;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    public function ListProductType($tipo) {
        try {
            $sql = "SELECT c.categoria_cod, c.categoria_nome, c.categoria_url, s.sub_cod, s.sub_titulo, p.produto_cod, p.produto_url, p.produto_nome, p.produto_breve, p.produto_thumb,
                   p.produto_codigo, p.produto_tipo, p.produto_descricao, p.produto_preco, p.produto_estoque, p.produto_altura, 
                   p.produto_largura, p.produto_profundidade, p.produto_peso, p.produto_status FROM tb_produtos p                  
                   INNER JOIN tb_categorias c ON p.produto_categoria = c.categoria_cod
                   INNER JOIN tb_subcategorias s ON p.produto_subcategoria = s.sub_cod 
                   WHERE p.produto_tipo = :tipo
                  ";
            $param = array(
                ":tipo" => $tipo
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaProd = [];
            foreach ($dt as $pts) {
                $produto = new Produto();
                $produto->setProduto_cod($pts['produto_cod']);
                $produto->setProduto_nome($pts['produto_nome']);
                $produto->setProduto_breve($pts['produto_breve']);
                $produto->setProduto_thumb($pts['produto_thumb']);
                $produto->setProduto_codigo($pts['produto_codigo']);
                $produto->setProduto_tipo($pts['produto_tipo']);
                $produto->setProduto_descricao($pts['produto_descricao']);
                $produto->setProduto_preco($pts['produto_preco']);
                $produto->setProduto_estoque($pts['produto_estoque']);
                $produto->setProduto_altura($pts['produto_altura']);
                $produto->setProduto_largura($pts['produto_largura']);
                $produto->setProduto_profundidade($pts['produto_profundidade']);
                $produto->setProduto_peso($pts['produto_peso']);
                $produto->setProduto_status($pts['produto_status']);
                $produto->setProduto_url($pts['produto_url']);

                $produto->getProduto_categoria()->setCategoria_cod($pts['categoria_cod']);
                $produto->getProduto_categoria()->setCategoria_nome($pts['categoria_nome']);
                $produto->getProduto_categoria()->setCategoria_url($pts['categoria_url']);

                $produto->getProduto_subcategoria()->setSub_cod($pts['sub_cod']);
                $produto->getProduto_subcategoria()->setSub_titulo($pts['sub_titulo']);

                $listaProd[] = $produto;
            }
            return $listaProd;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //LISTAR PRODUTOS EM PROMOÇÃO
    public function ListProductPromocao() {
        try {
            $sql = "SELECT c.categoria_cod, c.categoria_nome, c.categoria_url, s.sub_cod, s.sub_titulo, 
                   p.produto_cod, p.produto_url, p.produto_nome, p.produto_breve, p.produto_thumb,
                   p.produto_codigo, p.produto_tipo, p.produto_descricao, p.produto_preco, p.produto_estoque, 
                   p.produto_altura, p.produto_largura, p.produto_profundidade, p.produto_peso, p.produto_status FROM tb_produtos p                  
                   INNER JOIN tb_categorias c ON p.produto_categoria = c.categoria_cod
                   INNER JOIN tb_subcategorias s ON p.produto_subcategoria = s.sub_cod
                   WHERE p.produto_destaque = 3
                    ";

            $dt = $this->pdo->ExecuteQuery($sql);
            $listaProd = [];
            foreach ($dt as $pts) {
                $produto = new Produto();
                $produto->setProduto_cod($pts['produto_cod']);
                $produto->setProduto_nome($pts['produto_nome']);
                $produto->setProduto_breve($pts['produto_breve']);
                $produto->setProduto_thumb($pts['produto_thumb']);
                $produto->setProduto_codigo($pts['produto_codigo']);
                $produto->setProduto_tipo($pts['produto_tipo']);
                $produto->setProduto_descricao($pts['produto_descricao']);
                $produto->setProduto_preco($pts['produto_preco']);
                $produto->setProduto_estoque($pts['produto_estoque']);
                $produto->setProduto_altura($pts['produto_altura']);
                $produto->setProduto_largura($pts['produto_largura']);
                $produto->setProduto_profundidade($pts['produto_profundidade']);
                $produto->setProduto_peso($pts['produto_peso']);
                $produto->setProduto_status($pts['produto_status']);
                $produto->setProduto_url($pts['produto_url']);

                $produto->getProduto_categoria()->setCategoria_cod($pts['categoria_cod']);
                $produto->getProduto_categoria()->setCategoria_nome($pts['categoria_nome']);
                $produto->getProduto_categoria()->setCategoria_url($pts['categoria_url']);

                $produto->getProduto_subcategoria()->setSub_cod($pts['sub_cod']);
                $produto->getProduto_subcategoria()->setSub_titulo($pts['sub_titulo']);

                $listaProd[] = $produto;
            }
            return $listaProd;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    public function retornaProdutoUrl($url) {
        try {

            //$sql = "SELECT * FROM tb_produtos WHERE produto_cod = :cod";
            $sql = "SELECT c.categoria_cod, c.categoria_nome, c.categoria_url, s.sub_cod, s.sub_titulo, 
                    p.produto_cod, p.produto_url, p.produto_nome, p.produto_breve, p.produto_thumb, 
                    p.produto_codigo, p.produto_tipo, p.produto_descricao, p.produto_preco, p.produto_estoque, 
                    p.produto_altura, p.produto_largura, p.produto_profundidade, 
                    p.produto_peso, p.produto_status FROM tb_produtos p                    
                    INNER JOIN tb_subcategorias s ON s.sub_cod = p.produto_subcategoria 
                    INNER JOIN tb_categorias c ON p.produto_categoria = c.categoria_cod WHERE p.produto_url = :url";
            $param = array(":url" => $url);
            //Data Table

            $pts = $this->pdo->ExecuteQueryOneRow($sql, $param);
            $produto = new Produto();
            $produto->setProduto_cod($pts['produto_cod']);
            $produto->setProduto_nome($pts['produto_nome']);
            $produto->setProduto_breve($pts['produto_breve']);
            $produto->setProduto_thumb($pts['produto_thumb']);
            $produto->setProduto_codigo($pts['produto_codigo']);
            $produto->setProduto_tipo($pts['produto_tipo']);
            $produto->setProduto_descricao($pts['produto_descricao']);
            $produto->setProduto_preco($pts['produto_preco']);
            $produto->setProduto_estoque($pts['produto_estoque']);
            $produto->setProduto_altura($pts['produto_altura']);
            $produto->setProduto_largura($pts['produto_largura']);
            $produto->setProduto_profundidade($pts['produto_profundidade']);
            $produto->setProduto_peso($pts['produto_peso']);
            $produto->setProduto_status($pts['produto_status']);
            $produto->setProduto_url($pts['produto_url']);

            $produto->getProduto_categoria()->setCategoria_cod($pts['categoria_cod']);
            $produto->getProduto_categoria()->setCategoria_nome($pts['categoria_nome']);
            $produto->getProduto_categoria()->setCategoria_url($pts['categoria_url']);

            $produto->getProduto_subcategoria()->setSub_cod($pts['sub_cod']);
            $produto->getProduto_subcategoria()->setSub_titulo($pts['sub_titulo']);


            return $produto;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //retorna uma lista de subcategoria quando existe $cod
    public function produtosRelacionados($categoria, $inicio = null, $quantidade = null) {
        try {
            $sql = "SELECT c.categoria_cod, c.categoria_nome, c.categoria_url, s.sub_cod, s.sub_titulo, 
                    p.produto_cod, p.produto_url, p.produto_nome, p.produto_breve, p.produto_thumb, 
                    p.produto_codigo, p.produto_tipo, p.produto_descricao, p.produto_preco, p.produto_estoque, p.produto_altura, p.produto_largura, 
                    p.produto_profundidade, p.produto_peso, p.produto_status FROM tb_produtos p                    
                    INNER JOIN tb_subcategorias s ON s.sub_cod = p.produto_subcategoria 
                    INNER JOIN tb_categorias c ON p.produto_categoria = c.categoria_cod 
                    WHERE p.produto_categoria = :categoria LIMIT :inicio, :quantidade";

            $param = array(
                ":inicio" => $inicio,
                ":quantidade" => $quantidade,
                ":categoria" => $categoria
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);


            $listaProduto = [];

            foreach ($dt as $pts):
                $produto = new Produto();
                $produto->setProduto_cod($pts['produto_cod']);
                $produto->setProduto_nome($pts['produto_nome']);
                $produto->setProduto_breve($pts['produto_breve']);
                $produto->setProduto_thumb($pts['produto_thumb']);
                $produto->setProduto_codigo($pts['produto_codigo']);
                $produto->setProduto_tipo($pts['produto_tipo']);
                $produto->setProduto_descricao($pts['produto_descricao']);
                $produto->setProduto_preco($pts['produto_preco']);
                $produto->setProduto_estoque($pts['produto_estoque']);
                $produto->setProduto_altura($pts['produto_altura']);
                $produto->setProduto_largura($pts['produto_largura']);
                $produto->setProduto_profundidade($pts['produto_profundidade']);
                $produto->setProduto_peso($pts['produto_peso']);
                $produto->setProduto_status($pts['produto_status']);
                $produto->setProduto_url($pts['produto_url']);                

                $produto->getProduto_categoria()->setCategoria_cod($pts['categoria_cod']);
                $produto->getProduto_categoria()->setCategoria_nome($pts['categoria_nome']);
                $produto->getProduto_categoria()->setCategoria_url($pts['categoria_url']);

                $produto->getProduto_subcategoria()->setSub_cod($pts['sub_cod']);
                $produto->getProduto_subcategoria()->setSub_titulo($pts['sub_titulo']);

                $listaProduto[] = $produto;
            endforeach;

            return $listaProduto;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //retorna uma lista de produtos quando existe $views
    public function maisVistos($inicio = null, $quantidade = null) {
        try {
            $sql = "SELECT c.categoria_cod, c.categoria_nome, s.sub_cod, s.sub_titulo, p.produto_cod, p.produto_url, p.produto_nome, p.produto_breve, p.produto_thumb, 
                    p.produto_codigo, p.produto_tipo, p.produto_descricao, p.produto_preco, p.produto_estoque, p.produto_altura, p.produto_largura, 
                    p.produto_profundidade, p.produto_peso, p.produto_status FROM tb_produtos p                    
                    INNER JOIN tb_subcategorias s ON s.sub_cod = p.produto_subcategoria 
                    INNER JOIN tb_categorias c ON p.produto_categoria = c.categoria_cod WHERE p.produto_view >= 5
                    LIMIT :inicio, :quantidade";

            $param = array(
                ":inicio" => $inicio,
                ":quantidade" => $quantidade
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);
            $listaProduto = [];
            foreach ($dt as $pts):
                $produto = new Produto();
                $produto->setProduto_cod($pts['produto_cod']);
                $produto->setProduto_nome($pts['produto_nome']);
                $produto->setProduto_breve($pts['produto_breve']);
                $produto->setProduto_thumb($pts['produto_thumb']);
                $produto->setProduto_codigo($pts['produto_codigo']);
                $produto->setProduto_tipo($pts['produto_tipo']);
                $produto->setProduto_descricao($pts['produto_descricao']);
                $produto->setProduto_preco($pts['produto_preco']);
                $produto->setProduto_estoque($pts['produto_estoque']);
                $produto->setProduto_altura($pts['produto_altura']);
                $produto->setProduto_largura($pts['produto_largura']);
                $produto->setProduto_profundidade($pts['produto_profundidade']);
                $produto->setProduto_peso($pts['produto_peso']);
                $produto->setProduto_status($pts['produto_status']);
                $produto->setProduto_url($pts['produto_url']);
                $produto->getProduto_categoria()->setCategoria_cod($pts['categoria_cod']);
                $produto->getProduto_categoria()->setCategoria_nome($pts['categoria_nome']);
                $listaProduto[] = $produto;
            endforeach;

            return $listaProduto;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }

    //retorna uma lista de pesquisa page index
    public function buscarProduto($termo) {
        try {
            $sql = "SELECT c.categoria_cod, c.categoria_nome, c.categoria_url, s.sub_cod, s.sub_titulo, 
                    p.produto_cod, p.produto_url, p.produto_nome, p.produto_breve, p.produto_thumb, 
                    p.produto_codigo, p.produto_tipo, p.produto_descricao, p.produto_preco, p.produto_estoque, p.produto_altura, p.produto_largura, 
                    p.produto_profundidade, p.produto_peso, p.produto_status FROM tb_produtos p                    
                    INNER JOIN tb_subcategorias s ON s.sub_cod = p.produto_subcategoria 
                    INNER JOIN tb_categorias c ON p.produto_categoria = c.categoria_cod 
                    WHERE p.produto_nome LIKE :termo ORDER BY p.produto_nome ASC";

            $param = array(
                ":termo" => "%{$termo}%"
            );
            $dt = $this->pdo->ExecuteQuery($sql, $param);


            $listaProduto = [];

            foreach ($dt as $pts):
                $produto = new Produto();
                $produto->setProduto_cod($pts['produto_cod']);
                $produto->setProduto_nome($pts['produto_nome']);
                $produto->setProduto_breve($pts['produto_breve']);
                $produto->setProduto_thumb($pts['produto_thumb']);
                $produto->setProduto_codigo($pts['produto_codigo']);
                $produto->setProduto_tipo($pts['produto_tipo']);
                $produto->setProduto_descricao($pts['produto_descricao']);
                $produto->setProduto_preco($pts['produto_preco']);
                $produto->setProduto_estoque($pts['produto_estoque']);
                $produto->setProduto_altura($pts['produto_altura']);
                $produto->setProduto_largura($pts['produto_largura']);
                $produto->setProduto_profundidade($pts['produto_profundidade']);
                $produto->setProduto_peso($pts['produto_peso']);
                $produto->setProduto_status($pts['produto_status']);
                $produto->setProduto_url($pts['produto_url']);                

                $produto->getProduto_categoria()->setCategoria_cod($pts['categoria_cod']);
                $produto->getProduto_categoria()->setCategoria_nome($pts['categoria_nome']);
                $produto->getProduto_categoria()->setCategoria_url($pts['categoria_url']);

                $produto->getProduto_subcategoria()->setSub_cod($pts['sub_cod']);
                $produto->getProduto_subcategoria()->setSub_titulo($pts['sub_titulo']);

                $listaProduto[] = $produto;
            endforeach;

            return $listaProduto;
        } catch (PDOException $e) {
            if ($this->debug):
                echo "Erro {$e->getMessage()}, LINE {$e->getLine()}";
            else:
                return null;
            endif;
        }
    }
    
    //RETORNA A QUANTIDADE DE PRODUTOS PAGINAÇÃO 
    public function qtdProdCat($categoria) {
        try {
            $sql = "SELECT count(pr.produto_cod) as total FROM tb_produtos pr WHERE pr.produto_categoria = :categoria";
            $param = array(":categoria" => $categoria);
            $dr = $this->pdo->ExecuteQueryOneRow($sql, $param);
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
