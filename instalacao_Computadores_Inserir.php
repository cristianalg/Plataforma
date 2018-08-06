<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

	$nome_instalacao						= $_POST["nome_instalacao"];
	$nome_rede								= $_POST["nome_rede"];
	$impressora_follow_me					= $_POST["impressora_follow_me"];
	$antivirus								= $_POST["antivirus"];
	$data_instalacao_computadores			= $_POST["data_instalacao_computadores"];
	$observacao_instalacao_computadores		= $_POST["observacao_instalacao_computadores"];
			
	$idsistema_operativo					= $_POST["idsistema_operativo"];
	$idoffice								= $_POST["idoffice"];
	$idestado								= $_POST["idestado"];

		
if($nome_instalacao == "" || $nome_rede == "" || $data_instalacao_computadores == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('instalacao_Computadores_Inserir_Formulario.php'); </script>";  
	return;
}

try
    {
				
		if (isset($_POST['submit']))
		{
			//Aplicativos
			$chkbox = $_POST['chkbox_Aplicativos'];
			$chkNew = "";  
			
			//AIRC
			 $chkbox_AIRC = $_POST['chkbox'];
			 $chkNew_AIRC = ""; 
			 
			 foreach($chkbox as $chkNew1)  
			   {  
				  $chkNew .= $chkNew1 . ",";  
			   } 

			 foreach($chkbox_AIRC as $chkNew1_AIRC)  
			   {  
				  $chkNew_AIRC .= $chkNew1_AIRC . ",";  
			   } 
		 
		 
		 $query = "INSERT INTO instalacao_computadores (nome_instalacao, nome_rede, antivirus, observacao_instalacao_computadores, 
		 data_instalacao_computadores, Sistema_Operativo_idSistema_Operativo, Office_idOffice, Estado_idEstado, aplicativo, airc, impressora )
		 VALUES ('".trim($nome_instalacao)."', '".trim($nome_rede)."', '".trim($antivirus)."', '".trim($observacao_instalacao_computadores)."', '".trim($data_instalacao_computadores)."', '".trim($idsistema_operativo)."', 
		 '".trim($idoffice)."', '".trim($idestado)."','$chkNew','$chkNew_AIRC','".trim($impressora_follow_me)."')";
		 
		 mysql_query($query) or die(mysql_error());
		 

		 //echo "Successfully Submitted.";
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Inserido com sucesso!'); 
				  window.location.replace('instalacao_Computadores_Listar.php');
			   </script>";
		}
		
    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
       // echo "0";
	   
	   $_SESSION['post_data']=NULL;
	   //session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Não inserido!'); 
				  window.location.replace('instalacao_Computadores_Listar.php'); 
			 </script>";
    }


?>