<?php

require_once 'AppController.php' ;
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';
class DefaultController extends AppController{
    public function index(){
        //TODO display login.php
        $this->render('login', ['message'=>"Hello"]);
    }    

    public function recipes(){
        //TODO display projects.php
        $this->render('recipes');
    }
}