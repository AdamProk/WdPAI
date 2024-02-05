<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/recipes.css">
    <link rel="stylesheet" type="text/css" href="public/css/addrecipe.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/public/js/redirecting.js" defer></script>
    <script src="/public/js/script.js" defer></script>
    <title>Add recipe</title>
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
        <div class="add_recipe">
            <form action="addRecipe" method="POST" ENCTYPE="multipart/form-data">
                <input type="text" name="recipe_name" placeholder="Nazwa">
                <textarea name="description" placeholder="Sposób przygotowania"></textarea>
                <textarea name="ingredients" placeholder="Składniki"></textarea>
                <input type="number" name="prep_time" placeholder="Czas przygotowania">
                <input type="number" name="amount" placeholder="Liczba porcji">
                <input type="file" name="file" >
                <button type="submit" class="click-button">Dodaj</button>
                <?php if(isset($messages)){
                        foreach($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
            </form>
        </div>
    </div>
</body>