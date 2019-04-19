<?php
session_start();
 
if(isset($_SESSION['ID_Admin'])) {
    session_destroy();
    unset($_SESSION['ID_Admin']);
    unset($_SESSION['nombre']);
    header("Location: ../index.php");
} else {
    header("Location: ../index.php");
}
?>
