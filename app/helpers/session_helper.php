<?php

//have to run this function on every page for it to work
session_start();
//and then you can use these superglobals
//set session
//$_SESSION['user'] = 'Brad';
//unset session
//unset($_SESSION['user']);

// Flash messenger helper
// EXAMPLE - flash('register_success)', 'Youare now registered', 'alert alert-danger';
//DISPLAY IN VIEW - <?php  echo flash('register_success'); 
function flash($name = '', $message = '', $class = 'alert alert-success'){
    if(!empty($name)){
        if(!empty($message) && empty($_SESSION[$name])){
            if(!empty($_SESSION[$name])){
                unset($_SESSION[$name]);
            }

            if(!empty($_SESSION[$name. '_class'])){
                unset($_SESSION[$name. '_class']);
            }

            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;

        } elseif(empty($message) && !empty($_SESSION[$name])){
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
            echo '<div class ="' . $class . '" id = "msg-flash">' . $_SESSION[$name] . '</div>';
            
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);

        }
    }
}

//to use for protected routes
function isLoggedIn(){
    if(isset($_SESSION['user_id'])){
        return true;
    } else {
        return false;
    }
}
