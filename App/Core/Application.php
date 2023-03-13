<?php

namespace App\Core;

class Application
{
    public Request $request;
    public Response $response;
    public Router $router;
    public static Application $app;
    public static string $ROOT_DIR;
    public static array $CONFIG;
    public Database $db;
    public $auth = null;
    public $controller = null;

    public function __construct($rootPath, array $config)
    {
        self::$CONFIG = $config;
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        }
        catch (\Exception $e){
            echo $this->response->send(401, ['message' => 'Unauthorized']);
        }

    }

    public static function url(){

        $hostName = $_SERVER['HTTP_HOST'];

        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';

        return $protocol.$hostName."/";
    }
}