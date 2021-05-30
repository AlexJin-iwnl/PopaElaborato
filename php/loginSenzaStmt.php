<?php
session_start();
require_once('database.php');

$msg="";
$conta = 0;

if (isset($_SESSION['session_id'])) {
    header('Location: ../home.php');
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $msg = 'Inserisci username e password';
        echo "<br>" . $msg . "<br><a href='../loginForm.php'>torna indietro</a>";
    } else {
        $query = "
            SELECT username, password
            FROM users WHERE username = '$username'
        ";
        $query2="SELECT ruolo FROM users WHERE username='$username'";
        //echo $query2;
        $risultato_select = mysqli_query($connessione, $query2);
        while($array=mysqli_fetch_array($risultato_select,MYSQLI_ASSOC)){
            $ruolo=$array["ruolo"];
        }
        $ris=mysqli_query($connessione, $query);
        if(mysqli_affected_rows($connessione)>0){
        while($array2=mysqli_fetch_array($ris,MYSQLI_ASSOC)){
            if ($array2["username"]!=$username || password_verify($password, $array2['password']) === false) {
                $conta=1;
            }  
        }
        }
        else {
            $conta=1;
        }
        //echo $conta;
        if ($conta==1) {
            $msg = 'Credenziali utente errate';
            echo "<br>" . $msg . "<br><a href='../loginForm.php'>torna indietro</a>";
        } else {
            //$msg = 'Login effettuato con successo';
            //echo "<br>" . $msg . "<br><a href='../home.php'>Vai alla Home</a>";
            session_regenerate_id();
            $_SESSION['session_id'] = session_id();
            $_SESSION['ruolo'] = $ruolo;
            $_SESSION['session_user'] = $_POST['username'];
            header('Location: ../home.php');
            exit;
        }
    }
}