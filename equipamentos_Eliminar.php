<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao.php");

	$id = $_GET["id"];

	$query ="SELECT Copia_Fatura, Ficheiro_Configuracao FROM equipamentos WHERE idEquipamentos = '".$id."'";  
	$resultado = mysql_query($query);  
	$linhas = mysql_fetch_array($resultado);
	
	$result = mysql_query("SELECT Equipamentos_idEquipamentos FROM requisicao_material WHERE Equipamentos_idEquipamentos ='$id'");
	$dados = mysql_fetch_assoc($result);
	$var_id = $dados['Equipamentos_idEquipamentos'];
	
	
	
		if ($var_id > 0){ 
					  
				echo "
					<script type=\"text/javascript\">
						alert('Não pode eliminar este equipamento porque existe uma requisição de material associada a ele.'); 
						window.location.replace('equipamentos_Listar.php'); </script>
					</script>
				";	
			} 
			else{
	
	
	
	// Verifica se foi selecionado cópia da fatura ou ficheiro de configuração
	if(($linhas['Copia_Fatura'] == NULL) and ($linhas['Ficheiro_Configuracao'] == NULL)){
		//echo "sem pdf e zip";
			
		$query_Delete = mysql_query("DELETE FROM equipamentos WHERE idEquipamentos = $id");
		echo "
			<script type=\"text/javascript\">
				alert('Equipamentos removido com sucesso!'); 
				window.location.replace('equipamentos_Listar.php'); </script>
			</script>
		";
	
	}else{
		
		
			
		
				
		
					
		
				$sql = mysql_query("SELECT Copia_Fatura, Ficheiro_Configuracao FROM equipamentos WHERE idEquipamentos = '".$id."'");
				$img = mysql_fetch_object($sql);
					 
				// Remove o registo da base de dados
				$sql = mysql_query("DELETE FROM equipamentos WHERE idEquipamentos = '".$id."'");
				 
				// Remove imagem da pasta das fotos/
				/*unlink("Anexos_Equipamentos/".$img->Copia_Fatura."");
				unlink("Anexos_Equipamentos/".$img->Ficheiro_Configuracao."");*/
				
				if(($linhas['Copia_Fatura'] != NULL)){
					unlink("Anexos_Equipamentos/".$img->Copia_Fatura."");
				}
				
				if(($linhas['Ficheiro_Configuracao'] != NULL)){
					unlink("Anexos_Equipamentos/".$img->Ficheiro_Configuracao."");
				}
				 
				
				echo "
					<script type=\"text/javascript\">
					alert('Removido com sucesso!'); 
					window.location.replace('equipamentos_Listar.php'); </script>
					</script>
				";
			
		
		
		
	}
			}
?>