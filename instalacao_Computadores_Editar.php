<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$id   								= $_POST["numeroid"];
$nome_instalacao						= $_POST["nome_instalacao"];
	$nome_rede								= $_POST["nome_rede"];
	$impressora_follow_me					= $_POST["impressora"];
	$antivirus								= $_POST["antivirus"];
	$data_instalacao_computadores			= $_POST["data_instalacao_computadores"];
	$observacao_instalacao_computadores		= $_POST["observacao_instalacao_computadores"];
			
	$idsistema_operativo					= $_POST["idsistema_operativo"];
	$idoffice								= $_POST["idoffice"];
	$idestado								= $_POST["idestado"];

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
		
/*
$query = mysql_query("UPDATE instalacao_computadores set
nome_instalacao ='$nome_instalacao', nome_rede ='$nome_rede', antivirus ='$antivirus', observacao_instalacao_computadores ='$observacao_instalacao_computadores',
data_instalacao_computadores ='$data_instalacao_computadores',Sistema_Operativo_idSistema_Operativo  ='$idsistema_operativo', Office_idOffice ='$idoffice', Estado_idEstado ='$idestado',
aplicativo = '$chkNew', impressora ='$impressora_follow_me', airc = '$chkNew_AIRC'
WHERE 	idInstalacao_Computadores='$id'"); 
*/

$query = mysql_query("UPDATE instalacao_computadores set
nome_instalacao ='$nome_instalacao', nome_rede ='$nome_rede', antivirus ='$antivirus', observacao_instalacao_computadores ='$observacao_instalacao_computadores',
data_instalacao_computadores ='$data_instalacao_computadores',Sistema_Operativo_idSistema_Operativo  ='$idsistema_operativo', Office_idOffice ='$idoffice', Estado_idEstado ='$idestado',
 impressora ='$impressora_follow_me', airc = '$chkNew_AIRC'
WHERE 	idInstalacao_Computadores='$id'"); 
/*
$query = mysql_query("UPDATE instalacao_computadores set
nome_instalacao ='$nome_instalacao', nome_rede ='$nome_rede', antivirus ='$antivirus', observacao_instalacao_computadores ='$observacao_instalacao_computadores',
data_instalacao_computadores ='$data_instalacao_computadores',Sistema_Operativo_idSistema_Operativo  ='$idsistema_operativo', Office_idOffice ='$idoffice', Estado_idEstado ='$idestado', impressora ='$impressora_follow_me'
WHERE 	idInstalacao_Computadores='$id'");
*/
mysql_query($query) OR DIE(mysql_error());
		}

	/*
if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Editada com sucesso!'); 
						 window.location.replace('instalacao_Computadores_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				window.location.replace('instalacao_Computadores_Listar.php'); </script>
				</script>
			";		   

		}*/

		//mysql_query($query) OR DIE(mysql_error());
?>