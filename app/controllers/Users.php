<?php
    class Users extends Controller{
        public function __construct(){
            $this->userModel = $this->model('User');
        }
        
        public function register(){
            // check to se if the form is submitted or the page is just reloaded by checking if POST
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                // Process form
                
                // Sanatize the POST data to make sure it's string
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                // Init Data
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];
                
                // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'please Enter Email';
                }else{
                    // Check mail
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken';
                    }
                }
                
                 // Validate Name
                if(empty($data['name'])){
                    $data['name_err'] = 'please Enter Name';
                }
                
                 // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'please Enter Password';
                }elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'Password must be at least 6 characters';
                }
                
                // Validate Confirm Password
                if(empty($data['confirm_password'])){
                    $data['confirm_password_err'] = 'please Confirm Password';
                }elseif($data['confirm_password'] !== $data['password']){
                    $data['confirm_password_err'] = 'Passwords don\'t match';
                }
                
                // Make Sure There are no Errors
                if(empty($data['email_err'] && $data['name_err'] && $data['password_err'] && $data['confirm_password_err'])){
                    
                    // Validate

                    // Hash The Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT) ;
                    
                    // Register User
                    if($this->userModel->register($data)){// if register fn in userModel returns true
                        flash('register_success', 'You are registered and can login');
                        redirect('users/login');
                    }else{
                        die('something went wrong!');
                    }

                }else{
                    // Load View With Errors
                    $this->view('users/register', $data);
                }
                
            }else{
                // Init Data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => '',
                ];
                      
                // Load The View
                $this->view('users/register', $data);
            }
        }
        
        public function login(){
            // check to se if the form is submitted or the page is just reloaded by checking if POST
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                // Process form
                
                 
                // Sanatize the POST data to make sure it's string
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                
                // Init Data
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                ];
                
                 // Validate Email
                if(empty($data['email'])){
                    $data['email_err'] = 'please Enter Email';
                }
                

                 // Validate Password
                if(empty($data['password'])){
                    $data['password_err'] = 'please Enter Password';
                }
                
                // Check for user/mail
                if($this->userModel->findUserByEmail($data['email'])){
                    // User Found
                    
                }else{
                    // User Not Found
                    $data['email_err'] = 'No User with such email';
                }
                
                // Make Sure There are no Errors
                if( empty($data['email_err']) && empty($data['password_err']) ){
                    //Validated
                    
                    /* Check and set logged in user
                     * by using email and unhashed password(unhashing through the model)
                     */
                    $logedInUser = $this->userModel->login($data['email'], $data['password']);
                    
                    if($logedInUser){
                        // Create Session
                        $this->createUserSession($logedInUser);
                    }else{
                        $data['password_err'] = 'Password Incorrect';
                        $this->view('users/login', $data);
                    }
                    
                     
                }else{//if there is an error
                    $this->view('users/login', $data);
                }
                
            }else{// if page is refreshed and not called by POST method
                // Init Data
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '', 
                ];
                      
                // Load The View
                $this->view('users/login', $data);
            }
        }
        
        public function createUserSession($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirect('posts');
        }
        
        public function logout(){
            // Unset Session variables That we have created
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);
            // destroy the session
            session_destroy();
            redirect('users/login');
            
        }
        
    }