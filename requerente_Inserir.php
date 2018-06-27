<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$nome_requerente 		= $_POST["nome_requerente"];
$numero_funcionario		= $_POST["numero_funcionario"];
$morada_requerente 		= $_POST["morada_requerente"];
$email 					= $_POST["email"];
$contacto_requerente	= $_POST["contacto_requerente"];
$nif					= $_POST["nif"];
$codigo_postal			= $_POST["codigo_postal"];
$localidade				= $_POST["localidade"];
$idtipo_requerente		= $_POST["idtipo_requerente"];


if($nome_requerente == "" || $morada_requerente == "" || $email == "" || $contacto_requerente == "" || $nif == "" ||$codigo_postal == "" || $idtipo_requerente == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('requerente_Inserir_Formulario.php'); </script>";  
	return;
}

	try
    {
        //insere na BD
		//trim — Retira espaço no ínicio e final de uma string
       // $sql = "INSERT INTO tecnico (nome, apelido, numero_funcionario, email, contacto, funcao, user, password, observacao_tecnico) VALUES ('".trim($nome)."', '".trim($apelido)."', '".trim($numero_funcionario)."', '".trim($email)."', '".trim($contacto)."', '".trim($funcao)."', '".trim($user)."', '".trim($password)."', '".trim($observacao_tecnico)."')";
		$sql = "INSERT INTO requerente (nome_requerente, numero_funcionario, morada_requerente, email, contacto_requerente, nif, codigo_postal, localidade, Tipo_Requerente_idTipo_Requerente) VALUES 
		('".trim($nome_requerente)."', '".trim($numero_funcionario)."', '".trim($morada_requerente)."', '".trim($email)."', '".trim($contacto_requerente)."', '".trim($nif)."', '".trim($codigo_postal)."', '".trim($localidade)."', '".trim($idtipo_requerente)."')";
		
		$result = mysql_query($sql) or die(mysql_error());
 
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        //echo "1";
		
		$_SESSION['post_data']=NULL;
		//session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Requerente inserido com sucesso!'); 
				  window.location.replace('requerente_Listar.php');
			   </script>";

    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
       // echo "0";
	   
	   $_SESSION['post_data']=NULL;
	   //session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Requerente não inserido!'); 
				  window.location.replace('requerente_Listar.php'); 
			 </script>";
    }
	

?>