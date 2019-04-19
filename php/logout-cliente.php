<?php
session_start();
 
if(isset($_SESSION['ID_Cliente'])) {
    session_destroy();
    unset($_SESSION['ID_Cliente']);
    unset($_SESSION['usuario']);
    header("Location: ../index.php");
} else {
    header("Location: ../index.php");
}
?>
