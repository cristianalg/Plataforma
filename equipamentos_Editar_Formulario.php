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

    <title>Equipamentos</title>
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
		$result = mysql_query("SELECT * FROM equipamentos WHERE idEquipamentos = '$id'");
		$resultado = mysql_fetch_assoc($result);  //mysql_fetch_assoc - Obtém uma linha do resultado como um array associativo
	?>

<div class="container theme-showcase" role="main">      
  <div class="page-header">
	<h1>Editar Equipamento</h1>
  </div>
  
	
  <div class="row">
	<div class="col-md-12">
	  <form class="form-horizontal" method="POST" action="equipamentos_Editar.php" enctype="multipart/form-data">
		
		<?php $tipo_EquipamentoFK_id = $resultado['Tipo_Equipamento_idTipo_Equipamento'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Tipo de Equipamento</label>
			<div class="col-sm-10">
			<select class="form-control" name="idtipo_equipamento">
				<?php 
						$result_equi =mysql_query("SELECT idTipo_Equipamento, Nome_Tipo_Equipamento  FROM tipo_equipamento");
						while($dados = mysql_fetch_assoc($result_equi)){
							$id_tipo_EquipamentoPK = $dados['idTipo_Equipamento'];
							?>
								<option value="<?php echo $dados["idTipo_Equipamento"]; ?>"
								<?php if($id_tipo_EquipamentoPK == $tipo_EquipamentoFK_id){ echo 'selected'; } ?>
								><?php echo $dados["Nome_Tipo_Equipamento"];?></option>
							<?php
						}
				?>	
				</select>
			</div>
		</div>
		  
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
			<label for="inputPassword3" class="col-sm-2 control-label">Nome do Requerente</font></label>
			<div class="col-sm-10">
			<!-- <span class="carregando">Aguarde, carregando...</span> -->
			<select class="form-control" name="idrequerente" id="idrequerente">
				<!--<option value="">Selecione o Tipo de Requerente</option> -->
				
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
			<label for="inputEmail3" class="col-sm-2 control-label">Nome do Equipamento</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="nome_equipamento" placeholder="Nome do Equipamento" value="<?php echo $resultado['Nome_Equipamento']; ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Nº de Série</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="numero_serie" placeholder="Número de Série" value="<?php echo $resultado['Numero_Serie']; ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Marca</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="marca" placeholder="Marca" value="<?php echo $resultado['Marca']; ?>">
			</div>
		  </div>
		
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Modelo</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="modelo" placeholder="Modelo" value="<?php echo $resultado['Modelo']; ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Nº de Inventário</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="numero_inventario" placeholder="Número de Inventário" value="<?php echo $resultado['Numero_Inventario']; ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Local de Instalação</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="local_instalacao" placeholder="Local de Instalação" value="<?php echo $resultado['Local_Instalacao']; ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Contacto</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="contacto" placeholder="Contacto" value="<?php echo $resultado['Contacto']; ?>">
			</div>
		  </div>
			  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Estado do Material</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="estado_material" placeholder="Estado do Material" value="<?php echo $resultado['Estado_Material']; ?>">
			</div>
		  </div>
		    
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">User Internet</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="user_acesso_internet" placeholder="User de acesso à internet" value="<?php echo $resultado['User_Acesso_Internet']; ?>">
			</div>
		  </div>
		   
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Password Internet</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="password_acesso_internet" placeholder="Password de acesso à internet" value="<?php echo $resultado['Password_Acesso_Internet']; ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">User Equipamento</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="username_equipamento" placeholder="User de acesso ao equipamento" value="<?php echo $resultado['Username_Equipamento']; ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Password Equipamento</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="password_equipamento" placeholder="Password de acesso ao equipamento" value="<?php echo $resultado['Password_Equipamento']; ?>">
			</div>
		  </div>
		  
		   <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Contacto de Suporte</label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="contacto_suporte" placeholder="Contacto de Suporte" value="<?php echo $resultado['Contacto_Suporte']; ?>">
			</div>
		  </div>
		  
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Observação</label>
			<div class="col-sm-10">
				<?php
					echo '<textarea class="form-control" rows="3" name="observacao_equipamento">'. $resultado['Observacao_Equipamento']. '</textarea>';
				?>
			</div>
		  </div>
		  
		  
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Atualizar Cópia da Fatura (.PDF)</label>
			<div class="col-sm-10">
				<input type="file" name="copia_fatura" id="copia_fatura"/>
			</div>
		</div>
		
		
		
		 <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Atualizar ficheiro de configuração (.ZIP)</label>
			<div class="col-sm-10">
				<input type="file" name="ficheiro_configuracao" id="ficheiro_configuracao"/>
			</div>
		</div>
		  
		  
		  
		  
		  <input type="hidden" name="numeroid" value="<?php echo $resultado['idEquipamentos']; ?>">
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

