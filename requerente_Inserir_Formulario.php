<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
include_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página Inicial">
    <meta name="author" content="Cristiana">

    <title>Requerentes</title>
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
			$nome_requerente 		= $_POST["nome_requerente"];
			$numero_funcionario		= $_POST["numero_funcionario"];
			$morada_requerente 		= $_POST["morada_requerente"];
			$email 					= $_POST["email"];
			$contacto_requerente	= $_POST["contacto_requerente"];
			$nif					= $_POST["nif"];
			$codigo_postal			= $_POST["codigo_postal"];
			$localidade				= $_POST["localidade"];
			$idtipo_requerente		= $_POST["idtipo_requerente"];
		}
		

	?>	
    <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Inserir Requerente</h1>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="requerente_Inserir.php"> 
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nome<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="nome_requerente" placeholder="Nome do requerente" value="<?php if(isset($_POST["nome_requerente"])){ echo $_POST["nome_requerente"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Tipo de requerente<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <select class="form-control" name="idtipo_requerente">
				 
				  <?php 
						#seleciona os dados da tabela tipo requerente	
						$resultado =mysql_query("SELECT idtipo_requerente, Nome_Tipo_Requerente  FROM tipo_requerente;");
						while($dados = mysql_fetch_assoc($resultado)){
							#preencher o select com dados
							?>
								<option value="<?php echo $dados["idtipo_requerente"]; ?>"><?php echo $dados["Nome_Tipo_Requerente"];?></option>
							<?php
						}
					?>
				</select>
			</div>
		  </div>
		  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nº Funcionário</label>
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
				  <input type="text" type="tel" class="form-control" name="contacto_requerente" placeholder="Contacto" value="<?php if(isset($_POST["contacto_requerente"])){ echo $_POST["contacto_requerente"];} ?>">
				</div>
			  </div>
			  
			 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">NIF<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="nif" placeholder="NIF" value="<?php if(isset($_POST["nif"])){ echo $_POST["nif"];} ?>">
				</div>
			  </div>  
		    
			    <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Morada<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="morada_requerente" placeholder="Morada do requerente" value="<?php if(isset($_POST["morada_requerente"])){ echo $_POST["morada_requerente"];} ?>">
				</div>
			  </div>
			  
			 	 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Código Postal<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="codigo_postal" placeholder="0000-000"value="<?php if(isset($_POST["codigo_postal"])){ echo $_POST["codigo_postal"];} ?>">
				</div>
			  </div>
			  
			   
			 	 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Localidade<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="localidade" placeholder="Localidade do requerente" value="<?php if(isset($_POST["localidade"])){ echo $_POST["localidade"];} ?>">
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


