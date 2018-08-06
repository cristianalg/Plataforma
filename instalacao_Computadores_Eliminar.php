<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");
$id = $_GET["id"];

$query = "DELETE FROM instalacao_computadores WHERE idInstalacao_Computadores = ".$id."";
$resultado = mysql_query($query);
$linhas = mysql_affected_rows();

?>

<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
	</head>

	<body>
		<?php
		if (mysql_affected_rows() != 0 ){	
			echo "
				<script type=\"text/javascript\">
						alert('Removido com sucesso!'); 
						 window.location.replace('instalacao_Computadores_Listar.php'); </script>
				</script>
			";	
				
				   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
						alert('Não removida!'); 
						 window.location.replace(instalacao_Computadores_Listar); </script>
				</script>
			";		   

		}
//mysql_query($query) OR DIE(mysql_error());
		?>
	</body>
</html>