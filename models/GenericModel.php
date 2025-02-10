<?php

namespace App\models;

use App\config\Database;
use PDO;

abstract class GenericModel
{
    private static $Db;

    public function __construct()
    {
        
    }

    abstract public function TableName(): string;

    public function Create($object)
    { 

        $columns = $this->getAttributes();
        $values = [];
    
            
        foreach ((array)$object as $key => $value) {
            if(gettype($value) == "string" && $key != "Cpassword"){
                array_push($values, "'{$value}'");
            } else if(gettype($value) == "object") {
                array_push($values, $value->getId());
            } else if(gettype($value) == "number") {
                array_push($values, $value);
            }
        }

        $Db = Database::getInstance()->getConnection();
        $query = "INSERT INTO {$this->TableName()} " . "(" . implode(', ', $columns) . ")" ." VALUES(". implode(', ', $values) .");";
        $statement = $Db->prepare($query);  
        $statement->execute();
        $object->setId($Db->lastInsertId());

        return $object;
    }

    public function Update($object)
    {

        $columns = $this->getAttributes();
        $values = [];
    
            
        foreach ((array)$object as $key => $value){
            if(gettype($value) == "string"){
                array_push($values, "'{$value}'");
            } else if(gettype($value) == "object") {
                array_push($values, $value->getId());
            } else {
                array_push($values, $value);
            }
        }

        $Db = Database::getInstance()->getConnection();
        $new_array = array_combine($columns, $values);

        $query_parts = [];

        foreach ($new_array as $key => $value) 
        {
            if($key != "id")
            {
                $query_parts[] = $key . " = " . $value;
            }
        }

        $fields= implode(", ", $query_parts);


        $query = "UPDATE {$this->TableName()} SET " . $fields . " WHERE id = {$new_array['id']}";
        $statement = $Db->prepare($query);  
        $statement->execute();
        
        return $object;
    }


    public function Delete($object_id){
        $Db = Database::getInstance()->getConnection();
        $query = "DELETE FROM {$this->TableName()} WHERE id = {$object_id}";
        $statement = $Db->prepare($query);  
        $statement->execute();
    }

    public function getAll(){
        $Db = Database::getInstance()->getConnection();
        $query = "SELECT " . implode(", ", $this->getAttributes()) . " FROM {$this->TableName()}";
        $statement = $Db->prepare($query); 
        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_CLASS, $this->getClass());

        return $results;
    }

    public function findOneBy($field, $value){
        $Db = Database::getInstance()->getConnection();
        $query = "SELECT " . implode(", ", $this->getAttributes()) . " FROM {$this->TableName()} WHERE {$field} = '{$value}' LIMIT 1";
        $statement = $Db->prepare($query); 
        $statement->execute();
        $result = $statement->fetchObject($this->getClass());

        return $result;
    }

    abstract public function getAttributes(): array;

    abstract public function getClass();
}