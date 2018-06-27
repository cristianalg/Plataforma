<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$nome_tipo_requerente 			= $_POST["nome_tipo_requerente"];
$tipo_entidade					= $_POST["tipo_entidade"];
$observacao_tipo_requerente 	= $_POST["observacao_tipo_requerente"];


if($nome_tipo_requerente == "" || $tipo_entidade == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('tipo_Requerente_Inserir_Formulario.php'); </script>";  
	return;
}


	try
    {
        //insere na BD
		//trim — Retira espaço no ínicio e final de uma string
        $sql = "INSERT INTO tipo_requerente (nome_tipo_requerente, tipo_entidade,observacao_tipo_requerente) VALUES ('".trim($nome_tipo_requerente)."', '".trim($tipo_entidade)."', '".trim($observacao_tecnico)."')";
		 // $sql = "INSERT INTO tecnico (nome, apelido, numero_funcionario, email, contacto, funcao, user, passowrd, observacao_tecnico) VALUES ('".trim($nome)."', '".trim($apelido)."', '".trim($numero_funcionario)."', '".trim($email)."', '".trim($contacto)."', '".trim($funcao)."', '".trim($user)."', '".trim($password)."', '"$observacao_tecnico"')";
		
		$result = mysql_query($sql) or die(mysql_error());
 
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        //echo "1";
		
		$_SESSION['post_data']=NULL;
		//session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Inserido com sucesso!'); 
		window.location.replace('tipo_Requerente_Listar.php'); </script>";

    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
       // echo "0";
	   
	   $_SESSION['post_data']=NULL;
	   //session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Não inserido!'); 
		window.location.replace('tipo_Requerente_Listar.php'); </script>";
    }
	

?>