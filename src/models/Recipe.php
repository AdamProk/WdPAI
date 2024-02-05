<?php
namespace models;
class Recipe
{
    private $recipe_id;
    private $creator;
    private $recipe_name;
    private $description;
    private $recipe_picture;
    private $recipe_date;
    private $ingredients;
    private $amount;
    private $comments_amount;
    private $prep_time;
    private $cuisine = [];

    public function __construct($recipe_id, 
                                $creator,
                                $recipe_name, 
                                $description, 
                                $recipe_picture, 
                                $recipe_date, $ingredients, 
                                $amount, 
                                $comments_amount, 
                                $prep_time, 
                                array $cuisine){
        $this->recipe_id = $recipe_id;
        $this->creator = $creator;
        $this->recipe_name = $recipe_name;
        $this->description =$description;
        $this->recipe_picture = $recipe_picture;
        $this->recipe_date = $recipe_date;
        $this->ingredients = $ingredients;
        $this->amount = $amount;
        $this->comments_amount = $comments_amount;
        $this->prep_time = $prep_time;
        $this->cuisine = $cuisine;
    }
    public function getRecipeID():int{
        return $this->recipe_id;
    }
    public function setRecipeID(int $recipe_id){
        $this->recipe_id = $recipe_id;
    }
    
    public function getCreator(): string{
        return $this->creator;
    }
    public function setCreator(string $creator){
        $this->creator=$creator;
    }

    public function getRecipeName():string{
        return $this->recipe_name;
    }
    public function setRecipeName(string $recipe_name){
        $this->recipe_name = $recipe_name;
    }

    public function getDescription():string{
        return $this->description;
    }
    public function setDescription(string $description){
        $this->description = $description;
    }

    public function getImage():string{
        return $this->recipe_picture;
    }
    public function setImage(string $recipe_picture){
        $this->recipe_picture = $recipe_picture;
    }

    public function getRecipeDate():string{
        return $this->recipe_date;
    }
    public function setRecipeDate(string $recipe_date){
        $this->recipe_date = $recipe_date;
    }
    public function getIngredients():string{
        return $this->ingredients;
    }
    public function setIngredients(string $ingredients){
        $this->ingredients = $ingredients;
    }
    public function getAmount():string{
        return $this->amount;
    }
    public function getCommentsAmount():string{
        return $this->comments_amount;
    }
    public function getPrepTime(): int{
        return $this->prep_time;
    }
    public function getRecipePic(){
        return $this->recipe_picture;
    }
    public function getCuisine():array{
        return $this->cuisine;
    }
}