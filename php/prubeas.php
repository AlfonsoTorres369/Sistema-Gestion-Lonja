<?php
include_once 'Conexion.php';
$_SESSION['ID_Cliente']=1;
$sql_desc='SELECT num_desc, fecha_ult_comp FROM Descuentos WHERE ID_Cliente='.$_SESSION['ID_Cliente'].'';
	$result_desc=mysqli_query($con, $sql_desc);
	if(false==$result_desc){
		printf("\n error: %s\n", mysqli_error($con));
	}
	$row_desc=mysqli_fetch_assoc($result_desc);
	$fecha_act=date("Y-m-d");
	$fecha_comp=$row_desc["fecha_ult_comp"];
	$num_desc=$row_desc["num_desc"];
	$precio_actual=100;
	if((strtotime($fecha_act)>=strtotime($fecha_comp))&&(strtotime($fecha_act)<=strtotime($fecha_comp."+ 1 month"))){
		if($num_desc==3){
			$precio_actual=$precio_actual-($precio_actual*0.15);
			$sql_act="UPDATE Descuentos SET num_desc=2, fecha_ult_comp='".$fecha_act."' WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'";
			$res_act=mysqli_query($con, $sql_act);
			if(false==$res_act){
				printf("error1: $s", mysqli_error($con));
			}
		}
		if($num_desc==2){
			$precio_actual=$precio_actual-($precio_actual*0.10);
			$sql_act="UPDATE Descuentos SET num_desc=1, fecha_ult_comp='".$fecha_act."' WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'";
			$res_act=mysqli_query($con, $sql_act);
			if(false==$res_act){
				printf("error2: $s", mysqli_error($con));
			}
		}
		if($num_desc==1){
			$precio_actual=$precio_actual-($precio_actual*0.05);
			$sql_act="UPDATE Descuentos SET num_desc=0, fecha_ult_comp='".$fecha_act."' WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'";
			$res_act=mysqli_query($con, $sql_act);
			if(false==$res_act){
				printf("error3: $s", mysqli_error($con));
			}
		}
	}
	else if(strtotime($fecha_act)>strtotime($fecha_comp."+ 1 month")){
		$mes_anterior=date("Y-m-d",strtotime($fecha_act."- 1 month"));
		$sql_comp="SELECT COUNT(*) FROM Participa P INNER JOIN Subasta S ON P.ID_Subasta=S.ID_Subasta INNER JOIN Lote L ON P.ID_Subasta=L.ID_Subasta WHERE P.ID_Cliente='".$_SESSION['ID_Cliente']."' 
		AND S.fecha BETWEEN '".$mes_anterior."' AND '".$fecha_act."'";
		$res_comp=mysqli_query($con,$sql_comp);
		if($res_comp==false){
			printf("error4: %s", mysqli_error($con));
		}
		$row_comp=mysqli_fetch_assoc($res_comp);
		if($row_comp["COUNT(*)"]>1){
			$sql_act="UPDATE Descuentos SET num_desc=2, fecha_ult_comp='".$fecha_act."' WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'";
			$res_act=mysqli_query($con, $sql_act);
			if(false==$res_act){
				printf("error5: $s", mysqli_error($con));
			}
			$precio_actual=$precio_actual-($precio_actual*0.15);
		}else{
			$sql_act="UPDATE Descuentos SET num_desc=0, fecha_ult_comp='".$fecha_act."' WHERE ID_Cliente='".$_SESSION['ID_Cliente']."'";
			$res_act=mysqli_query($con, $sql_act);
			if(false==$res_act){
				printf("error6: $s", mysqli_error($con));
			}
		}
	}
	$sql_buy="SELECT COUNT(*) FROM Participa P INNER JOIN Subasta S ON P.ID_Subasta=S.ID_Subasta INNER JOIN Lote L ON P.ID_Subasta=L.ID_Subasta WHERE P.ID_Cliente='".$_SESSION['ID_Cliente']."' 
		AND S.fecha='".$fecha_act."'";
	$res_buy=mysqli_query($con,$sql_buy);
	if($res_buy==false){
		printf("error7: %s", mysqli_error($con));
	}
	$row_buy=mysqli_fetch_assoc($res_buy);
	if($row_buy["COUNT(*)"]>5){
		$precio_actual=$precio_actual-($precio_actual*0.05);
	}	

	
?>
