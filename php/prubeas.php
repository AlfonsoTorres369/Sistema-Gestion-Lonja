<?php
include_once 'Conexion.php';
$_SESSION['ID_Cliente']=15;
$sql_desc='SELECT num_desc, fecha_ult_comp FROM Descuentos WHERE ID_Cliente='.$_SESSION['ID_Cliente'].'';
	$result_desc=mysqli_query($con, $sql_desc);
	if(false==$result_desc){
		printf("\n error: %s\n", mysqli_error($con));
	}
	$row_desc=mysqli_fetch_assoc($result_desc);
	$fecha_act=date("Y-m-d");
	$fecha_comp=$row_desc["fecha_ult_comp"];
	$num_desc=$row["num_desc"];
	if(date("m",strtotime($fecha_act))==date("m",strtotime($fecha_comp))){
		
	}
?>
