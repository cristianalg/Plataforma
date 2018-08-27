 <?php  
 session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
include_once("conexao.php");
include_once("menu_Pagina_Inicial.php");
 // $connect = mysqli_connect("localhost", "root", "", "testing");  
 $query ="SELECT * FROM requisicao_material ORDER BY idRequisicao_Material DESC";  
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

		<title>Requisição de Material</title>
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
				<h1>Lista das Requisições de Material
				&nbsp
				<a href="requisicao_Material_Inserir_Formulario.php"><img src="imagens/add1.ico" width="30px" title="Adicionar"
></a>
				</h1>
			</div> 
            <div class="table-responsive">  
                <table id="tecnico_data" class="table table-striped table-bordered">  
                     <thead>  
                         <tr>  
							<th>ID</th>
							<th>Data Requisição</th>
							<th>Tipo Equipamento</th>
							<th>Equipamento</th>
							<th>Tipo Requerente</th>
							<th>Requerente</th>
							<th>Ações</th>
                        </tr>  
                    </thead>  
					
                 
				  <?php 
					while($linhas = mysql_fetch_array($resultado)){
						echo "<tr>";
							echo "<td>".$linhas['idRequisicao_Material']."</td>";
							echo "<td>".$linhas['Data_Requisicao']."</td>";
							
							
							//Tipo de equipamento
							$result_cat =mysql_query("SELECT Nome_Tipo_Equipamento FROM tipo_equipamento INNER JOIN 
							requisicao_material ON Tipo_Equipamento.idTipo_Equipamento = requisicao_material.Equipamentos_Tipo_Equipamento_idTipo_Equipamento 
							where requisicao_material.idRequisicao_Material = ".$linhas['idRequisicao_Material']." ORDER BY Nome_Tipo_Equipamento;");
							while($dados = mysql_fetch_assoc($result_cat)){
								echo "<td>".$dados['Nome_Tipo_Equipamento']."</td>";
							}
							
							//Equipamento
							$result_cat =mysql_query("SELECT Nome_Equipamento FROM equipamentos INNER JOIN 
							requisicao_material ON equipamentos.idEquipamentos = requisicao_material.Equipamentos_idEquipamentos 
							where requisicao_material.idRequisicao_Material = ".$linhas['idRequisicao_Material']." ORDER BY Nome_Equipamento;");
							while($dados = mysql_fetch_assoc($result_cat)){
								echo "<td>".$dados['Nome_Equipamento']."</td>";
							}
							
							//tipo de requerente
							$result_cat =mysql_query("SELECT Nome_Tipo_Requerente FROM tipo_requerente INNER JOIN 
							requisicao_material ON tipo_requerente.idTipo_Requerente = requisicao_material.	Requerente_Tipo_Requerente_idTipo_Requerente 
							where requisicao_material.idRequisicao_Material = ".$linhas['idRequisicao_Material']."  ORDER BY Nome_Tipo_Requerente;");
							while($dados = mysql_fetch_assoc($result_cat)){
								echo "<td>".$dados['Nome_Tipo_Requerente']."</td>";
							}
						
							//nome de requerente
							$result_cat =mysql_query("SELECT Nome_Requerente FROM requerente INNER JOIN 
							requisicao_material ON requerente.idRequerente = requisicao_material.Requerente_idRequerente 
							where requisicao_material.idRequisicao_Material = ".$linhas['idRequisicao_Material']." ORDER BY Nome_Requerente;");
							while($dados = mysql_fetch_assoc($result_cat)){
								echo "<td>".$dados['Nome_Requerente']."</td>";
							}
						?>
							
							<td> 
							<a href='requisicao_Material_Visualizar.php?id=<?php echo $linhas['idRequisicao_Material']; ?>'><img src='imagens/info.ico' width='30px' title="Visualizar"></a>
							<a href='requisicao_Material_Editar_Formulario.php?id=<?php echo $linhas['idRequisicao_Material']; ?>'><img src='imagens/edit.ico' width='30px' title="Editar"></a>
							<a href="#" onclick="javascript: if (confirm('Deseja remover este registo?'))location.href='requisicao_Material_Eliminar.php?id=<?php echo $linhas['idRequisicao_Material']; ?>'"><img src='imagens/edit_delete.png' width='30px' title="Eliminar"></a>
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