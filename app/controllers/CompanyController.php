<?php
namespace app\controllers;

header('Access-Control-Allow-Origin: *');


Use app\router\Router;
use app\models\Company;


class CompanyController
{
    /**
     * index - View to render page to view all companies 
     * @Router: an instance of Router class
     */
    public static function index(Router $router)
    {
        return $router->renderView('company/index', [
            'page_title' => 'ITCC SIWES COMPANY DIRECTORY',
        ], 'layouts/company_layout');
    }

    /**
     * get - API to get all companies all companies 
     * @Router: an instance of Router class
     */
    public static function all(Router $router)
    {
        header("Content-Type: application/json");
        $companies = (new Company($router->dbs))->all();
        echo json_encode($companies);
    }


    /**
     * store - View to add a new company
     * @Router: an instance of Router class
     */
    public static function store(Router $router)
    {
        if($_POST){
            header("Content-Type: application/json");
            $company = new Company($router->dbs, $_POST);
            unset($_POST);
            
            $errorBag = $company->save();
            
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