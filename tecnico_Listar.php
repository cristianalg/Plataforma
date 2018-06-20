<?php
	session_start();
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

    <title>Técnicos</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
	
	
	
	
	

	<!------ Include the above in your HEAD tag ---------->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
	
	
	
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
	<script>
	.trash { color:rgb(209, 91, 71); }
.flag { color:rgb(248, 148, 6); }
.panel-body { padding:0px; }
.panel-footer .pagination { margin: 0; }
.panel .glyphicon,.list-group-item .glyphicon { margin-right:5px; }
.panel-body .radio, .checkbox { display:inline-block;margin:0px; }
.panel-body input[type=checkbox]:checked + label { text-decoration: line-through;color: rgb(128, 144, 160); }
.list-group-item:hover, a.list-group-item:focus {text-decoration: none;background-color: rgb(245, 245, 245);}
.list-group { margin-bottom:0px; }
	</script>
	
  </head>

  <body role="document">
	<?php
		include_once("menu_Pagina_Inicial.php");
		$resultado=mysql_query("SELECT * FROM tecnico ORDER BY 'id'");
		$linhas=mysql_num_rows($resultado);
	?>	
	
	
    <div class="container theme-showcase" role="main">      
      <div class="page-header">
        <h1>Lista dos Técnicos
		&nbsp
		 <a href="tecnico.php"><img src="imagens/add1.ico" width="30px"></a>
		</h1>
      </div>
	  
      <div class="row">
        <div class="col-md-12">
          <table class="table">
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
			  
			  <?php 
					while($linhas = mysql_fetch_array($resultado)){
						echo "<tr>";
							echo "<td>".$linhas['idTecnico']."</td>";
							echo "<td>".$linhas['Numero_Funcionario']."</td>";
							echo "<td>".$linhas['Nome']."</td>";
							echo "<td>".$linhas['Email']."</td>";
							echo "<td>".$linhas['Contacto']."</td>";
							echo "<td>".$linhas['Funcao']."</td>";
							echo "
							<td> 
							<a href='#'><button type='button' class='btn btn-sm btn-primary'>Visualizar</button></a>
							<a href='#'><button type='button' class='btn btn-sm btn-warning'>Editar</button></a>
							<a href='#'><button type='button' class='btn btn-sm btn-danger'>Apagar</button></a>
							
							<a href='#'><img src='imagens/info.ico' width='30px'></a>
							<a href='#'><img src='imagens/edit.ico' width='30px'></a>
							<a href='#'><img src='imagens/edit_delete.png' width='30px'></a>
							
							</td>";
						echo "</tr>";
					}
				?>
            </tbody>
          </table>
        </div>
		</div>
    </div> <!-- /container -->
	
	
	



	
	
	
	
<div class="container">
	<div class="row">
        <div class="col-md-12">
        <h4>Bootstrap Snipp for Datatable</h4>
        <div class="table-responsive">
              <table id="mytable" class="table table-bordred table-striped">
                   <thead>
                   <th><input type="checkbox" id="checkall" /></th>
                   <th>First Name</th>
                    <th>Last Name</th>
                     <th>Address</th>
                     <th>Email</th>
                     <th>Contact</th>
                      <th>Edit</th>
                       <th>Delete</th>
                   </thead>
    <tbody>
 <tr>
    <td><input type="checkbox" class="checkthis" /></td>
    <td>Mohsin</td>
    <td>Irshad</td>
    <td>CB 106/107 Street # 11 Wah Cantt Islamabad Pakistan</td>
    <td>isometric.mohsin@gmail.com</td>
    <td>+923335586757</td>
    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
    </tr>
    </tbody>
        
</table>

<div class="clearfix"></div>
<ul class="pagination pull-right">
  <li class="disabled"><a href="#"><span class="glyphicon glyphicon-chevron-left"></span></a></li>
  <li class="active"><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#"><span class="glyphicon glyphicon-chevron-right"></span></a></li>
</ul>
                
            </div>
            
        </div>
	</div>
</div>


    



	
	
	
	
	
	
	

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
