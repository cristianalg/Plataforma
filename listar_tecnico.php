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
