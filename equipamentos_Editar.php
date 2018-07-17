<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao.php");

	$id   						= $_POST["numeroid"];
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
	
	
		$query ="SELECT Copia_Fatura, Ficheiro_Configuracao FROM equipamentos WHERE idEquipamentos = '".$id."'";  
		$resultado = mysql_query($query);  
		$linhas = mysql_fetch_array($resultado);
	
		//***********Edita o equipamento sem carregar copia de fatura nem ficheiro de configuracao*********
		//Edita copia_fatura e ficheiro_configuracao sem carregar os 2 anexos
		if (($_FILES['copia_fatura']['size'] == 0) and (($_FILES['ficheiro_configuracao']['size'] == 0))){
			
			//echo "copia_fatura e  ficheiro_configuracao não carregada";
			$query = mysql_query("UPDATE equipamentos set nome_equipamento = '$nome_equipamento', numero_serie = '$numero_serie', marca = '$marca', modelo = '$modelo', numero_inventario = '$numero_inventario', local_instalacao = '$local_instalacao', contacto = '$contacto', 
					estado_material = '$estado_material', user_acesso_internet = '$user_acesso_internet', password_acesso_internet = '$password_acesso_internet', username_equipamento = '$username_equipamento',
					password_equipamento = '$password_equipamento', contacto_suporte = '$contacto_suporte', observacao_equipamento = '$observacao_equipamento', 
					Tipo_Equipamento_idTipo_Equipamento = '$idtipo_equipamento', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
					Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento' WHERE idEquipamentos ='$id' ");
			echo "
				
				<script type=\"text/javascript\">
						alert('Equipamento editado com sucesso!'); 
						 window.location.replace('equipamentos_Listar.php'); </script>
				</script>
			";	
			
		}
		
		//********* Falta carregou os 2 anexos ****************
		elseif(($_FILES['copia_fatura']['size'] != 0) and ($_FILES['ficheiro_configuracao']['size'] != 0)){
	
			//echo "carregou os 2 anexos";
			$allowedExts = array("pdf");
			$temp = explode(".", $_FILES["copia_fatura"]["name"]);
			$extension = end($temp);
			
			$temp_zip = explode(".", $_FILES["ficheiro_configuracao"]["name"]);
			$extension_zip = end($temp_zip);
			

				//if(strstr('.pdf', $extension)){
					// Gera um nome único para o PDF
					$nome_pdf= md5(uniqid(time())) . "." . $extension;
				 
					// Caminho de onde ficará o PDF
					$caminho_pdf = "Anexos_Equipamentos/" . $nome_pdf;
				 
					// Faz o upload do PDF para seu respectivo caminho
					move_uploaded_file($_FILES["copia_fatura"]["tmp_name"], $caminho_pdf);
					
				//}elseif(strstr('.rar, .zip', $extension_zip)){
			
					$_SESSION['post_data'] = $_POST;
					
					// Gera um nome único para o PDF
					$nome_pdf_zip = md5(uniqid(time())) . "." . $extension_zip;
				 
					// Caminho de onde ficará o PDF
					$caminho_pdf_zip = "Anexos_Equipamentos/" . $nome_pdf_zip;
				 
					// Faz o upload do PDF para seu respectivo caminho
					move_uploaded_file($_FILES["ficheiro_configuracao"]["tmp_name"], $caminho_pdf_zip);
			
				//}
			        $sql = mysql_query("UPDATE equipamentos set nome_equipamento = '$nome_equipamento', numero_serie = '$numero_serie' , marca = '$marca', modelo = '$modelo', numero_inventario = '$numero_inventario', local_instalacao = '$local_instalacao', contacto = '$contacto', 
					estado_material = '$estado_material', user_acesso_internet = '$user_acesso_internet', password_acesso_internet = '$password_acesso_internet', username_equipamento = '$username_equipamento',
					copia_fatura = '$nome_pdf', ficheiro_configuracao = '$nome_pdf_zip', password_equipamento = '$password_equipamento', contacto_suporte = '$contacto_suporte', observacao_equipamento = '$observacao_equipamento', Tipo_Equipamento_idTipo_Equipamento = '$idtipo_equipamento', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
					Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'WHERE idEquipamentos ='$id' ");
		
					//mysql_query($sql) OR DIE(mysql_error());

					echo "
							<script type=\"text/javascript\">
								alert('Editado com sucesso!'); 
								 window.location.replace('equipamentos_Listar.php'); </script>
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
					$caminho_pdf = "Anexos_Equipamentos/" . $nome_pdf;
				 
					// Faz o upload do PDF para seu respectivo caminho
					move_uploaded_file($_FILES["copia_fatura"]["tmp_name"], $caminho_pdf);
				
					$sql = mysql_query("UPDATE equipamentos set nome_equipamento = '$nome_equipamento', numero_serie = '$numero_serie' , marca = '$marca', modelo = '$modelo', numero_inventario = '$numero_inventario', local_instalacao = '$local_instalacao', contacto = '$contacto', 
					estado_material = '$estado_material', user_acesso_internet = '$user_acesso_internet', password_acesso_internet = '$password_acesso_internet', username_equipamento = '$username_equipamento',
					 copia_fatura = '$nome_pdf', password_equipamento = '$password_equipamento', contacto_suporte = '$contacto_suporte', observacao_equipamento = '$observacao_equipamento', Tipo_Equipamento_idTipo_Equipamento = '$idtipo_equipamento', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
					Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'WHERE idEquipamentos ='$id' ");
		
					//mysql_query($sql) OR DIE(mysql_error());

					echo "
							<script type=\"text/javascript\">
								alert('Editado com sucesso!'); 
								 window.location.replace('equipamentos_Listar.php'); </script>
							</script>
						";	
				}
		
			
			}else{
				//echo"COM copia_fatura  na BD";
				if(isset($_FILES['copia_fatura']))
				{
	
					$result = mysql_query("SELECT * FROM equipamentos WHERE idEquipamentos = '$id' LIMIT 1");
					$resultado = mysql_fetch_assoc($result);

					date_default_timezone_set("Europe/Lisbon"); //Definindo timezone padrão
					$ext = strtolower(substr($_FILES['copia_fatura']['name'],-4)); //verifica extensão do arquivo
					$new_name = $resultado['Copia_Fatura']; //Define um novo nome para o arquivo
					$dir = 'Anexos_Equipamentos/'; //Caminho de onde ficará a imagem

					move_uploaded_file($_FILES['copia_fatura']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo

					$imagem = $new_name;

					//$query = mysql_query("UPDATE  set cargo ='$cargo',  observacao_registo_postos_trabalho = '$observacao_registo_posto_trabalho', Departamento_idDepartamento = '$iddepartamento', Requerente_Tipo_Requerente_idTipo_Requerente = '$idtipo_requerente', Requerente_idRequerente = '$idrequerente',anexo = '$imagem' WHERE idRegisto_Postos_Trabalho = '$id'");
					$query = mysql_query("UPDATE equipamentos set nome_equipamento = '$nome_equipamento', numero_serie = '$numero_serie' , marca = '$marca', modelo = '$modelo', numero_inventario = '$numero_inventario', local_instalacao = '$local_instalacao', contacto = '$contacto', 
						estado_material = '$estado_material', user_acesso_internet = '$user_acesso_internet', password_acesso_internet = '$password_acesso_internet', username_equipamento = '$username_equipamento',
						 copia_fatura = '$imagem', password_equipamento = '$password_equipamento', contacto_suporte = '$contacto_suporte', observacao_equipamento = '$observacao_equipamento', Tipo_Equipamento_idTipo_Equipamento = '$idtipo_equipamento', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
						Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'WHERE idEquipamentos ='$id' ");
			
					echo "
						<script type=\"text/javascript\">
							alert('Editado com sucesso!'); 
							window.location.replace('equipamentos_Listar.php'); </script>
						</script>
					";
			
				}
			}
		}
		
		//***********Edita a Ficheiro de Configuração********************************
		elseif(($_FILES['ficheiro_configuracao']['size'] != 0)){
			//echo "carregou o ficheiro_configuracao";
			
			$temp_zip = explode(".", $_FILES["ficheiro_configuracao"]["name"]);
			$extension_zip = end($temp_zip);
			
			
			if($linhas['Ficheiro_Configuracao'] == NULL){
				//echo"SEM ficheiro_configuracao na BD";
				
				if(strstr('.rar, .zip', $extension_zip)){
			
					$_SESSION['post_data'] = $_POST;
					
					// Gera um nome único para o PDF
					$nome_pdf_zip = md5(uniqid(time())) . "." . $extension_zip;
				 
					// Caminho de onde ficará o PDF
					$caminho_pdf_zip = "Anexos_Equipamentos/" . $nome_pdf_zip;
				 
					// Faz o upload do PDF para seu respectivo caminho
					move_uploaded_file($_FILES["ficheiro_configuracao"]["tmp_name"], $caminho_pdf_zip);
			
					$sql = mysql_query("UPDATE equipamentos set nome_equipamento = '$nome_equipamento', numero_serie = '$numero_serie' , marca = '$marca', modelo = '$modelo', numero_inventario = '$numero_inventario', local_instalacao = '$local_instalacao', contacto = '$contacto', 
					estado_material = '$estado_material', user_acesso_internet = '$user_acesso_internet', password_acesso_internet = '$password_acesso_internet', username_equipamento = '$username_equipamento',
					ficheiro_configuracao = '$nome_pdf_zip', password_equipamento = '$password_equipamento', contacto_suporte = '$contacto_suporte', observacao_equipamento = '$observacao_equipamento', Tipo_Equipamento_idTipo_Equipamento = '$idtipo_equipamento', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
					Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'WHERE idEquipamentos ='$id' ");
		
					//mysql_query($sql) OR DIE(mysql_error());

					echo "
							<script type=\"text/javascript\">
								alert('Editado com sucesso!'); 
								 window.location.replace('equipamentos_Listar.php'); </script>
							</script>
						";	
				}
			}else{
				//echo"COM ficheiro_configuracao  na BD";
				if(isset($_FILES['ficheiro_configuracao']))
				{
	
					$result = mysql_query("SELECT * FROM equipamentos WHERE idEquipamentos = '$id' LIMIT 1");
					$resultado = mysql_fetch_assoc($result);

					date_default_timezone_set("Europe/Lisbon"); //Definindo timezone padrão
					$ext = strtolower(substr($_FILES['ficheiro_configuracao']['name'],-4)); //verifica extensão do arquivo
					$new_name = $resultado['Ficheiro_Configuracao']; //Define um novo nome para o arquivo
					$dir = 'Anexos_Equipamentos/'; //Caminho de onde ficará a imagem

					move_uploaded_file($_FILES['ficheiro_configuracao']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo

					$imagem = $new_name;

					//$query = mysql_query("UPDATE  set cargo ='$cargo',  observacao_registo_postos_trabalho = '$observacao_registo_posto_trabalho', Departamento_idDepartamento = '$iddepartamento', Requerente_Tipo_Requerente_idTipo_Requerente = '$idtipo_requerente', Requerente_idRequerente = '$idrequerente',anexo = '$imagem' WHERE idRegisto_Postos_Trabalho = '$id'");
					$query = mysql_query("UPDATE equipamentos set nome_equipamento = '$nome_equipamento', numero_serie = '$numero_serie' , marca = '$marca', modelo = '$modelo', numero_inventario = '$numero_inventario', local_instalacao = '$local_instalacao', contacto = '$contacto', 
						estado_material = '$estado_material', user_acesso_internet = '$user_acesso_internet', password_acesso_internet = '$password_acesso_internet', username_equipamento = '$username_equipamento',
						ficheiro_configuracao = '$imagem', password_equipamento = '$password_equipamento', contacto_suporte = '$contacto_suporte', observacao_equipamento = '$observacao_equipamento', Tipo_Equipamento_idTipo_Equipamento = '$idtipo_equipamento', Registo_Postos_Trabalho_idRegisto_Postos_Trabalho = '$idregisto_postos_trabalho',  Registo_Postos_Trabalho_Requerente_idRequerente = '$idrequerente', 
						Registo_Postos_Trabalho_idTipo_Requerente = '$idtipo_requerente', Registo_Postos_Trabalho_Departamento_idDepartamento = '$iddepartamento'WHERE idEquipamentos ='$id' ");
			
					echo "
						<script type=\"text/javascript\">
							alert('Editado com sucesso!'); 
							window.location.replace('equipamentos_Listar.php'); </script>
						</script>
					";
			
				}
			}
		}
	
	
?>