<?php

require_once 'AppController.php' ;

class DefaultController extends AppController{
    public function index(){
        //TODO display login.php
        $this->render('login', ['message'=>"Hello"]);
    }    

    public function projects(){
        //TODO display projects.php
        $this->render('projects');
    }
}