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

    <title>Instalação de Computadores</title>
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
	$result = mysql_query("SELECT * FROM instalacao_computadores WHERE 	idInstalacao_Computadores = '$id'");
	$resultado = mysql_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Instalação de Computadores</h1>
	</div>
	
	 <div class="row">
		<div class="pull-right">
			<a href='instalacao_Computadores_Listar.php'><img src="imagens/list.png" width="30px" title="Listar"></a></a>
			<a href='instalacao_Computadores_Editar_Formulario.php?id=<?php echo $resultado['idInstalacao_Computadores']; ?>'><img src="imagens/edit.ico" width="30px" title="Editar"></a></a>
			<a href="#" onclick="javascript: if (confirm('Deseja remover este registo?'))location.href='instalacao_computadores_Eliminar.php?id=<?php echo $resultado['idInstalacao_Computadores']; ?>'"><img src='imagens/edit_delete.png' width='30px' title="Eliminar"></a>
		</div>
	</div> 
	
	<div class="row">
		<div class="col-md-12">
				<div>
				<b>Id:</b>
				<?php echo $resultado['idInstalacao_Computadores']; ?>
			</div>
			<br>
			
			<div>
				<b>Data da Instalação:</b>
			<?php echo $resultado['Data_Instalacao_Computadores']; ?>
			</div>
			<br>
			
			<div>
				<b>Nome da Instalação:</b>
			<?php echo $resultado['Nome_Instalacao']; ?>
			</div>
			<br>	
			
			<div>
				<b>Nome da Rede:</b>
			<?php echo $resultado['Nome_Rede']; ?>
			</div>
			<br>
			
			<div>
				<b>Impressora Follow Mes:</b>
			<?php 
				$sem = "Não";
				$com = "Sim";
				if($resultado['Impressora'] == 0){
					echo "<td>".$sem. "</td>";
				}else{
					echo "<td>".$com."</td>";
				}
			?>
			</div>	
			<br>
			
			<div>
				<b>Antivirus:</b>
			<?php 
				$sem = "Não";
				$com = "Sim";
				if($resultado['Antivirus'] == 0){
					echo "<td>".$sem. "</td>";
				}else{
					echo "<td>".$com."</td>";
				}
			?>
			</div>	
			<br>
			
			
			<div>
				<b>Sistema Operativo:</b>
			
			<?php
				$result_cat =mysql_query("SELECT Nome_Sistema_Operativo FROM sistema_operativo INNER JOIN instalacao_computadores 
				ON sistema_operativo.idSistema_Operativo = instalacao_computadores.Sistema_Operativo_idSistema_Operativo 
				where instalacao_computadores.idInstalacao_Computadores = ".$resultado['idInstalacao_Computadores'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Sistema_Operativo']."</td>";
				}
			?>
			</div>
			<br>
				
			<div>
				<b>Office:</b>
			
			<?php
				$result_cat =mysql_query("SELECT Nome_Office FROM office INNER JOIN instalacao_computadores 
				ON office.idOffice = instalacao_computadores.Office_idOffice 
				where instalacao_computadores.idInstalacao_Computadores = ".$resultado['idInstalacao_Computadores'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Office']."</td>";
				}
			?>
			</div>
			<br>
			
			<div>
				<b>Aplicativos:</b>
			<?php echo $resultado['Aplicativo']; ?>
			</div>
			<br>
			
			<div>
				<b>AIRC:</b>
			<?php echo $resultado['AIRC']; ?>
			</div>
			<br>
			
			<div>
				<b>Estado:</b>
			
			<?php
				$result_cat =mysql_query("SELECT Nome_Estado_Assistencia FROM estado INNER JOIN instalacao_computadores 
				ON estado.idEstado = instalacao_computadores.Estado_idEstado 
				where instalacao_computadores.idInstalacao_Computadores = ".$resultado['idInstalacao_Computadores'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Estado_Assistencia']."</td>";
				}
			?>
			</div>
			<br>
			
			<div>
				<b>Observação:</b>
			<?php echo $resultado['Observacao_Instalacao_Computadores']; ?>
			</div>
			<br>
		
			
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

