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

    <title>Office</title>
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
			$nome_office 			= $_POST["nome_office"];
			$versao_office			= $_POST["versao_office"];
			$descricao_office		= $_POST["descricao_office"];
			$observacao_office		= $_POST["observacao_office"];
		}
		

	?>	
    <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Inserir Office</h1>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="office_Inserir.php" enctype="multipart/form-data"> 
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nome do Office<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="nome_office" placeholder="Nome do Office" value="<?php if(isset($_POST["nome_office"])){ echo $_POST["nome_office"];} ?>">
				</div>
			  </div>
		 
			   <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Versão do Office<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			    <input type="text" class="form-control" name="versao_office" placeholder="Versão do Office" value="<?php if(isset($_POST["versao_office"])){ echo $_POST["versao_office"];} ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Descrição</label>
			<div class="col-sm-10">
			    <input type="text" class="form-control" name="descricao_office" placeholder="Descrição" value="<?php if(isset($_POST["descricao_office"])){ echo $_POST["descricao_office"];} ?>">
			</div>
		  </div>
			
			<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Observação</label>
				<div class="col-sm-10">
				   <textarea class="form-control" id="observacao_office" rows="3" name="observacao_office" value="<?php if(isset($_POST["observacao_office"])){ echo $_POST["observacao_office"];} ?>"></textarea>
				</div>
			</div>
			  
			  
			  
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Anexo</label>
				<div class="col-sm-10">
					<!--<input name="arquivo" type="file"/>	-->
					<input type="file" name="foto" />
				</div>
			</div>
			  
			  
			   
			  <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success"  name="cadastrar">Inserir</button>
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


