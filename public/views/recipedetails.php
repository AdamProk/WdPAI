<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/recipes.css">
    <link rel="stylesheet" type="text/css" href="public/css/recipedetail.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/public/js/redirecting.js" defer></script>
    <script src="/public/js/script.js" defer></script>
    <title>Recipes</title>
</head>
<body>
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
            <button class="logout_button">Logout</button>
        </div>
    </div>
    <div class="container">
        <div class="logo">
            <img id="img" src="public/img/logo.svg">
        </div>
        <div class="recipe-details">
            <div class="recipe_details_left">
                <div class="recipe_details_top">
                    <div class="recipe_left">
                        <div class="recipe_img">
                            <img class="search_img" src="public/img/<? echo $recipe->getRecipePic(); ?>">
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
                <div class="recipe_details_bottom">   
                    <h1>Sposób przygotowania:</h1>
                    <p><? echo $recipe->getDescription() ?></p>                     
                </div>
            </div>
            <div class="recipe_details_right">
                <h1>Składniki:</h1>
                <p><? echo $recipe->getIngredients() ?></p>
            </div>
        </div>
        
        <div class="comments">
        <?php foreach ($comments as $comment): ?>
            <div class="comment">
                <div class="comment_left">
                    <img class="comment_img" src="public/img/<? echo $comment->getProfile_picture(); ?>">
                </div>
                <div class="comment_right">
                    <div class="comment_top">
                        <div class="comment_top_side">
                            <h1><?= $comment->getCommenter() ?></h1>
                        </div>
                        <div class="comment_top_side">
                            <p><?= $comment->getDate() ?></p>
                        </div>
                    </div>
                    <div class="comment_bottom">
                        <p><?= $comment->getComment() ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
       
        <div class="add_comment">
            <form action="add_comment" class="add_comment_form" method="post">
                <div class="add_comment_div">
                    <textarea name="user_comment" id="user_comment" placeholder="Napisz komentarz" required></textarea>
                    <input type="hidden" id="recipe_id" name="recipe_id" value="<? echo $recipe->getRecipeID() ?>">
                </div>
                <button class="click-button">Dodaj komentarz</button>
            </form>
        </div>
    </div>
</body>
