<?php
ob_start(); // Inicializa o buffer e bloqueia qualquer saída para o navegador

if(($_SESSION['utilizadorIdTecnico'] == "") || ($_SESSION['utilizadorNome'] == "") || 
	($_SESSION['utilizadorApelido'] == "") || ($_SESSION['utilizadorNumero_Funcionario'] == "") || 
	($_SESSION['utilizadorEmail'] == "") || ($_SESSION['utilizadorContacto'] == "") || 
	($_SESSION['utilizadorFuncao'] == "") || ($_SESSION['utilizadorUser'] == "") || 
	($_SESSION['utilizadorPassword'] == "")){
			
			//unset - Destrói a variável especificada
			unset($_SESSION['utilizadorIdTecnico'], 			
			  $_SESSION['utilizadorNome'], 				
			  $_SESSION['utilizadorApelido'], 				
			  $_SESSION['utilizadorNumero_Funcionario'], 	
			  $_SESSION['utilizadorEmail'], 				
			  $_SESSION['utilizadorContacto'], 			
			  $_SESSION['utilizadorFuncao'], 				
			  $_SESSION['utilizadorUser'],			
			  $_SESSION['utilizadorPassword']);
			  
	//Mensagem de Erro
	$_SESSION['loginErro'] = "Área restrita para utilizadores com login";
	
	//Manda o utilizador para a tela de login
	header("Location: index.php");
}
?>