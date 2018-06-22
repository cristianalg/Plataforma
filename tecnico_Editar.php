<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

// ini_set('display_errors',1);
// ini_set('display_startup_erros',1);
// error_reporting(E_ALL);

$id   					= $_POST["numeroid"];
$nome 					= $_POST["nome"];
$apelido 				= $_POST["apelido"];
$numero_funcionario		= $_POST["numero_funcionario"];
$email 					= $_POST["email"];
$contacto 				= $_POST["contacto"];
$funcao 				= $_POST["funcao"];
$user 					= $_POST["user"];
$password 				= $_POST["password"];
$observacao_tecnico 	= $_POST["observacao_tecnico"];


$query = mysql_query("UPDATE tecnico set nome ='$nome', apelido ='$apelido', numero_funcionario ='$numero_funcionario', email = '$email', 
contacto = '$contacto', funcao = '$funcao', user = '$user', password = '$password',observacao_tecnico = '$observacao_tecnico' WHERE idTecnico='$id'");

if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Técnico editado com sucesso!'); 
						 window.location.replace('tecnico_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				 window.location.replace('tecnico_Listar.php'); </script>
				</script>
			";		   

		}
		mysql_query($query) OR DIE(mysql_error());
?>