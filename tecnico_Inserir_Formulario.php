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
	  
		if(isset($_SESSION['post_data'])){
			$_POST 					= $_SESSION['post_data'];
			$nome 					= $_POST["nome"];
			$apelido 				= $_POST["apelido"];
			$numero_funcionario		= $_POST["numero_funcionario"];
			$email 					= $_POST["email"];
			$contacto 				= $_POST["contacto"];
			$funcao 				= $_POST["funcao"];
			$user 					= $_POST["user"];
			$password 				= $_POST["password"];
			$observacao_tecnico 	= $_POST["observacao_tecnico"];
		}
		

	?>	
    <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Inserir Técnico</h1>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="tecnico_Inserir.php"> 
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nome<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <!-- <input type="text" class="form-control" name="nome" placeholder="Nome">-->
 
				  <input type="text" class="form-control" name="nome" placeholder="Nome" value="<?php if(isset($_POST["nome"])){ echo $_POST["nome"];} ?>">
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Apelido<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="apelido" placeholder="Apelido" value="<?php if(isset($_POST["apelido"])){ echo $_POST["apelido"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nº Funcionário<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="numero_funcionario" placeholder="Número de Funcionário" value="<?php if(isset($_POST["numero_funcionario"])){ echo $_POST["numero_funcionario"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">E-mail<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="email" class="form-control" name="email" placeholder="email@example.com" value="<?php if(isset($_POST["email"])){ echo $_POST["email"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Contacto<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" type="tel" class="form-control" name="contacto" placeholder="Contacto" value="<?php if(isset($_POST["contacto"])){ echo $_POST["contacto"];} ?>">
				</div>
			  </div>
			  
			 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Função<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="funcao" placeholder="Função" value="<?php if(isset($_POST["funcao"])){ echo $_POST["funcao"];} ?>">
				</div>
			  </div>  
		    
			  <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">User<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" name="user" placeholder="@User" value="<?php if(isset($_POST["user"])){ echo $_POST["user"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Password<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="password" class="form-control" name="password" placeholder="Password" value="<?php if(isset($_POST["password"])){ echo $_POST["password"];} ?>">
				</div>
			  </div>
			  
			    <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Observação</label>
				<div class="col-sm-10">
				   <textarea class="form-control" id="observacao_tecnico" rows="3" name="observacao_tecnico" value="<?php if(isset($_POST["observacao_tecnico"])){ echo $_POST["observacao_tecnico"];} ?>"></textarea>
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


