<?php
//session_start();
if(isset($_SESSION['session_id'])){
    ?>
    <div id="navbar" class="navbar-collapse collapse">
    <form class="navbar-form navbar-right" action="feedback/feedback.php">
    <button type="submit" class="btn btn-success">Feedback</button>
    </form>
    </div>
    <?php
}  
else{ 
}
?>