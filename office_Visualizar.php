<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
include_once("conexao.php");
?>
	
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página Inicial">
    <meta name="author" content="Cristiana">

    <title>Office</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>

	<!-- Zoom da Imagem -->
	<style>
	div.item {
		position: relative;
		width: 300px;
		min-height: 500px;
	}

	div.item div.inner {
	   
		width: 100%;
		height: 600px;
		top: 0;
		left: 0;
		transition: all .2s;
	}

	div.item div.inner:hover {
		position: absolute;
		z-index: 20;
		width: 200%; /*ajusta a largura do zoom*/
		cursor:pointer;
	}

	div.item div.inner img {
		display: block;
		margin: 0 auto;
		width: 100%;

	}
	</style>

  </head>

  <body role="document">
<?php
	include_once("menu_Pagina_Inicial.php");	
	$id = $_GET['id'];
	//Executa consulta
	$result = mysql_query("SELECT * FROM office WHERE idOffice = '$id'");
	$resultado = mysql_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Office</h1>
	</div>
	
	 <div class="row">
		<div class="pull-right">
			<a href='office_Listar.php'><img src="imagens/list.png" width="30px" title="Listar"></a></a>
			<a href='office_Editar_Formulario.php?id=<?php echo $resultado['idOffice']; ?>'><img src="imagens/edit.ico" width="30px" title="Editar"></a>
				<a href="#" onclick="javascript: if (confirm('Deseja remover este registo?'))location.href='office_Eliminar.php?id=<?php echo $resultado['idOffice']; ?>'"><img src='imagens/edit_delete.png' width='30px' title="Eliminar"></a>
		</div>
	</div> 
	
	<div class="row">
		<div class="col-md-12">
			
			<div>
				<b>Id:</b>
				<?php echo $resultado['idOffice']; ?>
			</div>
			<br>
			
			<div>
				<b>Nome do Office:</b>
			<?php echo $resultado['Nome_Office']; ?>
			</div>
			<br>
				
			<div>
				<b>Versão do Office:</b>
				<?php echo $resultado['Versao_Office']; ?>
			</div>
			<br>
			
			<div>
				<b>Descrição:</b>
				<?php echo $resultado['Descricao_Office']; ?>
			</div>
			<br>
			
			<div>
				<b>Observação:</b>
			<?php echo $resultado['Observacao_Office']; ?>
			</div>
			<br>
			
			<div><b>Anexo:</b>
			
			<?php
				$id = $_GET["id"];

				$query ="SELECT foto FROM office WHERE idOffice = '".$id."'";  
				$resultado = mysql_query($query);  
				$linhas = mysql_fetch_array($resultado);
				
				if($linhas['foto'] == NULL){
					//echo "sem foto";
					 echo "Sem Anexo";
				}else{
			?>
					
				<div class="item">
					<div class="inner">
						<?php
					
							$sql = mysql_query("SELECT foto FROM office WHERE idOffice = '$id'");
							 
							while ($img = mysql_fetch_object($sql)) {
								// Exibimos a foto
								echo "<img src='Anexos_Office/".$img->foto."' /><br/>";
							}
				}	
						?>
					</div>
				</div>

			</div>
			
		</div>  
	</div>
</div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>