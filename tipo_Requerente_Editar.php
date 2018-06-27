<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

$id   							= $_POST["numeroid"];
$nome_tipo_requerente 			= $_POST["nome_tipo_requerente"];
$tipo_entidade 					= $_POST["tipo_entidade"];
$observacao_tipo_requerente 	= $_POST["observacao_tipo_requerente"];


$query = mysql_query("UPDATE tipo_requerente set nome_tipo_requerente ='$nome_tipo_requerente', tipo_entidade ='$tipo_entidade', 
 observacao_tipo_requerente = '$observacao_tipo_requerente' WHERE idTipo_Requerente='$id'");

if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Editado com sucesso!'); 
						 window.location.replace('tipo_Requerente_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				window.location.replace('tipo_Requerente_Listar.php'); </script>
				</script>
			";		   

		}
		//mysql_query($query) OR DIE(mysql_error());
?>