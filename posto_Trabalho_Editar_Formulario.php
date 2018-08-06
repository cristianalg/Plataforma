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

    <title>Posto de Trabalho</title>
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
		$result = mysql_query("SELECT * FROM registo_postos_trabalho WHERE idRegisto_Postos_Trabalho = '$id'");
		$resultado = mysql_fetch_assoc($result);  //mysql_fetch_assoc - Obtém uma linha do resultado como um array associativo
	?>

	  
<div class="container theme-showcase" role="main">      
  <div class="page-header">
	<h1>Editar Posto de Trabalho</h1>
  </div>
	
  <div class="row">
	<div class="col-md-12">
	  <form class="form-horizontal" method="POST" action="posto_Trabalho_Editar.php" enctype="multipart/form-data">

		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Cargo</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="cargo" placeholder="Cargo" value="<?php echo $resultado['Cargo']; ?>">
			</div>
		  </div>
		
	
		<?php $departamentoFK_id = $resultado['Departamento_idDepartamento'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Departamento</label>
			<div class="col-sm-10">
			<select class="form-control" name="iddepartamento">
				<?php 
						$result_req =mysql_query("SELECT idDepartamento, Nome_Departamento  FROM departamento");
						while($dados = mysql_fetch_assoc($result_req)){
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
		
		 
			
		<?php $tipo_RequerenteFK_id = $resultado['Requerente_Tipo_Requerente_idTipo_Requerente'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tipo de Requerente</label>
			<div class="col-sm-10">
			<select class="form-control" name="idtipo_requerente" id="idtipo_requerente" onchange="myFunction()">
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
			<!-- <span class="carregando">Aguarde, carregando...</span> -->
			<select class="form-control" name="idrequerente" id="idrequerente">
				<!--<option value="">Selecione o Tipo de Requerente</option> -->
				
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
					echo '<textarea class="form-control" rows="3" name="observacao_registo_posto_trabalho">'. $resultado['Observacao_Registo_Postos_Trabalho']. '</textarea>';
				?>
			</div>
		</div>
		  
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Atualizar anexo (jpg,png)</label>
			<div class="col-sm-10">
				<input type="file" name="anexo" id="anexo"/>
			</div>
		</div>
		
		<?php 
			$foto = $resultado['Anexo'];
		?>
		<?php
			if($foto != ""){
		?>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Anexo antigo</label>
					<div class="col-sm-10">
						<img src="<?php echo "Anexos_Postos_Trabalho/$foto"; ?>" width="100" height="100">
						<input type="hidden" name="img_antiga" value='<?php echo $foto ?>'>
						</div>
					</div>
		<?php 
		}
		?>
		  
		  
		  
		  <input type="hidden" name="numeroid" value="<?php echo $resultado['idRegisto_Postos_Trabalho']; ?>">
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

