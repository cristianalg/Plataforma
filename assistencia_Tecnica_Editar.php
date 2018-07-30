<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$id   							= $_POST["numeroid"];
$descricao_avaria				= $_POST["descricao_avaria"];
$data_pedido					= $_POST["data_pedido"];
$data_prevista_entrega			= $_POST["data_prevista_entrega"];
$historico_servico				= $_POST["historico_servico"];
$observacao_assistencia			= $_POST["observacao_assistencia"];
$idrequerente					= $_POST["idrequerente"];
$idtipo_requerente				= $_POST["idtipo_requerente"];
$idtipo_assistencia				= $_POST["idtipo_assistencia"];
$idtecnico						= $_POST["idtecnico"];
$idestado						= $_POST["idestado"];
$imprimir_relatorio				= $_POST["imprimir_relatorio"];


$query = mysql_query("UPDATE assistencia_tecnica set descricao_avaria ='$descricao_avaria', data_pedido ='$data_pedido',  data_prevista_entrega = '$data_prevista_entrega', historico_servico = '$historico_servico', observacao_assistencia = '$observacao_assistencia',
Requerente_idRequerente = '$idrequerente', Requerente_Tipo_Requerente_idTipo_Requerente = '$idtipo_requerente', Tipo_Assistencia_idTipo_Assistencia = '$idtipo_assistencia', Tecnico_idTecnico ='$idtecnico', Estado_idEstado ='$idestado', imprimir_relatorio ='$imprimir_relatorio'  
WHERE idAssistencia_Tecnica = '$id'");


if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Assistência Ténica editada com sucesso!'); 
						 window.location.replace('assistencia_Tecnica_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				window.location.replace('assistencia_Tecnica_Listar.php'); </script>
				</script>
			";		   

		 }

		mysql_query($query) OR DIE(mysql_error());
?>