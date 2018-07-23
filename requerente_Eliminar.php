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
		
			$result_requisicao = mysql_query("SELECT Requerente_idRequerente FROM requisicao_material WHERE Requerente_idRequerente ='$id'");
			$dados_requisicao = mysql_fetch_assoc($result_requisicao);
			$var_id_requisicao = $dados_requisicao['Requerente_idRequerente'];	
		
			$result_requerimento = mysql_query("SELECT Requerente_idRequerente FROM requerimento WHERE Requerente_idRequerente ='$id'");
			$dados_requerimento = mysql_fetch_assoc($result_requerimento);
			$var_id_requerimento = $dados_requerimento['Requerente_idRequerente'];	
		
			$result_assistencia = mysql_query("SELECT Requerente_idRequerente FROM assistencia_tecnica WHERE Requerente_idRequerente ='$id'");
			$dados_assistencia = mysql_fetch_assoc($result_assistencia);
			$var_id_assistencia = $dados_assistencia['Requerente_idRequerente'];
			
			if (($var_id_requisicao > 0) or ($var_id_requerimento > 0) or ($var_id_assistencia > 0)) { 
					  
				echo "
					<script type=\"text/javascript\">
						alert('Não pode eliminar este requerente porque existem registos associados a ele.'); 
						window.location.replace('requerente_Listar.php'); </script>
					</script>
				";	
			} 
			else{
				$sql = mysql_query("DELETE FROM requerente WHERE idRequerente  = $id");
				echo "
					<script type=\"text/javascript\">
						alert('Removido com sucesso!'); 
						window.location.replace('requerente_Listar.php'); </script>
					</script>";
					
			}
		?>
	</body>
</html>