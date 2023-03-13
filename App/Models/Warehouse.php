<?php

namespace App\Models;

use App\Core\Model;

class Warehouse extends Model
{
    public $table = 'warehouses';

    public function insertIfNotExists(array $data)
    {

        $query = "SELECT * FROM $this->table where name = :name";
        $sql = $this->connection->prepare($query);
        $sql->bindValue(":name", $data['name']);
        $sql->execute();
        $warehouse = $sql->fetch();
        if( $warehouse){
            return $warehouse['id'];
        }

        $query = "INSERT INTO $this->table (name) VALUES (:name)";
        $sql = $this->connection->prepare($query);
        $sql->bindValue(":name" , $data['name']);
        $sql->execute();
        return $this->connection->lastInsertId();
    }
}