<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="/public/js/script.js" defer></script>
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img id="img" src="public/img/logo.svg">
        </div>
        <div class="Message">
            <h1>Rejestracja</h1>
        </div>
        <div class="login-container">
            <form class="signup" action="signup" method="POST">
                <input name="username" type="text" placeholder="wpisz nazwę użytkownika" required>
                <input name="email" type="email" placeholder="wpisz adres email" required>
                <input name="password" type="password" placeholder="wpisz hasło" required>
                <input name="repeat_password" type="password" placeholder="powtórz hasło" required>
                <button class ="click-button" type="submit">Utworz konto</button>
                <div class='messages'>
                    <?php if(isset($messages)){
                        foreach($messages as $message){
                            echo $message;
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
        <div id="move_login">
            <button class="click-button" onclick="redirectToLogin()">Login</button>
        </div>
    </div>
    <script>
</script>
</body>