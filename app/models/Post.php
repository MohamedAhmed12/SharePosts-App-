<?php
    class Post{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }
        
        public function getPosts(){
            $this->db->query('SELECT *,
                              posts.id          as postId,
                              users.id          as userId,
                              posts.created_at  as postCreated,
                              users.created_at  as userCreated
                              FROM posts
                              INNER JOIN users
                              ON posts.user_id = users.id
                              ORDER BY posts.created_at DESC
                              ');
            
            $result = $this->db->resultSet();
            
            return $result;
        }
        
        public function addPost($data){
            // Query to DB
            $this->db->query('INSERT INTO posts (title, user_id, body) VALUES(:Mtitle, :Muser_id, :Mbody)');
            // Bind The values
            $this->db->bind(':Mtitle', $data['title']);
            $this->db->bind(':Muser_id', $data['user_id']);
            $this->db->bind(':Mbody', $data['body']);
            // Execute The Query
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        public function updatePost($data){
            // Query to DB
            $this->db->query('UPDATE posts SET title = :Mtitle, body = :Mbody WHERE id = :Mid');
            // Bind The values
            $this->db->bind(':Mid', $data['id']);
            $this->db->bind(':Mtitle', $data['title']);
            $this->db->bind(':Mbody', $data['body']);
            // Execute The Query
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        public function deletePost($id){
            // Query to DB
            $this->db->query('DELETE FROM posts WHERE id = :Mid');
            // Bind The values
            $this->db->bind(':Mid', $id);
            // Execute The Query
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
        
        public function getPostById($id){
            $this->db->query('SELECT * FROM posts WHERE id = :Mpost_id');
            $this->db->bind(':Mpost_id', $id);
            $row = $this->db->single();
            
            return $row;
        }
        
    }
?>