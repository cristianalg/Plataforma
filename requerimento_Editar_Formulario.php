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

    <title>Requerimento</title>
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
		$result = mysql_query("SELECT * FROM requerimento WHERE idRequerimento = '$id'");
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
	<h1>Editar Requerimento</h1>
  </div>
	
  <div class="row">
	<div class="col-md-12">
	  <form class="form-horizontal" method="POST" action="requerimento_Editar.php">

		<div class="form-group">
			<label class="control-label col-sm-2 requiredField" for="date">Data do Pedido<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-3">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar">
						</i>
					</div>
					<input class="form-control" onclick="func_data_requerimento()" id="data_requerimento" name="data_requerimento" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Requerimento']; ?>"/>
				</div>
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
			<label for="inputEmail3" class="col-sm-2 control-label">Festa<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="festa" placeholder="Festa"  value="<?php echo $resultado['Festa']; ?>">
			</div>
		</div>
		 
						
		<div class="form-group">
			<label class="control-label col-sm-2 requiredField" for="date">Data da Festivivdade<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-3">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar">
						</i>
					</div>
					<input class="form-control" onclick="func_data_festividade()" id="data_festividade" name="data_festividade" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Festividade']; ?>"/>
				</div>
			</div>
		</div>

		
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Observação</label>
			<div class="col-sm-10">
				<?php
					echo '<textarea class="form-control" rows="3" name="observacao_requerimento">'. $resultado['Observacao_Requerimento']. '</textarea>';
				?>
			</div>
		</div>
		
		<br>  
		<div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-10">
			<!--************Elaboração dos Cartazes alusivos ao evento*********************-->
			<label>  Elaboração dos Cartazes alusivos ao evento<font color="red" size="4">&nbsp* &nbsp &nbsp </font></label>
			<input type="radio" name="elaboracao_cartazes_alusivos" value="1" <?php if($resultado['Elaboracao_Cartazes_Alusivos'] == 1){ echo "checked";}?> />Sim &nbsp &nbsp
			<input type="radio" name="elaboracao_cartazes_alusivos" value="0" <?php if($resultado['Elaboracao_Cartazes_Alusivos'] == 0){ echo "checked";}?>/>Não
			
			<!--************Impressão dos Cartazes*********************-->
			<p>
			<label for="inputEmail3">Impressão dos Cartazes<font color="red" size="4">&nbsp* &nbsp </font></label>
			<input type="radio" name="impressao_cartazes" value="1" <?php if($resultado['Impressao_Cartazes'] == 1){ echo "checked";}?>/>Sim &nbsp &nbsp 
			<input type="radio" name="impressao_cartazes" value="0" <?php if($resultado['Impressao_Cartazes'] == 0){ echo "checked";}?>/>Não
		
			<label for="inputEmail3">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Se sim, indique quantidades:<font color="red" size="4">&nbsp*</font></label>
			&nbsp &nbsp &nbsp
			<label><b>A3</b></label>
			<input type="text" size="4" name="tamanho_a3" placeholder="" value="<?php echo $resultado['Tamanho_A3']; ?>">
			&nbsp &nbsp &nbsp 
			<label><b>A4</b> </label>
			<input type="text" size="4" name="tamanho_a4" placeholder="" value="<?php echo $resultado['Tamanho_A4']; ?>">
			
			</p>				
				
				
			<p>
				<table>
				<tr>
					<td><label for="inputEmail3">Permite Publicação/Publicidade:</label></td>
					<td>
						<label>&nbsp &nbsp &nbsp <b>Site do Município</b> &nbsp </label>
					</td>
					<td>
						<input type="radio" name="site_municipio" value="1" <?php if($resultado['Site_Municipio'] == 1){ echo "checked";}?>/>Sim &nbsp &nbsp 
						<input type="radio" name="site_municipio" value="0" <?php if($resultado['Site_Municipio'] == 0){ echo "checked";}?> />Não
					</td>
				</tr>
				
				<tr>
					<td><label for="inputEmail3">&nbsp &nbsp &nbsp </label></td>
					<td>
						<label><b>Mupis de Publicidade</b>&nbsp &nbsp </label>
					</td>
					<td>
						<input type="radio" name="mupis_publicidade" value="1" <?php if($resultado['Mupis_Publicidade'] == 1){ echo "checked";}?> />Sim &nbsp &nbsp 
						<input type="radio" name="mupis_publicidade" value="0" <?php if($resultado['Mupis_Publicidade'] == 0){ echo "checked";}?>/>Não
					</td>
				</tr>
				
				<tr>
					<td><label for="inputEmail3">&nbsp &nbsp &nbsp </label></td>
					<td>
					<label><b>Agenda/Boletim</b>&nbsp </label>
					</td>
					<td>
						<input type="radio" name="agenda_boletim" value="1" <?php if($resultado['Agenda_Boletim'] == 1){ echo "checked";}?>/>Sim &nbsp &nbsp 
						<input type="radio" name="agenda_boletim" value="0" <?php if($resultado['Agenda_Boletim'] == 0){ echo "checked";}?>/>Não
					</td>
				</tr>
				</table>
			</p>
				
			</div>
		</div>
	
		
		<br>
		<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
		Outros apoios no normal desenvolvimento da atividade:</p>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Apoio 1</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="outros_apoios_1" placeholder=""  value="<?php echo $resultado['Outros_Apoios_1']; ?>">
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Apoio 2</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="outros_apoios_2" placeholder=""  value="<?php echo $resultado['Outros_Apoios_2']; ?>">
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Apoio 3</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="outros_apoios_3" placeholder=""  value="<?php echo $resultado['Outros_Apoios_3']; ?>">
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Apoio 4</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="outros_apoios_4" placeholder=""  value="<?php echo $resultado['Outros_Apoios_4']; ?>">
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Apoio 5</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="outros_apoios_5" placeholder=""  value="<?php echo $resultado['Outros_Apoios_5']; ?>">
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Apoio 6</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="outros_apoios_6" placeholder=""  value="<?php echo $resultado['Outros_Apoios_6']; ?>">
			</div>
		</div>
		
		  <input type="hidden" name="numeroid" value="<?php echo $resultado['idRequerimento']; ?>">
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			  <button type="submit" class="btn btn-success">Editar</button>
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
	function func_data_requerimento(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_requerimento"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	//})
	}
	
	function func_data_festividade(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_festividade"]'); //our date input has the name "date"
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


