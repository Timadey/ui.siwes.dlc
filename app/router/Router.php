<?php
namespace app\router;

use app\operations\Database;

class Router
{
        public Database $dbs;
        public array $getRoutes = [];
        public array $postRoutes = [];

        public function __construct(Database $db)
        {
                $this->dbs = $db;
        }
        public function get($url, $fn)
        {
                $this->getRoutes[$url] = $fn;
                return $url;
        }
        public function post($url, $fn)
        {
                $this->postRoutes[$url] = $fn;
                return $url;
        }
        public function resolve()
        {
                $currUrl = $_SERVER['REQUEST_URI'] ?? '/';
                $method = $_SERVER['REQUEST_METHOD'];
        	$parsedUrl = parse_url($currUrl);
        	$currUrl = $parsedUrl['path'];

                if ($method === 'GET')
                {
                        $fn = $this->getRoutes[$currUrl] ?? null;
                }
                else
                {
                        $fn = $this->postRoutes[$currUrl] ?? null;
                }
                if (!$fn)
                {
                        echo $this->renderView("404", ['page_title' => 'Page not found']);
                }
                else
                {
                        call_user_func($fn, $this);
                }
                
        }

        public function renderView ($view, $params = [], $layout = 'layouts/layout' )
        {
                // echo '<pre>';
                // var_dump($_SERVER);
                // echo '</pre>';
                //exit;
                foreach ($params as $key => $value) {
                        $$key = $value; 
                }
                
                if ($layout !== ''){
                        ob_start();
                        include_once __DIR__."/../../views/$view.php";
                        $content = ob_get_clean();
                        include_once __DIR__."/../../views/$layout.php";
                }else{
                        include_once __DIR__."/../../views/$view.php";
                }
                
        }
}
?>
