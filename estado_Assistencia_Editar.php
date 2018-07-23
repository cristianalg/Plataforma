<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

$id   							= $_POST["numeroid"];
$nome_estado_assistencia 		= $_POST["nome_estado_assistencia"];


$query = mysql_query("UPDATE estado set nome_estado_assistencia ='$nome_estado_assistencia' WHERE idEstado='$id'");

if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Editado com sucesso!'); 
						 window.location.replace('estado_Assistencia_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				window.location.replace('estado_Assistencia_Listar.php'); </script>
				</script>
			";		   

		}
		//mysql_query($query) OR DIE(mysql_error());
?>