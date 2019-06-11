<?php
    /*
    * App Core Class
    * Create URL & Loads Core Controller
    * URL FORMAT - /controller/method/param
    */

    class Core{
        protected $currentController = 'Pages';// default value pages
        protected $currentMethod    = 'index';// default value index
        protected $params           = [];     // default empty array 
        
        public function __construct(){
           // print_r($this->getUrl());
            
            $url = $this->getUrl();
            
            // Look In Controllers for first value
            if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){ // ucwords to capitalized first letter
                // If Exists Then Set As Current Controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 index
                unset($url[0]);
            }
            
            // Require The Controller
            require_once '../app/controllers/' . $this->currentController . '.php';
            
            // Instantiate controller class
            $this->currentController = new $this->currentController;
            
            // check for the second part of the URl
            if(isset($url[1])){
                //check to see if method exists in controller using PHP built-in fn called method_exists(controller, method)
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }
            
            // Get Params
            //if params get added in url then its equal to it if not then it's empty array
            $this->params = $url ? array_values($url) : [];// what's left in the array after unsetting the $url[0,1] controller and method
            
            // Call a Callback with array of params
            // Call the class->method $currentController->currentMethod()  with 2 arguments
            call_user_func_array([$this->currentController,$this->currentMethod ], $this->params);
        }
        
        public function getUrl(){ // fetch the URL
           if(isset($_GET['url'])){// $_GET['variable'] will get any variabe that passed through the url
                $url = rtrim($_GET['url'], '/'); // rtrim('the content', 'what we wanna trim of the content')
                $url = filter_var($url, FILTER_SANITIZE_URL);// filter_var($variable, type of filter ) used to filter values
                $url = explode('/', $url); // explode('character we wanna explode at', 'the var to explode') to explode string to array
                return $url;
           }
        }
    }