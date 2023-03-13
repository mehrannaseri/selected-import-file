<?php
namespace App\Services;
use App\Services\Importer\ImporterInterface;
use App\Services\Importer\JsonImporter;
use App\Services\Importer\XmlImporter;
use Exception;

class FileImporter
{
    public function handle($file)
    {
        $importer = $this->getImporter($file);

        $data = $importer->readFile();

        $importer->saveData($data);
    }

    public function getImporter($file) :ImporterInterface | Exception
    {
        switch ($file['type']){
            case "application/json" :
                return new JsonImporter($file);
            break;
            case "application/xml" :
                return new XmlImporter($file);
            break;
            default :
                throw new \Exception("Invalid file format", 400);

        }
    }
}