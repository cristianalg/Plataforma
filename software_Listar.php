﻿<?php  
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
include_once("conexao.php");
include_once("menu_Pagina_Inicial.php");
 // $connect = mysqli_connect("localhost", "root", "", "testing");  
 $query ="SELECT * FROM software ORDER BY idSoftware DESC";  
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

		<title>Software</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="css/theme.css" rel="stylesheet">
		<script src="js/ie-emulation-modes-warning.js"></script>
	
    </head>  
    <body>  
        <div class="container">  
            <div>
			<!--<div class="page-header">-->
				<h1>Lista dos Sofware
				&nbsp
				<a href="software_Inserir_Formulario.php"><img src="imagens/add1.ico" width="30px"></a>
				</h1>
			</div> 
            <div class="table-responsive">  
                <table id="tecnico_data" class="table table-striped table-bordered">  
                     <thead>  
                         <tr>  
							<th>ID</th>
							<th>Nome Software</th>
							<th>Versão</th>
							<th>Data Registo</th>
							<th>Data Início</th>
							<th>Data Fim</th>
							<th>Ações</th>
                        </tr>  
                    </thead>  
				 				 
				  <?php 
					while($linhas = mysql_fetch_array($resultado)){
						echo "<tr>";
							echo "<td>".$linhas['idSoftware']."</td>";
							echo "<td>".$linhas['Nome_Software']."</td>";
							echo "<td>".$linhas['Versao']."</td>";
							echo "<td>".$linhas['Data_Registo']."</td>";
							echo "<td>".$linhas['Data_Inicio_Contrato']."</td>";
							echo "<td>".$linhas['Data_Renovacao_Contrato']."</td>";
							?>
							
							<td> 
							<a href='software_Visualizar.php?id=<?php echo $linhas['idSoftware']; ?>'><img src='imagens/info.ico' width='30px'></a>
							<a href='software_Editar_Formulario.php?id=<?php echo $linhas['idSoftware']; ?>'><img src='imagens/edit.ico' width='30px'></a>
							<a href="#" onclick="javascript: if (confirm('Deseja remover este registo?'))location.href='software_Eliminar.php?id=<?php echo $linhas['idSoftware']; ?>'"><img src='imagens/edit_delete.png' width='30px'></a>
							<?php
						echo "</tr>";
					}
				?>
                     </table>  
                </div>  
           </div>  
		   
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
 
 <!-- Script da função do spinner-->
 <script>  
 $(document).ready(function(){  
      $('#tecnico_data').DataTable();  
 });  
 </script>  