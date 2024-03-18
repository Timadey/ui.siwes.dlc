<?php
header('Access-Control-Allow-Origin: *');
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);
// define ('SITE_ROOT', realpath(dirname(__FILE__)));
define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].'/siwes/dlc');
define('MAX_FILE_SIZE', 800000);

// session_start();
// echo '<pre>';
// var_dump ($_SERVER);
// echo "</pre>"; exit;

//  $_SESSION['user_id'] = 6;
//  $_SESSION['email'] = 'tim@budget.com';
//  $_SESSION['name'] = "Timothy";

require_once __DIR__.'/vendor/autoload.php';

use app\controllers\DLCStudentController;
use app\router\Router;
use app\operations\Database;



$dbs = new Database();
$router = new Router($dbs);

$router->get('/', [DLCStudentController::class, 'registerForm']);
$router->get('/siwes/dlc/register', [DLCStudentController::class, 'registerForm']);
$router->get('/siwes/dlc/preview', [DLCStudentController::class, 'preview']);
$router->post('/siwes/dlc/register-it', [DLCStudentController::class, 'registerForIT']);

$router->resolve();
?>
