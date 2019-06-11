<?php
    /*
     * This is the base Controller
     * It's Load The Models & Views
     */
    class Controller{
        // Load Model
        public function model($model){
            // Require model file
            require_once '../app/models/' . $model . '.php';
            
            
            // Instantiate Model
            return new $model();// if I pass User the it'll return new User
        }
        
        // Load The View
        public function view($view, $data = []){
            // Check for the view File
            if(file_exists ( '../app/views/' . $view . '.php')){
                
                require_once '../app/views/' . $view . '.php';
                
            }else{
                
                // View Doesn't Exist
                die('View Does not Exist');
                
            }
        }
    }