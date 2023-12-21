<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';

class SecurityContrller extends AppController{
    public function login()
    {
        $user = new User('johnsnow@pk.edu.pl', 'johnsnow123', 'John', 'Snow'); 

        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];
        
        if($user -> getEmail() !== $email){
            return $this->render( 'login', ['messages' => ['User with this email does not exist']]);
        }

        if($user -> getPassword !== $password){
            return $this->render( 'login',['messages' => ['Wrong password']]);
        } 

        //return $this->render('projects')
        $url = "http://$_SERVER[HTTP_HOST]";
        header("locations ($url)/projects");
    }

}