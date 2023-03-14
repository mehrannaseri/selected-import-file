<?php

namespace App\Models;

use App\Core\Model;

class Catalog extends Model
{
    public $table = 'catalogs';

    public function insert (array $data)
    {
        $query = "INSERT INTO $this->table (product_id,NR,name,url,keywords,description,category_id,sub_category_id,brand)
                    VALUES (:product_id,:NR,:name,:url,:keywords,:description,:category_id,:sub_category_id,:brand)";
        $sql = $this->connection->prepare($query);
        $sql->bindValue(":product_id" , $data['product_id']);
        $sql->bindValue(":NR" , $data['NR']);
        $sql->bindValue(":name" , $data['name']);
        $sql->bindValue(":url" , $data['url']);
        $sql->bindValue(":keywords" , $data['keywords']);
        $sql->bindValue(":description" , $data['description']);
        $sql->bindValue(":category_id" , $data['category_id']);
        $sql->bindValue(":sub_category_id" , $data['sub_category_id']);
        $sql->bindValue(":brand" , $data['brand']);
        $sql->execute();
        return $this->connection->lastInsertId();
    }
}