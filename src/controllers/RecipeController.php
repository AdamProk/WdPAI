<?php
 
use models\Recipe;
use repository\RecipeRepository;
use repository\UserRepository;
use repository\CommentRepository;
require_once 'AppController.php';
require_once __DIR__.'/../models/Recipe.php';
require_once __DIR__.'/../models/Comment.php';
require_once __DIR__.'/../repository/RecipeRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/CommentRepository.php';
class RecipeController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024*32;
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

    public function recipes(){
        $recipes = $this->recipeRepository->getRecipes();
        $me = $this->userRepository->getUserByID($_COOKIE["id_user"]);
        return $this->render('recipes', ['recipes'=> $recipes, 'me'=> $me]);
    }
    public function recipedetails()
    {   
        if (!isset($_COOKIE["id_user"])){
            header("Location: login");
        }
        $recipeID = isset($_GET['recipeID']) ? $_GET['recipeID'] : null;
        $recipe = $this->recipeRepository->GetRecipeByID($recipeID);
        $comments = $this->commentRepository->GetCommentsByRecipeID($recipeID);
        $me = $this->userRepository->getUserByID($_COOKIE["id_user"]);
        return $this->render('recipedetails', ['recipe' => $recipe,'comments' => $comments, 'me'=>$me]);
    }

    public function searchRecipe()
    {
        if ($this->isPost()) {
            if (isset($_POST['filter'])) {       
                $filter = $_POST['filter'];
                $filteredRecipes= $this->recipeRepository->getRecipeByTitle($filter);
                
                foreach ($filteredRecipes as $recipe) {
                echo '    <div class="recipe-container">';
                echo '    <div class="recipe">';
                echo '        <div class="recipe_left">';
                echo '            <div class="recipe_img">';
                echo '                <img class="search_img" src="public/img/kotlet.jpg">';
                echo '            </div>';
                echo '        </div>';
                echo '        <div class="recipe_right">';
                echo '            <div class="recipe_top">';
                echo '                <h1>'.$recipe->getRecipeName().'</h1>';
                echo '            </div>';
                echo '            <div class="recipe_bottom">';
                echo '                <div class="recipe_info">';
                echo '                    <div class="recipe_time">';
                echo '                        <h2>Czas przygotowania:</h1>';
                echo '                        <p>'.$recipe->getPrepTime().' min.</p>';
                echo '                    </div>';
                echo '                    <div class="recipe_time">';
                echo '                        <h2>Ilość porcji</h2>';
                echo '                        <p>'.$recipe->getAmount().'</p>';
                echo '                    </div>';
                echo '                </div>';
                echo '                <div class="recipe_com">';
                echo '                    <div class="recipe_coms">';
                echo '                        <p>Likes:</p>';
                echo '                    </div>';
                echo '                    <div class="recipe_coms">';
                echo '                        <p>Komentarze ('.$recipe->getCommentsAmount().')</p>';
                echo '                    </div>';
                echo '                </div>';
                echo '            </div>';
                echo '        </div>';
                echo '    </div>';
                echo '    <form class ="recipe-form" action="RecipeDetails", method="get">';
                echo '        <input type="hidden" name="recipeID" id="recipeID" value="'.$recipe->getRecipeID().'">';
                echo '    </form>'; 
                echo '</div>';
                }
            }else header("Location: recipes");
            $filteredRecipes = $this->recipeRepository->getRecipeByTitle($filter);
            return $filteredRecipes;
        }
    }

    public function add_recipe(){
        if(!isset($_COOKIE["id_user"])){
            header("Location: login");
        }
        $me = $this->userRepository->getUserByID($_COOKIE["id_user"]);
        return $this->render('add_recipe', ['me' => $me]);
    }
    public function addRecipe()
    {
        if(!isset($_COOKIE["id_user"])){
            header("Location: login");
        }
        $me = $this->userRepository->getUserByID($_COOKIE["id_user"]);
        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__) . self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            $recipeData = [
                'recipe_name' => $_POST['recipe_name'],
                'recipe_description' => $_POST['description'],
                'ingredients' =>$_POST['ingredients'],
                'prep_time' =>$_POST['prep_time'] ,
                'amount' =>  $_POST['amount'] ,
                'id_user' => $_COOKIE['id_user'],
                'recipe_picture' => isset($_FILES['file']['name']) ? $_FILES['file']['name'] : '',
            ];
            if(!$this->recipeRepository->addRecipe($recipeData)){
                return $this->render('add_recipe', ['messages' => ["Error while adding recipe"], 'me' => $me]); 
            };
        }else return $this->render('add_recipe', ['messages' => ["File is too large"], 'me' => $me]);
        return $this->render('add_recipe', ['messages' => ["Added Successfully"], 'me' => $me]);
    }

    private function validate(array $file):bool{
        if($file['size'] > self::MAX_FILE_SIZE){
            $this->message[] = 'File is too large for destiantion file system';
            return false;
        }
        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)){
            $this->message[] = 'File type is not supported';
            return false;
        }
        return true;
    }

    public function profile(){
        $recipes = $this->recipeRepository->getRecipesByUserID($_COOKIE["id_user"]);
        $me = $this->userRepository->getUserByID($_COOKIE["id_user"]);
        return $this->render('profile', ['recipes'=> $recipes, 'me'=> $me]);
    }

}