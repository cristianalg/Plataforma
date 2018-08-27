 <?php  
 session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
include_once("conexao.php");
include_once("menu_Pagina_Inicial.php");
 // $connect = mysqli_connect("localhost", "root", "", "testing");  
 $query ="SELECT * FROM requerente ORDER BY idRequerente DESC";  
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

		<title>Requerentes</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="css/theme.css" rel="stylesheet">
		<script src="js/ie-emulation-modes-warning.js"></script>
		
		<!-- eliminar-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    </head>  
    <body>  
        <div class="container">  
            <div>
			<!--<div class="page-header">-->
				<h1>Lista dos Requerentes
				&nbsp
				<a href="requerente_Inserir_Formulario.php"><img src="imagens/add1.ico" width="30px" title="Adicionar"></a>
				</h1>
			</div> 
            <div class="table-responsive">  
                <table id="tecnico_data" class="table table-striped table-bordered">  
                     <thead>  
                         <tr>  
							<th>ID</th>
							<th>Tipo de Requerente</th>
							<th>Nome</th>
							<th>Nº Funcionário</th>
							<th>E-mail</th>
							<th>Contacto</th>
							<th>Ações</th>
                        </tr>  
                    </thead>  
                 
						
				  <?php 
				  $sem = "sem número";
					while($linhas = mysql_fetch_array($resultado)){
						echo "<tr>";
							echo "<td>".$linhas['idRequerente']."</td>";
							
							//echo "<td>".$linhas['Tipo_Requerente_idTipo_Requerente']."</td>";
							$result_cat =mysql_query("SELECT Nome_Tipo_Requerente FROM tipo_requerente INNER JOIN 
							requerente ON tipo_Requerente.idTipo_Requerente = requerente.Tipo_Requerente_idTipo_Requerente where requerente.idRequerente = ".$linhas['idRequerente'].";");
							while($dados = mysql_fetch_assoc($result_cat)){
								echo "<td>".$dados['Nome_Tipo_Requerente']."</td>";
							}
							
							echo "<td>".$linhas['Nome_Requerente']."</td>";
							
							if($linhas['Numero_Funcionario'] == 0){
								echo "<td>".$sem. "</td>";
							}else{
								echo "<td>".$linhas['Numero_Funcionario']."</td>";
							}
							echo "<td>".$linhas['Email']."</td>";
							echo "<td>".$linhas['Contacto_Requerente']."</td>";
							
							
						?>
							
							<td> 
							<a href='requerente_Visualizar.php?id=<?php echo $linhas['idRequerente']; ?>'><img src='imagens/info.ico' width='30px' title="Visualizar"></a>
							<a href='requerente_Editar_Formulario.php?id=<?php echo $linhas['idRequerente']; ?>'><img src='imagens/edit.ico' width='30px' title="Editar"></a>
							<a href="#" onclick="javascript: if (confirm('Deseja remover este registo?'))location.href='requerente_Eliminar.php?id=<?php echo $linhas['idRequerente']; ?>'"><img src='imagens/edit_delete.png' width='30px' title="Eliminar"></a>
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