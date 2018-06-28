<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$id   							= $_POST["numeroid"];
$nome_sistema_operativo 		= $_POST["nome_sistema_operativo"];
$observacao_sistema_operativo 	= $_POST["observacao_sistema_operativo"];


$query = mysql_query("UPDATE sistema_operativo set nome_sistema_operativo ='$nome_sistema_operativo', observacao_sistema_operativo = '$observacao_sistema_operativo' WHERE idSistema_Operativo='$id'");

if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Editado com sucesso!'); 
						 window.location.replace('sistema_Operativo_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				window.location.replace('sistema_Operativo_Listar.php'); </script>
				</script>
			";		   

		}
		//mysql_query($query) OR DIE(mysql_error());
?>