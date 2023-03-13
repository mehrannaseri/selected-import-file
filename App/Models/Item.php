<?php

namespace App\Models;

use App\Core\Model;

class Item extends Model
{
    public $table = 'items';

    public function insert (array $data)
    {
        $query = "INSERT INTO $this->table (catalog_id,SKU,price,retail_price,thumbnail_url,color,color_family,size,size_family,occassion,season,rating_avg,rating_count,active)
                VALUES (:catalog_id,:SKU,:price,:retail_price,:thumbnail_url,:color,:color_family,:size,:size_family,:occassion,:season,:rating_avg,:rating_count,:active)";
        $sql = $this->connection->prepare($query);
        $sql->bindValue(":catalog_id" , $data['catalog_id']);
        $sql->bindValue(":SKU" , $data['SKU']);
        $sql->bindValue(":price" , $data['price']);
        $sql->bindValue(":retail_price" , $data['retail_price']);
        $sql->bindValue(":thumbnail_url" , $data['thumbnail_url']);
        $sql->bindValue(":color" , $data['color']);
        $sql->bindValue(":color_family" , $data['color_family']);
        $sql->bindValue(":size" , $data['size']);
        $sql->bindValue(":size_family" , $data['size_family']);
        $sql->bindValue(":occassion" , $data['occassion']);
        $sql->bindValue(":season" , $data['season']);
        $sql->bindValue(":rating_avg" , $data['rating_avg']);
        $sql->bindValue(":rating_count" , $data['rating_count']);
        $sql->bindValue(":active" , $data['active']);
        $sql->execute();
        return $this->connection->lastInsertId();
    }
}