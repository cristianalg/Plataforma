<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
?>
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página Inicial">
    <meta name="author" content="Cristiana">

    <title>Técnicos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script->
  </head>

  <body role="document">
	<?php
		include_once("menu_Pagina_Inicial.php");		
	?>	
    <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Inserir Técnico</h1>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="processa/inserir_Tecnico.php"> 
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nome</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="nome" placeholder="Nome">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Apelido</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="nome" placeholder="Apelido">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Número de Funcionário</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="nome" placeholder="Número de Funcionário">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">E-mail</label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" name="email" placeholder="email@example.com">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Contacto</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="contacto" placeholder="Contacto">
				</div>
			  </div>
			  
			 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Função</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="funcao" placeholder="Função">
				</div>
			  </div>  
		    
			  <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">User</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" name="user" placeholder="@User">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Password</label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" name="password" placeholder="Password">
				</div>
			  </div>
			  
			    <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Observação</label>
				<div class="col-sm-10">
				   <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
				</div>
			  </div>
			  
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success">Inserir</button>
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
