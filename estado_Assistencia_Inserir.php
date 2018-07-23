<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$nome_estado_assistencia 			= $_POST["nome_estado_assistencia"];


if($nome_estado_assistencia == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('estado_Assistencia_Inserir_Formulario.php'); </script>";  
	return;
}


	try
    {
        //insere na BD
		//trim — Retira espaço no ínicio e final de uma string
        $sql = "INSERT INTO estado (nome_estado_assistencia) VALUES ('".trim($nome_estado_assistencia)."')";
	
		$result = mysql_query($sql) or die(mysql_error());
 
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        //echo "1";
		
		$_SESSION['post_data']=NULL;
		//session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Inserido com sucesso!'); 
		window.location.replace('estado_Assistencia_Listar.php'); </script>";

    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
       // echo "0";
	   
	   $_SESSION['post_data']=NULL;
	   //session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Não inserido!'); 
		window.location.replace('estado_Assistencia_Listar.php'); </script>";
    }
	

?>