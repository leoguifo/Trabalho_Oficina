<?php

namespace Framework\Database;

use PDO;
use Framework\Helper\Helper;

class Database {
    private $con;
    private $query; 
    private $coluna;
    private $lastedId;

    public function __construct(){

        include($_SERVER['DOCUMENT_ROOT'] . Helper::getUrlRoot() . "/config/Database.php");

        $host = $config['db_host'];
        $nome = $config['db_nome'];
        $usuario = $config['db_usuario'];
        $senha = $config['db_senha'];
        $driver = $config['db_driver'];

        try {
            $this->con = new PDO("$driver:host=$host; dbname=$nome", $usuario, $senha);
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function query($query){
        $this->query = $query;

        return $this;
    }

    public function lastedId(){
        return $this->lastedId;
    }

    public function select($colunas){
        $this->query = "SELECT ";

        $count = count($colunas);

        for($i = 0; $i < $count; $i++){
            if($i == ($count - 1)){
                $this->query .= $colunas[$i] . " ";
            } else {
                $this->query .= $colunas[$i] . ", ";
            }
        }

        $this->query .= "FROM $this->tabela ";

        return $this;
    }

    public function insert($parans){
        $this->query = "INSERT INTO $this->tabela (";
        $count = count($parans);
        $aux = 1;
        foreach($parans as $k => $p){
            if($count == $aux){
                $this->query .= "$k) ";
            } else {
                $this->query .= "$k,";
            }
            $aux++;
        }
        $this->query .= "VALUES (";
        $aux = 1;
        foreach($parans as $k => $p){
            if($count == $aux){
                $this->query .= "'$p') ";
            } else {
                $this->query .= "'$p',";
            }
            $aux++;
        }

        try{
            $result = $this->con->prepare($this->query);
            $result->execute();
            $this->lastedId = $this->con->lastInsertId();
            return true;
        } catch(PDOExeption $e){a;
            echo $e->getMessage();
            return false;
        }
    }

    public function update($parans){
        $this->query = "UPDATE $this->tabela SET ";
        $count = count($parans);
        $aux = 1;
        foreach($parans as $k => $p){
            if($aux == $count){
                $this->query .= "$k = '$p' ";
            } else {
                $this->query .= "$k = '$p',";
            }
            $aux++;
        }

        return $this;
    }

    public function join($tabela, $coluna1, $condicao, $coluna2){
        $this->query .= "JOIN $tabela ON($coluna1 $condicao $coluna2) ";

        return $this;
    }

    public function innerJoin($tabela, $coluna1, $condicao, $coluna2){
        $this->query .= "INNER JOIN $tabela ON($coluna1 $condicao $coluna2) ";

        return $this;
    }

    public function leftJoin($tabela, $coluna1, $condicao, $coluna2){
        $this->query .= "LEFT JOIN $tabela ON($coluna1 $condicao $coluna2) ";

        return $this;
    }

    public function rightJoin($tabela, $coluna1, $condicao, $coluna2){
        $this->query .= "RIGHT JOIN $tabela ON($coluna1 $condicao $coluna2) ";

        return $this;
    }

    public function delete(){
        $this->query = "DELETE FROM $this->tabela ";

        return $this;
    }

    public function where($coluna, $comparacao, $valor){
        $this->query .= "WHERE ";
        $this->query .= "$coluna $comparacao '$valor' ";

        return $this;
    }

    public function andWhere($coluna, $comparacao, $valor){
        $this->query .= "AND ";
        $this->query .= "$coluna $comparacao '$valor' ";

        return $this;
    }

    public function orWhere($coluna, $comparacao, $valor){
        $this->query .= "OR ";
        $this->query .= "$coluna $comparacao '$valor' ";

        return $this;
    }

    public function limit($val1, $val2 = null){
        if($val2){
            $this->query .= "LIMIT $val1, $val2 ";
        } else {
            $this->query .= "LIMIT $val1 ";
        }

        return $this;
    }

    public function orderBy($coluna){
        $this->query .= "ORDER BY $coluna ";

        return $this;
    }

    public function groupBy($coluna){
        $this->query .= "GROUP BY $coluna ";

        return $this;
    }

    public function all(){
        try{
            $result = $this->con->prepare("SELECT * FROM $this->tabela");
            $result->execute();
            $this->coluna = $result->fetchAll(PDO::FETCH_OBJ);
            return $this->coluna;
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function find($id){
        $this->query = "SELECT * FROM $this->tabela WHERE id = $id";
        return $this->first();
    }

    public function first(){
        try{
            $result = $this->con->prepare($this->query);
            $result->execute();
            $this->coluna = $result->fetch(PDO::FETCH_OBJ);
            return $this->coluna;
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function get(){
        try{
            $result = $this->con->prepare($this->query);
            $result->execute();
            $this->coluna = $result->fetchAll(PDO::FETCH_OBJ);
            return $this->coluna;
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function excluir($id){
        $this->query = "DELETE FROM $this->tabela WHERE id = $id";
        return $this->get();
    }

    public function count(){
        return count($this->coluna);
    }
}