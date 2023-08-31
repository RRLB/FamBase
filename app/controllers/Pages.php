<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class Pages extends Controller {



    public function __construct(){

    }
    public function index(){
        //as Pages extends Controller, we can access it here through $this
        
        if(isLoggedIn()){
            redirect('posts');
        }
        
        $data = [
            'title' => 'HOMEPAGE',
            'description' => 'Simple social network built on the OnoMVC PHP framework'
        ];

        

        $this->view('pages/index', $data);
    }

    public function about(){
        
        $data = [
            'title' => 'ABOUT',
            'description' => 'App to share posts with other users'
        ];
        $this->view('pages/about', $data);
    }
}