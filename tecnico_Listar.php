﻿ <?php  
 session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
include_once("conexao.php");
include_once("menu_Pagina_Inicial.php");
 // $connect = mysqli_connect("localhost", "root", "", "testing");  
 $query ="SELECT * FROM tecnico ORDER BY IdTecnico DESC";  
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

		<title>Técnicos</title>
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
				<h1>Lista dos Técnicos
				&nbsp
				<a href="tecnico_Inserir_Formulario.php"><img src="imagens/add1.ico" width="30px"></a>
				</h1>
			</div> 
            <div class="table-responsive">  
                <table id="tecnico_data" class="table table-striped table-bordered">  
                     <thead>  
                         <tr>  
							<th>ID</th>
							<th>Nº Funcionário</th>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Contacto</th>
							<th>Função</th>
							<th>Ações</th>
                        </tr>  
                    </thead>  
                 
						
				  <?php 
					while($linhas = mysql_fetch_array($resultado)){
						echo "<tr>";
							echo "<td>".$linhas['idTecnico']."</td>";
							echo "<td>".$linhas['Numero_Funcionario']."</td>";
							echo "<td>".$linhas['Nome']."</td>";
							echo "<td>".$linhas['Email']."</td>";
							echo "<td>".$linhas['Contacto']."</td>";
							echo "<td>".$linhas['Funcao']."</td>";
							?>
							
							<td> 
							<a href='tecnico_Visualizar.php?id=<?php echo $linhas['idTecnico']; ?>'><img src='imagens/info.ico' width='30px'></a>
							<a href='tecnico_Editar_Formulario.php?id=<?php echo $linhas['idTecnico']; ?>'><img src='imagens/edit.ico' width='30px'></a>
							<a href="#" onclick="javascript: if (confirm('Deseja remover este registo?'))location.href='tecnico_Eliminar.php?id=<?php echo $linhas['idTecnico']; ?>'"><img src='imagens/edit_delete.png' width='30px'></a>
							<?php
						echo "</tr>";
					}
				?>
                     </table>  
                </div>  
           </div>  
      </body>  
	  
	  
	  
<!--eliminar-->
<script>  
 $(document).ready(function(){  
      $('#tecnico_data').DataTable();  
	      $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");

        if(confirm('Tem certeza de remover este registo ?'))
        {
            $.ajax({
               url: 'eliminar.php',
               type:'GET',
               data: {id: id}, 
               error: function() {
                  alert('Algo está errado');
               },
               success: function(data) {
                    $("tecnico_Listar.php"+id).remove();
                    alert("Registo removido com sucesso");  
               }
            });
        }
    });
 });  
 </script>
<!--<script type="text/javascript">
    //$(".remove").click(function(){
		$(document).ready(function(){  
        var id = $(this).parents("tr").attr("id");

        if(confirm('Tem certeza de remover este registo ?'))
        {
            $.ajax({
               url: 'eliminar.php',
               type:'POST',
               data: {id: id}, 
               error: function() {
                  alert('Algo está errado');
               },
               success: function(data) {
                    $("tecnico_Listar.php"+id).remove();
                    alert("Registo removido com sucesso");  
               }
            });
        }
    });
	
</script> -->
<!--
	  // deleteing rows
// $(".remove").click(function(){
// var element = $(this);
// var remove = element.attr("id");
// var info = 'did=' + remove;
// if(confirm("Eliminar?"))
// {
 // $.ajax({
   // type: "POST",
   // url: "eliminar.php",
   // data: info,
   // success: function(){
    // alert('Eliminado com sucesso!');
 // }
// });
 // }
// return false;
// });
-->

	  
	  
	  
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