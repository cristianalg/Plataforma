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

    <title>Software</title>
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
			$_POST 						= $_SESSION['post_data'];
			$nome_software				= $_POST["nome_software"];
			$data_registo				= $_POST["data_registo"];
			$data_inicio_contrato		= $_POST["data_inicio_contrato"];
			$data_renovacao_contrato	= $_POST["data_renovacao_contrato"];
			$versao						= $_POST["versao"];
			$observacao_software		= $_POST["observacao_software"];
		
			$idrequerente				= $_POST["idrequerente"];
			$iddepartamento				= $_POST["iddepartamento"];
			
			// Registo_Postos_Trabalho_idRegisto_Postos_Trabalho` 
			// Registo_Postos_Trabalho_idTipo_Requerente` INT NOT 
			
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
        <h1>Inserir Equipamento</h1>
		</div>
		<p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
		<div class="bootstrap-iso">
			<div class="container-fluid">
		 
 
 
			<div class="row">
				<div class="col-md-12">
					<form class="form-horizontal" method="POST" action="software_Inserir.php" enctype="multipart/form-data">

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Departamento<font color="red" size="4">&nbsp*</font></label>
							<div class="col-sm-10">
								<select class="form-control" name="iddepartamento" id="iddepartamento" onclick="myFunction()">
									<option value="">Selecione o Departamento</option>
									<?php
													
										$result_cat_post = "SELECT * FROM departamento ORDER BY Nome_Departamento";
										$resultado_cat_post = mysql_query($result_cat_post);
										while($row_cat_post = mysql_fetch_assoc($resultado_cat_post) ) {
											echo '<option value="'.$row_cat_post['idDepartamento'].'">'.$row_cat_post['Nome_Departamento'].'</option>';
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
									<option value="">Selecione o Departamento</option>
								</select>	
							</div>
						</div> 

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Nome do Software<font color="red" size="4">&nbsp*</font></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="nome_software" placeholder="Nome do Software" value="<?php if(isset($_POST["nome_software"])){ echo $_POST["nome_software"];} ?>">
							</div>
						</div>
						  
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Versão do Software<font color="red" size="4">&nbsp*</font></label>
							<div class="col-sm-10">
							  <input type="text" class="form-control" name="versao" placeholder="Versão do Software" value="<?php if(isset($_POST["versao"])){ echo $_POST["versao"];} ?>">
							</div>
						</div>
						  
						  
					
						<div class="form-group">
							<label class="control-label col-sm-2 requiredField" for="date">Data de Registo<font color="red" size="4">&nbsp*</font></label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar">
										</i>
									</div>
									<input class="form-control" onclick="func_data_registo()" id="data_registo" name="data_registo" placeholder="YYYY/MM/DD" type="text"/>
								</div>
							</div>
						</div>
						  
						
						<div class="form-group">
							<label class="control-label col-sm-2 requiredField" for="date">Data de Início<font color="red" size="4">&nbsp*</font></label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar">
										</i>
									</div>
									<input class="form-control" onclick="func_data_inicio_contrato()" id="data_inicio_contrato" name="data_inicio_contrato" placeholder="YYYY/MM/DD" type="text"/>
								</div>
							</div>
						</div>
					  
					
						<div class="form-group">
							<label class="control-label col-sm-2 requiredField" for="date">Data de Fim<font color="red" size="4">&nbsp*</font></label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar">
										</i>
									</div>
									<input class="form-control" onclick="func_data_renovacao_contrato()" id="data_renovacao_contrato" name="data_renovacao_contrato" placeholder="YYYY/MM/DD" type="text"/>
								</div>
							</div>
						</div>
				
					
					  
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">Observação</label>
							<div class="col-sm-10">
							   <textarea class="form-control" id="observacao_software" rows="3" name="observacao_software" value="<?php if(isset($_POST["observacao_software"])){ echo $_POST["observacao_software"];} ?>"></textarea>
							</div>
						</div>
					   

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Cópia da Fatura</label>
							<div class="col-sm-10">
								<input type="file" name="copia_fatura" id="copia_fatura" accept="application/pdf" />
							</div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Contrato Protocolo</label>
							<div class="col-sm-10">
								<input type="file" name="contrato_protocolo" id="contrato_protocolo" accept="application/pdf"/>
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
			</div>
		</div>
    </div> <!-- /container -->

		<!--********************COMBOBOX***************************************************************-->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
		  google.load("jquery", "1.4.2");
		</script>
		
		<script type="text/javascript">
			
			//	function func_PostoTrabalho(){
					$(function(){
						$('#iddepartamento').change(function(){
							if( $(this).val() ) {
								$('#idrequerente').hide();
								//$('.carregando').show();
								$.getJSON('equipamentos_ComboBox.php?search=',{iddepartamento: $(this).val(), ajax: 'true'}, function(j){
									var options = '<option value="">Selecione o Nome do Requerente</option>';	
									for (var i = 0; i < j.length; i++) {
										options += '<option value="' + j[i].idRequerente + '">' + j[i].Nome_Requerente + '</option>';
										//options += '<option value="' + j[i].idRegisto_Postos_Trabalho + '">' + j[i].Requerente_idRequerente + '</option>';
									}	
									$('#idrequerente').html(options).show();
									//$('.carregando').hide();
								});
							} else {
								$('#idrequerente').html('<option value="">Selecione o Departamento</option>');
							}
						});
					});
			//}
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
	function func_data_registo(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_registo"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	//})
	}
	
	function func_data_inicio_contrato(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_inicio_contrato"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	//})
	}
	
	function func_data_renovacao_contrato(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_renovacao_contrato"]'); //our date input has the name "date"
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


