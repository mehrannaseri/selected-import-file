<?php

namespace App\Controller;

use App\Core\Response;

class BaseController
{
    public function response($code, $message, $data = [])
    {
        $response = new Response();
        $data['message'] = $message;
        return $response->send($code, $data);
    }
}