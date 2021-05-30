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
            SELECT User FROM mysql.user;
        ";
        
    $risultato_select = mysqli_query($connessione, $query);
    if(mysqli_affected_rows($connessione)>0){
        ?>
        <select name="menu2">
        <?php
        while($array=mysqli_fetch_array($risultato_select,MYSQLI_ASSOC)){
            ?>
            <?php
            if($array['User']!="Admin" && $array['User']!="root" && $array['User']!="pma"){
                echo "<option value=".$array['User'].">".$array['User']."</option>";
            }
        }
        echo "</select>";
    }
}
mysqli_close($connessione);
?>