$sql = 'SELECT L. ID_Lote, L.barco, L.zona_captura, L.producto, L.tamanio, L.peso, L.precio_salida, L.precio_minimo, L.imagen, S.fecha, L.ID_Subasta
		FROM Lote L INNER JOIN Subasta S ON L.ID_Subasta=S.ID_Subasta INNER JOIN Cliente C ON C.ID_Lonja = S.ID_Lonja
		WHERE L.ID_Admin IS NOT NULL AND L.ID_Subasta IS NOT NULL AND S.realizada=0 AND S.actual=0 AND C.ID_Cliente = ' . $_SESSION['ID_Cliente'] . '';
