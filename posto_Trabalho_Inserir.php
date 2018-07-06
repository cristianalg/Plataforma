<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$cargo							= $_POST["cargo"];
$observacao_posto_trabalho		= $_POST["observacao_posto_trabalho"];
$iddepartamento					= $_POST["iddepartamento"];
$idtipo_requerente				= $_POST["idtipo_requerente"];
$idrequerente					= $_POST["idrequerente"];
$anexo							= $_FILES["anexo"];			

			
if($cargo == "" ||  $iddepartamento == "" ||$idtipo_requerente == "" || $idrequerente == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('posto_Trabalho_Inserir_Formulario.php'); </script>";  
	return;
}
// Se a foto estiver sido selecionada
	if (!empty($anexo["name"])) {
		//echo "anexo selecionado";
	
		// Largura máxima em pixels
		$largura = 1920;
		// Altura máxima em pixels
		$altura = 1080;
		// Tamanho máximo do arquivo em bytes
		$tamanho = 500000;
 
		$error = array();
 
    	// Verifica se o arquivo é uma imagem
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $anexo["type"])){
     	   //$error[1] = "Isso não é uma imagem.";
		   $error[1] = "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Extensão inválida, insira formato de imagem.'); 
					window.location.replace('posto_Trabalho_Inserir_Formulario.php'); </script>";
   	 	} 
	
		// Pega as dimensões da imagem
		$dimensoes = getimagesize($anexo["tmp_name"]);
	
		// Verifica se a largura da imagem é maior que a largura permitida
		if($dimensoes[0] > $largura) {
			//$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
			 $error[2] = "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('A largura da imagem não deve ultrapassar ".$largura." pixels.'); 
					window.location.replace('posto_Trabalho_Inserir_Formulario.php'); </script>";
		}
 
		// Verifica se a altura da imagem é maior que a altura permitida
		if($dimensoes[1] > $altura) {
			//$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
			$error[3] = "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Altura da imagem não deve ultrapassar ".$altura." pixels.'); 
					window.location.replace('posto_Trabalho_Inserir_Formulario.php'); </script>";
		}
		
		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($anexo["size"] > $tamanho) {
   		 	//$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
			$error[4] = "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('A imagem deve ter no máximo ".$tamanho." bytes.'); 
					window.location.replace('posto_Trabalho_Inserir_Formulario.php'); </script>";
		}
 
		// Se não houver nenhum erro
		if (count($error) == 0) {
		
			// Pega extensão da imagem
			preg_match("/\.(gif|bmp|png|jpg|jpeg!){1}$/i", $anexo["name"], $ext);
 
        	// Gera um nome único para a imagem
        	$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
 
        	// Caminho de onde ficará a imagem
        	$caminho_imagem = "Anexos_Postos_Trabalho/" . $nome_imagem;
 
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($anexo["tmp_name"], $caminho_imagem);
		
			$sql = mysql_query("INSERT INTO registo_postos_trabalho (Cargo, Observacao_Registo_Postos_Trabalho, Departamento_idDepartamento, Requerente_Tipo_Requerente_idTipo_Requerente, Requerente_idRequerente,anexo)
			VALUES ('".$cargo."', '".$observacao_posto_trabalho."', '".$iddepartamento."', '".$idtipo_requerente."', '".$idrequerente."', '".$nome_imagem."')");
		
		if ($sql){
				//echo "sucesso.";
				  $_SESSION['post_data']=NULL;
					echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('Registo inserido com anexo!'); 
						window.location.replace('posto_Trabalho_Listar.php'); </script>";
			}else{
				//echo " nao sucesso.";
				  $_SESSION['post_data']=NULL;
					echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('Registo não inserido!'); 
						window.location.replace('posto_Trabalho_Listar.php'); </script>";
			}
		
		
		}
		
			// Se houver mensagens de erro, exibe-as
			if (count($error) != 0) {
				foreach ($error as $erro) {
					echo $erro . "<br />";
				}
			}
	}else{
		//echo "anexo não selecionado";
		try
		{
			//insere na BD
			$sql = "INSERT INTO registo_postos_trabalho (Cargo, Observacao_Registo_Postos_Trabalho, Departamento_idDepartamento, Requerente_Tipo_Requerente_idTipo_Requerente, Requerente_idRequerente) VALUES 
			('".trim($cargo)."', '".trim($observacao_posto_trabalho)."', '".trim($iddepartamento)."', '".trim($idtipo_requerente)."', '".trim($idrequerente)."')";
			
			$result = mysql_query($sql) or die(mysql_error());
	 		
			$_SESSION['post_data']=NULL;
			//session_destroy();
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					  alert('Posto de Trabalho inserido, sem anexo!'); 
					  window.location.replace('posto_Trabalho_Listar.php');
				   </script>";

		} 
		catch (Exception $ex)
		{
		   $_SESSION['post_data']=NULL;
		   //session_destroy();
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					  alert('Posto de Trabalho não inserido!'); 
					  window.location.replace('posto_Trabalho_Listar.php'); 
				 </script>";
		}
	}
		
		
		
		
		
		
/*
	try
    {
        //insere na BD
		//trim — Retira espaço no ínicio e final de uma string
		
		$sql = "INSERT INTO registo_postos_trabalho (Cargo, Observacao_Registo_Postos_Trabalho, Departamento_idDepartamento, Requerente_Tipo_Requerente_idTipo_Requerente, Requerente_idRequerente) VALUES 
		('".trim($cargo)."', '".trim($observacao_posto_trabalho)."', '".trim($iddepartamento)."', '".trim($idtipo_requerente)."', '".trim($idrequerente)."')";
		
		
		
		$result = mysql_query($sql) or die(mysql_error());
 
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        //echo "1";
		
		$_SESSION['post_data']=NULL;
		//session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Posto de Trabalho inserido com sucesso!'); 
				  window.location.replace('posto_Trabalho_Listar.php');
			   </script>";

    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
       // echo "0";
	   
	   $_SESSION['post_data']=NULL;
	   //session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Posto de Trabalho não inserido!'); 
				  window.location.replace('posto_Trabalho_Listar.php'); 
			 </script>";
    }
	
	*/
?>