<?php



namespace vendor\core\base;


abstract class Controller{


    
    public $route = [];
    public $view;

    public function __construct($route)
    {
        $this->route = $route;
        
        // $this->view = $route['action'];

        // include APP . "/views/{$this->route['controller']}/{$this->view}.php";


    }








}