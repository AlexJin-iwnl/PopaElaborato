<?php
/*Elimina tutti i dati della sessione ma non elimina quelle che creo in pi�
session_destroy();
header('Location: ../login.html');
exit;
*/
?>



<?php
/*con la unset posso eliminare tutte le variabili di sessione create*/

if (isset($_SESSION['session_id'])) {
    unset($_SESSION['session_id']);
}
if (isset($_SESSION['session_user'])) {
    unset($_SESSION['session_user']);
}
session_destroy();
header('Location: ../login.html');
exit;
?>