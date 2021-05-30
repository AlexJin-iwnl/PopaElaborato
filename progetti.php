<?php
$servername = "127.0.0.1:3306";
$username = "root";
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
    $query = "
            SELECT *
            FROM projects
        ";
        
    $risultato_select = mysqli_query($connessione, $query);
    if(mysqli_affected_rows($connessione)>0){
        ?>
        <div class="row" id="row">
        <?php
        while($array=mysqli_fetch_array($risultato_select,MYSQLI_ASSOC)){
            ?>
            <div class="col-md-4 col-sm-12" style="width:48%;height:auto;">
            <?php
            echo "<h2>".$array['nomeProgetto']."</h2>";
            echo "<p>".$array['descrizione']."</p>";
            echo "<p style='padding-bottom:5vh;'>".$array['postiOccupati']."/".$array['postiDisponibili']."</p>";
            //<p><a class="btn btn-default" href="#" role="button">View details »</a></p>
            if(isset($_SESSION['ruolo']) && $_SESSION['ruolo']=='Studente'){
                if($array["postiOccupati"]<$array["postiDisponibili"]){
                    $id=$array['id'];
                    echo "<button type='submit' class='addAndDelete' value='$id'>Partecipate Project</button>";
                }
                else{
                        echo "<p>Posti esauriti</p>";
                    }
            }
            else{
                if(isset($_SESSION['ruolo'])){
                    $id=$array['id'];
                    if($array['nomeCreatore']==$_SESSION['session_user']){
                        echo "<button type='submit' class='addAndDelete' value='$id'>Delete Project</button>";
                    }
                }
            }
        echo "</div>";
        }
    echo "</div>"; 
    }
}
mysqli_close($connessione);
?>