<?php
    session_start();

    /* Flash message helper
     * EXAMPLE - flash('register_success', 'You are now registered', 'alert alert-danger')
     * Display in the view - echo flash('register_success');
     */
    function flash($name = '', $message= '', $class = 'alert alert-success'){
       if(!empty($name)){
           if(!empty($message) && empty($_SESSION[$name])){//if msg isn't empty and the name isn't used before

                // Unset the values of session
                if(!empty($_SESSION[$name])){
                    unset($_SESSION[$name]);
                }
                
                if(!empty($_SESSION[$name . '_class'])){
                    unset($_SESSION[$name . '_class']);
                }
               
                // Set the new values
                $_SESSION[$name] = $message;// put the msg in session with the name of flash
                $_SESSION[$name . '_class'] = $calss;
               
                // elseif there's no input msg but there's msg in session $_SESSION[$name]
            }elseif(empty($message) && !empty($_SESSION[$name])){
               
                // if session has class then set it to variable $class
               $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : $class;
               
               // div will have calss same as that in session and if it's empty then the default class
               echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name]  . '</div>';
               unset($_SESSION[$name]);
               unset($_SESSION[$name . '_class']);
            }
       }
    }

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }
?> 