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

    <title>Assistências Técnicas</title>
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
		$result = mysql_query("SELECT * FROM assistencia_tecnica WHERE idAssistencia_Tecnica = '$id'");
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
	<h1>Editar Assistências Técnicas</h1>
  </div>
	
  <div class="row">
	<div class="col-md-12">
	  <form class="form-horizontal" method="POST" action="assistencia_Tecnica_Editar.php">

		<div class="form-group">
			<label class="control-label col-sm-2 requiredField" for="date">Data do Pedido<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-3">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar">
						</i>
					</div>
					<input class="form-control" onclick="func_data_pedido()" id="data_pedido" name="data_pedido" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Pedido']; ?>"/>
				</div>
			</div>
		</div>
	  
	  
	  	<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Descrição<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="descricao_avaria" placeholder="Descrição"  value="<?php echo $resultado['Descricao_Avaria']; ?>">
			</div>
		</div>
		 
	 <div class="form-group">
			<label class="control-label col-sm-2 requiredField" for="date">Data Prevista de Resolução<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-3">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar">
						</i>
					</div>
					<input class="form-control" onclick="func_data_prevista_entrega()" id="data_prevista_entrega" name="data_prevista_entrega" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Prevista_Entrega']; ?>"/>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Histórico do Serviço<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="historico_servico" placeholder="Histórico do Serviço"  value="<?php echo $resultado['Historico_Servico']; ?>">
			</div>
		</div>
		
		<?php $assistencia_tecnicaFK_id = $resultado['Tipo_Assistencia_idTipo_Assistencia'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tipo de Assistência</label>
			<div class="col-sm-10">
			<select class="form-control" name="idtipo_assistencia">
				<?php 
						$result_assistencia_tecnica =mysql_query("SELECT idTipo_Assistencia, Nome_Tipo_Assistencia  FROM tipo_assistencia");
						while($dados = mysql_fetch_assoc($result_assistencia_tecnica)){
							$id_assistencia_tecnicaPK = $dados['idTipo_Assistencia'];
							?>
								<option value="<?php echo $dados["idTipo_Assistencia"]; ?>"
								<?php if($id_assistencia_tecnicaPK == $assistencia_tecnicaFK_id){ echo 'selected'; } ?>
								><?php echo $dados["Nome_Tipo_Assistencia"];?></option>
							<?php
						}
				?>	
			</select>
			</div>
		</div> 
		
			<?php $estadoFK_id = $resultado['Estado_idEstado'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Estado da Assistência</label>
			<div class="col-sm-10">
			<select class="form-control" name="idestado">
				<?php 
						$result_estado =mysql_query("SELECT idEstado, Nome_Estado_Assistencia  FROM estado");
						while($dados = mysql_fetch_assoc($result_estado)){
							$id_estadoPK = $dados['idEstado'];
							?>
								<option value="<?php echo $dados["idEstado"]; ?>"
								<?php if($id_estadoPK == $estadoFK_id){ echo 'selected'; } ?>
								><?php echo $dados["Nome_Estado_Assistencia"];?></option>
							<?php
						}
				?>	
			</select>
			</div>
		</div> 
		
		
			<?php $tecnicoFK_id = $resultado['Estado_idEstado'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Técnico da Assistência</label>
			<div class="col-sm-10">
			<select class="form-control" name="idtecnico">
				<?php 
						$result_tecnico =mysql_query("SELECT idTecnico, Nome  FROM tecnico");
						while($dados = mysql_fetch_assoc($result_tecnico)){
							$id_tecnicoPK = $dados['idTecnico'];
							?>
								<option value="<?php echo $dados["idTecnico"]; ?>"
								<?php if($id_tecnicoPK == $tecnicoFK_id){ echo 'selected'; } ?>
								><?php echo $dados["Nome"];?></option>
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
			<label for="inputEmail3" class="col-sm-2 control-label">Observação</label>
			<div class="col-sm-10">
				<?php
					echo '<textarea class="form-control" rows="3" name="observacao_assistencia">'. $resultado['Observacao_Assistencia']. '</textarea>';
				?>
			</div>
		</div>
		
		<br>  
		<div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-10">
			<label>Imprimir Relatório<font color="red" size="4">&nbsp* &nbsp &nbsp </font></label>
			<input type="radio" name="imprimir_relatorio" value="1" <?php if($resultado['Imprimir_Relatorio'] == 1){ echo "checked";}?> />Sim &nbsp &nbsp
			<input type="radio" name="imprimir_relatorio" value="0" <?php if($resultado['Imprimir_Relatorio'] == 0){ echo "checked";}?>/>Não
			</div>
		</div>
		
		
		
		  <input type="hidden" name="numeroid" value="<?php echo $resultado['idAssistencia_Tecnica']; ?>">
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


