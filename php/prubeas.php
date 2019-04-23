<?php
include_once "Conexion.php";
$sql_buy="SELECT COUNT(*) FROM   Subasta S  INNER JOIN Lote L ON S.ID_Subasta=L.ID_Subasta WHERE L.ID_Cliente='".$_SESSION['ID_Cliente']."' 
		AND S.fecha='".$fecha_act."'";
	$res_buy=mysqli_query($con,$sql_buy);
	if($res_buy==false){
		printf("error7: %s", mysqli_error($con));
	}
	$row_buy=mysqli_fetch_assoc($res_buy);
echo $row_buy['COUNT(*)'];
?>