<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");
?>

<?php
	$id = $_GET["id"];

	$query ="SELECT foto FROM office WHERE idOffice = '".$id."'";  
	$resultado = mysql_query($query);  
	$linhas = mysql_fetch_array($resultado);
	
	if($linhas['foto'] == NULL){
		//echo "sem foto";
		$query_Delete = mysql_query("DELETE FROM office WHERE idOffice = $id");
			echo "
				<script type=\"text/javascript\">
				alert('Removido com sucesso, registo sem foto!'); 
				window.location.replace('office_Listar.php'); </script>
				</script>
			";
	}else{
		//echo "com foto";
		// Seleciona nome da foto
		$sql = mysql_query("SELECT foto FROM office WHERE idOffice = '".$id."'");
		$img = mysql_fetch_object($sql);
			 
		// Remove o registo da base de dados
		$sql = mysql_query("DELETE FROM office WHERE idOffice = '".$id."'");
		 
		// Remove imagem da pasta das fotos/
		unlink("Anexos_Office/".$img->foto."");
		echo "
			<script type=\"text/javascript\">
			alert('Removido com sucesso, registo com foto!'); 
			window.location.replace('office_Listar.php'); </script>
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