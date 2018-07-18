<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao.php");

	$id = $_GET["id"];

	$query ="SELECT Copia_Fatura, Contrato_Protocolo FROM software WHERE idSoftware = '".$id."'";  
	$resultado = mysql_query($query);  
	$linhas = mysql_fetch_array($resultado);
	
	// Verifica se foi selecionado cópia da fatura ou ficheiro de configuração
	if(($linhas['Copia_Fatura'] == NULL) and ($linhas['Contrato_Protocolo'] == NULL)){
		//echo "sem pdf e zip";
			
		$query_Delete = mysql_query("DELETE FROM software WHERE idSoftware = $id");
		echo "
			<script type=\"text/javascript\">
				alert('Software removido com sucesso!'); 
				window.location.replace('software_Listar.php'); </script>
			</script>
		";
	
	}else{
		
		
		$sql = mysql_query("SELECT Copia_Fatura, Contrato_Protocolo FROM software WHERE idSoftware = '".$id."'");
		$img = mysql_fetch_object($sql);
			 
		// Remove o registo da base de dados
		$sql = mysql_query("DELETE FROM software WHERE idSoftware = '".$id."'");
		
		 
		if(($linhas['Copia_Fatura'] != NULL)){
			unlink("Anexos_Software/".$img->Copia_Fatura."");
		}
		
		if(($linhas['Contrato_Protocolo'] != NULL)){
			unlink("Anexos_Software/".$img->Contrato_Protocolo."");
		}
		 
		/* 
		// Remove imagem da pasta das fotos/
		unlink("Anexos_Software/".$img->Copia_Fatura."");
		unlink("Anexos_Software/".$img->Contrato_Protocolo."");
		
		*/
		echo "
			<script type=\"text/javascript\">
			alert('Removido com sucesso!'); 
			window.location.replace('software_Listar.php'); </script>
			</script>
		";
	}
	
?>