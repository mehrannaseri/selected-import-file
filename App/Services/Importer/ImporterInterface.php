<?php

namespace App\Services\Importer;

interface ImporterInterface
{
    public function readFile():array|\Exception;

    public function saveData(array $data);
}