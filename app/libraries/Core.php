<?php
/*
* Main App Core Class
* Creates URL & loads core controller
* URL FORMAT - /controller/method/params
*/

class Core {
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    //get url
    public function __construct(){
        //print_r($this->getUrl());

        //set variable url = to this getUrl
        $url = $this->getUrl();

        //FIRST VALUE = PAGES
        //Look in controllers for first value
        //path defined as if we are in index.php as everything gets routed through it
        //file_exists checks file exists
        //ucwords => capitalises first letter
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            //if exists (for example check url for Posts) and checks off $currentController = 'Pages'
            //sets it as controller => will overwrite pages which is the default
            $this->currentController = ucwords($url[0]);
            //Unset O Index
            unset($url[0]);
        }

        //require the controller
        require_once '../app/controllers/'. $this->currentController . '.php';
        //instatiate controller class
        $this->currentController = new $this->currentController;

        //SECOND VALUE = METHOD => Pages
        //check for the second part of the url
        
        if(isset($url[1])){
            //method_exists => checks to see if method exists
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];
                //unset 1 index
                unset($url[1]);
            }
        }

        //THIRD VALUE = PARAMS
        //Get Params
        //if there are params they will get added, if not it will remain an empty array
        $this->params = $url ? array_values($url) : [];
        //call a call back with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    
    public function getUrl(){
        //first check to see if this is set
        if(isset($_GET['url'])){
            //rtrim => strips white space or other characters from the end of a string
            $url = rtrim($_GET['url'], '/');
            //filter_var => Filters variable with a specified filter => here it removes any character that shouldnt be in a url
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}