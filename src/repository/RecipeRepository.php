<?php
namespace repository;
use models\Recipe;
use PDO;
use \DateTime;
require_once 'Repository.php';
require_once __DIR__.'/../models/Recipe.php';

class RecipeRepository extends Repository
{
    public function getRecipes(): array
    {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public."Recipes"
        ');
        $stmt->execute();

        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recipes as $recipe){
            $result[] = new Recipe(
                $recipe['ID_recipe'],
                $recipe['ID_user'],
                $recipe['recipe_name'],
                $recipe['description'],
                $recipe['recipe_picture'],
                $recipe['recipe_date'],
                $recipe['ingredients'],
                $recipe['amount'],
                $recipe['comments_amount'],
                $recipe['prep_time'],
                $this->getRecipeCuisinesById($recipe['ID_recipe']),
            );
        }
        return $result;
    }
    public function getRecipeByID(int $search): ?Recipe
    {
        $result;
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public."Recipes" where "Recipes"."ID_recipe" = :search
        ');
        $stmt->bindParam(':search', $search, PDO::PARAM_INT);
        $stmt->execute();
        $recipe = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = new Recipe(
            $search,
            $recipe[0]['ID_user'],
            $recipe[0]['recipe_name'],
            $recipe[0]['description'],
            $recipe[0]['recipe_picture'],
            $recipe[0]['recipe_date'],
            $recipe[0]['ingredients'],
            $recipe[0]['amount'],
            $recipe[0]['comments_amount'],
            $recipe[0]['prep_time'],
            $this->getRecipeCuisinesById($search),
        );
        return $result;
    }
    public function getRecipesByUserID(int $search){
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public."Recipes" WHERE "ID_user" = :search
        ');
        $stmt->bindParam(':search', $search, PDO::PARAM_INT);
        $stmt->execute();
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recipes as $recipe){
            $result[] = new Recipe(
                $recipe['ID_recipe'],
                $recipe['ID_user'],
                $recipe['recipe_name'],
                $recipe['description'],
                $recipe['recipe_picture'],
                $recipe['recipe_date'],
                $recipe['ingredients'],
                $recipe['amount'],
                $recipe['comments_amount'],
                $recipe['prep_time'],
                $this->getRecipeCuisinesById($recipe['ID_recipe']),
            );
        }
        return $result;
    }
    public function getRecipeCuisinesById(int $search){
        $stmt = $this->database->connect()->prepare('
        SELECT 
            c.cuisine
        FROM public."Recipes" r
        JOIN public."Recipe_cuisine" rc ON rc."ID_recipe" = r."ID_recipe"
        JOIN public."Cuisine" c on rc."ID_cuisine" = c."ID_cuisine"
        WHERE r."ID_recipe" = :search
        ');
        $stmt->bindParam(':search', $search, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecipe(int $ID_recipe): ?Recipe
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public."Recipes" WHERE ID_recipe = :ID_recipe
        ');
        $stmt->bindParam(':ID_recipe', $ID_recipe, PDO::PARAM_INT);
        $stmt->execute();

        $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

        if($recipe == false){
            return null;
        }

        return new Recipe(
                $ID_recipe,
                $recipe['ID_user'],
                $recipe['recipe_name'],
                $recipe['description'],
                $recipe['recipe_picture'],
                $recipe['recipe_date'],
                $recipe['ingredients'],
                $recipe['amount'],
                $recipe['comments_amount'],
                $recipe['prep_time'],
                $this->getRecipeCuisinesById($recipe['ID_recipe']),
        );
    }
    public function getRecipeByTitle(string $searchString){
        $result=[];
        $searchString = '%'.strtolower($searchString).'%';
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM public."Recipes" WHERE LOWER(recipe_name) LIKE :search
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        #var_dump($games);
        foreach ($recipes as $recipe){
            $result[] = new Recipe(
                $recipe["ID_recipe"],
                $recipe['ID_user'],
                $recipe['recipe_name'],
                $recipe['description'],
                $recipe['recipe_picture'],
                $recipe['recipe_date'],
                $recipe['ingredients'],
                $recipe['amount'],
                $recipe['comments_amount'],
                $recipe['prep_time'],
                $this->getRecipeCuisinesById($recipe['ID_recipe']),
            );
        }
        return $result;
    }

    public function addRecipe(array $values)
    {
        $recipe_date = new DateTime();
        $dbh = $this->database->connect();
        $stmt = $dbh->prepare('
            INSERT INTO "Recipes" (recipe_name,likes, dislikes,comments_amount, description, ingredients,prep_time,amount,"ID_user",recipe_picture,recipe_date)
            VALUES(?,0,0,0,?,?,?,?,?,?,?)
        ');
        try{
            $dbh->beginTransaction();
            $stmt->execute([
                $values['recipe_name'],
                $values['recipe_description'],
                $values['ingredients'],
                $values['prep_time'],
                $values['amount'],
                $values['id_user'],
                $values['recipe_picture'],
                $recipe_date->format('Y-m-d'),
            ]);
            $dbh->commit();
        }catch (\PDOException $exception){
            return null;
        }
        return true;
        
    }
}