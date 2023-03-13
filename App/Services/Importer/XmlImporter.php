<?php

namespace App\Services\Importer;

class XmlImporter implements ImporterInterface
{

    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

}