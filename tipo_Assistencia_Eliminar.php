<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");
$id = $_GET["id"];
?>

<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			$result = mysql_query("SELECT Tipo_Assistencia_idTipo_Assistencia FROM assistencia_tecnica WHERE Tipo_Assistencia_idTipo_Assistencia ='$id'");
			
			$dados = mysql_fetch_assoc($result);
			$var_id = $dados['Tipo_Assistencia_idTipo_Assistencia'];	
		
				
			if ($var_id > 0){ 
					  
				echo "
					<script type=\"text/javascript\">
						alert('Não pode eliminar este tipo de assistência técnica porque existem assistências técnicas associadas a ele.'); 
						window.location.replace('tipo_Assistencia_Listar.php'); </script>
					</script>
				";	
			} 
			else{
				$sql = mysql_query("DELETE FROM tipo_assistencia WHERE idTipo_Assistencia = $id");
				echo "
					<script type=\"text/javascript\">
						alert('Removido com sucesso!'); 
						window.location.replace('tipo_Assistencia_Listar.php'); </script>
					</script>";
					
			}
		
		?>
	</body>
</html>