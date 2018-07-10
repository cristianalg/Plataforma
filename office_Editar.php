<?php
	session_start();
	include_once("seguranca.php");
	include_once("conexao.php");

	$id   					= $_POST["numeroid"];
	$nome_office 			= $_POST["nome_office"];
	$versao_office 			= $_POST["versao_office"];
	$descricao_office 		= $_POST["descricao_office"];
	$observacao_office		= $_POST["observacao_office"];
	$foto 					= $_FILES["foto"];

	
	$query ="SELECT foto FROM office WHERE idOffice = '".$id."'";  
	$resultado = mysql_query($query);  
	$linhas = mysql_fetch_array($resultado);
	
	if ($_FILES['foto']['size'] == 0){ //verifica se o user carregou alguma imagem
		//echo "foto não carregada";
		$query = mysql_query("UPDATE office set nome_office ='$nome_office', versao_office ='$versao_office', descricao_office ='$descricao_office',observacao_office = '$observacao_office' WHERE idOffice = '$id'");
		echo "
			<script type=\"text/javascript\">
				alert('Editado com sucesso!'); 
				 window.location.replace('office_Listar.php'); </script>
			</script>
		";		
	}elseif($linhas['foto'] == NULL){
		//echo"BD sem foto";
		
		// Se a foto estiver sido selecionada
			/*if (!empty($foto["name"])) {
				
				//echo "foto carregada mas é para insert";
				
				// Largura máxima em pixels
				$largura = 1920;
				// Altura máxima em pixels
				$altura = 1080;
				// Tamanho máximo do arquivo em bytes
				$tamanho = 500000;
		 
				$error = array();
		 
				// Verifica se o arquivo é uma imagem
				if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
				   //$error[1] = "Isso não é uma imagem.";
				   $error[1] = "<script language='javascript' type='text/javascript' text-align:'center' > 
							alert('O formato não é de imagem.'); 
							window.location.replace('office_Editar_Formulario.php'); </script>";
				} 
			
				// Pega as dimensões da imagem
				$dimensoes = getimagesize($foto["tmp_name"]);
			
				// Verifica se a largura da imagem é maior que a largura permitida
				if($dimensoes[0] > $largura) {
					//$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
					 $error[2] = "<script language='javascript' type='text/javascript' text-align:'center' > 
							alert('A largura da imagem não deve ultrapassar ".$largura." pixels.'); 
							window.location.replace('office_Editar_Formulario.php'); </script>";
				}
		 
				// Verifica se a altura da imagem é maior que a altura permitida
				if($dimensoes[1] > $altura) {
					//$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
					$error[3] = "<script language='javascript' type='text/javascript' text-align:'center' > 
							alert('Altura da imagem não deve ultrapassar ".$altura." pixels.'); 
							window.location.replace('office_Editar_Formulario.php'); </script>";
				}
				
				// Verifica se o tamanho da imagem é maior que o tamanho permitido
				if($foto["size"] > $tamanho) {
					//$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
					$error[4] = "<script language='javascript' type='text/javascript' text-align:'center' > 
							alert('A imagem deve ter no máximo ".$tamanho." bytes.'); 
							window.location.replace('office_Editar_Formulario.php'); </script>";
				}*/
		 
		 $error = array();
				// Se não houver nenhum erro
				if (count($error) == 0) {
				
					// Pega extensão da imagem
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
		 
					// Gera um nome único para a imagem
					$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
		 
					// Caminho de onde ficará a imagem
					$caminho_imagem = "Anexos_Office/" . $nome_imagem;
		 
					// Faz o upload da imagem para seu respectivo caminho
					move_uploaded_file($foto["tmp_name"], $caminho_imagem);
				
					$sql = mysql_query("UPDATE office set nome_office ='$nome_office', versao_office ='$versao_office', descricao_office ='$descricao_office',observacao_office = '$observacao_office', foto = '$nome_imagem' WHERE idOffice = '$id'");
					echo "
						<script type=\"text/javascript\">
							alert('Editado com sucesso!'); 
							 window.location.replace('office_Listar.php'); </script>
						</script>
					";
				}
			//}
		
			// Se houver mensagens de erro, exibe-as
			if (count($error) != 0) {
				foreach ($error as $erro) {
					echo $erro . "<br />";
				}
			}
		
		
		}else{
			//echo"BD com foto";
			if(isset($_FILES['foto']))
			{
				$result = mysql_query("SELECT * FROM office WHERE idOffice = '$id' LIMIT 1");
				$resultado = mysql_fetch_assoc($result);

				date_default_timezone_set("Europe/Lisbon"); //Definindo timezone padrão
				$ext = strtolower(substr($_FILES['foto']['name'],-4)); //verifica extensão do arquivo
				$new_name = $resultado['foto']; //Define um novo nome para o arquivo
				$dir = 'Anexos_Office/'; //Caminho de onde ficará a imagem

				move_uploaded_file($_FILES['foto']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo

				$imagem = $new_name;

				$query = mysql_query("UPDATE office set nome_office ='$nome_office', versao_office ='$versao_office', descricao_office ='$descricao_office',observacao_office = '$observacao_office', foto = '$imagem' WHERE idOffice = '$id'");
				echo "
					<script type=\"text/javascript\">
						alert('Editado com sucesso!'); 
						window.location.replace('office_Listar.php'); </script>
					</script>
				";
			}
		}

?>