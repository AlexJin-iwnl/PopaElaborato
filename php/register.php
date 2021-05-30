<?php
require_once('database.php');
$msg="";
$conta = 0;

if (isset($_POST['register'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $ruolo = $_POST['menu2'] ?? '';
    $isUsernameValid = filter_var(
        $username,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );

    $password = trim(filter_var($password, FILTER_SANITIZE_STRING));
    $pwdLenght = mb_strlen($password);
    
    if (empty($username) || empty($password)) {
        $msg = 'Compila tutti i campi';
        echo "<br>" . $msg . "<br><a href='../register.html'>torna indietro</a>";
    } else if (false === $isUsernameValid) {
            $msg = 'Lo username non è valido. Sono ammessi solamente caratteri 
                    alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.
                    Lunghezza massima 20 caratteri';
            echo "<br>" . $msg . "<br><a href='../register.html'>torna indietro</a>";
        } else if ($pwdLenght < 8 || $pwdLenght > 20) {
                $msg = 'Lunghezza minima password 8 caratteri.
                        Lunghezza massima 20 caratteri';
                        echo "<br>" . $msg . "<br><a href='../register.html'>torna indietro</a>";
            } else {
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                $query = "
                    SELECT username 
                    FROM users
                ";
                $risultato_select = mysqli_query($connessione, $query);
                while($array=mysqli_fetch_array($risultato_select,MYSQLI_ASSOC)){
                    if (strcmp($array["username"],$isUsernameValid) == 0) {
                        $conta=1;
                    }  
                }
                if ($conta == 1) {
                    $msg = 'Username già in uso';
                    echo "<br>" . $msg . "<br><a href='../register2.php'>torna indietro</a>";
                } else {
                    $sql = "
                        INSERT INTO users (username,password,email,ruolo)
                        VALUES (?, ?, ?, ?)
                    ";
                    $stmt = $connessione->prepare($sql);
                    $stmt->bind_param("ssss", $isUsernameValid, $password_hash, $email,$ruolo);
                    $risultato_insert=$stmt->execute();
                    $stmt->close();
                    if ($risultato_insert === TRUE) {
                        //$msg = 'Registrazione eseguita con successo';
                        //echo "<br>" . $msg . "<br><a href='../login.html'>vai alla pagina login</a>";
                        header('Location: ../loginForm.php');
                    } else {
                        $msg = 'Problemi con l\'inserimento dei dati';
                        echo "<br>" . $msg . "<br><a href='../register2.php'>torna indietro</a>";
                    }
                }
            }
}