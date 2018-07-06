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
?>



<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		
		// if (mysql_affected_rows() != 0 ){	
			// echo "
				// <script type=\"text/javascript\">
						// alert('Removido com sucesso!'); 
						 // window.location.replace('office_Listar.php'); </script>
				// </script>
			// ";	
				
				   
		// }
		 // else{ 	
				// echo "
				// <script type=\"text/javascript\">
						// alert('Não removido!'); 
						 // window.location.replace('office_Listar.php'); </script>
				// </script>
			// ";		   

		// }
//mysql_query($query) OR DIE(mysql_error());
		?>
	</body>
</html>