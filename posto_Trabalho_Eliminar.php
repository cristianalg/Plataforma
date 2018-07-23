<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");
?>

<?php
	$id = $_GET["id"];

	$query ="SELECT anexo FROM registo_postos_trabalho WHERE idRegisto_Postos_Trabalho = '".$id."'";  
	$resultado = mysql_query($query);  
	$linhas = mysql_fetch_array($resultado);
	
	$result_soft = mysql_query("SELECT Registo_Postos_Trabalho_idRegisto_Postos_Trabalho FROM software WHERE Registo_Postos_Trabalho_idRegisto_Postos_Trabalho ='$id'");	
	$dados_soft = mysql_fetch_assoc($result_soft);
	$var_id_soft = $dados_soft['Registo_Postos_Trabalho_idRegisto_Postos_Trabalho'];	
	
	$result_equi = mysql_query("SELECT Registo_Postos_Trabalho_idRegisto_Postos_Trabalho FROM equipamentos WHERE Registo_Postos_Trabalho_idRegisto_Postos_Trabalho ='$id'");
	$dados_equi = mysql_fetch_assoc($result_equi);
	$var_id_equi = $dados_equi['Registo_Postos_Trabalho_idRegisto_Postos_Trabalho'];	
				
	if (($var_id_soft > 0) or ($var_id_equi > 0)){ 
					  
		echo "
			<script type=\"text/javascript\">
				alert('Não pode eliminar este posto de trabalho porque existem registos associados a ele.'); 
				window.location.replace('posto_Trabalho_Listar.php'); </script>
			</script>
		";	
	} 
	else{
		
		if($linhas['anexo'] == NULL){
			//echo "sem foto";
			$query_Delete = mysql_query("DELETE FROM registo_postos_trabalho WHERE idRegisto_Postos_Trabalho = $id");
				echo "
					<script type=\"text/javascript\">
					alert('Removido com sucesso, registo sem foto!'); 
					window.location.replace('posto_Trabalho_Listar.php'); </script>
					</script>
				";
		}else{
			//echo "com foto";
			// Seleciona nome da foto
			$sql = mysql_query("SELECT anexo FROM registo_postos_trabalho WHERE idRegisto_Postos_Trabalho = '".$id."'");
			$img = mysql_fetch_object($sql);
				 
			// Remove o registo da base de dados
			$sql = mysql_query("DELETE FROM registo_postos_trabalho WHERE idRegisto_Postos_Trabalho = '".$id."'");
			 
			// Remove imagem da pasta das fotos/
			unlink("Anexos_Postos_Trabalho/".$img->anexo."");
			echo "
				<script type=\"text/javascript\">
				alert('Removido com sucesso, registo com foto!'); 
				window.location.replace('posto_Trabalho_Listar.php'); </script>
				</script>
			";
		}
	}
	
?>
