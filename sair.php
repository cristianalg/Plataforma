<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
session_destroy(); //Destrói todos os dados registrados na sessão

//Remove todas as informações contidas na variaveis globais
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

//redirecionar o utilizador para a página de login
header("Location: index.php");
?>