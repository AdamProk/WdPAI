<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/recipes.css">
    <link rel="stylesheet" type="text/css" href="public/css/profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/public/js/redirecting.js" defer></script>
    <script src="/public/js/script.js" defer></script>
    <title>Profile</title>
</head>
<body>
<?php
        if (!isset($_COOKIE["id_user"]) ){
            header("Location: login");
        }
?>
    <div class="navbar">
        <div class="profile_link">
            <button class="profile_button" onclick="redirectToProfile()">
                <img class="profile_button_img" src="public/img/<? echo $me->getProfile_picture() ?>" >
            </button>
        </div>
        <div class="filler">
            <button class="logo2" onclick="redirectToRecipes()">
                <img id="img2" src="public/img/logo.svg">
            </button>
        </div>
        <div class="logout">
            <button type="submit" id="logout" class="logout_button">Logout</button>
        </div>
    </div>
    <div class="container">
        <div class="profile_pic">
            <div class="profile_img">
                <img class="profile_button_img" src="public/img/<? echo $me->getProfile_picture() ?>" >
            </div>
            <div class="profile_pic_change">

            </div>
        </div>
        <div class="profile_info">
            <h1>Nazwa użytkownika:</h1>
            <p><? echo $me->getName() ?></p>
            <h1>Email:</h1>
            <p><? echo $me->getEmail() ?></p>
        </div>
        <div class="user_recipes">
            <h1>Przepisy użytkownika:</h1>
            <div class="recipes">
                <?php foreach ($recipes as $recipe): ?>
                    <div class="recipe-container">
                        <div class="recipe">
                            <div class="recipe_left">
                                <div class="recipe_img">
                                    <img class="search_img" src="public/img/kotlet.jpg">
                                </div>
                            </div>
                            <div class="recipe_right">
                                <div class="recipe_top">
                                    <h1> <? echo $recipe->getRecipeName(); ?> </h1>
                                </div>
                                <div class="recipe_bottom">
                                    <div class="recipe_info">
                                        <div class="recipe_time">
                                            <h2>Czas przygotowania:</h1>
                                            <p><?echo $recipe->getPrepTime(); ?> min.</p>
                                        </div>
                                        <div class="recipe_time">
                                            <h2>Ilość porcji</h2>
                                            <p><?echo $recipe->getAmount(); ?></p>
                                        </div>
                                    </div>
                                    <div class="recipe_com">
                                        <div class="recipe_coms">
                                            <p>Likes:</p>
                                        </div>
                                        <div class="recipe_coms">
                                            <p>Komentarze (<? echo $recipe->getCommentsAmount(); ?>)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form class ="recipe-form" action="RecipeDetails", method="get">
                            <input type="hidden" name="recipeID" id="recipeID" value="<? echo $recipe->getRecipeID() ?>">
                        </form> 
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="liked_recipes">

        </div>
    </div>

</body>