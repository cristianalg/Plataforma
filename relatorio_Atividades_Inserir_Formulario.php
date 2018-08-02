 <?php  
 session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
include_once("conexao.php");
include_once("menu_Pagina_Inicial.php");
 // $connect = mysqli_connect("localhost", "root", "", "testing");  
 $query ="SELECT * FROM assistencia_tecnica ORDER BY idAssistencia_Tecnica DESC";  
 $resultado = mysql_query($query);  
 
 ?>  
 <!DOCTYPE html>  
 <html  lang="pt-pt">  
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
		
		<!-- eliminar-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </head>  
    <body>  
        <?php
		include_once("menu_Pagina_Inicial.php");	
	  
		if(isset($_SESSION['post_data'])){
			$_POST 							= $_SESSION['post_data'];
			$imprimir						= $_POST["imprimir"];
			$data_pedido					= $_POST["data_pedido"];
			$data_prevista_entrega			= $_POST["data_prevista_entrega"];
			
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
        <h1>Inserir Relatório</h1>
      </div>
	  <p><font color="red" size="4">*</font> <font size="2">Campos de preenchimento obrigatório </font></p>
 
      <div class="row">
        <div class="col-md-12">
          <form class="form-horizontal" method="POST" action="relatorio_Atividades_GerarPDF.php" role="form" enctype="multipart/form-data"> 
			<div class="form-group">
				<label class="control-label col-sm-2 requiredField" for="date">Data Início<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar">
							</i>
						</div>
						<input class="form-control" onclick="func_data_pedido()" id="data_pedido" name="data_pedido" placeholder="YYYY/MM/DD" type="text" value="<?php if(isset($_POST["data_pedido"])){ echo $_POST["data_pedido"];} ?>"/>
					</div>
				</div>
			</div>
           
		   
			<div class="form-group">
				<label class="control-label col-sm-2 requiredField" for="date">Data Fim<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-3">
					<div class="input-group">
						<div class="input-group-addon">
							<i class="fa fa-calendar">
							</i>
						</div>
						<input class="form-control" onclick="func_data_prevista_entrega()" id="data_prevista_entrega" name="data_prevista_entrega" placeholder="YYYY/MM/DD" type="text" value="<?php if(isset($_POST["data_prevista_entrega"])){ echo $_POST["data_prevista_entrega"];} ?>"/>
					</div>
				</div>
			</div>	
		 
		  <div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Assunto<font color="red" size="4">&nbsp*</font></label>
				<div class="col-sm-10">
				  <input type="text" class="form-control" name="imprimir" placeholder="Assunto" value="<?php if(isset($_POST["imprimir"])){ echo $_POST["imprimir"];} ?>">
				</div>
			  </div>
		 
		 
		 	<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary">
						<img src="imagens/print.png" width="23px">
						<font color="white" size="2">Gerar PDF</font>
					</button>
					
				</div>
			</div> 
		</form>
        </div>
		</div>
    </div> <!-- /container -->

	
		


		
      </body>  
	  
	      <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	
	
	<!-- Script do spinner
    ================================================== -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
	<script src="js/spinner.js"></script>
	<script src="js/spinner_Function.js"></script>
	<!--<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
	<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>    -->        
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
	
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