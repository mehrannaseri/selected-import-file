<?php

namespace App\Controller;

use App\Core\Application;
use App\Core\Request;
use App\Services\FileImporter;

class ImportController extends BaseController
{

    /**
     * @var FileImporter
     */
    private FileImporter $service;

    public function __construct()
    {
        $this->service = new FileImporter();
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function store(Request $request)
    {
        $this->service->handle($request->body->file);

        return $this->response(201, "Data imported successfully");
    }
}