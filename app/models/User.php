<?php
    class User{
        private $db;
        
        public function __construct(){
            $this->db = new Database;// Connect to Database
        }
        
        // Register The User
        public function register($data){
            $this->db->query('INSERT INTO users (name, email, password) VALUES (:Mname, :Memail, :Mpass)');
            // Binding Values
            $this->db->bind(':Mname', $data['name']);
            $this->db->bind(':Memail', $data['email']);
            $this->db->bind(':Mpass', $data['password']);
            
            // Execute
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        // Login The User
        public function login($email, $password){
            
            $this->db->query('SELECT * FROM users WHERE email = :Memail');
            
            // Binding Values
            $this->db->bind(':Memail', $email);
            
            // Get The row of user
            $row = $this->db->single();
            
            // Set hashed password
            $hashed_pass = $row->password;// as $row fetched style was fetch(PDO::FETCH_OBJ) fethced as object
            
            // Check if password identical to hashed password from database
            if(password_verify($password, $hashed_pass)){//password_verify — Verifies that password matches hash
                return $row;
            }else{
                return false;
            }
        }
        
        // Find User By Email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :Memail');
            $this->db->bind(':Memail', $email);
            $row = $this->db->single();
            
            // Check Row
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
        
        // get User By Id
        public function getUserById($id){
            $this->db->query('SELECT * FROM users WHERE id = :Mid');
            $this->db->bind(':Mid', $id);
            $row = $this->db->single();
            
            return $row;
        }
    }