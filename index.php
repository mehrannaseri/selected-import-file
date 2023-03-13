<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Core\Application;

require_once __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ],
    'jwt' => [
        'secret' => $_ENV['JWT_SECRET'],
        'issuer' => $_ENV['JWT_ISSUER'],
        'expire' => $_ENV['JWT_EXPIRE']
    ]
];

$app = new Application(dirname(__DIR__), $config);

dd($app);
$app->router->post('/register', [AuthController::class, 'register']);

$app->run();


function dd($data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit();
}