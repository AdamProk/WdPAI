<?php
use models\Recipe;
use models\User;
use repository\UserRepository;


require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        //$user = new User('johnsnow@pk.edu.pl', 'johnsnow123', 'John'); 

        if(!$this->isPost()){
            return $this->render('login');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $this->userRepository->getUser($email);
        if(!$user){
            return $this->render( 'login', ['messages' => ['User does not exist']]);
        }
        
        if($user -> getEmail() !== $email){
            return $this->render( 'login', ['messages' => ['User with this email does not exist']]);
        }

        if(!password_verify($password, $user->getPassword())){
            return $this->render( 'login',['messages' => ['Wrong password']]);
        } 
        else{
            setcookie("id_user", $user->getID(), time()+1800, '/');
        }

        //return $this->render('projects');
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/recipes");
    }
    public function signup(){

        if (!$this->isPost()) {
            return $this->render('signup');
        }
        if($_POST['password'] != $_POST['repeat_password']){
            return $this->render('signup', ['messages'=> ['Passwords must match!']]);
        }
        $userData = [
            'email' => $_POST['email'],
            'password_hash' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'username' => $_POST['username'],
        ];
        $user = $this->userRepository->addUser($userData);
        #var_dump($user);
        if(is_null($user)){
            return $this->render('signup', ['messages'=> ['Username or email is taken!']]);
        }else{
            setcookie("id_user", $user->getID(), time()+1800, '/');
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/recipes");
        }
    }
    

}