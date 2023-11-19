<?php
abstract class CRUD extends PDO {
    public function __construct(){
        // parent::__construct('mysql:host=localhost; dbname=blog; port=3306; charset=utf8', 'root', 'root');
        // parent::__construct('mysql:host=localhost; dbname=blog; port=3306; charset=utf8', 'root', '');
        parent::__construct('mysql:host=localhost; dbname=e2296789; port=3306; charset=utf8', 'e2296789', 'JLl2AH6eOoD6Ru7pOjhO');
    }

    public function select($field='id', $order='ASC'){
        $sql = "SELECT * FROM $this->table ORDER BY $field $order";
        $stmt = $this->query($sql);
        return $stmt->fetchAll();
    }

    public function selectId($value){
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = '$value'";
        $stmt = $this->query($sql);
        $count = $stmt->rowCount();
        if($count == 1){
            return $stmt->fetch();
        }else{
            // RequirePage::url('home/error/404');
            RequirePage::url('home');
        }  
    }

    public function insert($data){
        $data_keys = array_intersect_key($data, array_fill_keys($this->fillable, ''));
        // $data_keys = array_fill_keys($this->fillable, '');
        // $data = array_intersect_key($data, $data_keys);

        $nomChamp = implode(", ", array_keys($data_keys));
        $valeurChamp = ":" . implode(", :", array_keys($data_keys));
        // $nomChamp = implode(", ",array_keys($data));
        // $valeurChamp = ":".implode(", :", array_keys($data));
        
        $sql = "INSERT INTO $this->table ($nomChamp) VALUES ($valeurChamp)";
        $stmt = $this->prepare($sql);
        foreach ($data_keys as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        if($stmt->execute()){
            return $this->lastInsertId();
        }else{
            // return $stmt->errorInfo();
            RequirePage::url('home');
        }
    }

    public function update($data){ 
        $queryField = null;
        foreach($data as $key=>$value){
            $queryField .="$key =:$key, ";
        }
        $queryField = rtrim($queryField, ", ");
        $sql = "UPDATE $this->table SET $queryField WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        foreach($data as $key => $value){
            $stmt->bindValue(":$key", $value);
        }
        
        if($stmt->execute()){
            return true;
        }else{
            return $stmt->errorInfo();
            // RequirePage::url('home');
        }
    }

    public function delete($value){
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey = :$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $value);

        if($stmt->execute()){
            return true;
        }else{
            return $stmt->errorInfo();
            // RequirePage::url('home');
            // $errorInfo = $stmt->errorInfo();
            // print_r($errorInfo);
        }
    }

    public function hasMany($tableJoin, $tableJoinFk, $tablePk){
        $sql = "SELECT * FROM $this->table 
                INNER JOIN $tableJoin ON $tableJoinFk = $tablePk";
        $stmt = $this->query($sql);
        $articleCommentaire = $stmt->fetchAll();
        return $articleCommentaire;
    }
}
?>