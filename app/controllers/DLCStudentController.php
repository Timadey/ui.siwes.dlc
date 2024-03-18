<?php
namespace app\controllers;

header('Access-Control-Allow-Origin: *');


Use app\router\Router;
use app\models\DLCStudent;


class DLCStudentController
{
    /**
     * registerForm - View to render page to register student 
     * @Router: an instance of Router class
     */
    public static function registerForm(Router $router)
    {
        return $router->renderView('dlc/register');
    }

    /**
     * preview - View to render page to preview ITCC student 
     * @Router: an instance of Router class
     */
    public static function preview(Router $router)
    {
        if ($_GET['reg'] ?? false){
            $record_id = $_GET['reg'];
            $student = (new DLCStudent($router->dbs))->getStudent('record_id', $record_id);
            if ($student){
                return $router->renderView('dlc/preview', ['student' => $student], '');
            }
        }else if($_GET['matric'] ?? false){
            $matric_no = $_GET['matric'];
            $student = (new DLCStudent($router->dbs))->getStudent('matric_no', $matric_no);
            if ($student){
                return $router->renderView('dlc/preview', ['student' => $student], '');
            }  
        }
        header("Location: /siwes/dlc/register");
    }

    /**
     * registerForIT - View to register for IT
     * @Router: an instance of Router class
     */
    public static function registerForIT(Router $router)
    {
        if($_POST){
            header("Content-Type: application/json");
            $dlcStudent = new DLCStudent($router->dbs, $_POST);
            unset($_POST);
            
            $errorBag = $dlcStudent->save();
            
            if ($errorBag->errors)
            {
                http_response_code(400);

                echo json_encode($errorBag->errors);
                exit;
            }
            else if ($errorBag->last_inserted)
            {
                http_response_code(200);
                echo json_encode($errorBag->inserted_obj);
                exit;
            }
            else
            {
                http_response_code(500);
                echo json_encode($errorBag);
                exit;
            }

        }
        header("Location: /siwes/dlc");

        

    }
}

?>