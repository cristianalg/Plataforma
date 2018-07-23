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
		
			$result = mysql_query("SELECT Estado_idEstado FROM assistencia_tecnica WHERE Estado_idEstado ='$id'");
			
			$dados = mysql_fetch_assoc($result);
			$var_id = $dados['Estado_idEstado'];	
		
				
			if ($var_id > 0){ 
					  
				echo "
					<script type=\"text/javascript\">
						alert('Não pode eliminar este estado porque existem assistências técnicas associadas a ele.'); 
						window.location.replace('estado_Assistencia_Listar.php'); </script>
					</script>
				";	
			} 
			else{
				$sql = mysql_query("DELETE FROM estado WHERE idEstado = $id");
				echo "
					<script type=\"text/javascript\">
						alert('Removido com sucesso!'); 
						window.location.replace('estado_Assistencia_Listar.php'); </script>
					</script>";
					
			}
		
		?>
	</body>
</html>