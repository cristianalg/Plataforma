<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao.php");

	$id   						= $_POST["numeroid"];
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
	
	
		$query ="SELECT Copia_Fatura, Contrato_Protocolo FROM software WHERE idSoftware = '".$id."'";  
		$resultado = mysql_query($query);  
		$linhas = mysql_fetch_array($resultado);
		
		//***********Edita o equipamento sem carregar copia de fatura nem ficheiro de configuracao*********
		//Edita copia_fatura e ficheiro_configuracao sem carregar os 2 anexos
		if (($_FILES['copia_fatura']['size'] == 0) and (($_FILES['contrato_protocolo']['size'] == 0))){
			
			//echo "copia_fatura e  ficheiro_configuracao não carregada";
			$query = mysql_query("UPDATE software set nome_software = '$nome_software', versao = '$versao', data_registo = '$data_registo', data_inicio_contrato = '$data_inicio_contrato', data_renovacao_contrato = '$data_renovacao_contrato',
		observacao_software = '$observacao_software', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
					Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'
					 WHERE idSoftware ='$id' ");
			echo "
				
				<script type=\"text/javascript\">
						alert('Software editado com sucesso!'); 
						 window.location.replace('software_Listar.php'); </script>
				</script>
			";	
			
		}
		
		//********* Falta carregou os 2 anexos ****************
		elseif(($_FILES['copia_fatura']['size'] != 0) and ($_FILES['contrato_protocolo']['size'] != 0)){
	
			//echo "carregou os 2 anexos";
			$allowedExts = array("pdf");
			$temp = explode(".", $_FILES["copia_fatura"]["name"]);
			$extension = end($temp);
			
			$temp_protocolo = explode(".", $_FILES["contrato_protocolo"]["name"]);
			$extension_protocolo = end($temp_protocolo);
			

				//if(strstr('.pdf', $extension)){
					// Gera um nome único para o PDF
					$nome_pdf= md5(uniqid(time())) . "." . $extension;
				 
					// Caminho de onde ficará o PDF
					$caminho_pdf = "Anexos_Software/" . $nome_pdf;
				 
					// Faz o upload do PDF para seu respectivo caminho
					move_uploaded_file($_FILES["copia_fatura"]["tmp_name"], $caminho_pdf);
					
				//}elseif(strstr('.rar, .zip', $extension_zip)){
			
					$_SESSION['post_data'] = $_POST;
					
					// Gera um nome único para o PDF
					$nome_pdf_protocolo = md5(uniqid(time())) . "." . $extension_protocolo;
				 
					// Caminho de onde ficará o PDF
					$caminho_pdf_protocolo = "Anexos_Software/" . $nome_pdf_protocolo;
				 
					// Faz o upload do PDF para seu respectivo caminho
					move_uploaded_file($_FILES["contrato_protocolo"]["tmp_name"], $caminho_pdf_protocolo);
			
				//}
		
					$sql = mysql_query("UPDATE software set nome_software = '$nome_software', versao = '$versao', data_registo = '$data_registo', data_inicio_contrato = '$data_inicio_contrato', data_renovacao_contrato = '$data_renovacao_contrato',
					observacao_software = '$observacao_software',copia_fatura = '$nome_pdf', contrato_protocolo = '$nome_pdf_protocolo', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
					Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'
					 WHERE idSoftware ='$id' ");
	
		
					//mysql_query($sql) OR DIE(mysql_error());

					echo "
							<script type=\"text/javascript\">
								alert('Editado com sucesso!'); 
								 window.location.replace('software_Listar.php'); </script>
							</script>
						";
		}	
		
		//***********Edita a Copia da fatura********************************
		elseif(($_FILES['copia_fatura']['size'] != 0)){
			
			$allowedExts = array("pdf");
			$temp = explode(".", $_FILES["copia_fatura"]["name"]);
			$extension = end($temp);
			
			//echo "carregou o copia_fatura";
			if($linhas['Copia_Fatura'] == NULL){
				//echo"SEM Copia_Fatura na BD";
				
				if(strstr('.pdf', $extension)){
					// Gera um nome único para o PDF
					$nome_pdf= md5(uniqid(time())) . "." . $extension;
				 
					// Caminho de onde ficará o PDF
					$caminho_pdf = "Anexos_Software/" . $nome_pdf;
				 
					// Faz o upload do PDF para seu respectivo caminho
					move_uploaded_file($_FILES["copia_fatura"]["tmp_name"], $caminho_pdf);
				
					$sql = mysql_query("UPDATE software set nome_software = '$nome_software', versao = '$versao', data_registo = '$data_registo', data_inicio_contrato = '$data_inicio_contrato', data_renovacao_contrato = '$data_renovacao_contrato',
					observacao_software = '$observacao_software',copia_fatura = '$nome_pdf', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
					Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'
					 WHERE idSoftware ='$id' ");
		
					//mysql_query($sql) OR DIE(mysql_error());

					echo "
							<script type=\"text/javascript\">
								alert('Editado com sucesso!'); 
								 window.location.replace('software_Listar.php'); </script>
							</script>
						";	
				}
		
			
			}else{
				//echo"COM copia_fatura  na BD";
				if(isset($_FILES['copia_fatura']))
				{
	
					$result = mysql_query("SELECT * FROM software WHERE idSoftware = '$id' LIMIT 1");
					$resultado = mysql_fetch_assoc($result);

					date_default_timezone_set("Europe/Lisbon"); //Definindo timezone padrão
					$ext = strtolower(substr($_FILES['copia_fatura']['name'],-4)); //verifica extensão do arquivo
					$new_name = $resultado['Copia_Fatura']; //Define um novo nome para o arquivo
					$dir = 'Anexos_Software/'; //Caminho de onde ficará a imagem

					move_uploaded_file($_FILES['copia_fatura']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo

					$imagem = $new_name;

					//$query = mysql_query("UPDATE  set cargo ='$cargo',  observacao_registo_postos_trabalho = '$observacao_registo_posto_trabalho', Departamento_idDepartamento = '$iddepartamento', Requerente_Tipo_Requerente_idTipo_Requerente = '$idtipo_requerente', Requerente_idRequerente = '$idrequerente',anexo = '$imagem' WHERE idRegisto_Postos_Trabalho = '$id'");
					$query = mysql_query("UPDATE software set nome_software = '$nome_software', versao = '$versao', data_registo = '$data_registo', data_inicio_contrato = '$data_inicio_contrato', data_renovacao_contrato = '$data_renovacao_contrato',
					observacao_software = '$observacao_software',copia_fatura = '$imagem', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
					Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'
					 WHERE idSoftware ='$id' ");
			
					echo "
						<script type=\"text/javascript\">
							alert('Editado com sucesso!'); 
							window.location.replace('software_Listar.php'); </script>
						</script>
					";
			
				}
			}
		}
		
		//***********Edita o Contrato_Protocolo********************************
		elseif(($_FILES['contrato_protocolo']['size'] != 0)){
			//echo "carregou o fContrato_Protocolo";
			
			$allowedExts = array("pdf");
			$temp_protocolo = explode(".", $_FILES["contrato_protocolo"]["name"]);
			$extension_protocolo = end($temp_protocolo);
			
			
			if($linhas['Contrato_Protocolo'] == NULL){
				//echo"SEM Contrato_Protocolo na BD";
				
				if(strstr('.pdf', $extension_protocolo)){
			
					$_SESSION['post_data'] = $_POST;
					
					// Gera um nome único para o PDF
					$nome_pdf_protocolo = md5(uniqid(time())) . "." . $extension_protocolo;
				 
					// Caminho de onde ficará o PDF
					$caminho_pdf_protocolo = "Anexos_Software/" . $nome_pdf_protocolo;
				 
					// Faz o upload do PDF para seu respectivo caminho
					move_uploaded_file($_FILES["contrato_protocolo"]["tmp_name"], $caminho_pdf_protocolo);
			
					$sql = mysql_query("UPDATE software set nome_software = '$nome_software', versao = '$versao', data_registo = '$data_registo', data_inicio_contrato = '$data_inicio_contrato', data_renovacao_contrato = '$data_renovacao_contrato',
					observacao_software = '$observacao_software', contrato_protocolo = '$nome_pdf_protocolo', contrato_protocolo = '$nome_pdf_protocolo', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
					Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'
					 WHERE idSoftware ='$id' ");
		
					//mysql_query($sql) OR DIE(mysql_error());

					echo "
							<script type=\"text/javascript\">
								alert('Editado com sucesso!'); 
								 window.location.replace('software_Listar.php'); </script>
							</script>
						";	
				}
			}else{
				//echo"COM fContrato_Protocolo  na BD";
				if(isset($_FILES['contrato_protocolo']))
				{
	
					$result = mysql_query("SELECT * FROM software WHERE idSoftware = '$id' LIMIT 1");
					$resultado = mysql_fetch_assoc($result);

					date_default_timezone_set("Europe/Lisbon"); //Definindo timezone padrão
					$ext = strtolower(substr($_FILES['contrato_protocolo']['name'],-4)); //verifica extensão do arquivo
					$new_name = $resultado['Contrato_Protocolo']; //Define um novo nome para o arquivo
					$dir = 'Anexos_Software/'; //Caminho de onde ficará a imagem

					move_uploaded_file($_FILES['contrato_protocolo']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo

					$imagem = $new_name;

					//$query = mysql_query("UPDATE  set cargo ='$cargo',  observacao_registo_postos_trabalho = '$observacao_registo_posto_trabalho', Departamento_idDepartamento = '$iddepartamento', Requerente_Tipo_Requerente_idTipo_Requerente = '$idtipo_requerente', Requerente_idRequerente = '$idrequerente',anexo = '$imagem' WHERE idRegisto_Postos_Trabalho = '$id'");
					$query = mysql_query("UPDATE software set nome_software = '$nome_software', versao = '$versao', data_registo = '$data_registo', data_inicio_contrato = '$data_inicio_contrato', data_renovacao_contrato = '$data_renovacao_contrato',
					observacao_software = '$observacao_software', contrato_protocolo = '$imagem', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
					Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'
					 WHERE idSoftware ='$id' ");
			
					echo "
						<script type=\"text/javascript\">
							alert('Editado com sucesso!'); 
							window.location.replace('software_Listar.php'); </script>
						</script>
					";
			
				}
			}
		}
?>