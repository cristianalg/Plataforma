<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$data_requisicao					= $_POST["data_requisicao"];
$data_prevista_devolucao			= $_POST["data_prevista_devolucao"];
$seccao								= $_POST["seccao"];
$observacao_requisicao_material		= $_POST["observacao_requisicao_material"];
$idtipo_equipamento					= $_POST["idtipo_equipamento"];
$idequipamento						= $_POST["idequipamento"];
$idtipo_requerente					= $_POST["idtipo_requerente"];
$idrequerente						= $_POST["idrequerente"];


if($data_requisicao == "" || $data_prevista_devolucao == "" || $seccao == "" || $idtipo_equipamento == "" || $idequipamento == "" ||$idtipo_requerente == "" || $idrequerente == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('requisicao_Material_Inserir_Formulario.php'); </script>";  
	return;
}

	try
    {
        //insere na BD
		$sql = "INSERT INTO requisicao_material (data_requisicao, data_prevista_devolucao, seccao, observacao_requisicao_material, Equipamentos_Tipo_Equipamento_idTipo_Equipamento, Equipamentos_idEquipamentos, Requerente_Tipo_Requerente_idTipo_Requerente, Requerente_idRequerente) VALUES 
		('".trim($data_requisicao)."', '".trim($data_prevista_devolucao)."', '".trim($seccao)."', '".trim($observacao_requisicao_material)."', '".trim($idtipo_equipamento)."', '".trim($idequipamento)."', '".trim($idtipo_requerente)."', '".trim($idrequerente)."')";
		
		$result = mysql_query($sql) or die(mysql_error());
 
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        //echo "1";
		
		$_SESSION['post_data']=NULL;
		//session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Requisição de material inserida com sucesso!'); 
				  window.location.replace('requisicao_Material_Listar.php');
			   </script>";

    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
       // echo "0";
	   
	   $_SESSION['post_data']=NULL;
	   //session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Requisição de material não inserida!'); 
				  window.location.replace('requisicao_Material_Listar.php'); 
			 </script>";
    }
	

?>