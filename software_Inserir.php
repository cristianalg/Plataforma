<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao.php");

	$nome_software				= $_POST["nome_software"];
	$data_registo				= $_POST["data_registo"];
	$data_inicio_contrato		= $_POST["data_inicio_contrato"];
	$data_renovacao_contrato	= $_POST["data_renovacao_contrato"];
	$versao						= $_POST["versao"];
	$observacao_software		= $_POST["observacao_software"];
	$idrequerente				= $_POST["idrequerente"];
	$iddepartamento				= $_POST["iddepartamento"];
	$copia_fatura				= $_FILES["copia_fatura"];	
	$contrato_protocolo			= $_FILES["contrato_protocolo"];
	
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

	

	if($nome_software == "" || $data_registo == "" || $data_inicio_contrato == "" || $data_renovacao_contrato == "" 
	|| $versao == "" || $iddepartamento == "" || $idrequerente == "")
	{
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
			alert('Os campos com (*) são de preenchimento obrigatório.'); ";
		
		// session_start();
		$_SESSION['post_data'] = $_POST;
		
		echo "window.location.replace('software_Inserir_Formulario.php'); </script>";  
		return;
	}
	
	//Copia da fatura - PDF
	$allowedExts = array("pdf");
	$temp = explode(".", $_FILES["copia_fatura"]["name"]);
	$extension = end($temp);
	
	//Contrato_Protocolo - PDF
	$temp_Protocolo = explode(".", $_FILES["contrato_protocolo"]["name"]);
	$extension_Protocolo  = end($temp_Protocolo );
	
	
	// Verifica se foi selecionado cópia da fatura ou Contrato_Protocolo
	if ((!empty($copia_fatura["name"])) and (!empty($contrato_protocolo["name"]))){
		//echo "selecionado PDF";
		$_SESSION['post_data'] = $_POST;
		
		if(strstr('.pdf', $extension)){
			
			$_SESSION['post_data'] = $_POST;
			// Gera um nome único para o PDF
			$nome_pdf= md5(uniqid(time())) . "." . $extension;
		 
			// Caminho de onde ficará o PDF
			$caminho_pdf = "Anexos_Software/" . $nome_pdf;
		 
			// Faz o upload do PDF para seu respectivo caminho
			move_uploaded_file($_FILES["copia_fatura"]["tmp_name"], $caminho_pdf);
			
			
			
		}else{
			 //echo"O arquivo possui extensão inválida, só permite <b>PDF<b>." ;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('A cópia da fatura possui extensão inválida, só permite PDF.'); 
						window.location.replace('software_Inserir_Formulario.php'); 
				</script>";
		}	

		
		
		//Verifica se a extensão do Contrato_Protocolo 
			if(strstr('.pdf', $extension_Protocolo)){
			
			$_SESSION['post_data'] = $_POST;
			
			// Gera um nome único para o PDF
			$nome_pdf_Protocolo = md5(uniqid(time())) . "." . $extension_Protocolo;
		 
			// Caminho de onde ficará o PDF
			$caminho_pdf_Protocolo= "Anexos_Software/" . $nome_pdf_Protocolo;
		 
			// Faz o upload do PDF para seu respectivo caminho
			move_uploaded_file($_FILES["contrato_protocolo"]["tmp_name"], $caminho_pdf_Protocolo);
			
		}else{
			 //echo"O arquivo possui extensão inválida, só permite <b>PDF<b>." ;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('O Contrato/Protocolo possui extensão inválida, só permite PDF.'); 
						window.location.replace('software_Inserir_Formulario.php'); 
				</script>";
		}	
			
			$sql = "INSERT INTO software (
					Nome_Software, Data_Registo, Data_Inicio_Contrato, Data_Renovacao_Contrato, Versao, Observacao_Software,
					Registo_Postos_Trabalho_idRegisto_Postos_Trabalho,  Registo_Postos_Trabalho_Requerente_idRequerente, 
					Registo_Postos_Trabalho_idTipo_Requerente, Registo_Postos_Trabalho_Departamento_idDepartamento,Copia_Fatura, Contrato_Protocolo) VALUES 
					('".trim($nome_software)."', '".trim($data_registo)."', '".trim($data_inicio_contrato)."', '".trim($data_renovacao_contrato)."',
					'".trim($versao)."', '".trim($observacao_software)."', '".trim($idregisto_postos_trabalho)."',
					'".trim($idrequerente)."', '".trim($idtipo_requerente)."', '".trim($iddepartamento)."', '$nome_pdf', '$nome_pdf_Protocolo')";
			
			
			
			
			$result = mysql_query($sql) or die(mysql_error());
			
				//if($sql){
					//echo "Data Submit Successful";
			$_SESSION['post_data']=NULL;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Software inserido com sucesso!'); 
					window.location.replace('software_Listar.php');
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
			$caminho_pdf = "Anexos_Software/" . $nome_pdf;
		 
			// Faz o upload do PDF para seu respectivo caminho
			move_uploaded_file($_FILES["copia_fatura"]["tmp_name"], $caminho_pdf);
				
			//Insere na BD o nome do PDF
			//$sql=mysql_query("INSERT INTO equipamentos(Copia_Fatura)VALUES('$nome_pdf')");
			
			$sql = "INSERT INTO software (
					Nome_Software, Data_Registo, Data_Inicio_Contrato, Data_Renovacao_Contrato, Versao, Observacao_Software,
					Registo_Postos_Trabalho_idRegisto_Postos_Trabalho,  Registo_Postos_Trabalho_Requerente_idRequerente, 
					Registo_Postos_Trabalho_idTipo_Requerente, Registo_Postos_Trabalho_Departamento_idDepartamento,Copia_Fatura) VALUES 
					('".trim($nome_software)."', '".trim($data_registo)."', '".trim($data_inicio_contrato)."', '".trim($data_renovacao_contrato)."',
					'".trim($versao)."', '".trim($observacao_software)."', '".trim($idregisto_postos_trabalho)."',
					'".trim($idrequerente)."', '".trim($idtipo_requerente)."', '".trim($iddepartamento)."', '$nome_pdf')";
			
			
			$result = mysql_query($sql) or die(mysql_error());
			
				//if($sql){
					//echo "Data Submit Successful";
			$_SESSION['post_data']=NULL;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Software inserido com sucesso!'); 
					window.location.replace('software_Listar.php');
				</script>";
		}
		else{
			 //echo"O arquivo possui extensão inválida, só permite <b>PDF<b>." ;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('A cópia da fatura possui extensão inválida, só permite PDF.'); 
						window.location.replace('software_Inserir_Formulario.php'); 
				</script>";
		}
	}
	
		
		
	else if((!empty($contrato_protocolo["name"]))){
		//echo "selecionado ZIP ";
		$_SESSION['post_data'] = $_POST;
	
		//Verifica se a extensão é ZIP
		if(strstr('.pdf', $extension_Protocolo)){
 
		
			// Gera um nome único para o PDF
			$nome_pdf_Protocolo = md5(uniqid(time())) . "." . $extension_Protocolo;
		 
			// Caminho de onde ficará o PDF
			$caminho_pdf_Protocolo = "Anexos_Software/" . $nome_pdf_Protocolo;
		 
			// Faz o upload do PDF para seu respectivo caminho
			move_uploaded_file($_FILES["contrato_protocolo"]["tmp_name"], $caminho_pdf_Protocolo);
	
			//Insere na BD o nome do PDF
			//$sql=mysql_query("INSERT INTO equipamentos(Ficheiro_Configuracao)VALUES('$nome_pdf_zip')");
			
			
			$sql = "INSERT INTO software (
					Nome_Software, Data_Registo, Data_Inicio_Contrato, Data_Renovacao_Contrato, Versao, Observacao_Software,
					Registo_Postos_Trabalho_idRegisto_Postos_Trabalho,  Registo_Postos_Trabalho_Requerente_idRequerente, 
					Registo_Postos_Trabalho_idTipo_Requerente, Registo_Postos_Trabalho_Departamento_idDepartamento, Contrato_Protocolo) VALUES 
					('".trim($nome_software)."', '".trim($data_registo)."', '".trim($data_inicio_contrato)."', '".trim($data_renovacao_contrato)."',
					'".trim($versao)."', '".trim($observacao_software)."', '".trim($idregisto_postos_trabalho)."',
					'".trim($idrequerente)."', '".trim($idtipo_requerente)."', '".trim($iddepartamento)."', '$nome_pdf_Protocolo')";
			
			$result = mysql_query($sql) or die(mysql_error());
			
				//if($sql){
					//echo "Data Submit Successful";
			$_SESSION['post_data']=NULL;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Software inserido com sucesso!'); 
					window.location.replace('software_Listar.php');
				</script>";
		}
		else{
			 //echo"O arquivo possui extensão inválida, só permite <b>PDF<b>." ;
			echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('O Contrato/Protocolo possui extensão inválida, só permite PDF.'); 
						window.location.replace('software_Inserir_Formulario.php'); 
				</script>";
		}
		
		
	}else{ 
			//echo "sem selecionados";
			try
			{
			
				$sql = "INSERT INTO software (
					Nome_Software, Data_Registo, Data_Inicio_Contrato, Data_Renovacao_Contrato, Versao, Observacao_Software,
					Registo_Postos_Trabalho_idRegisto_Postos_Trabalho,  Registo_Postos_Trabalho_Requerente_idRequerente, 
					Registo_Postos_Trabalho_idTipo_Requerente, Registo_Postos_Trabalho_Departamento_idDepartamento) VALUES 
					('".trim($nome_software)."', '".trim($data_registo)."', '".trim($data_inicio_contrato)."', '".trim($data_renovacao_contrato)."',
					'".trim($versao)."', '".trim($observacao_software)."', '".trim($idregisto_postos_trabalho)."',
					'".trim($idrequerente)."', '".trim($idtipo_requerente)."', '".trim($iddepartamento)."')";
			
				$result = mysql_query($sql) or die(mysql_error());
		 
				
				$_SESSION['post_data']=NULL;
				echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						  alert('Software inserido com sucesso!'); 
						  window.location.replace('software_Listar.php');
					   </script>";

			} 
			catch (Exception $ex)
			{
			   $_SESSION['post_data']=NULL;
				echo "<script language='javascript' type='text/javascript' text-align:'center' > 
			         	  alert('Software não inserido!'); 
						  window.location.replace('software_Listar.php'); 
					 </script>";
			}
			
	}
	
?>