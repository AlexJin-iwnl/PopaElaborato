<!DOCTYPE html>
<html>
    <head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <title>Home Page</title>
        <script src ="ajaxFeedback.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    </head>
    <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Projects</a>
        </div>
        <form class="navbar-form navbar-right" action="../home.php">
        <button type="submit" class="btn btn-success">Home</button>
        </form>
      </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
<?php

if(!isset($_SESSION))
    require_once('../databasePostLogin.php');
//print_r($_SESSION);
if(isset($_SESSION['ruolo'])){
    //print_r($_SESSION);
    if($_SESSION['ruolo']=='Insegnante') {
        
        
        $nome=$_SESSION['session_user'];
        //echo $nome;
        $query = "
                SELECT DISTINCT *
                FROM projectsFeedback 
                JOIN projects
                ON projectsFeedback.idProjects=projects.id
                WHERE nomeCreatore='$nome'
                GROUP BY idProjects
            ";
        //echo $query;
        $ris = mysqli_query($connessione, $query);
        echo (mysqli_error($connessione));
        //$conta=0;
        while($array=mysqli_fetch_array($ris,MYSQLI_ASSOC)){
            ?>
            <div class="col-md-12" style="border: 1px solid black;margin:1vh;width:80%;">
            <?php
            $id=$array['id'];
            echo "<h2>".$array['nomeProgetto']."</h2>";
            echo "<p>Descrizione: ".$array['descrizione']."</p>";
            echo '<select name="studenti" id="studenti'.$id.'">';
            $query = "
            SELECT idProjects,usernameUtente FROM projectsFeedback WHERE idProjects=$id;
            ";
            //echo $query;
            $risStudenti = mysqli_query($connessione, $query);
            echo (mysqli_error($connessione));
            while($array2=mysqli_fetch_array($risStudenti,MYSQLI_ASSOC)){
                echo "<option value=".$array2['usernameUtente'].">".$array2['usernameUtente']."</option>";
            }
            echo '</select>';
            echo "<br>";
            echo "<br>";
            echo '<input type="text" id="descrizione'.$id.'" placeholder="Feedback" name="descrizione" maxlength="500" required>';
            echo "<br>";
            echo "<br>";
            echo '<label for="voto">Voto (1-10):</label>';
            echo '<input type="number" id="voto'.$id.'" name="posti"min="1" max="10">';
            echo "<br>";
            echo "<br>";
            //if($array['votoProgetto']==""){
            echo "<button type='submit' class='addVoto' value='$id'>Add Mark</button>";
            echo "<br>";
            echo "<br>";
            //}
            //else{
               // echo "<button type='submit' class='modificaVoto' value='$id'>Update Mark</button>";
            //}
            echo "</div>";
        }
    }
    else{
        $nome=$_SESSION['session_user'];
        //echo $nome;
        $query = "
                SELECT DISTINCT *
                FROM projectsFeedback 
                JOIN projects
                ON projectsFeedback.idProjects=projects.id
                WHERE usernameUtente='$nome'
                GROUP BY idProjects
            ";
        //echo $query;
        $ris = mysqli_query($connessione, $query);
        echo (mysqli_error($connessione));
        $conta=0;
        while($array=mysqli_fetch_array($ris,MYSQLI_ASSOC)){
            ?>
            <div class="col-md-12" style="border: 1px solid black;margin:2vh; width:80%;">
            <?php
            $id=$array['id'];
            $voto=$array['votoProgetto'];
            $feedback=$array['feedback'];
            echo "<h2>".$array['nomeProgetto']."</h2>";
            echo "<p>Descrizione: ".$array['descrizione']."</p>";
            if($voto=="" AND $feedback==""){
                echo "<br>";
                //echo '<label for="voto">Voto e Feedback:</label>';
                //echo '<input style="width:50vw;;" type="text" id="country" name="voto" value="Il tuo voto e feedback non sono ancora stati assegnati per questo progetto" readonly>';
                echo '<p  id="country" style="font-weight: bold;" name="voto" value="Il tuo voto e feedback non sono ancora stati assegnati per questo progetto">Voto e Feedback: Il tuo voto e feedback non sono ancora stati assegnati per questo progetto</p>';
                //echo "<br>";
                //echo "<br>";
            }
            else{
                //echo '<label for="voto">Voto:</label>';
                echo '<p  id="country" style="font-weight: bold;" name="voto" value="'.$voto.'">Voto: '.$voto.'</p>';
                //echo '<input type="text" id="country" name="voto" value="'.$voto.'" readonly>';
                //echo '<label for="voto">Feedback:</label>';
                echo '<p  id="country" style="font-weight: bold;" name="voto" value="'.$feedback.'">Feedback: '.$feedback.'</p>';
                //echo '<input style="width:auto;padding:auto;" type="text" id="country" name="voto" value="'.$feedback.'" readonly>';
                //echo "<br>";
                //echo "<br>";
            }
            echo "</div>";
        }
    }
}
else{
    //print_r($_SESSION);
}
?>