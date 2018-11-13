<?php
if(isset($_POST['finalizar'])){
    session_destroy();
    header("refresh: 0;");
}

?>