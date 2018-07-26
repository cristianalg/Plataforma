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

    <title>Técnicos</title>
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
		$result = mysql_query("SELECT * FROM tecnico WHERE idTecnico = '$id'");
		$resultado = mysql_fetch_assoc($result);  //mysql_fetch_assoc - Obtém uma linha do resultado como um array associativo
	?>

	  
<div class="container theme-showcase" role="main">      
  <div class="page-header">
	<h1>Editar Técnico</h1>
  </div>
  <!--<div class="row espaco">
		<div class="pull-right">
			<a href='administrativo.php?link=2&id=<?php echo $resultado['id']; ?>'><button type='button' class='btn btn-sm btn-info'>Listar</button></a>
	
			<a href='processa/proc_apagar_utilizaador.php?id=<?php echo $resultado['id']; ?>'><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
		</div>
	</div>-->
	
  <div class="row">
	<div class="col-md-12">
	  <form class="form-horizontal" method="POST" action="tecnico_Editar.php">

		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php echo $resultado['Nome']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Apelido</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="apelido" placeholder="Apelido" value="<?php echo $resultado['Apelido']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Nº Funcionário</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="numero_funcionario" placeholder="numero_funcionario" value="<?php echo $resultado['Numero_Funcionario']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">E-mail</label>
			<div class="col-sm-10">
			  <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php echo $resultado['Email']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Contacto</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="contacto" placeholder="Contacto" value="<?php echo $resultado['Contacto']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Função</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="funcao" placeholder="Função" value="<?php echo $resultado['Funcao']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Login</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="user" placeholder="User" value="<?php echo $resultado['User']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
			  <input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo $resultado['Password']; ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Observação</label>
			<div class="col-sm-10">
				<?php
					echo '<textarea class="form-control" rows="3" name="observacao_tecnico">'. $resultado['Observacao_Tecnico']. '</textarea>';
				?>
				
			</div>
		  </div>
		  
		 



		  
		  <input type="hidden" name="numeroid" value="<?php echo $resultado['idTecnico']; ?>">
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

