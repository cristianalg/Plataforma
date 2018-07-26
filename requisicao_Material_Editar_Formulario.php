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

    <title>Requisição de Material</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  </head>

  <body role="document">
	<?php
		include_once("menu_Pagina_Inicial.php");	
		$id = $_GET['id'];
		//Executa consulta
		$result = mysql_query("SELECT * FROM requisicao_material WHERE idRequisicao_Material = '$id'");
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
	<h1>Editar Requisição de Material</h1>
  </div>
	
  <div class="row">
	<div class="col-md-12">
	  <form class="form-horizontal" method="POST" action="requisicao_Material_Editar.php">

	  
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Secção</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="seccao" placeholder="Secção" value="<?php echo $resultado['Seccao']; ?>">
			</div>
		  </div>
	
	  
		  <?php $tipo_RequerenteFK_id = $resultado['Equipamentos_Tipo_Equipamento_idTipo_Equipamento'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tipo de Equipamento</label>
			<div class="col-sm-10">
			<select class="form-control" name="idtipo_equipamento" id="idtipo_equipamento" onclick="func_Equipamento()">
				<?php 
						$result_req ="SELECT idTipo_Equipamento, Nome_Tipo_Equipamento  FROM tipo_equipamento ORDER BY Nome_Tipo_Equipamento";
						$resultado_req = mysql_query($result_req);
						while($dados = mysql_fetch_assoc($resultado_req)){
							$id_tipo_RequerentePK = $dados['idTipo_Equipamento'];
							?>
								<option value="<?php echo $dados["idTipo_Equipamento"]; ?>"
								<?php if($id_tipo_RequerentePK == $tipo_RequerenteFK_id){ echo 'selected'; } ?>
								><?php echo $dados["Nome_Tipo_Equipamento"];?></option>
							<?php
						}
				?>	
				
			</select>
			</div>
		</div>
		
		<?php $var_idTipo = $resultado['Equipamentos_Tipo_Equipamento_idTipo_Equipamento'];?> 
		<?php $tipo_EquipamentoFK_id = $resultado['Equipamentos_idEquipamentos'];?>
				<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Nome do Equipamento<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			<select class="form-control" name="idequipamento" id="idequipamento">
				
				<?php
					$result_equi =mysql_query("SELECT idEquipamentos, Nome_Equipamento  FROM equipamentos WHERE 	Tipo_Equipamento_idTipo_Equipamento = ".$var_idTipo." ORDER BY Nome_Equipamento");
					while($dados = mysql_fetch_assoc($result_equi)){
					$id_tipo_EquipamentoPK = $dados['idEquipamentos'];
				?>
				
				<option value="<?php echo $dados["idEquipamentos"]; ?>"
				<?php if($id_tipo_EquipamentoPK == $tipo_EquipamentoFK_id){ echo 'selected'; } ?>
				><?php echo $dados["Nome_Equipamento"];?></option>
				<?php
					}
				?>
				
			</select>	
			</div>
		  </div> 	
			
	  
		 <?php $tipo_RequerenteFK_id = $resultado['Requerente_Tipo_Requerente_idTipo_Requerente'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tipo de Requerente</label>
			<div class="col-sm-10">
			<select class="form-control" name="idtipo_requerente" id="idtipo_requerente" onclick="func_Requerente()">
				<?php 
						$result_req ="SELECT idTipo_requerente, Nome_Tipo_Requerente  FROM tipo_requerente ORDER BY Nome_Tipo_Requerente";
						$resultado_req = mysql_query($result_req);
						while($dados = mysql_fetch_assoc($resultado_req)){
							$id_tipo_RequerentePK = $dados['idTipo_requerente'];
							?>
								<option value="<?php echo $dados["idTipo_requerente"]; ?>"
								<?php if($id_tipo_RequerentePK == $tipo_RequerenteFK_id){ echo 'selected'; } ?>
								><?php echo $dados["Nome_Tipo_Requerente"];?></option>
							<?php
						}
				?>	
				
			</select>
			</div>
		</div>
		
		<?php $var_idTipo = $resultado['Requerente_Tipo_Requerente_idTipo_Requerente'];?> 
		
		<?php $tipo_RequerenteFK_id = $resultado['Requerente_idRequerente'];?>
				<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Nome do Requerente<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			<select class="form-control" name="idrequerente" id="idrequerente">
				
				<?php
					$result_req =mysql_query("SELECT idRequerente, Nome_Requerente  FROM requerente WHERE Tipo_Requerente_idTipo_Requerente = ".$var_idTipo." ORDER BY Nome_Requerente");
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
			<label class="control-label col-sm-2 requiredField" for="date">Data de Requisição<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-3">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar">
						</i>
					</div>
					<input class="form-control" onclick="func_data_requisicao()" id="data_requisicao" name="data_requisicao" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Requisicao']; ?>"/>
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
					<input class="form-control" onclick="func_data_prevista_devolucao()" id="data_prevista_devolucao" name="data_prevista_devolucao" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Prevista_Devolucao']; ?>"/>
				</div>
			</div>
		</div>

		
		<br><br>
		<div class="form-group">
			<label class="control-label col-sm-2 requiredField" for="date">Data da Devolução<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-3">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar">
						</i>
					</div>
					<input class="form-control" onclick="func_data_devolucao()" id="data_devolucao" name="data_devolucao" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Devolucao']; ?>"/>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Estado do Material Devolvido<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="estado_material_devolvido" placeholder="Estado do material devolvido"  value="<?php echo $resultado['Estado_Material_Devolvido']; ?>">
			</div>
		</div>
		
		
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Estado da Requisição<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
				<input type="radio" name="estado_requisicao" value="1" <?php if($resultado['Estado_Requisicao'] == 1){ echo "checked";}?>/>Entregue &nbsp &nbsp
				<input type="radio" name="estado_requisicao" value="0" <?php if($resultado['Estado_Requisicao'] == 0){ echo "checked";}?>/>Não Entregue
			</div>
		</div>
		
		
		<br><br>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Observação</label>
			<div class="col-sm-10">
				<?php
					echo '<textarea class="form-control" rows="3" name="observacao_requisicao_material">'. $resultado['Observacao_Requisicao_Material']. '</textarea>';
				?>
			</div>
		</div>
		
		
		  <input type="hidden" name="numeroid" value="<?php echo $resultado['idRequisicao_Material']; ?>">
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


