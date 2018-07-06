<?php
	
	include_once("conexao.php");

	$idtipo_requerente = $_REQUEST['idtipo_requerente'];
	
	$result_req = "SELECT * FROM requerente WHERE Tipo_Requerente_idTipo_Requerente = $idtipo_requerente ORDER BY Nome_Requerente";
	$resultado_req = mysql_query($result_req);
	
	while ($row_requerente = mysql_fetch_assoc($resultado_req) ) {
		$requerente_post[] = array(
			'idRequerente'	=> $row_requerente['idRequerente'],
			'Nome_Requerente' => utf8_encode($row_requerente['Nome_Requerente']),
		);
	}
	
	echo(json_encode($requerente_post)); //vai buscar o requerente

?>


