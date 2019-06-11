<?php
    // Load Config
    require_once 'config/config.php';
    // Load Helpers
    require_once 'helper/url_helper.php';
    require_once 'helper/session_helper.php';
    // Auto Load Core LIberaries
    spl_autoload_register(function($className){// whenever I use anyclass or create obj to a class it will get the name of the class
        require_once 'liberaries/' . $className . '.php';
    });