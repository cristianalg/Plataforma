<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$id   								= $_POST["numeroid"];
$data_requisicao					= $_POST["data_requisicao"];
$data_prevista_devolucao			= $_POST["data_prevista_devolucao"];
$seccao								= $_POST["seccao"];
$observacao_requisicao_material		= $_POST["observacao_requisicao_material"];
$data_devolucao						= $_POST["data_devolucao"];
$estado_material_devolvido 			= $_POST["estado_material_devolvido"];
$estado_requisicao					= $_POST["estado_requisicao"];
$idtipo_equipamento					= $_POST["idtipo_equipamento"];
$idequipamento						= $_POST["idequipamento"];
$idtipo_requerente					= $_POST["idtipo_requerente"];
$idrequerente						= $_POST["idrequerente"];


$query = mysql_query("UPDATE requisicao_material set data_requisicao ='$data_requisicao', data_prevista_devolucao ='$data_prevista_devolucao', seccao = '$seccao', observacao_requisicao_material = '$observacao_requisicao_material', data_devolucao = '$data_devolucao',
estado_material_devolvido = '$estado_material_devolvido', estado_requisicao = '$estado_requisicao', Equipamentos_Tipo_Equipamento_idTipo_Equipamento = '$idtipo_equipamento', Equipamentos_idEquipamentos ='$idequipamento', 	Requerente_Tipo_Requerente_idTipo_Requerente ='$idtipo_requerente', 
Requerente_idRequerente ='$idrequerente' WHERE 	idRequisicao_Material='$id'");


//Tipo_Requerente_idTipo_Requerente='$idrequerente'
if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Requisição de Material editada com sucesso!'); 
						 window.location.replace('requisicao_Material_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				window.location.replace('requisicao_Material_Listar.php'); </script>
				</script>
			";		   

		}

		mysql_query($query) OR DIE(mysql_error());
?>