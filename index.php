<?php

require 'Routing.php';


$path = trim($_SERVER['REQUEST_URI'],'/');
$path = parse_url($path, PHP_URL_PATH);

Routing::get('index','DefaultController');
Routing::post('recipes','RecipeController');
Routing::post('login','SecurityController');
Routing::post('recipedetails', 'RecipeController');
Routing::post('signup', 'SecurityController');
Routing::post('profile', 'RecipeController');
Routing::get('add_recipe', 'RecipeController');
Routing::post('addRecipe', 'RecipeController');
Routing::post('add_comment', 'CommentController');
Routing::post('searchRecipe', 'RecipeController');
Routing::run($path);

?>