<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
			$id = $_GET["id"];
			
			$result = mysql_query("SELECT Tipo_Equipamento_idTipo_Equipamento FROM equipamentos WHERE Tipo_Equipamento_idTipo_Equipamento ='$id'");
			
			$dados = mysql_fetch_assoc($result);
			$var_id = $dados['Tipo_Equipamento_idTipo_Equipamento'];	
		
				
			if ($var_id > 0){ 
					  
				echo "
					<script type=\"text/javascript\">
						alert('Não pode eliminar este tipo de equipamento porque existem equipamentos associados a ele.'); 
						window.location.replace('tipo_Equipamento_Listar.php'); </script>
					</script>
				";	
			} 
			else{
				$sql = mysql_query("DELETE FROM tipo_equipamento WHERE idTipo_Equipamento = $id");
				echo "
					<script type=\"text/javascript\">
						alert('Removido com sucesso!'); 
						window.location.replace('tipo_Equipamento_Listar.php'); </script>
					</script>";
					
			}
		?>
	</body>
</html>