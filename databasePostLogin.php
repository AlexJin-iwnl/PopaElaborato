<?php
    session_start();
    $servername = "127.0.0.1:3306";
    $username = $_SESSION['ruolo'];
    $password = "";
    $databasename = "elaborato";

    // Create connection
    $connessione = mysqli_connect($servername, $username, $password, $databasename);

    // Check connection
    if ($connessione==false) {
        die("Connection failed: " . mysqli_error($connessione));
        mysqli_close($connessione);
    }else{
       //echo "Connected successfully";
    }
?>