<?php

namespace App\Services\Importer;

use Exception;

class JsonImporter implements ImporterInterface
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function readFile() :array|Exception
    {
        $file_content = file_get_contents($this->file['tmp_name']);
        $file_content = json_decode($file_content);

        if(count($file_content) == 0){
            throw new Exception("The selected file is empty", 400);
        }

        return $file_content;
    }


    public function saveData(array $data)
    {

    }
}