<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$descricao_avaria				= $_POST["descricao_avaria"];
$data_pedido					= $_POST["data_pedido"];
$data_prevista_entrega			= $_POST["data_prevista_entrega"];
$observacao_assistencia			= $_POST["observacao_assistencia"];
$idrequerente					= $_POST["idrequerente"];
$idtipo_requerente				= $_POST["idtipo_requerente"];
$idtipo_assistencia				= $_POST["idtipo_assistencia"];
$idtecnico						= $_POST["idtecnico"];
$idestado						= $_POST["idestado"];
$imprimir_relatorio				= $_POST["imprimir_relatorio"];		


if($descricao_avaria == "" || $data_pedido == "" || $data_prevista_entrega == "" || $idrequerente == "" || $idtipo_requerente == "" ||$idtipo_assistencia == "" || $idtecnico == "" || $idestado == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('assistencia_Tecnica_Inserir_Formulario.php'); </script>";  
	return;
}

	try
    {
        //insere na BD
		$sql = "INSERT INTO assistencia_tecnica (descricao_avaria, data_pedido, data_prevista_entrega, observacao_assistencia,
		Requerente_idRequerente, Requerente_Tipo_Requerente_idTipo_Requerente, Tipo_Assistencia_idTipo_Assistencia, Tecnico_idTecnico, Estado_idEstado, imprimir_relatorio) VALUES 
		('".trim($descricao_avaria)."', '".trim($data_pedido)."', '".trim($data_prevista_entrega)."', '".trim($observacao_assistencia)."',
		'".trim($idrequerente)."', '".trim($idtipo_requerente)."', '".trim($idtipo_assistencia)."', '".trim($idtecnico)."', '".trim($idestado)."', '".trim($imprimir_relatorio)."')";

		$result = mysql_query($sql) or die(mysql_error());
 
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        //echo "1";
		
		$_SESSION['post_data']=NULL;
		//session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Assistência Técnica inserida com sucesso!'); 
				  window.location.replace('assistencia_Tecnica_Listar.php');
			   </script>";

    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
       // echo "0";
	   
	   $_SESSION['post_data']=NULL;
	   //session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Assistência Técnica não inserida!'); 
				  window.location.replace('assistencia_Tecnica_Listar.php'); 
			 </script>";
    }
?>