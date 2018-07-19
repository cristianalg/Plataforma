<?php
	
	include_once("conexao.php");

	$idtipo_equipamento = $_REQUEST['idtipo_equipamento'];
	
	$result_req = "SELECT * FROM equipamentos WHERE Tipo_Equipamento_idTipo_Equipamento = $idtipo_equipamento ORDER BY Nome_Equipamento";
	$resultado_req = mysql_query($result_req);
	
	while ($row_requerente = mysql_fetch_assoc($resultado_req) ) {
		$requerente_post[] = array(
			'idEquipamentos'	=> $row_requerente['idEquipamentos'],
			'Nome_Equipamento' => ($row_requerente['Nome_Equipamento']),
		);
	}
	
	echo(json_encode($requerente_post)); //vai buscar o requerente

?>


