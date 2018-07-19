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

	<title>Requisição de Material</title>
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
			$_POST 								= $_SESSION['post_data'];
			$data_requisicao					= $_POST["data_requisicao"];
			$data_prevista_devolucao			= $_POST["data_prevista_devolucao"];
			$seccao								= $_POST["seccao"];
			$observacao_requisicao_material		= $_POST["observacao_requisicao_material"];
			
			
			/*$data_devolucao						= $_POST["data_devolucao"];
			$estado_material_devolvido 			= $_POST["estado_material_devolvido"];
			$estado_requisicao					= $_POST["estado_requisicao"];
			*/
			
			$idtipo_equipamento				= $_POST["idtipo_equipamento"];
			$idequipamento					= $_POST["idequipamento"];
			$idtipo_requerente				= $_POST["idtipo_requerente"];
			$idrequerente					= $_POST["idrequerente"];
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
        <h1>Inserir Requisição de Material</h1>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="requisicao_Material_Inserir.php" role="form" enctype="multipart/form-data"> 
			
			
					<div class="form-group">
							<label class="control-label col-sm-2 requiredField" for="date">Data de Requisição<font color="red" size="4">&nbsp*</font></label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar">
										</i>
									</div>
									<input class="form-control" onclick="func_data_requisicao()" id="data_requisicao" name="data_requisicao" placeholder="YYYY/MM/DD" type="text" value="<?php if(isset($_POST["data_requisicao"])){ echo $_POST["data_requisicao"];} ?>"/>
								</div>
							</div>
						</div>
						  
						
						<div class="form-group">
							<label class="control-label col-sm-2 requiredField" for="date">Data de Prevista Devolução<font color="red" size="4">&nbsp*</font></label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar">
										</i>
									</div>
									<input class="form-control" onclick="func_data_prevista_devolucao()" id="data_prevista_devolucao" name="data_prevista_devolucao" placeholder="YYYY/MM/DD" type="text" value="<?php if(isset($_POST["data_prevista_devolucao"])){ echo $_POST["data_prevista_devolucao"];} ?>"/>
								</div>
							</div>
						</div>
			
		
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Secção<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="seccao" placeholder="Secção" value="<?php if(isset($_POST["seccao"])){ echo $_POST["seccao"];} ?>">
				</div>
			</div>
		
		
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Tipo de Equipamento<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			<select class="form-control" name="idtipo_equipamento" id="idtipo_equipamento" onclick="func_Equipamento()">
				<option value="">Selecione o Tipo de Equipamento</option>
				<?php
					$result_cat_post = "SELECT * FROM tipo_equipamento ORDER BY Nome_Tipo_Equipamento";
					$resultado_cat_post = mysql_query($result_cat_post);
					while($row_cat_post = mysql_fetch_assoc($resultado_cat_post) ) {
						echo '<option value="'.$row_cat_post['idTipo_Equipamento'].'">'.$row_cat_post['Nome_Tipo_Equipamento'].'</option>';
					}
				?>
			</select>
			</div>
		  </div>
		  
			 <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Nome do Equipamento<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			<select class="form-control" name="idequipamento" id="idequipamento">
				<option value="">Selecione o Tipo de Equipamento</option>
			</select>	
			</div>
		  </div>
		
						
		  <div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Tipo de Requerente<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			<select class="form-control" name="idtipo_requerente" id="idtipo_requerente" onclick="func_Requerente()">
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
			<select class="form-control" name="idrequerente" id="idrequerente">
				<option value="">Selecione o Tipo de Requerente</option>
			</select>	
			</div>
		  </div>
		  
		
		<div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Observação</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="observacao_requisicao_material" rows="3" name="observacao_requisicao_material" value="<?php if(isset($_POST["observacao_requisicao_material"])){ echo $_POST["observacao_requisicao_material"];} ?>"></textarea>
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
		
		function func_Requerente(){
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
		}
		
		
		function func_Equipamento(){
			$(function(){
				$('#idtipo_equipamento').change(function(){
					if( $(this).val() ) {
						$('#idequipamento').hide();
						//$('.carregando').show();
						$.getJSON('requisicao_Material_ComboBox.php?search=',{idtipo_equipamento: $(this).val(), ajax: 'true'}, function(j){
							var options = '<option value="">Selecione o Nome do Equipamento</option>';	
							for (var i = 0; i < j.length; i++) {
								options += '<option value="' + j[i].idEquipamentos + '">' + j[i].Nome_Equipamento + '</option>';
							}	
							$('#idequipamento').html(options).show();
							//$('.carregando').hide();
						});
					} else {
						$('#idequipamento').html('<option value="">Selecione o Tipo de Equipamento</option>');
					}
				});
			});
		}
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
	function func_data_requisicao(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_requisicao"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	//})
	}
	
	function func_data_prevista_devolucao(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_prevista_devolucao"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	//})
	}
	
	function func_data_devolucao(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_devolucao"]'); //our date input has the name "date"
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

