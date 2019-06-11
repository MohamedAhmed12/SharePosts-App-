<?php
    class Pages extends Controller{
        public function __construct(){
        }
        
        public function index(){
            // If User Logged in then redirect him from welcome page to posts page
            if(isLoggedIn()){
                redirect('posts');
            }
            
            $data =[
                'title' => 'sharePosts',
                'desc'  => 'Simple Social Network Built on GadMVC PHP Framework'
            ]; 
            
            $this->view('pages/index', $data);
        }
        
        public function about(){
            $data= [
                'title' => 'About Page',
                'desc'  => 'App To Share Posts With Other Users'
            ];
            
             $this->view('pages/about', $data);
        }
    }