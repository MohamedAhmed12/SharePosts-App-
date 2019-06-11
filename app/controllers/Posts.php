<?php
    class Posts extends Controller{
        
        public function __construct(){
            // Prevent the non logedin users to view any of posts methods
            if(!isLoggedIn()){
                redirect('users/login');
            }
            
            // Load Post Model
            $this->postModel = $this->model('Post');
            // Load User Model
            $this->userModel = $this->model('User');
        }
        
        public function index(){    
            // Get Posts
            $posts =  $this->postModel->getPosts();
            
            $data = [
                'posts' => $posts,
            ];
            
            $this->view('posts/index', $data);
        }
        
         public function add(){
             
             // Check if it's Post Request
             if($_SERVER['REQUEST_METHOD'] === 'POST'){
                 // Sanitize Post array
                 $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                 
                 // Data array
                 $data = [
                    'title'     => trim($_POST['title']),
                    'body'      => trim($_POST['body']),
                    'user_id'   => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => '',
                 ];
                 
                 // Validate title
                 if(empty($data['title'])){
                    $data['title_err'] = 'Please Enter Title';
                 }
                 
                 // Validate body
                 if(empty($data['body'])){
                    $data['body_err'] = 'Post Body Can\'nt Be Empty';
                 }
                 
                 // Make Sure There Are No Errors
                 if( empty($data['body_err']) &&  empty($data['title_err']) ){
                     // Validated if there're no errors 
                     if($this->postModel->addPost($data)){// if fn add returns true
                        flash('post_msg', 'Post Added');
                        redirect('posts');
                     }else{
                         die('somethign went wrong');
                     }
                 }else{
                     // Load View With Errors if ther're Errors
                     $this->view('posts/add', $data);
                 }
                 
             }else{
                $data = [
                    'title' => '',
                    'body' => ''
                ];

                $this->view('posts/add', $data); 
             }
         }
        
         public function edit($id){
             
             // Check if it's Post Request
             if($_SERVER['REQUEST_METHOD'] === 'POST'){
                 // Sanitize Post array
                 $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                 
                 // Data array
                 $data = [
                    'id'        => $id,
                    'title'     => trim($_POST['title']),
                    'body'      => trim($_POST['body']),
                    'user_id'   => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => '',
                 ];
                 
                 // Validate title
                 if(empty($data['title'])){
                    $data['title_err'] = 'Please Enter Title';
                 }
                 
                 // Validate body
                 if(empty($data['body'])){
                    $data['body_err'] = 'Post Body Can\'nt Be Empty';
                 }
                 
                 // Make Sure There Are No Errors
                 if( empty($data['body_err']) &&  empty($data['title_err']) ){
                     // Validated if there're no errors 
                     if($this->postModel->updatePost($data)){// if fn add returns true
                        flash('post_msg', 'Post Updated');
                        redirect('posts');
                     }else{
                         die('somethign went wrong');
                     }
                 }else{
                     // Load View With Errors if ther're Errors
                     $this->view('posts/edit', $data);
                 }
                 
             }else{
                 // Get Existing Post
                 $post = $this->postModel->getPostById($id);
                 // Check For Owner
                 if($post->user_id !== $_SESSION['user_id']){
                     redirect('posts');
                 }
                 
                $data = [
                    'id'    => $id,
                    'title' => $post->title,
                    'body'  => $post->body
                ];

                $this->view('posts/edit', $data); 
             }
         }
        
          public function delete($id){
             
            // Check if it's Post Request
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                if($this->postModel->deletePost($id)){
                    flash('post_msg', 'Post Has Been Removed');
                    redirect('posts');
                }
            }else{
                die('Something Went Wrong');
            }
          }
        public function show($id){ 
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);
            
            $data = [
                'post' => $post,
                'user' => $user
            ];
            
            // Load View 
            $this->view('posts/show', $data);
        }
    }