<?php
header('Access-Control-Allow-Origin: *');
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
// define ('SITE_ROOT', realpath(dirname(__FILE__)));
define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].'/siwes/dlc');
define('MAX_FILE_SIZE', 800000);

session_start();
// echo '<pre>';
// var_dump ($_SERVER);
// echo "</pre>"; exit;

//  $_SESSION['user_id'] = 6;
//  $_SESSION['email'] = 'tim@budget.com';
//  $_SESSION['name'] = "Timothy";

require_once __DIR__.'/vendor/autoload.php';

use app\controllers\CompanyController;
use app\controllers\DLCStudentController;
use app\controllers\AuthController;

use app\router\Router;
use app\operations\Database;
use app\operations\Account;



$dbs = new Database();
$router = new Router($dbs);
$user = new Account ($dbs);


$router->get('/', [DLCStudentController::class, 'registerForm']);
$router->get('/siwes/dlc/register', [DLCStudentController::class, 'registerForm']);
$router->get('/siwes/dlc/preview', [DLCStudentController::class, 'preview']);
$router->post('/siwes/dlc/register-it', [DLCStudentController::class, 'registerForIT']);

$router->get('/siwes/dlc/companies', [CompanyController::class, 'index']);
$router->get('/siwes/dlc/companies/all', [CompanyController::class, 'all']);
$router->get('/siwes/dlc/backdoor/companies/all', [CompanyController::class, 'all']);




$router->get('/siwes/dlc/backdoor', [AuthController::class, 'login']);
$router->get('/siwes/dlc/backdoor/register', [AuthController::class, 'register']);
$router->post('/siwes/dlc/backdoor', [AuthController::class, 'auth']);
$router->post('/siwes/dlc/backdoor/register', [AuthController::class, 'auth']);
$router->get('/siwes/dlc/backdoor/logout', [AuthController::class, 'logout']);

$authMiddlewareRequired = [
    $router->get('/siwes/dlc/backdoor/companies', [CompanyController::class, 'index']),
];

if (in_array($_SERVER['REQUEST_URI'], $authMiddlewareRequired))
{
        require_once __DIR__.'/session.php';
        $router->resolve();
        exit;
}

$router->resolve();
?>
