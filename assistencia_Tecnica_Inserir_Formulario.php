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

	<title>Assistências Técnicas</title>
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
			$descricao_avaria				= $_POST["descricao_avaria"];
			$data_pedido					= $_POST["data_pedido"];
			$data_prevista_entrega			= $_POST["data_prevista_entrega"];
			$observacao_assistencia			= $_POST["observacao_assistencia"];
			$idrequerente					= $_POST["idrequerente"];
			$idtipo_requerente				= $_POST["idtipo_requerente"];
			$idtipo_assistencia				= $_POST["idtipo_assistencia"];
			$idtecnico						= $_POST["idtecnico"];
			$idestado						= $_POST["idestado"];
			$imprimir_relatorio				= $_POST["imprimir_relatorio"];
		}   
		    
	?>	   
	
	
<!--********************DATA***************************************************************-->
<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>


    <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Inserir Assistência Técnica</h1>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="assistencia_Tecnica_Inserir.php" role="form" enctype="multipart/form-data"> 
			
			<div class="form-group">
				<label class="control-label col-sm-2 requiredField" for="date">Data do Pedido<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar">
							</i>
						</div>
						<input class="form-control" onclick="func_data_pedido()" id="data_pedido" name="data_pedido" placeholder="YYYY/MM/DD" type="text" value="<?php if(isset($_POST["data_pedido"])){ echo $_POST["data_pedido"];} ?>"/>
					</div>
				</div>
			</div>
			
			
			 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Descrição<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="descricao_avaria" placeholder="Descrição" value="<?php if(isset($_POST["descricao_avaria"])){ echo $_POST["descricao_avaria"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label class="control-label col-sm-2 requiredField" for="date">Data Prevista Resolução<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar">
							</i>
						</div>
						<input class="form-control" onclick="func_data_prevista_entrega()" id="data_prevista_entrega" name="data_prevista_entrega" placeholder="YYYY/MM/DD" type="text" value="<?php if(isset($_POST["data_prevista_entrega"])){ echo $_POST["data_prevista_entrega"];} ?>"/>
					</div>
				</div>
			</div>	
			
			
			<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Tipo de Assistência<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <select class="form-control" name="idtipo_assistencia">
				 <option value="">Selecione o Tipo de Assistência</option>
				  <?php 
						#seleciona os dados da tabela departamento	
						$resultado =mysql_query("SELECT idTipo_Assistencia, Nome_Tipo_Assistencia  FROM tipo_assistencia;");
						while($dados = mysql_fetch_assoc($resultado)){
							#preencher o select com dados
							?>
								<option value="<?php echo $dados["idTipo_Assistencia"]; ?>"><?php echo $dados["Nome_Tipo_Assistencia"];?></option>
								
							<?php
						}
					?>
				</select>
			</div>
		  </div>
			
			
			<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Estado da Assistência<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <select class="form-control" name="idestado">
				 <option value="">Selecione o Estado</option>
				  <?php 
						#seleciona os dados da tabela departamento	
						$resultado =mysql_query("SELECT idEstado, Nome_Estado_Assistencia  FROM estado;");
						while($dados = mysql_fetch_assoc($resultado)){
							#preencher o select com dados
							?>
								<option value="<?php echo $dados["idEstado"]; ?>"><?php echo $dados["Nome_Estado_Assistencia"];?></option>
								
							<?php
						}
					?>
				</select>
			</div>
		  </div>
			
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Técnico<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <select class="form-control" name="idtecnico">
				 <option value="">Selecione o Técnico da Assistência</option>
				  <?php 
						#seleciona os dados da tabela departamento	
						$resultado =mysql_query("SELECT idTecnico, Nome FROM tecnico;");
						while($dados = mysql_fetch_assoc($resultado)){
							#preencher o select com dados
							?>
								<option value="<?php echo $dados["idTecnico"]; ?>"><?php echo $dados["Nome"];?></option>
								
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
					<textarea class="form-control" id="observacao_assistencia" rows="3" name="observacao_assistencia" value="<?php if(isset($_POST["observacao_assistencia"])){ echo $_POST["observacao_assistencia"];} ?>"></textarea>
				</div>
			  </div>
			  
			  <div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-10">
			<label>Imprimir Relatório<font color="red" size="4">&nbsp* &nbsp &nbsp </font></label>
			<input type="radio" name="imprimir_relatorio" value="1"  />Sim &nbsp &nbsp
			<input type="radio" name="imprimir_relatorio" value="0" checked="true"/>Não
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

<!--********************DATA***************************************************************-->
<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
	
	function func_data_pedido(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_pedido"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	//})
	}
	
	function func_data_prevista_entrega(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_prevista_entrega"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	//})
	}
	
	
</script>