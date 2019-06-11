<?php
    // DataBase Parameters
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'sharePosts');


    /* App Root is The actual rooth/path of directory => (C:\xampp\htdocs\GadMVC\app\config\config.php)
    * dirname => give us the parent folder
    * define => used to define constant and all const shoud be all caps
    */

    // App Root
    define('APPROOT', dirname( dirname( __FILE__ ) ));
    // URL Root
    define('URLROOT', 'http://localhost/sharePosts/');
    // Site Name
    define('SITENAME', 'sharePosts');
    // App Version
    define('APPVERSION', '1.0');