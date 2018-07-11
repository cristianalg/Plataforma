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

    <title>Posto de Trabalho</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script->
	
	<style type="text/css">
			.carregando{
				color:#FF0000;
				display:none;
			}
	</style>
  </head>

  <body role="document">
	<?php
		include_once("menu_Pagina_Inicial.php");	
	  
		if(isset($_SESSION['post_data'])){
			$_POST 							= $_SESSION['post_data'];
			$cargo							= $_POST["cargo"];
			$observacao_posto_trabalho		= $_POST["observacao_posto_trabalho"];
			//Falta 
			//Anexo
			$idrequerente					= $_POST["idrequerente"];
			$idtipo_requerente				= $_POST["idtipo_requerente"];
			$iddepartamento					= $_POST["iddepartamento"];
		}
		

	?>	



    <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Inserir Posto de Trabalho</h1>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="posto_Trabalho_Inserir.php" role="form" enctype="multipart/form-data"> 
			
			 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Cargo<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="cargo" placeholder="Cargo" value="<?php if(isset($_POST["cargo"])){ echo $_POST["cargo"];} ?>">
				</div>
			  </div>
			
			<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Departamento<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <select class="form-control" name="iddepartamento">
				 <option value="">Selecione o Departamento</option>
				  <?php 
						#seleciona os dados da tabela departamento	
						$resultado =mysql_query("SELECT idDepartamento, Nome_Departamento  FROM departamento;");
						while($dados = mysql_fetch_assoc($resultado)){
							#preencher o select com dados
							?>
								<option value="<?php echo $dados["idDepartamento"]; ?>"><?php echo $dados["Nome_Departamento"];?></option>
								
							<?php
						}
					?>
				</select>
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Tipo de Requerente<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			<select class="form-control" name="idtipo_requerente" id="idtipo_requerente" onchange="myFunction()">
				<option value="">Selecione o Tipo de Requerente</option>
				<?php
								
					$result_cat_post = "SELECT * FROM tipo_requerente ORDER BY Nome_Tipo_Requerente";
					$resultado_cat_post = mysql_query($result_cat_post);
					while($row_cat_post = mysql_fetch_assoc($resultado_cat_post) ) {
						echo '<option value="'.$row_cat_post['idTipo_Requerente'].'">'.$row_cat_post['Nome_Tipo_Requerente'].'</option>';
					}
				?>
			</select>
			</div>
		  </div>
		  
			 <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Nome do Requerente<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			<!-- <span class="carregando">Aguarde, carregando...</span> -->
			<select class="form-control" name="idrequerente" id="idrequerente">
				<option value="">Selecione o Tipo de Requerente</option>
			</select>	
			</div>
		  </div>
		
		
		<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Observação</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="observacao_posto_trabalho" rows="3" name="observacao_posto_trabalho" value="<?php if(isset($_POST["observacao_posto_trabalho"])){ echo $_POST["observacao_posto_trabalho"];} ?>"></textarea>
				</div>
			  </div>
			  
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Anexo</label>
				<div class="col-sm-10">
					<input type="file" name="anexo" id="anexo"/>
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

	
	
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
		  google.load("jquery", "1.4.2");
		</script>
		
		<script type="text/javascript">
		
		$(function(){
			$('#idtipo_requerente').change(function(){
				if( $(this).val() ) {
					$('#idrequerente').hide();
					//$('.carregando').show();
					$.getJSON('posto_Trabalho_ComboBox.php?search=',{idtipo_requerente: $(this).val(), ajax: 'true'}, function(j){
						var options = '<option value="">Selecione o Nome do Requerente</option>';	
						for (var i = 0; i < j.length; i++) {
							options += '<option value="' + j[i].idRequerente + '">' + j[i].Nome_Requerente + '</option>';
						}	
						$('#idrequerente').html(options).show();
						//$('.carregando').hide();
					});
				} else {
					$('#idrequerente').html('<option value="">Selecione o Tipo de Requerente</option>');
				}
			});
		});
		</script>
	
	
	
	

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