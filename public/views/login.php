<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="/public/js/script.js" defer></script>
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img id="img" src="public/img/logo.svg">
        </div>
        
        
        <div class="Message">
            <h1>Logowanie</h1>
        </div>
        <div class="login-container">
            <form class="login" action="login" method="POST">
                <input name="email" type="text" placeholder="wpisz adres email">
                <input name="password" type="password" placeholder="wpisz hasło">
                <button class="click-button" type="submit">Zaloguj</button>
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
        <button class="click-button" onclick="redirectToAnotherSite()">Register </button>
        <div class="fill"></div>
    </div>
    <script>
</script>
</body>