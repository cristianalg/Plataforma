<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao.php");

	$nome_equipamento			= $_POST["nome_equipamento"];
	$numero_serie 				= $_POST["numero_serie"];
	$marca						= $_POST["marca"];
	$modelo						= $_POST["modelo"];
	$numero_inventario			= $_POST["numero_inventario"];
	$local_instalacao			= $_POST["local_instalacao"];
	$contacto 					= $_POST["contacto"];
	$estado_material			= $_POST["estado_material"];
	$user_acesso_internet 		= $_POST["user_acesso_internet"];
	$password_acesso_internet 	= $_POST["password_acesso_internet"];
	$username_equipamento 		= $_POST["username_equipamento"];
	$password_equipamento 		= $_POST["password_equipamento"];
	$contacto_suporte		 	= $_POST["contacto_suporte"];
	$observacao_equipamento 	= $_POST["observacao_equipamento"];
	$idtipo_equipamento			= $_POST["idtipo_equipamento"];
	$iddepartamento				= $_POST["iddepartamento"];
	$idrequerente				= $_POST["idrequerente"];

	$copia_fatura				= $_FILES["copia_fatura"];	
	$ficheiro_configuracao		= $_FILES["ficheiro_configuracao"];
	
	//***********************************************************
	//Vai buscar o ID do tipo requerente
	$result_Tipo_Req =mysql_query("SELECT idRequerente, Nome_Requerente, Tipo_Requerente_idTipo_Requerente FROM requerente WHERE idRequerente = '$idrequerente'");
	$resultado_Tipo_Req = mysql_fetch_assoc($result_Tipo_Req);
	$idtipo_requerente = $resultado_Tipo_Req['Tipo_Requerente_idTipo_Requerente'];
	//echo "ID tipo de requerente: ".$idtipo_requerente."	 ";
	
	//Vai buscar o ID do posto de trabalho
	$result_Posto_Trab =mysql_query("Select idRegisto_Postos_Trabalho, Requerente_idRequerente FROM registo_postos_trabalho WHERE Requerente_idRequerente = '$idrequerente'");
	$resultado_Posto_Trab = mysql_fetch_assoc($result_Posto_Trab);
	$idregisto_postos_trabalho = $resultado_Posto_Trab['idRegisto_Postos_Trabalho'];
	//echo "ID posto trabalho: ".$idregisto_postos_trabalho."	 ";

		
	if($nome_equipamento == "" || $numero_serie == "" || $marca == "" || $modelo == "" || $numero_inventario == "" ||$local_instalacao == "" 
	|| $contacto == "" || $estado_material == "" || $user_acesso_internet == "" || $password_acesso_internet == "" || $username_equipamento == "" 
	|| $password_equipamento == "" || $contacto_suporte == "" || $idtipo_equipamento == "" || $iddepartamento == "" || $idrequerente == "")
	{
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
			alert('Os campos com (*) são de preenchimento obrigatório.'); ";
		
		// session_start();
		$_SESSION['post_data'] = $_POST;
		
		echo "window.location.replace('equipamentos_Inserir_Formulario.php'); </script>";  
		return;
	}


	//Copia da fatura - PDF
	$allowedExts = array("pdf");
	$temp = explode(".", $_FILES["copia_fatura"]["name"]);
	$extension = end($temp);
	
	//Ficheiro de configuração - ZIP
	$temp_zip = explode(".", $_FILES["ficheiro_configuracao"]["name"]);
	$extension_zip = end($temp_zip);
	
	
// Verifica se foi selecionado cópia da fatura ou ficheiro de configuração
	if ((!empty($copia_fatura["name"])) and (!empty($ficheiro_configuracao["name"]))){
		//echo "selecionado PDF e ZIP";
		$_SESSION['post_data'] = $_POST;
		
		if(strstr('.pdf', $extension)){
			
			$_SESSION['post_data'] = $_POST;
			// Gera um nome único para o PDF
			$nome_pdf= md5(uniqid(time())) . "." . $extension;
		 
			// Caminho de onde ficará o PDF
			$caminho_pdf = "Anexos_Equipamentos/" . $nome_pdf;
		 
			// Faz o upload do PDF para seu respectivo caminho
			move_uploaded_file($_FILES["copia_fatura"]["tmp_name"], $caminho_pdf);
			
			
			
		}else{
			 //echo"O arquivo possui extensão inválida, só permite <b>PDF<b>." ;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('A cópia da fatura possui extensão inválida, só permite PDF.'); 
						window.location.replace('equipamentos_Inserir_Formulario.php'); 
				</script>";
		}	

		
		
		//Verifica se a extensão é ZIP
		if(strstr('.rar, .zip', $extension_zip)){
			
			$_SESSION['post_data'] = $_POST;
			
			// Gera um nome único para o PDF
			$nome_pdf_zip = md5(uniqid(time())) . "." . $extension_zip;
		 
			// Caminho de onde ficará o PDF
			$caminho_pdf_zip = "Anexos_Equipamentos/" . $nome_pdf_zip;
		 
			// Faz o upload do PDF para seu respectivo caminho
			move_uploaded_file($_FILES["ficheiro_configuracao"]["tmp_name"], $caminho_pdf_zip);
			
		}else{
			 //echo"O arquivo possui extensão inválida, só permite <b>PDF<b>." ;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('O ficheiro de configração possui extensão inválida, só permite ZIP ou RAR.'); 
						window.location.replace('equipamentos_Inserir_Formulario.php'); 
				</script>";
		}	
		
		
		$sql = "INSERT INTO equipamentos (
					Nome_Equipamento, Numero_Serie, Marca, Modelo, Numero_Inventario, Local_Instalacao, Contacto, 
					Estado_Material, User_Acesso_Internet, Password_Acesso_Internet, Username_Equipamento,
					Password_Equipamento, Contacto_Suporte, Observacao_Equipamento, Tipo_Equipamento_idTipo_Equipamento,
					Registo_Postos_Trabalho_idRegisto_Postos_Trabalho,  Registo_Postos_Trabalho_Requerente_idRequerente, 
					Registo_Postos_Trabalho_idTipo_Requerente, Registo_Postos_Trabalho_Departamento_idDepartamento, Copia_Fatura, Ficheiro_Configuracao) VALUES 
					('".trim($nome_equipamento)."', '".trim($numero_serie)."', '".trim($marca)."', '".trim($modelo)."',
					'".trim($numero_inventario)."', '".trim($local_instalacao)."', '".trim($contacto)."', '".trim($estado_material)."', 
					'".trim($user_acesso_internet)."','".trim($password_acesso_internet)."', '".trim($username_equipamento)."', 
					'".trim($password_equipamento)."', '".trim($contacto_suporte)."', '".trim($observacao_equipamento)."',
					'".trim($idtipo_equipamento)."', '".trim($idregisto_postos_trabalho)."',
					'".trim($idrequerente)."', '".trim($idtipo_requerente)."', '".trim($iddepartamento)."', '$nome_pdf', '$nome_pdf_zip')";
			
			$result = mysql_query($sql) or die(mysql_error());
			
				//if($sql){
					//echo "Data Submit Successful";
			$_SESSION['post_data']=NULL;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Equipamento inserido com sucesso!'); 
					window.location.replace('equipamentos_Listar.php');
				</script>";
	}
		
		
		
		
	else if ((!empty($copia_fatura["name"]))) {
		//echo "selecionado PDf";
		$_SESSION['post_data'] = $_POST;
	
		//Verifica se a extensão é PDF
		if(strstr('.pdf', $extension)){
		
			// Gera um nome único para o PDF
			$nome_pdf= md5(uniqid(time())) . "." . $extension;
		 
			// Caminho de onde ficará o PDF
			$caminho_pdf = "Anexos_Equipamentos/" . $nome_pdf;
		 
			// Faz o upload do PDF para seu respectivo caminho
			move_uploaded_file($_FILES["copia_fatura"]["tmp_name"], $caminho_pdf);
				
			//Insere na BD o nome do PDF
			//$sql=mysql_query("INSERT INTO equipamentos(Copia_Fatura)VALUES('$nome_pdf')");
			
			$sql = "INSERT INTO equipamentos (
					Nome_Equipamento, Numero_Serie, Marca, Modelo, Numero_Inventario, Local_Instalacao, Contacto, 
					Estado_Material, User_Acesso_Internet, Password_Acesso_Internet, Username_Equipamento,
					Password_Equipamento, Contacto_Suporte, Observacao_Equipamento, Tipo_Equipamento_idTipo_Equipamento,
					Registo_Postos_Trabalho_idRegisto_Postos_Trabalho,  Registo_Postos_Trabalho_Requerente_idRequerente, 
					Registo_Postos_Trabalho_idTipo_Requerente, Registo_Postos_Trabalho_Departamento_idDepartamento, Copia_Fatura) VALUES 
					('".trim($nome_equipamento)."', '".trim($numero_serie)."', '".trim($marca)."', '".trim($modelo)."',
					'".trim($numero_inventario)."', '".trim($local_instalacao)."', '".trim($contacto)."', '".trim($estado_material)."', 
					'".trim($user_acesso_internet)."','".trim($password_acesso_internet)."', '".trim($username_equipamento)."', 
					'".trim($password_equipamento)."', '".trim($contacto_suporte)."', '".trim($observacao_equipamento)."',
					'".trim($idtipo_equipamento)."', '".trim($idregisto_postos_trabalho)."',
					'".trim($idrequerente)."', '".trim($idtipo_requerente)."', '".trim($iddepartamento)."', '$nome_pdf')";
			
			$result = mysql_query($sql) or die(mysql_error());
			
				//if($sql){
					//echo "Data Submit Successful";
			$_SESSION['post_data']=NULL;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Equipamento inserido com sucesso, com anexo PDF!'); 
					window.location.replace('equipamentos_Listar.php');
				</script>";
		}
		else{
			 //echo"O arquivo possui extensão inválida, só permite <b>PDF<b>." ;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('O arquivo possui extensão inválida, só permite PDF.'); 
						window.location.replace('equipamentos_Inserir_Formulario.php'); 
				</script>";
		}
	}
	
		
		
	else if((!empty($ficheiro_configuracao["name"]))){
		//echo "selecionado ZIP ";
		$_SESSION['post_data'] = $_POST;
	
		//Verifica se a extensão é ZIP
		if(strstr('.rar, .zip', $extension_zip)){
 
		
			// Gera um nome único para o PDF
			$nome_pdf_zip = md5(uniqid(time())) . "." . $extension_zip;
		 
			// Caminho de onde ficará o PDF
			$caminho_pdf_zip = "Anexos_Equipamentos/" . $nome_pdf_zip;
		 
			// Faz o upload do PDF para seu respectivo caminho
			move_uploaded_file($_FILES["ficheiro_configuracao"]["tmp_name"], $caminho_pdf_zip);
	
			//Insere na BD o nome do PDF
			//$sql=mysql_query("INSERT INTO equipamentos(Ficheiro_Configuracao)VALUES('$nome_pdf_zip')");
			
			$sql = "INSERT INTO equipamentos (
					Nome_Equipamento, Numero_Serie, Marca, Modelo, Numero_Inventario, Local_Instalacao, Contacto, 
					Estado_Material, User_Acesso_Internet, Password_Acesso_Internet, Username_Equipamento,
					Password_Equipamento, Contacto_Suporte, Observacao_Equipamento, Tipo_Equipamento_idTipo_Equipamento,
					Registo_Postos_Trabalho_idRegisto_Postos_Trabalho,  Registo_Postos_Trabalho_Requerente_idRequerente, 
					Registo_Postos_Trabalho_idTipo_Requerente, Registo_Postos_Trabalho_Departamento_idDepartamento, Ficheiro_Configuracao) VALUES 
					('".trim($nome_equipamento)."', '".trim($numero_serie)."', '".trim($marca)."', '".trim($modelo)."',
					'".trim($numero_inventario)."', '".trim($local_instalacao)."', '".trim($contacto)."', '".trim($estado_material)."', 
					'".trim($user_acesso_internet)."','".trim($password_acesso_internet)."', '".trim($username_equipamento)."', 
					'".trim($password_equipamento)."', '".trim($contacto_suporte)."', '".trim($observacao_equipamento)."',
					'".trim($idtipo_equipamento)."', '".trim($idregisto_postos_trabalho)."',
					'".trim($idrequerente)."', '".trim($idtipo_requerente)."', '".trim($iddepartamento)."', '$nome_pdf_zip')";
			
			$result = mysql_query($sql) or die(mysql_error());
			
				//if($sql){
					//echo "Data Submit Successful";
			$_SESSION['post_data']=NULL;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Equipamento inserido com sucesso, com anexo ZIP!'); 
					window.location.replace('equipamentos_Listar.php');
				</script>";
		}
		else{
			 //echo"O arquivo possui extensão inválida, só permite <b>PDF<b>." ;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('O arquivo possui extensão inválida, só permite ZIP ou RAR.'); 
						window.location.replace('equipamentos_Inserir_Formulario.php'); 
				</script>";
		}
		
		
		
	}else{ 
			//echo "sem selecionados";
			try
			{
				$sql = "INSERT INTO equipamentos (
					nome_equipamento, numero_serie, marca, modelo, numero_inventario, local_instalacao, contacto, 
					estado_material, user_acesso_internet, password_acesso_internet, username_equipamento,
					password_equipamento, contacto_suporte, observacao_equipamento, Tipo_Equipamento_idTipo_Equipamento,
					Registo_Postos_Trabalho_idRegisto_Postos_Trabalho,  Registo_Postos_Trabalho_Requerente_idRequerente, 
					Registo_Postos_Trabalho_idTipo_Requerente, Registo_Postos_Trabalho_Departamento_idDepartamento) VALUES 
					('".trim($nome_equipamento)."', '".trim($numero_serie)."', '".trim($marca)."', '".trim($modelo)."',
					'".trim($numero_inventario)."', '".trim($local_instalacao)."', '".trim($contacto)."', '".trim($estado_material)."', 
					'".trim($user_acesso_internet)."','".trim($password_acesso_internet)."', '".trim($username_equipamento)."', 
					'".trim($password_equipamento)."', '".trim($contacto_suporte)."', '".trim($observacao_equipamento)."',
					'".trim($idtipo_equipamento)."', '".trim($idregisto_postos_trabalho)."',
					'".trim($idrequerente)."', '".trim($idtipo_requerente)."', '".trim($iddepartamento)."')";
			
				$result = mysql_query($sql) or die(mysql_error());
		 
				
				$_SESSION['post_data']=NULL;
				echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						  alert('Equipamento inserido com sucesso!'); 
						  window.location.replace('equipamentos_Listar.php');
					   </script>";

			} 
			catch (Exception $ex)
			{
			   $_SESSION['post_data']=NULL;
				echo "<script language='javascript' type='text/javascript' text-align:'center' > 
			         	  alert('Equipamento não inserido!'); 
						  window.location.replace('equipamentos_Listar.php'); 
					 </script>";
			}
			
	}
	
?>