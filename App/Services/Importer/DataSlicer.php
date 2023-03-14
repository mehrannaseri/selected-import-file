<?php

namespace App\Services\Importer;

class DataSlicer
{

    final public function getSliceData(array $data){

        foreach ($data as $item){
            yield $item;

        }
    }
}