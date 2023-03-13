<?php

namespace App\Controller;

use App\Core\Application;
use App\Core\Request;
use App\Services\FileImporter;

class ImportController extends BaseController
{

    private FileImporter $service;

    public function __construct()
    {
        $this->service = new FileImporter();
    }

    public function store(Request $request)
    {
        $result = $this->service->handle($request->body->file);

        return $this->response(201, "Data imported successfully");
    }
}