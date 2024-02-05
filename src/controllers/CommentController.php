<?php
 
use models\Recipe;
use models\Comment;
use repository\RecipeRepository;
use repository\UserRepository;
use repository\CommentRepository;

require_once 'AppController.php';
require_once __DIR__.'/../models/Recipe.php';
require_once __DIR__.'/../models/Comment.php';
require_once __DIR__.'/../repository/RecipeRepository.php';
require_once __DIR__.'/../repository/CommentRepository.php';

class CommentController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png','image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/upload';

    private $messages = [];
    private $recipeRepository;
    private $userRepository;
    private $commentRepository;

    public function __construct()
    {
        parent::__construct();
        $this->recipeRepository = new RecipeRepository();
        $this->userRepository = new UserRepository();
        $this->commentRepository = new CommentRepository();
    }

    public function add_comment(){
        if(!$this->isPost()){
            header("Location: recipes");
        }
        if(!isset($_COOKIE['id_user']))
        {
            return $this->render('login', ['messages' => ['Session Expired']]);
        }
        if(!isset($_POST['user_comment']) || !isset($_POST['recipe_id']))
        {
            header("Location: recipes");
        }
        $commentData = [
            'user_id' => $_COOKIE['id_user'],
            'comment' =>  $_POST['user_comment'],
            'recipe_id' => $_POST['recipe_id'],
        ];
        $this->commentRepository->addComment($commentData);
        $recipe = $this->recipeRepository->getRecipeByID($_POST['recipe_id']);
        $link = "/recipedetails?recipeID=".$recipe->getRecipeID();
        header("Location: ".$link);

    }
}