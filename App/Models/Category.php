<?php

namespace App\Models;

use App\Core\Model;

class Category extends Model
{
    public $table = 'categories';


    public function insertIfNotExists(array $data)
    {

        $query = "SELECT * FROM $this->table where category_id = :category_id";
        $sql = $this->connection->prepare($query);
        $sql->bindValue(":category_id", $data['category_id']);
        $sql->execute();
        $category = $sql->fetch();
        if( $category){
            return $category['id'];
        }

        $query = "INSERT INTO $this->table (category_id, title) VALUES (:category_id, :title)";
        $sql = $this->connection->prepare($query);
        $sql->bindValue(":category_id" , $data['category_id']);
        $sql->bindValue(":title" , $data['title']);
        $sql->execute();
        return $this->connection->lastInsertId();
    }
}