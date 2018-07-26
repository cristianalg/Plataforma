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

    <title>Estado das Assistências Técnicas</title>
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
		$result = mysql_query("SELECT * FROM estado WHERE idEstado = '$id'");
		$resultado = mysql_fetch_assoc($result);  //mysql_fetch_assoc - Obtém uma linha do resultado como um array associativo
	?>

	  
<div class="container theme-showcase" role="main">      
  <div class="page-header">
	<h1>Editar Estado de uma Assistência</h1>
  </div>
  
	
  <div class="row">
	<div class="col-md-12">
	  <form class="form-horizontal" method="POST" action="estado_Assistencia_Editar.php">

		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Estado da Assistência</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="nome_estado_assistencia" placeholder="Estado da Assistência" value="<?php echo $resultado['Nome_Estado_Assistencia']; ?>">
			</div>
		  </div>
		  
		  <input type="hidden" name="numeroid" value="<?php echo $resultado['idEstado']; ?>">
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-danger">Editar</button>
			</div>
		  </div>
		</form>
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

