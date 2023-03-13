<?php

namespace App\Models;

use App\Core\Model;

class ItemWarehouse extends Model
{
    public $table = 'item_warehouse';

    public function insert (array $data)
    {
        $query = "INSERT INTO $this->table (item_id,warehouse_id,inventory_count)
                    VALUES (:item_id,:warehouse_id,:inventory_count)";
        $sql = $this->connection->prepare($query);
        $sql->bindValue(":item_id" , $data['item_id']);
        $sql->bindValue(":warehouse_id" , $data['warehouse_id']);
        $sql->bindValue(":inventory_count" , $data['inventory_count']);
        $sql->execute();
        return $this->connection->lastInsertId();
    }
}