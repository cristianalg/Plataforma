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
		
			$result = mysql_query("SELECT Tecnico_idTecnico FROM assistencia_tecnica WHERE Tecnico_idTecnico ='$id'");
			
			$dados = mysql_fetch_assoc($result);
			$var_id = $dados['Tecnico_idTecnico'];	
		
				
			if ($var_id > 0){ 
					  
				echo "
					<script type=\"text/javascript\">
						alert('Não pode eliminar este técnico porque existem assistências técnicas associadas a ele.'); 
						window.location.replace('tecnico_Listar.php'); </script>
					</script>
				";	
			} 
			else{
				$sql = mysql_query("DELETE FROM tecnico WHERE idTecnico = $id");
				echo "
					<script type=\"text/javascript\">
						alert('Removido com sucesso!'); 
						window.location.replace('tecnico_Listar.php'); </script>
					</script>";
					
			}
		
		
		
		
		
		
		
		
		
		
		
		
		
		if (mysql_affected_rows() != 0 ){	
			echo "
				<script type=\"text/javascript\">
						alert('Técnico removido com sucesso!'); 
						 window.location.replace('tecnico_Listar.php'); </script>
				</script>
			";	
				
				   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
						alert('Técnico não removido!'); 
						 window.location.replace('tecnico_Listar.php'); </script>
				</script>
			";		   

		}
//mysql_query($query) OR DIE(mysql_error());
		?>
	</body>
</html>