<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$id   					= $_POST["numeroid"];
$nome_requerente 		= $_POST["nome_requerente"];
$numero_funcionario		= $_POST["numero_funcionario"];
$morada_requerente 		= $_POST["morada_requerente"];
$email 					= $_POST["email"];
$contacto_requerente	= $_POST["contacto_requerente"];
$nif					= $_POST["nif"];
$codigo_postal			= $_POST["codigo_postal"];
$localidade				= $_POST["localidade"];
$idrequerente			= $_POST["idrequerente"];

//echo $idrequerente;

$query = mysql_query("UPDATE requerente set nome_requerente ='$nome_requerente', numero_funcionario ='$numero_funcionario', email = '$email', contacto_requerente = '$contacto_requerente', morada_requerente = '$morada_requerente'
, codigo_postal = '$codigo_postal', localidade = '$localidade', nif = '$nif', Tipo_Requerente_idTipo_Requerente ='$idrequerente' WHERE idRequerente='$id'");

//Tipo_Requerente_idTipo_Requerente='$idrequerente'
if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Requerente editado com sucesso!'); 
						 window.location.replace('requerente_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				window.location.replace('requerente_Listar.php'); </script>
				</script>
			";		   

		}

		mysql_query($query) OR DIE(mysql_error());
?>