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
			
			$result = mysql_query("SELECT Sistema_Operativo_idSistema_Operativo FROM instalacao_computadores WHERE Sistema_Operativo_idSistema_Operativo ='$id'");
			$dados = mysql_fetch_assoc($result);
			$var_id = $dados['Sistema_Operativo_idSistema_Operativo'];	
		
				
			if ($var_id > 0){ 
					  
				echo "
					<script type=\"text/javascript\">
						alert('Não pode eliminar este sistema operativo porque existem instalações de computadores associados a ele.'); 
						window.location.replace('sistema_Operativo_Listar.php'); </script>
					</script>
				";	
			} 
			else{
				$sql = mysql_query("DELETE FROM sistema_operativo WHERE idSistema_Operativo = $id");
				echo "
					<script type=\"text/javascript\">
						alert('Removido com sucesso!'); 
						window.location.replace('sistema_Operativo_Listar.php'); </script>
					</script>";
					
			}
		?>
	</body>
</html>