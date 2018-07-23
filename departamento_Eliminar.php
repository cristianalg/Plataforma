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


			$result = mysql_query("SELECT Departamento_idDepartamento FROM registo_postos_trabalho WHERE Departamento_idDepartamento ='$id'");
			
			$dados = mysql_fetch_assoc($result);
			$var_id = $dados['Departamento_idDepartamento'];	
		
				
			if ($var_id > 0){ 
					  
				echo "
					<script type=\"text/javascript\">
						alert('Não pode eliminar este departamento porque existem postos de trabalho associados a ele.'); 
						window.location.replace('departamento_Listar.php'); </script>
					</script>
				";	
			} 
			else{
				$sql = mysql_query("DELETE FROM departamento WHERE idDepartamento= $id");
				echo "
					<script type=\"text/javascript\">
						alert('Removido com sucesso!'); 
						window.location.replace('departamento_Listar.php'); </script>
					</script>";
					
			}
		?>
	</body>
</html>