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
        // Get state and area, 
        return $router->renderView('company/index', [
            'page_title' => 'ITCC SIWES COMPANY DIRECTORY',
        ], 'layouts/company_layout');
    }

    /**
     * courses - Returns all courses
     * @Router: an instance of Router class
     */
    public static function courses(Router $router)
    {
        // Get state and area, 
        $query = "SELECT DISTINCT `course_of_study` FROM `company_directory`;";
        try {
            $q = ($router->dbs->conn)->prepare($query);
            $q->execute();
            $data = $q->fetchall(\PDO::FETCH_ASSOC);
            $courses = [];
            if (is_array($data) && !empty($data)){
                foreach ($data as $key => $value) {
                    $value = explode(",", $value["course_of_study"]);
                    $courses = array_merge($courses, $value);
                }
                echo json_encode(array_unique($courses)); exit;
            }; return NULL;
            
        } catch (\PDOException $err) {
            // echo $err->getMessage();
            throw new \Exception("Error Processing Request", 1);  
        }
        
    }

    /**
     * states - Returns all states and their respective cities or area
     * @Router: an instance of Router class
     */
    public static function states(Router $router)
    {
        // Get state and area, 
        $query = "SELECT state_name, GROUP_CONCAT(city_name SEPARATOR ', ') AS cities 
                    FROM state 
                    LEFT JOIN city_or_area ON state.id = city_or_area.state_id 
                    GROUP BY state.state_name;";
        try {
            $q = ($router->dbs->conn)->prepare($query);
            $q->execute();
            $data = $q->fetchall(\PDO::FETCH_ASSOC);
            $states = [];
            if (is_array($data) && !empty($data)){
                foreach ($data as $key => $value) {
                    $cities = $value["cities"];
                    $state_name = $value["state_name"];
                    $states[$state_name] = explode(',', $cities);
                }
                echo json_encode($states); exit;
            }; return NULL;
            
        } catch (\PDOException $err) {
            // echo $err->getMessage();
            throw new \Exception("Error Processing Request", 1);  
        }
        
    }

    /**
     * filter - View to filter companies by post data
     * @Router: an instance of Router class
     */
    public static function filter(Router $router)
    {
        if ($_POST){
            // Select company based on course_of_study, city_or_area
            header("Content-Type: application/json");
            $p = $_POST;
            $query = [
                "city_or_area" => $p["city"] ?? "",
                "state" => $p["state"] ?? "",
                "course_of_study" => $p["course"],
            ];

            if(!$query["course_of_study"]){
                $error = "Please fill all required fields";
                http_response_code(400);
                echo json_encode($error);
                exit;

            }
            
            $companies = (new Company($router->dbs))->filter($query);
            http_response_code(200);
            echo json_encode($companies);
        }
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