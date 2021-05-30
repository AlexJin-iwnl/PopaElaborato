<!DOCTYPE html>
<html>
    <head>
        <title>Registrazione</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
        <link rel="stylesheet" href="./css/style.css">
    </head>
    <body>
        <form method="post" action="./php/register.php">
            <h1>Registrazione</h1>
            <input type="text" id="username" placeholder="Username" name="username" maxlength="50" required>
            <input type="email" id="email" placeholder="Email" name="email" maxlength="50" required>
            <input type="password" id="password" placeholder="Password" name="password" required>
            <input type="password" id="password" placeholder="Ripeti La Password" name="passwordVerify">
            <?php include 'userCreateOption.php';?>
            <br>
            <button type="submit" name="register">Registrati</button>
            <br>
            <br>
            <a href="./loginForm.php">Se hai già un account, loggati qui</a>
            <br>
            <br>
            <a href="./home.php">Clicca qui Per tornare alla schermata iniziale</a>
        </form>
        <!--js-->
        
    </body>
</html>