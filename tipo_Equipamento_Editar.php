<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$id   							= $_POST["numeroid"];
$nome_tipo_equipamento 			= $_POST["nome_tipo_equipamento"];


$query = mysql_query("UPDATE tipo_equipamento set nome_tipo_equipamento ='$nome_tipo_equipamento' WHERE idTipo_Equipamento ='$id'");

if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Editado com sucesso!'); 
						 window.location.replace('tipo_Equipamento_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				window.location.replace('tipo_Equipamento_Listar.php'); </script>
				</script>
			";		   

		}
		//mysql_query($query) OR DIE(mysql_error());
?>