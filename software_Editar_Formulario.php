<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
include_once("conexao.php");
?>
	
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página Inicial">
    <meta name="author" content="Cristiana">

    <title>Software</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
	
		
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
		$id = $_GET['id'];
		//Executa consulta
		$result = mysql_query("SELECT * FROM software WHERE idSoftware = '$id'");
		$resultado = mysql_fetch_assoc($result);  //mysql_fetch_assoc - Obtém uma linha do resultado como um array associativo
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
	<h1>Editar Software</h1>
  </div>
  
	
  <div class="row">
	<div class="col-md-12">
	  <form class="form-horizontal" method="POST" action="software_Editar.php" enctype="multipart/form-data">
		
		 <?php $departamentoFK_id = $resultado['Registo_Postos_Trabalho_Departamento_idDepartamento'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Departamento</label>
			<div class="col-sm-10">
			<select class="form-control" name="iddepartamento" id="iddepartamento" onchange="myFunction()">
				<?php 
				
						$result_departamento ="SELECT * FROM departamento ORDER BY Nome_Departamento";
						$resultado_departamento = mysql_query($result_departamento);
						while($dados = mysql_fetch_assoc($resultado_departamento)){
							$id_departamentoPK = $dados['idDepartamento'];
							?>
								<option value="<?php echo $dados["idDepartamento"]; ?>"
								<?php if($id_departamentoPK == $departamentoFK_id){ echo 'selected'; } ?>
								><?php echo $dados["Nome_Departamento"];?></option>
							<?php
						}
				?>	
				
			</select>
			</div>
		</div>
			 
			 
		<?php $var_idTipo = $resultado['Registo_Postos_Trabalho_Departamento_idDepartamento'];?> 
		
		<?php $tipo_RequerenteFK_id = $resultado['Registo_Postos_Trabalho_Requerente_idRequerente'];?>
				<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Nome do Requerente</label>
			<div class="col-sm-10">
			<select class="form-control" name="idrequerente" id="idrequerente">
				
				<?php
					//$result_req =mysql_query("SELECT idRequerente, Nome_Requerente  FROM requerente WHERE Tipo_Requerente_idTipo_Requerente = ".$var_idTipo." ORDER BY Nome_Requerente");
					$result_req =mysql_query("SELECT idRequerente, Nome_Requerente FROM requerente INNER JOIN 
					registo_postos_trabalho ON Requerente.idRequerente = registo_postos_trabalho.Requerente_idRequerente 
					where registo_postos_trabalho.Departamento_idDepartamento = ".$var_idTipo." ORDER BY Nome_Requerente");
					
					while($dados = mysql_fetch_assoc($result_req)){
					$id_tipo_RequerentePK = $dados['idRequerente'];
				?>
				
				<option value="<?php echo $dados["idRequerente"]; ?>"
				<?php if($id_tipo_RequerentePK == $tipo_RequerenteFK_id){ echo 'selected'; } ?>
				><?php echo $dados["Nome_Requerente"];?></option>
				<?php
					}
				?>
				
			</select>	
			</div>
		  </div> 

		
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Nome do Software</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="nome_software" placeholder="Nome do Software" value="<?php echo $resultado['Nome_Software']; ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Versão</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="versao" placeholder="Versão" value="<?php echo $resultado['Versao']; ?>">
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
						<input class="form-control" onclick="func_data_registo()" id="data_registo" name="data_registo" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Registo']; ?>"/>
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
						<input class="form-control" onclick="func_data_inicio_contrato()" id="data_inicio_contrato" name="data_inicio_contrato" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Inicio_Contrato']; ?>"/>
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
						<input class="form-control" onclick="func_data_renovacao_contrato()" id="data_renovacao_contrato" name="data_renovacao_contrato" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Renovacao_Contrato']; ?>"/>
					</div>
				</div>
			</div>
		   
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Observação</label>
			<div class="col-sm-10">
				<?php
					echo '<textarea class="form-control" rows="3" name="observacao_software">'. $resultado['Observacao_Software']. '</textarea>';
				?>
			</div>
		  </div>
		  
		  
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Atualizar Cópia da Fatura (.PDF)</label>
			<div class="col-sm-10">
				<input type="file" name="copia_fatura" id="copia_fatura" accept="application/pdf"/>
			</div>
		</div>
		
		
		
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Atualizar Contrato/Protocolo (.PDF)</label>
			<div class="col-sm-10">
				<input type="file" name="contrato_protocolo" id="contrato_protocolo" accept="application/pdf"/>
			</div>
		</div>
		  
		  
		  
		  
		  <input type="hidden" name="numeroid" value="<?php echo $resultado['idSoftware']; ?>">
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-danger">Editar</button>
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


