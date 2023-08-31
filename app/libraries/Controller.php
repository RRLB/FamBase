<?php
/*
* base controller
* loads models and views
*/

class Controller {
    //load model
    public function model($model){
        //require model file
        require_once '../app/models/' . $model . '.php';

        //Instantiate model
        return new $model();
    }

    //Load View
    public function view($view, $data = []){
        //Check for the view file
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else {
            //view does not exist
            die('View does not exist');
        }
    }
}