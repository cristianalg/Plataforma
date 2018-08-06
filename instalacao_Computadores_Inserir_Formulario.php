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

	<title>Instalação de Computadores</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script->
	
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	
	
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
			$_POST 									= $_SESSION['post_data'];
			$nome_instalacao						= $_POST["nome_instalacao"];
			$nome_rede								= $_POST["nome_rede"];
			$impressora_follow_me					= $_POST["impressora_follow_me"];
			$antivirus								= $_POST["antivirus"];
			$data_instalacao_computadores			= $_POST["data_instalacao_computadores"];
			$observacao_instalacao_computadores		= $_POST["observacao_instalacao_computadores"];
			
			$idsistema_operativo					= $_POST["idsistema_operativo"];
			$idoffice								= $_POST["idoffice"];
			$idestado								= $_POST["idestado"];
			
			/*
			$chkbox = $_POST['chkbox_Aplicativos'];
			$chkbox_AIRC = $_POST['chkbox'];*/
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
        <h1>Inserir Instalação de Computadores</h1>
		</div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          
			
			 <form class="form-horizontal" method="post" action="instalacao_Computadores_Inserir.php">
			 
			 	<div class="form-group">
							<label class="control-label col-sm-2 requiredField" for="date">Data da Instalação<font color="red" size="4">&nbsp*</font></label>
							<div class="col-sm-3">
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar">
										</i>
									</div>
									<input class="form-control" onclick="func_data()" id="data_instalacao_computadores" name="data_instalacao_computadores" placeholder="YYYY/MM/DD" type="text" value="<?php if(isset($_POST["data_instalacao_computadores"])){ echo $_POST["data_instalacao_computadores"];} ?>"/>
								</div>
							</div>
						</div>
						
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nome da Instalação<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="nome_instalacao" placeholder="Nome da Instalação" value="<?php if(isset($_POST["nome_instalacao"])){ echo $_POST["nome_instalacao"];} ?>">
				</div>
			</div>
			
		<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Nome da Rede<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" name="nome_rede" placeholder="Nome da Rede" value="<?php if(isset($_POST["nome_rede"])){ echo $_POST["nome_rede"];} ?>">
				</div>
			</div>
		
		<br>
		 <div class="form-group">
			<label class="col-sm-2 control-label">&nbsp &nbsp Impressora Follow Me</label>
			<div class="col-sm-10">
				<p><b>1 - </b>Instalar impressora com ip 192.168.1.237 com base nos drivers da ineo +224e
					em: \\192.168.1.151\publico\UTILITARIOS\gestão de utilizadores equipamentos
					multifunções\drivers equip develop\ </p> 
				<p> <b>2 -</b> Instalar safe q em: \\192.168.1.151\publico\UTILITARIOS\SafeQ\ </p>
				<p><b>3 -</b> Nas preferências alterar o seguinte: <b>a)</b> colocar um lado por defeito <b>b)</b> Colocar preto e branco por defeito.</p>
				<p>Marcar tudo o que for aplicável. </p>
				
				<font size="3">
					<input type="radio" name="impressora_follow_me" value="1"/>Sim &nbsp &nbsp
					<input type="radio" name="impressora_follow_me" value="0"  checked="true"/>Não 
				</font>
			</div>
		</div>
		
		<div class="form-group">
		<br>
			<label class="col-sm-2 control-label">&nbsp &nbsp Antivirus</label>
			<div class="col-sm-10">
				<p>ACEDER AO WEBSITE DO ANTIVIRUS <a href="https://wfbs-svc-emea.trendmicro.com/">https://wfbs-svc-emea.trendmicro.com/</a> com
					nome de utilizador Mcbeira e palavra passe de segurança definida na informática
					com maiúscula no inicio.</p>
				<p>Marcar tudo o que for aplicável.</p>
				
				<font size="3">
					<input type="radio" name="antivirus" value="1"/>Sim &nbsp &nbsp
					<input type="radio" name="antivirus" value="0"  checked="true"/>Não 
				</font>
			</div>
		</div>
		 <br>
		
		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Sistema Operativo<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <select class="form-control" name="idsistema_operativo">
				 <option value="">Selecione o Sistema Operativo</option>
				  <?php 
						#seleciona os dados da tabela departamento	
						$resultado =mysql_query("SELECT idSistema_Operativo, Nome_Sistema_Operativo  FROM sistema_operativo;");
						while($dados = mysql_fetch_assoc($resultado)){
							#preencher o select com dados
							?>
								<option value="<?php echo $dados["idSistema_Operativo"]; ?>"><?php echo $dados["Nome_Sistema_Operativo"];?></option>
								
							<?php
						}
					?>
				</select>
			</div>
		  </div>
		
			<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Office<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <select class="form-control" name="idoffice">
				 <option value="">Selecione o Office</option>
				  <?php 
						#seleciona os dados da tabela departamento	
						$resultado =mysql_query("SELECT idOffice, Nome_Office  FROM office;");
						while($dados = mysql_fetch_assoc($resultado)){
							#preencher o select com dados
							?>
								<option value="<?php echo $dados["idOffice"]; ?>"><?php echo $dados["Nome_Office"];?></option>
							<?php
						
						}
			
					?>
				</select>
			</div>
		  </div>
			
			<br>
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Aplicativos</label>
				<div class="col-sm-10">
				<p>Escolha os aplicativos instalados:</p>
					<input type="checkbox" name="chkbox_Aplicativos[]" value="Adobe Reader"><label>&nbsp Adobe Reader</label> &nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox_Aplicativos[]" value="7 ZIP"><label>&nbsp 7 ZIP</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox_Aplicativos[]" value="Java"><label>&nbsp Java</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox_Aplicativos[]" value="Google Chrome"><label>&nbsp Google Chrome</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox_Aplicativos[]" value="Mozilla Firefox"><label>&nbsp Mozilla Firefox</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox_Aplicativos[]" value="Opera Browser"><label>&nbsp Opera Browser</label> 
				
				</div>
			</div>
		
		 	<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">AIRC</label>
				<div class="col-sm-10">
					<input type="checkbox" name="chkbox[]" value="Guias de Receita Gerais"><label>&nbsp Guias de Receita Gerais</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Gestão de Mercados"><label>&nbsp Gestão de Mercados</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Gestão de Publicidade"><label>&nbsp Gestão de Publicidade</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Obras por Administração Directa"><label>&nbsp Obras por Administração Directa</label>&nbsp &nbsp &nbsp </br>
					<input type="checkbox" name="chkbox[]" value="Sistema de Tratamento de Actas"><label>&nbsp Sistema de Tratamento de Actas</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Sistema de Beneficiários da ADSE"><label>&nbsp Sistema de Beneficiários da ADSE</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Sistema de Avaliação de Desempenho"><label>&nbsp Sistema de Avaliação de Desempenho </label>&nbsp &nbsp &nbsp </br>
					<input type="checkbox" name="chkbox[]" value="Gestão de Tesouraria"><label>&nbsp Gestão de Tesouraria</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Sistema de Controlo de Empreitadas"><label>&nbsp Sistema de Controlo de Empreitadas</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Gestão Documental Registo de Correspondência"><label>&nbsp Gestão Documental Registo de Correspondência</label>&nbsp &nbsp &nbsp </br>
					<input type="checkbox" name="chkbox[]" value="Sistema de Inventário e Cadastro Patrimonial"><label>&nbsp Sistema de Inventário e Cadastro Patrimonial</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Gestão de Stocks"><label>&nbsp  Gestão de Stocks</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Gestão de Pessoal"><label>&nbsp Gestão de Pessoal</label>&nbsp &nbsp &nbsp 
					<input type="checkbox" name="chkbox[]" value="Sistema de Gestão de Água"><label>&nbsp Sistema de Gestão de Água</label>&nbsp &nbsp &nbsp </br>
					<input type="checkbox" name="chkbox[]" value="Sistema de Contabilidaden Autárquica"><label>&nbsp Sistema de Contabilidade Autárquica</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Sistema de Processos de Obras"><label>&nbsp Sistema de Processos de Obras</label>&nbsp &nbsp &nbsp
					<input type="checkbox" name="chkbox[]" value="Administração de Aplicações AIRC"><label>&nbsp Administração de Aplicações AIRC</label>&nbsp &nbsp &nbsp
				</div>
			</div>
			
			
			
			<!--
			
			 
			TAX - Guias de Receita Gerais
			TAX - Gestão de Mercados
			TAX - Gestão de Publicidade
			
			OAD - Obras por Administração Directa
			STA - Sistema de Tratamento de Actas
			SBA - Sistema de Beneficiários da ADSE
			SAD - Sistema de Avaliação de Desempenho 
			
			SGT - Gestão de Tesouraria
			SCE - Sistema de Controlo de Empreitadas
			SGD - Gestão Documental Registo de Correspondência
			SIC - Sistema de Inventário e Cadastro Patrimonial
			GES - Gestão de Stocks
			SGP - Gestão de Pessoal
			SCA - Sistema de Contabilidade Autárquica
			SPO - Sistema de Processos de Obras
			SGA - Sistema de Gestão de Água
			ADM - Administração de Aplicações AIRC
			
			-->
 
		  		<div class="form-group">
			<label for="inputPassword3" class="col-sm-2 control-label">Estado<font color="red" size="4">&nbsp*</font></label>
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
				<label for="inputPassword3" class="col-sm-2 control-label">Observação</label>
				<div class="col-sm-10">
					<textarea class="form-control" id="observacao_instalacao_computadores" rows="3" name="observacao_instalacao_computadores" value="<?php if(isset($_POST["observacao_instalacao_computadores"])){ echo $_POST["observacao_instalacao_computadores"];} ?>"></textarea>
				</div>
			  </div>
			  
		
		
 	<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
				  <button type="submit" class="btn btn-success"  name="submit" Value="submit">Inserir</button>
				</div>
			  </div>
 </form>

			
        </div>
		</div>
    </div> <!-- /container -->

	
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
	function func_data(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_instalacao_computadores"]'); //our date input has the name "date"
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