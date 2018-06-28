<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$id   						= $_POST["numeroid"];
$nome_departamento 			= $_POST["nome_departamento"];
$contacto_departamento 		= $_POST["contacto_departamento"];
$observacao_departamento	= $_POST["observacao_departamento"];


$query = mysql_query("UPDATE departamento set nome_departamento ='$nome_departamento', contacto_departamento ='$contacto_departamento', 
 observacao_departamento = '$observacao_departamento' WHERE idDepartamento='$id'");

if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Editado com sucesso!'); 
						 window.location.replace('departamento_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				window.location.replace('departamento_Listar.php'); </script>
				</script>
			";		   

		}
		//mysql_query($query) OR DIE(mysql_error());
?>