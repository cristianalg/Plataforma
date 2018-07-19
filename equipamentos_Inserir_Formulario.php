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

    <title>Equipamentos</title>
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
			$nome_equipamento			= $_POST["nome_equipamento"];
			$numero_serie 				= $_POST["numero_serie"];
			$marca						= $_POST["marca"];
			$modelo						= $_POST["modelo"];
			$numero_inventario			= $_POST["numero_inventario"];
			$local_instalacao			= $_POST["local_instalacao"];
			$contacto 					= $_POST["contacto"];
			$estado_material			= $_POST["estado_material"];
			$user_acesso_internet 		= $_POST["user_acesso_internet"];
			$password_acesso_internet 	= $_POST["password_acesso_internet"];
			$username_equipamento 		= $_POST["username_equipamento"];
			$password_equipamento 		= $_POST["password_equipamento"];
			$contacto_suporte		 	= $_POST["contacto_suporte"];
			$observacao_equipamento 	= $_POST["observacao_equipamento"];
			//faltam
			// Copia_Fatura` BLOB NULL,
			// Ficheiro_Configuracao` BLOB NULL,
			$idtipo_equipamento			= $_POST["idtipo_equipamento"];
			$idrequerente				= $_POST["idrequerente"];
			$iddepartamento				= $_POST["iddepartamento"];
		}
	?>	


	
	<div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Inserir Equipamento</h1>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="equipamentos_Inserir.php" enctype="multipart/form-data">

			<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Tipo de Equipamento<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <select class="form-control" name="idtipo_equipamento">
				 <option value="">Selecione o Tipo de Equipamento</option>
				  <?php 
						#seleciona os dados da tabela tipo 
						$resultado =mysql_query("SELECT idTipo_Equipamento, Nome_Tipo_Equipamento  FROM tipo_equipamento;");
						while($dados = mysql_fetch_assoc($resultado)){
							#preencher o select com dados
							?>
								<option value="<?php echo $dados["idTipo_Equipamento"]; ?>"><?php echo $dados["Nome_Tipo_Equipamento"];?></option>
							<?php
						}
					?>
				</select>
			</div>
		  </div>
			
			
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
				<label for="inputEmail3" class="col-sm-2 control-label">Nome do Equipamento<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <!-- <input type="text" class="form-control" name="nome" placeholder="Nome">-->
 
				  <input type="text" class="form-control" name="nome_equipamento" placeholder="Nome do equipamento" value="<?php if(isset($_POST["nome_equipamento"])){ echo $_POST["nome_equipamento"];} ?>">
				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nº Série<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="numero_serie" placeholder="Número de série" value="<?php if(isset($_POST["numero_serie"])){ echo $_POST["numero_serie"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Marca<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="marca" placeholder="Marca" value="<?php if(isset($_POST["marca"])){ echo $_POST["marca"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Modelo<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="modelo" placeholder="Modelo" value="<?php if(isset($_POST["modelo"])){ echo $_POST["modelo"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nº Inventário<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="numero_inventario" placeholder="Número de Inventário" value="<?php if(isset($_POST["numero_inventario"])){ echo $_POST["numero_inventario"];} ?>">
				</div>
			  </div>
			  
			   <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Local da Instalação<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="local_instalacao" placeholder="Local da Instalação" value="<?php if(isset($_POST["local_instalacao"])){ echo $_POST["local_instalacao"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Contacto Instalação<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" type="tel" class="form-control" name="contacto" placeholder="Contacto da Instalação" value="<?php if(isset($_POST["contacto"])){ echo $_POST["contacto"];} ?>">
				</div>
			  </div>
			  
			 <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Estado do Material<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="estado_material" placeholder="Estado do Material" value="<?php if(isset($_POST["estado_material"])){ echo $_POST["estado_material"];} ?>">
				</div>
			  </div>  
		    
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">User Internet</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="user_acesso_internet" placeholder="User de acesso à internet" value="<?php if(isset($_POST["user_acesso_internet"])){ echo $_POST["user_acesso_internet"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Password Internet</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="password_acesso_internet" placeholder="Password de acesso à internet" value="<?php if(isset($_POST["password_acesso_internet"])){ echo $_POST["password_acesso_internet"];} ?>">
				</div>
			  </div>
			  
			   <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">User Equipamento</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="username_equipamento" placeholder="User de acesso ao equipamento" value="<?php if(isset($_POST["username_equipamento"])){ echo $_POST["username_equipamento"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Password Equipamento</label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="password_equipamento" placeholder="Password de acesso ao equipamento" value="<?php if(isset($_POST["password_equipamento"])){ echo $_POST["password_equipamento"];} ?>">
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Contacto de Suporte</label>
				<div class="col-sm-10">
				  <input type="text" type="tel" class="form-control" name="contacto_suporte" placeholder="Contacto de suporte" value="<?php if(isset($_POST["contacto_suporte"])){ echo $_POST["contacto_suporte"];} ?>">
				</div>
			  </div>
			  
			  
			    <div class="form-group">
				<label for="inputPassword3" class="col-sm-2 control-label">Observação</label>
				<div class="col-sm-10">
				   <textarea class="form-control" id="observacao_equipamento" rows="3" name="observacao_equipamento" value="<?php if(isset($_POST["observacao_equipamento"])){ echo $_POST["observacao_equipamento"];} ?>"></textarea>
				</div>
			  </div>
			   

			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Cópia da Fatura</label>
				<div class="col-sm-10">
					<input type="file" name="copia_fatura" id="copia_fatura" accept="application/pdf" />
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Ficheiro de Configuração</label>
				<div class="col-sm-10">
					<input type="file" name="ficheiro_configuracao" />
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


