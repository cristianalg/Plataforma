<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");
$id = $_GET["id"];

$query = "DELETE FROM requerimento WHERE idRequerimento = ".$id."";
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
						alert('Requerimento removido com sucesso!'); 
						 window.location.replace('requerimento_Listar.php'); </script>
				</script>
			";	
				
				   
		}
		 else{ 	
				echo "
				<script type=\"text/javascript\">
						alert('Requerimento não removido!'); 
						 window.location.replace('requerimento_Listar.php'); </script>
				</script>
			";		   

		}
//mysql_query($query) OR DIE(mysql_error());
		?>
	</body>
</html>