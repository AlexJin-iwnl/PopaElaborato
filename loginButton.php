<?php
//session_start();
//print_r($_SESSION);
if(isset($_SESSION['session_id'])){
    //echo "Benvuto, ".$_SESSION['session_user'];
    ?>
    <div id="navbar" class="navbar-collapse collapse">
    <form class="navbar-form navbar-right" action="">
    <button type="submit"  id="logOut">Log Out</button>
    </form>
    </div>
    <?php
}  
else{
    ?>
    <div id="navbar" class="navbar-collapse collapse">
    <form class="navbar-form navbar-right" action="./loginForm.php">
    <button type="submit" class="btn btn-success">Sign in</button>
    </form>
    </div>
    <?php
}
?>