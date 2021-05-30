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
        //$query = "SELECT username, passwordROM users WHERE username = ?";
        //$query2="SELECT ruolo FROM users WHERE username='$username'";
        //$query3="SELECT ruolo FROM users WHERE username = ? ";
        $sql = "SELECT ruolo FROM users WHERE username = ?"; // SQL with parameters
        $stmt = $connessione->prepare($sql); 
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        $user = $result->fetch_assoc(); // fetch data  
        if(mysqli_stmt_affected_rows($stmt)!=0){
            $ruolo=$user["ruolo"];
        }
        //print_r($user);
        $sql2 = "SELECT username, password FROM users WHERE username = ?"; // SQL with parameters
        $stmt2 = $connessione->prepare($sql2); 
        $stmt2->bind_param("s", $username);
        $stmt2->execute();
        $result = $stmt2->get_result(); // get the mysqli result
        $userPsw = $result->fetch_assoc(); // fetch data  
        if(mysqli_stmt_affected_rows($stmt2)!=0){
            $array=$userPsw;
            if ($array["username"]!=$username || password_verify($password, $array['password']) === false) {
                $conta=1;
            }  
        }
        else{
            $conta=1;
        }
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