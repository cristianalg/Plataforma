<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
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
		
		$result_req =mysql_query("SELECT Tipo_Requerente_idTipo_Requerente FROM requerente WHERE Tipo_Requerente_idTipo_Requerente ='$id'");
		// while($dados = mysql_fetch_assoc($result_req)){
			// $var_id_tipo_Requerente = $dados['Tipo_Requerente_idTipo_Requerente'];	
		// }
		$dados = mysql_fetch_assoc($result_req);
		$var_id_tipo_Requerente = $dados['Tipo_Requerente_idTipo_Requerente'];	
		
		if ($var_id_tipo_Requerente > 0){ 
				  
			echo "
				<script type=\"text/javascript\">
					alert('Não pode eliminar este tipo de requerente porque existem requerentes associados a ele.'); 
					window.location.replace('tipo_Requerente_Listar.php'); </script>
				</script>
			";	
		} 
		else{
				
			$sql = mysql_query("DELETE FROM tipo_requerente WHERE idTipo_Requerente = $id");
			echo "
				<script type=\"text/javascript\">
					alert('Removido com sucesso!'); 
					window.location.replace('tipo_Requerente_Listar.php'); </script>
				</script>";
		}
		?>
	</body>
</html>