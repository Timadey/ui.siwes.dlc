<?php
namespace app\controllers;

header('Access-Control-Allow-Origin: *');

use app\helpers\Help;
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
                	$value = array_map("trim", $value);
                    $courses = array_merge($courses, $value);
                }
                $courses = array_unique($courses);
                sort($courses);
                $courses = array_filter($courses);
                echo json_encode($courses); exit;
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
    public static function all_states(Router $router)
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
     * states - Returns all states and their respective cities or area
     * @Router: an instance of Router class
     */
    public static function course_states(Router $router)
    {
        if ($_POST && isset($_POST["course"])) {
            $course = '%' . str_replace("&amp;", "&", Help::clean($_POST["course"])) . '%';
            $query = "SELECT DISTINCT `state`
                      FROM company_directory 
                      WHERE course_of_study LIKE :course";
        
            try {
                $q = $router->dbs->conn->prepare($query);
                $q->bindParam(':course', $course, \PDO::PARAM_STR);
                $q->execute();
                $data = $q->fetchAll(\PDO::FETCH_ASSOC);
                
                $states = [];
                foreach ($data as $row) {
                    $states[] = $row["state"];
                }
                
                echo json_encode($states);
            } catch (\PDOException $err) {
                throw new \Exception("Error Processing Request", 1);  
            }
        }
        
        
        
    }

    /**
     * course_states_city - Returns all states and their respective cities or area
     * @Router: an instance of Router class
     */
    public static function course_states_city(Router $router)
    {
        if ($_POST && isset($_POST["course"]) && isset($_POST["state"])) {
            $course = '%' . str_replace("&amp;", "&", Help::clean($_POST["course"])) . '%';
            $state = Help::clean($_POST["state"]);
        
            $query = "SELECT DISTINCT `city_or_area`
                      FROM company_directory 
                      WHERE course_of_study LIKE :course
                      AND `state` = :state";
        
            try {
                $q = $router->dbs->conn->prepare($query);
                $q->bindParam(':course', $course, \PDO::PARAM_STR);
                $q->bindParam(':state', $state, \PDO::PARAM_STR);
                $q->execute();
                $data = $q->fetchAll(\PDO::FETCH_ASSOC);
                
                $cities = [];
                foreach ($data as $row) {
                    $cities[] = $row["city_or_area"];
                }
                
                echo json_encode($cities);
            } catch (\PDOException $err) {
                // echo $err->getMessage();
                throw new \Exception("Error Processing Request", 1);  
            }
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
                $error = "Please select course of study";
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

     /**
     * update - View to update a new company
     * @Router: an instance of Router class
     */
    public static function update(Router $router)
    {
        if($_POST){
            header("Content-Type: application/json");
            $company = new Company($router->dbs, $_POST);
            
            // print_r($_POST); exit;
            unset($_POST);
            
            $errorBag = $company->save(true);
            
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

    /**
     * destroy - View to update a new company
     * @Router: an instance of Router class
     */
    public static function destroy(Router $router)
    {
        if($_POST){
            header("Content-Type: application/json");
            $company = new Company($router->dbs, $_POST);
            unset($_POST);

            $num_deleted = $company->delete();
            if (! $num_deleted)
            {
                http_response_code(400);
                $error =(object) [
                    "error" => "Company with that ID does not exist",
                ];

                echo json_encode($error);
                exit;
            }
            
            else
            {
                http_response_code(204);
                exit;
            }
            exit;
        }

        header("Location: /siwes/dlc");
    }

    /**
     * suggest - View to give suggestions based on users input a new company
     * @Router: an instance of Router class
     */
    public static function suggest(Router $router)
    {

        if ($_POST && isset($_POST["where"]) && isset($_POST["find"])) {
            $where = str_replace("&amp;", "&", Help::clean($_POST["where"]));
            $find = str_replace("&amp;", "&", Help::clean($_POST["find"])) . '%';
            $query = "SELECT `$where`
                      FROM company_directory 
                      WHERE `$where` LIKE :find LIMIT 3";
        
            try {
                $q = $router->dbs->conn->prepare($query);
                // echo $query; exit;
                $q->bindParam(':find', $find, \PDO::PARAM_STR);
                $q->execute();
                $data = $q->fetchAll(\PDO::FETCH_ASSOC);
                
                $suggestions = [];
                // print_r($suggestions); exit;
                foreach ($data as $row) {
                    $suggestions[] = $row[$where];
                }
                
                echo json_encode($suggestions);
            } catch (\PDOException $err) {
                echo $err->getMessage();
                throw new \Exception("Error Processing Request", 1);  
            }
        }
        // if($_POST){
        //     header("Content-Type: application/json");
        //     $company = new Company($router->dbs, $_POST);
        //     // print_r($_POST); exit;
        //     unset($_POST);
            
        //     $errorBag = $company->save(true);
            
        //     if ($errorBag->errors)
        //     {
        //         http_response_code(400);

        //         echo json_encode($errorBag->errors);
        //         exit;
        //     }
        //     else if ($errorBag->last_inserted)
        //     {
        //         http_response_code(200);
        //         echo json_encode($errorBag->inserted_obj);
        //         exit;
        //     }
        //     else
        //     {
        //         http_response_code(500);
        //         echo json_encode($errorBag);
        //         exit;
        //     }

        // }
        // header("Location: /siwes/dlc");

        

    }
}

?>