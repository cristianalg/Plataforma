<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
$utilizadort = $_POST['utilizador'];
$passwordt = $_POST['password'];
include_once("conexao.php");

$result = mysql_query("SELECT * FROM Tecnico WHERE user ='$utilizadort' AND password='$passwordt'");
$resultado = mysql_fetch_assoc($result);
//echo "utilizador: ".$resultado['nome'];
if(empty($resultado)){
	//Mensagem de Erro
	$_SESSION['loginErro'] = "Utilizador ou Password Inválido";
	
	//Manda o utilizador para a tela de login
	header("Location: index.php");
}else{
	//Define os valores atribuidos na sessao do utilizador
	$_SESSION['utilizadorIdTecnico'] 				= $resultado['idTecnico'];
	$_SESSION['utilizadorNome'] 					= $resultado['Nome'];
	$_SESSION['utilizadorApelido'] 					= $resultado['Apelido'];
	$_SESSION['utilizadorNumero_Funcionario'] 		= $resultado['Numero_Funcionario'];
	$_SESSION['utilizadorEmail'] 					= $resultado['Email'];
	$_SESSION['utilizadorContacto'] 				= $resultado['Contacto'];
	$_SESSION['utilizadorFuncao'] 					= $resultado['Funcao'];
	$_SESSION['utilizadorUser'] 					= $resultado['User'];
	$_SESSION['utilizadorPassword'] 				= $resultado['Password'];
	
	header("Location: pagina_Inicial.php");
}
?>