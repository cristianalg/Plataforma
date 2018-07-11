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

    <title>Departamentos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  </head>

  <body role="document">
<?php
	include_once("menu_Pagina_Inicial.php");	
	$id = $_GET['id'];
	//Executa consulta
	$result = mysql_query("SELECT * FROM departamento WHERE idDepartamento = '$id'");
	$resultado = mysql_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Departamento</h1>
	</div>
	
	 <div class="row">
		<div class="pull-right">
			<a href='departamento_Listar.php'><img src="imagens/list.png" width="30px"></a></a>
			<a href='departamento_Editar_Formulario.php?id=<?php echo $resultado['idDepartamento']; ?>'><img src="imagens/edit.ico" width="30px"></a></a>
			<a href='departamento_Eliminar.php?id=<?php echo $resultado['idDepartamento']; ?>'><img src='imagens/edit_delete.png' width='30px'></a>
		</div>
	</div> 
	
	
	<div class="row"> 
	
		<div class="col-md-12">
			<div>
				<b>Id:</b>
				<?php echo $resultado['idDepartamento']; ?>
			</div>
			<br>
			
			<div>
				<b>Departamento:</b>
			<?php echo $resultado['Nome_Departamento']; ?>
			</div>
			<br>
			
			<div>
				<b>Observação:</b>
			<?php echo $resultado['Observacao_Departamento']; ?>
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