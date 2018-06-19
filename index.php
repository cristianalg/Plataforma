<?php
	session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
?>
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página para realizar login">
    <meta name="author" content="Cristiana">

    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signin.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>

  </head>

  <style type="text/css" media="screen">
*  {
	margin:0;
	padding:0;
}

html, body {height:100%;}

.geral {
	min-height:100%;
	position:relative;
	width:800px;
}

.footer {
	position:absolute;
	bottom:0;
	width:100%;
}

.content {overflow:hidden;}
.aside {width:200px;}
.fleft {float:left;}
.fright {float:right;}

</style>
  
  <body>
	<?php
		unset($_SESSION['utilizadorIdTecnico'], 			
			  $_SESSION['utilizadorNome'], 				
			  $_SESSION['utilizadorApelido'], 				
			  $_SESSION['utilizadorNumero_Funcionario'], 	
			  $_SESSION['utilizadorEmail'], 				
			  $_SESSION['utilizadorContacto'], 			
			  $_SESSION['utilizadorFuncao'], 				
			  $_SESSION['utilizadorUser'],			
			  $_SESSION['utilizadorPassword']);
	?>
    <div class="container">		
      <form class="form-signin" method="POST" action="valida_login.php">
		&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
		<img class="form-signin-heading text-center" src="imagens/Celorico_Logo_150.png">
        <!--<h4 class="form-signin-heading text-center">Câmara Municipal Celorico da Beira</h4> -->
		<p><font face="verdana" class="form-signin-heading text-center" size="3">Câmara Municipal Celorico da Beira</font></p>
        <label for="inputEmail" class="sr-only">Utilizador</label>
		
        <input type="text" name="utilizador" class="form-control" placeholder="Utilizador" required autofocus><br />
		
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required >
        
		<!--<button class="btn btn-secondary my-2 my-sm-0"  type="submit">Login</button>
		<button type="button" class="btn btn-primary">Login</button> -->
        <button class="btn btn btn-primary btn-block" type="submit">Login</button>
      </form>
		<p class="text-center text-danger">
			<?php
				if(isset($_SESSION['loginErro'])){
					echo $_SESSION['loginErro'];
					unset($_SESSION['loginErro']);
				}
			?>
		</p>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	
	
<!--Rodapé -->
<div class="content">
	<div class="footer">
		<font class="footer text-left"  face="Brush Script">©Cristiana Gabriel</font>
		<font class="footer text-center" face="Brush Script">|| Projeto em Contexto de Estágio ||</font>
		<font class="footer text-right" face="Brush Script">Engenharia Informática - IPG</font>
	</div>
</div>

  </body>
</html>