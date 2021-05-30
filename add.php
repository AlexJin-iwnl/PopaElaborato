<?php
    require_once('databasePostLogin.php');
    echo $_SESSION['ruolo'];
    if(isset($_SESSION['ruolo'])){
        //require_once('databasePostLogin.php');
        
        $id=$_POST['idProgettoSelezionato'];
        //echo $id;
        $query = "
                SELECT *
                FROM projects WHERE id='$id'
            ";
        $risultato_select = mysqli_query($connessione, $query);
        if(mysqli_affected_rows($connessione)>0){
            if(isset($_SESSION['ruolo']) && $_SESSION['ruolo']=='Studente'){
                while($array=mysqli_fetch_array($risultato_select,MYSQLI_ASSOC)){
                    $postiOccupati=$array["postiOccupati"];
                    $postiOccupati++;
                    //echo $postiOccupati;
                    //echo $id;
                    //if($postiOccupati>$array["postiDisponibili"]))
                    $nomeUtente=$_SESSION['session_user'];
                    $query = "
                        SELECT usernameUtente
                        FROM projectsFeedback WHERE usernameUtente='$nomeUtente' AND idProjects=$id
                    ";
                    //echo $query;
                    //
                    $c= mysqli_query($connessione, $query);
                    //echo("Error description: " . mysqli_error($connessione));
                    //$tot=mysqli_affected_rows($connessione);
                    //echo $tot;
                    if (mysqli_affected_rows($connessione)==0) {
                        //echo "afsaaa";
                        $query2 = "
                            UPDATE projects
                            SET postiOccupati=$postiOccupati WHERE id=$id
                        ";
                        //echo $query2;
                        $a= mysqli_query($connessione, $query2);
                        echo("Error description: " . mysqli_error($connessione));
                        $query3 = "
                            INSERT INTO projectsFeedback(usernameUtente,idProjects)
                            VALUES ('$nomeUtente',$id);
                            ";
                        $b= mysqli_query($connessione, $query3);
                        //echo("Error description: " . mysqli_error($connessione));
                    }  
                    else{
                        echo "Studente già presente nel progetto";
                    }
                }
            }
            else{
                $nomeUtente=$_SESSION['session_user'];
                $queryIniziale= "SET FOREIGN_KEY_CHECKS=0";
                $queryFinale= "SET FOREIGN_KEY_CHECKS=1";
                $a= mysqli_query($connessione, $queryIniziale);
                $query = "
                    DELETE FROM projects
                    WHERE id=$id
                ";
                echo $query;
            //
            $b= mysqli_query($connessione, $query);
            echo mysqli_error($connessione);
            $c=mysqli_query($connessione, $queryFinale);
            }
        }
    mysqli_close($connessione);
    }

?>