<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao.php");

	$id   									= $_POST["numeroid"];
	$cargo									= $_POST["cargo"];
	$observacao_registo_posto_trabalho		= $_POST["observacao_registo_posto_trabalho"];
	$idrequerente							= $_POST["idrequerente"];
	$idtipo_requerente						= $_POST["idtipo_requerente"];
	$iddepartamento							= $_POST["iddepartamento"];
	$anexo 									= $_FILES["anexo"];
	
	$query ="SELECT anexo FROM registo_postos_trabalho WHERE idRegisto_Postos_Trabalho = '".$id."'";  
	$resultado = mysql_query($query);  
	$linhas = mysql_fetch_array($resultado);
	
	if ($_FILES['anexo']['size'] == 0){ //verifica se o user carregou alguma imagem
		//echo "foto não carregada";
		$query = mysql_query("UPDATE registo_postos_trabalho set cargo ='$cargo', observacao_registo_postos_trabalho = '$observacao_registo_posto_trabalho', Departamento_idDepartamento = '$iddepartamento', Requerente_Tipo_Requerente_idTipo_Requerente = '$idtipo_requerente', Requerente_idRequerente = '$idrequerente'
		WHERE idRegisto_Postos_Trabalho = '$id'");
		echo "
			<script type=\"text/javascript\">
				alert('Editado com sucesso!'); 
				 window.location.replace('posto_Trabalho_Listar.php'); </script>
			</script>
		";		
	}elseif($linhas['anexo'] == NULL){
		//echo"BD sem foto";
		
				$error = array();
				// Se não houver nenhum erro
				if (count($error) == 0) {
				
					// Pega extensão da imagem
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $anexo["name"], $ext);
		 
					// Gera um nome único para a imagem
					$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
		 
					// Caminho de onde ficará a imagem
					$caminho_imagem = "Anexos_Postos_Trabalho/" . $nome_imagem;
		 
					// Faz o upload da imagem para seu respectivo caminho
					move_uploaded_file($anexo["tmp_name"], $caminho_imagem);
				
					$sql = mysql_query("UPDATE registo_postos_trabalho set cargo ='$cargo', observacao_registo_postos_trabalho = '$observacao_registo_posto_trabalho', Departamento_idDepartamento = '$iddepartamento', Requerente_Tipo_Requerente_idTipo_Requerente = '$idtipo_requerente', Requerente_idRequerente = '$idrequerente',anexo = '$nome_imagem' WHERE idRegisto_Postos_Trabalho = '$id'");
					echo "
						<script type=\"text/javascript\">
							alert('Editado com sucesso!'); 
							 window.location.replace('posto_Trabalho_Listar.php'); </script>
						</script>
					";	
				}
		
			// Se houver mensagens de erro, exibe-as
			if (count($error) != 0) {
				foreach ($error as $erro) {
					echo $erro . "<br />";
				}
			}
		
		
		}else{
			//echo"BD com foto";
			if(isset($_FILES['anexo']))
			{
	
				$result = mysql_query("SELECT * FROM registo_postos_trabalho WHERE idRegisto_Postos_Trabalho = '$id' LIMIT 1");
				$resultado = mysql_fetch_assoc($result);

				date_default_timezone_set("Europe/Lisbon"); //Definindo timezone padrão
				$ext = strtolower(substr($_FILES['anexo']['name'],-4)); //verifica extensão do arquivo
				$new_name = $resultado['Anexo']; //Define um novo nome para o arquivo
				$dir = 'Anexos_Postos_Trabalho/'; //Caminho de onde ficará a imagem

				move_uploaded_file($_FILES['anexo']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo

				$imagem = $new_name;

				$query = mysql_query("UPDATE registo_postos_trabalho set cargo ='$cargo',  observacao_registo_postos_trabalho = '$observacao_registo_posto_trabalho', Departamento_idDepartamento = '$iddepartamento', Requerente_Tipo_Requerente_idTipo_Requerente = '$idtipo_requerente', Requerente_idRequerente = '$idrequerente',anexo = '$imagem' WHERE idRegisto_Postos_Trabalho = '$id'");
				echo "
					<script type=\"text/javascript\">
						alert('Editado com sucesso!'); 
						window.location.replace('posto_Trabalho_Listar.php'); </script>
					</script>
				";
			
			}
		}

?>