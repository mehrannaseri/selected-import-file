<?php

namespace App\Services\Importer;

class XmlImporter extends DataSlicer implements ImporterInterface
{

    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function readFile(): array|\Exception
    {
        // TODO: Implement readFile() method.
    }

    public function saveData(array $data) :bool
    {
        // TODO: Implement saveData() method.
    }
}