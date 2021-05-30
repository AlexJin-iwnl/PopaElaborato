<?php
session_start();
//print_r($_SESSION);
if(isset($_SESSION['ruolo'])){
    //print_r($_SESSION);
    if($_SESSION['ruolo']=='Insegnante') {
        ?>
        <div id="navbar" class="navbar-collapse collapse">
        <form class="navbar-form navbar-right" action="formCreateProgetto.php">
        <button type="submit" class="btn btn-success">Crea Progetto</button>
        </form>
        </div>
        <?php
    }
}
else{
    //print_r($_SESSION);
}
?>