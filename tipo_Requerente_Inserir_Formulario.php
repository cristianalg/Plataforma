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

    <title>Tipo de Requerentes</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script->
	
  </head>

  <body role="document">
	<?php
		include_once("menu_Pagina_Inicial.php");	
	  
		if(isset($_SESSION['post_data'])){
			$_POST 							= $_SESSION['post_data'];
			$nome_tipo_requerente 			= $_POST["nome_tipo_requerente"];
			$tipo_entidade					= $_POST["tipo_entidade"];
			$observacao_tipo_requerente 	= $_POST["observacao_tipo_requerente"];
		}
		

	?>	
    <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Inserir Tipo de Requerente</h1>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="tipo_Requerente_Inserir.php"> 
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Tipo de Requerente<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="nome_tipo_requerente" placeholder="Tipo de Requerente" value="<?php if(isset($_POST["nome_tipo_requerente"])){ echo $_POST["nome_tipo_requerente"];} ?>">
				</div>
			  </div>
		 
		  <div class="form-group">
		<label class="col-sm-2 control-label">&nbsp &nbsp Tipo de Entidade<font color="red" size="4">&nbsp* &nbsp &nbsp </font></label>
		<div class="col-sm-10">
			<!--************Elaboração dos Cartazes alusivos ao evento*********************-->
			
			<input type="radio" name="tipo_entidade" value="1"  checked="true"/>Interna &nbsp &nbsp
			<input type="radio" name="tipo_entidade" value="0"/>Externa
		  </div>
		  </div>
		 
			
			    <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Observação</label>
				<div class="col-sm-10">
				   <textarea class="form-control" id="observacao_tipo_requerente" rows="3" name="observacao_tipo_requerente" value="<?php if(isset($_POST["observacao_tipo_requerente"])){ echo $_POST["observacao_tipo_requerente"];} ?>"></textarea>
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


