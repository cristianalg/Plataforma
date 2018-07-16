<?php

		include_once("conexao.php");

		$iddepartamento = $_REQUEST['iddepartamento'];
		
		//Vai buscar os departamentos à tabela posto de trabalho
		$query_posto_trabalho = "SELECT * FROM registo_postos_trabalho WHERE Departamento_idDepartamento = $iddepartamento ORDER BY Cargo";
		$resultado_posto_trabalho = mysql_query($query_posto_trabalho);
	
 
		while($linha = mysql_fetch_array($resultado_posto_trabalho)){
		   $var_idReq = $linha["Requerente_idRequerente"];
		
		
		//Vai buscar o Id do requerente à tabela posto de trabalho
		//$var_idReq = $resultado_posto_trabalho['Requerente_idRequerente']; 
		
		//Vai buscar o Nome do requerente à tabela dos requerentes
		$result_Nome_Req ="SELECT idRequerente, Nome_Requerente  FROM requerente WHERE idRequerente = $var_idReq ORDER BY Nome_Requerente";
		$resultado_Nome_Req = mysql_query($result_Nome_Req);
		while ($row_requerente = mysql_fetch_assoc($resultado_Nome_Req) ) {
			$requerente_post[] = array(
				'idRequerente'	=> $row_requerente['idRequerente'],
				'Nome_Requerente' =>($row_requerente['Nome_Requerente']),
			);
		}
	}
		echo(json_encode($requerente_post)); //vai buscar o requerente
	

?>


