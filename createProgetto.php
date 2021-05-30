<?php
require_once('databasePostLogin.php');
$msg="";

if (isset($_POST['crea'])) {
    $nomeProgetto = $_POST['nomeProgetto'] ?? '';
    $descrizione = $_POST['descrizione'] ?? '';
    $posti = $_POST['posti'] ?? '';
    $creatore=$_SESSION['session_user'];
    $query = "
        INSERT INTO projects (nomeProgetto,descrizione,postiDisponibili,nomeCreatore)
        VALUES ('$nomeProgetto', '$descrizione','$posti','$creatore')
        ";
    $risultato_insert = mysqli_query($connessione,$query);
    if ($risultato_insert === TRUE) {
        //$msg = 'Progetto Creato con successo';
        //echo "<br>" . $msg . "<br><a href='home.php'>vai home page</a>";
        header('Location:/home.php');
    } else {
        $msg = 'Problemi con l\'inserimento dei dati';
            echo "<br>" . $msg . "<br><a href='home.php'>torna indietro</a>";
        }
}