<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$nome 					= $_POST["nome"];
$apelido 				= $_POST["apelido"];
$numero_funcionario		= $_POST["numero_funcionario"];
$email 					= $_POST["email"];
$contacto 				= $_POST["contacto"];
$user 					= $_POST["user"];
$password 				= $_POST["password"];



if($nome == "" || $apelido == "" || $numero_funcionario == "" || $email == "" || $contacto == "" || $user == "" || $password == "")
{
echo "<script language='javascript' type='text/javascript' text-align:'center' > 
  alert('Todos os campos são de preenchimento obrigatório...'); 
  window.location.replace('tecnico.php'); </script>";
//echo 'Nome em falta, volte para atrás e preencha o nome'; exit;
}


 
 //recebe os parâmetros
    $nome 				 = $_REQUEST ["Nome"];
    $apelido 			 = $_REQUEST["Apelido"];
    $numero_funcionario	 = $_REQUEST["Numero_Funcionario"];
	$email 				 = $_REQUEST["Email"];
	$contacto 			 = $_REQUEST["Contacto"];
	$funcao 				=$_REQUEST["Funcao"];
	$user 				 =$_REQUEST["User"];
    $password 			 =$_REQUEST["Password"];
	$observacao_tecnico	 =$_REQUEST["Observacao_Tecnico"];

	


	try
    {
        //insere na BD
        $sql = "INSERT INTO tecnico (nome, apelido, numero_funcionario, email, contacto, funcao, user, passowrd, observacao_tecnico) VALUES ('".trim($nome)."', '".trim($apelido)."', '".trim($numero_funcionario)."', '".trim($email)."', '".trim($contacto)."', '".trim($funcao)."', '".trim($user)."', '".trim($passowrd)."', '".trim($observacao_tecnico)."')";
		$result = mysql_query($sql) or die(mysql_error());
 
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        //echo "1";
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
  alert('Técnico inserido com sucesso!'); 
  window.location.replace('tecnico_Listar.php'); </script>";

    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
       // echo "0";
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
  alert('Técnico nao inserido!'); 
  window.location.replace('tecnico_Listar.php'); </script>";
    }


?>