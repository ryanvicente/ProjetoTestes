<?php
    namespace Config\Init;

    abstract class Boot{

        private $routes;

        abstract protected function initRoutes();

        public function __construct()
        {

            $this->initRoutes();
            $this->run($this->getUrl());
        }
        public function getRoutes()
        {
            return $this -> routes;
        }
        public function setRoutes(array $routes)
        {
            $this -> routes = $routes;
        }
        protected function run ($url)
        {
            $class = "App\\Controllers\\Erro_404Controller";
            $method = "Erro404";
            foreach($this->getRoutes() as $key => $route)
            {
                
                if($url == $route['route'])
                {
                    $class = "App\\Controllers\\".$route['controller'];
                    $method = $route['method'];
                    $controller = new $class;
                    $controller -> $method();
                    exit;
                }
            }
            
            $controller = new $class;
            //print_r($controller);
            $controller ->$method();
            //print_r($controller);
        }
        public function getUrl()
        {
            return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }
    }