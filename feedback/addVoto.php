<?php
    if(isset($_POST['studenti'])){
        require_once('../databasePostLogin.php');
        //session_start();
        $studente = $_POST['studenti'];
        $id =$_POST['idProgettoSelezionato'];
        $feedback=$_POST['feedback'];
        $voto=$_POST['voto'];
        if(isset($_POST['idProgettoSelezionato'])){
            $query = "
                    UPDATE projectsFeedback
                    SET votoProgetto='$voto', feedback='$feedback'
                    WHERE idProjects=$id AND usernameUtente='$studente'
                ";
            echo $query;
            $risultato_select = mysqli_query($connessione, $query);
            echo mysqli_error($connessione);
        }
}