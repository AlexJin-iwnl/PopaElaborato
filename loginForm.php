<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        
        <form method="post" action="./php/login.php">
            <h1>Login</h1>
            <input type="text" id="username" placeholder="Username" name="username" maxlength="50" required>
            <input type="password" id="password" placeholder="Password" name="password">
            <button type="submit" name="login">Accedi</button>
            <br>
            <br>
            <a href="./register2.php">Clicca qui se non hai ancora un account, registrati qui</a>
            <br>
            <br>
            <a href="./home.php">Clicca qui Per tornare alla schermata iniziale</a>
        </form>
    </body>
</html>
