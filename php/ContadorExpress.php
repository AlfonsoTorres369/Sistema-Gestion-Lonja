<?php
session_start();
include_once 'Conexion.php';

$fecha = getdate();
$comenzar = false;
$sentencia;

$subasta= mysqli_query($con, "SELECT ID_Subasta, precio_actual, YEAR(fecha), MONTH(fecha), DAY(fecha), HOUR(fecha), MINUTE(fecha), SECOND(fecha) FROM Subasta WHERE ID_Subasta=".$_SESSION['subasta']);
$subastarow= mysqli_fetch_array($subasta);
$lote= mysqli_query($con, "SELECT precio_minimo FROM lote WHERE ID_Subasta=".$subastarow['ID_Subasta']);
$loterow= mysqli_fetch_array($lote);
if($subastarow['YEAR(fecha)']==$fecha['year'] && $subastarow['MONTH(fecha)']==$fecha['mon'] && $subastarow['DAY(fecha)']==$fecha['mday'] && $subastarow['HOUR(fecha)']==$fecha['hours'] && $subastarow['MINUTE(fecha)']==$fecha['minutes']){
    $comenzar=true;
    $comenzar1=mysqli_query($con, "UPDATE Subasta SET actual=true, realizada=false WHERE ID_Subasta=".$_SESSION['subasta']);
}


if($comenzar==true && $subastarow['precio_actual']>1){
    
    $update= mysqli_query($con,"UPDATE Subasta SET precio_actual=".$subastarow['precio_actual']."-1 WHERE ID_Subasta=".$subastarow['ID_Subasta']);
    $consulta= mysqli_query($con, "SELECT * FROM Subasta WHERE actual=true");
    $row= mysqli_fetch_array($consulta);
    echo $row['precio_actual']."€";
}elseif($comenzar==false)
{
    echo $subastarow['precio_actual']."€";
}

if($subastarow['precio_actual']==1){
    $acabada= mysqli_query($con, "UPDATE Subasta VALUE SET actual=false, realizada=true, express_no=true WHERE ID_Subasta=".$subastarow['ID_Subasta']);
    $acabada1= mysqli_query($con, "UPDATE lote VALUE SET subastado=true WHERE ID_Subasta=".$subastarow['ID_Subasta']);
    $_SESSION['expirada']=true;
    echo "SUBASTA TERMINADA";
    
}
?>