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
		
			$result_requerimento = mysql_query("SELECT Estado_idEstado FROM assistencia_tecnica WHERE Estado_idEstado = '$id'");
			$dados_requerimento = mysql_fetch_assoc($result_requerimento);
			$var_id_requerimento = $dados_requerimento['Estado_idEstado'];	
		
			$result_assistencia = mysql_query("SELECT Estado_idEstado FROM instalacao_computadores WHERE Estado_idEstado ='$id'");
			$dados_assistencia = mysql_fetch_assoc($result_assistencia);
			$var_id_assistencia = $dados_assistencia['Estado_idEstado'];
			
			if (($var_id_requerimento > 0) or ($var_id_assistencia > 0)) { 
					  
				echo "
					<script type=\"text/javascript\">
						alert('Não pode eliminar este estado porque existem registos associados a ele.'); 
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