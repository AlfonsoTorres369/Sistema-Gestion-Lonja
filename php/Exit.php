<?php
session_start();
include_once "Conexion.php";
if($_SESSION['expirada']){
    echo "SALIR";
}
else{
    echo "COMPRAR";
}
?>