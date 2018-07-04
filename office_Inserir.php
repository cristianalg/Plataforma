<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
	</head>
	
<?php
	$nome_office 			= $_POST["nome_office"];
	$versao_office			= $_POST["versao_office"];
	$descricao_office		= $_POST["descricao_office"];
	$observacao_office		= $_POST["observacao_office"];
	$foto 					= $_FILES["foto"];

	if($nome_office == "" || $versao_office == "")
	{
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
			alert('Os campos com (*) são de preenchimento obrigatório.'); ";
		
		$_SESSION['post_data'] = $_POST;
		
		echo "window.location.replace('office_Inserir_Formulario.php'); </script>";  
		return;
	}

	// Se a foto estiver sido selecionada
	if (!empty($foto["name"])) {
		
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
					alert('Isso não é uma imagem.'); 
					window.location.replace('office_Inserir_Formulario.php'); </script>";
   	 	} 
	
		// Pega as dimensões da imagem
		$dimensoes = getimagesize($foto["tmp_name"]);
	
		// Verifica se a largura da imagem é maior que a largura permitida
		if($dimensoes[0] > $largura) {
			//$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
			 $error[2] = "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('A largura da imagem não deve ultrapassar ".$largura." pixels.'); 
					window.location.replace('office_Inserir_Formulario.php'); </script>";
		}
 
		// Verifica se a altura da imagem é maior que a altura permitida
		if($dimensoes[1] > $altura) {
			//$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
			$error[3] = "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Altura da imagem não deve ultrapassar ".$altura." pixels.'); 
					window.location.replace('office_Inserir_Formulario.php'); </script>";
		}
		
		// Verifica se o tamanho da imagem é maior que o tamanho permitido
		if($foto["size"] > $tamanho) {
   		 	//$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
			$error[4] = "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('A imagem deve ter no máximo ".$tamanho." bytes.'); 
					window.location.replace('office_Inserir_Formulario.php'); </script>";
		}
 
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
		
			$sql = mysql_query("INSERT INTO office ( nome_office, versao_office,descricao_office, observacao_office,foto)VALUES ('".$nome_office."', '".$versao_office."', '".$descricao_office."', '".$observacao_office."', '".$nome_imagem."')");
			if ($sql){
				//echo "sucesso.";
				  $_SESSION['post_data']=NULL;
					echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('Registo inserido com imagem!'); 
						window.location.replace('office_Listar.php'); </script>";
			}else{
				//echo " nao sucesso.";
				  $_SESSION['post_data']=NULL;
					echo "<script language='javascript' type='text/javascript' text-align:'center' > 
						alert('Registo não inserido!'); 
						window.location.replace('office_Listar.php'); </script>";
			}
		
		
		}
		
			// Se houver mensagens de erro, exibe-as
			if (count($error) != 0) {
				foreach ($error as $erro) {
					echo $erro . "<br />";
				}
			}
		}else{
	
			try
			{
				//insere na BD
				//trim — Retira espaço no ínicio e final de uma string
				$sql = "INSERT INTO office (nome_office, versao_office,descricao_office, observacao_office) VALUES ('".trim($nome_office)."', '".trim($versao_office)."', '".trim($descricao_office)."', '".trim($observacao_office)."')";
				
				$result = mysql_query($sql) or die(mysql_error());
				
				$_SESSION['post_data']=NULL;
				echo "<script language='javascript' type='text/javascript' text-align:'center' > 
					alert('Registo inserido sem imagem!'); 
					window.location.replace('office_Listar.php'); </script>";

			} 
			catch (Exception $ex)
			{
			   $_SESSION['post_data']=NULL;
				echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				alert('Registo não inserido!'); 
				window.location.replace('office_Listar.php'); </script>";
			}
		}
?>
	</body>
</html>