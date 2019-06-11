<?php
    /*
     * PDO Database Class
     * Used For Connecting to Database
     * Create Prepared Statments
     * Bind Vlaues
     * Return rows & Results
     */
     class Database{
         // Database details
         private $host = DB_HOST;
         private $user = DB_USER;
         private $pass = DB_PASS;
         private $dbname = DB_NAME;
         
         private $dbHandller;
         private $stmt;
         private $error;
         
         public function __construct(){
             // set DSN
             $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
             $options = array(
                PDO::ATTR_PERSISTENT => true,// increase the performance by checking constintly to keep presist connection to DB
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION// choose one of the three errmodes which is exception
             );
             
             // Create PDO instance
             try{
                 $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);// dbh stands for database handeller
                 
             } catch(PDOException $e){
                 $this->error = $e->getMessage();// getMessage() is built in fn that assocciated with $e
                 echo $this->error;
             }
         }
         
         // First: Prepare Statement With Query
         public function query($sql){
             $this->stmt = $this->dbh->prepare($sql);
         }
         
         // Second: Bind The Values 
         public function bind($param, $value, $type = null){
             if(is_null($type)){
                 switch(true){// confition
                     case is_int($value):
                         $type = PDO::PARAM_INT;
                         break;
                     case is_bool($value):
                         $type = PDO::PARAM_BOOL;
                         break;
                     case is_null($value):
                         $type = PDO::PARAM_NULL;
                         break;
                     default:
                         $type = PDO::PARAM_STR;     
                 }
             }
             
             // bind value 
             $this->stmt->bindValue($param, $value, $type);// bindValue built in fn in php to bind values
         }
         
         // Third: Execute The Prepared Statement
         public function execute(){
             return $this->stmt->execute();
         }
         
         // Fifth: Get Result Set As Array 
         public function resultSet(){
             $this->execute();
             return $this->stmt->fetchAll(PDO::FETCH_OBJ);
         }
         
         // Get Single Record as Object
         public function single(){
            $this->execute();
             return $this->stmt->fetch(PDO::FETCH_OBJ);
         }
         
         // Get Row Count 
         public function rowCount(){
             return $this->stmt->rowCount();
         }
         
     }