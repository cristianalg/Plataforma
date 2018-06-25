 <?php  
 session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
include_once("conexao.php");

 // $connect = mysqli_connect("localhost", "root", "", "testing");  
 $query ="SELECT * FROM tecnico ORDER BY IdTecnico DESC";  
 $resultado = mysql_query($query);  
 
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Datatables Jquery Plugin with Php MySql and Bootstrap</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
                <h3 align="center">Datatables Jquery Plugin with Php MySql and Bootstrap</h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="tecnico_data" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                   <!-- <td>Name</td>  
                                    <td>Address</td>  
                                    <td>Gender</td>  
                                    <td>Designation</td>  
                                    <td>Age</td>   -->
									
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
							<a href='tecnico_Eliminar.php?id=<?php echo $linhas['idTecnico']; ?>'><img src='imagens/edit_delete.png' width='30px'></a>
							<?php
						echo "</tr>";
					}
				?>
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#tecnico_data').DataTable();  
 });  
 </script>  