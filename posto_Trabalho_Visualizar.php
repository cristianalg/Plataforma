<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
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

    <title>Posto de Trabalho</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
	
	<!-- Zoom da Imagem -->
	<style>
	div.item {
		position: relative;
		width: 300px;
		min-height: 500px;
	}

	div.item div.inner {
	   
		width: 100%;
		height: 600px;
		top: 0;
		left: 0;
		transition: all .2s;
	}

	div.item div.inner:hover {
		position: absolute;
		z-index: 20;
		width: 200%; /*ajusta a largura do zoom*/
		cursor:pointer;
	}

	div.item div.inner img {
		display: block;
		margin: 0 auto;
		width: 100%;

	}
	</style>
  </head>

  <body role="document">
<?php
	include_once("menu_Pagina_Inicial.php");	
	$id = $_GET['id'];
	//Executa consulta
	$result = mysql_query("SELECT * FROM registo_postos_trabalho WHERE 	idRegisto_Postos_Trabalho = '$id'");
	$resultado = mysql_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Posto de Trabalho</h1>
	</div>
	
	 <div class="row">
		<div class="pull-right">
			<a href='posto_Trabalho_Listar.php'><img src="imagens/list.png" width="30px"></a></a>
			<a href='posto_Trabalho_Editar_Formulario.php?id=<?php echo $resultado['idRegisto_Postos_Trabalho']; ?>'><img src="imagens/edit.ico" width="30px"></a></a>
			<a href="#" onclick="javascript: if (confirm('Deseja remover este registo?'))location.href='posto_Trabalho_Eliminar.php?id=<?php echo $resultado['idRegisto_Postos_Trabalho']; ?>'"><img src='imagens/edit_delete.png' width='30px'></a>
		</div>
	</div> 
	
	<div class="row">
		<div class="col-md-12">
				<div>
				<b>Id:</b>
				<?php echo $resultado['idRegisto_Postos_Trabalho']; ?>
			</div>
			<br>
			
			<div>
				<b>Cargo:</b>
			<?php echo $resultado['Cargo']; ?>
			</div>
			<br>
			
			<div>
				<b>Departamento:</b>
			
			<?php
				$result_cat =mysql_query("SELECT Nome_Departamento FROM departamento INNER JOIN 
								registo_postos_trabalho ON departamento.idDepartamento = registo_postos_trabalho.Departamento_idDepartamento where registo_postos_trabalho.idRegisto_Postos_Trabalho = ".$resultado['idRegisto_Postos_Trabalho'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Departamento']."</td>";
				}
			?>
			</div>
			<br>
			
			<div>
				<b>Tipo de Requerente:</b>
			
			<?php
				$result_cat =mysql_query("SELECT Nome_Tipo_Requerente FROM tipo_requerente INNER JOIN 
								registo_postos_trabalho ON tipo_requerente.idtipo_requerente = registo_postos_trabalho.Requerente_Tipo_Requerente_idTipo_Requerente where registo_postos_trabalho.idRegisto_Postos_Trabalho = ".$resultado['idRegisto_Postos_Trabalho'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Tipo_Requerente']."</td>";
				}
			?>
			</div>
			<br>
			
			<div>
				<b>Nome do Requerente:</b>
			
			<?php
				$result_cat =mysql_query("SELECT Nome_Requerente FROM requerente INNER JOIN 
								registo_postos_trabalho ON requerente.idrequerente = registo_postos_trabalho.Requerente_idRequerente where registo_postos_trabalho.idRegisto_Postos_Trabalho = ".$resultado['idRegisto_Postos_Trabalho'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Requerente']."</td>";
				}
			?>
			</div>
			<br>
			
			<div>
				<b>Observação:</b>
			<?php echo $resultado['Observacao_Registo_Postos_Trabalho']; ?>
			</div>
			<br>
			
			<div><b>Anexo:</b>
			
			<?php
				$id = $_GET["id"];

				$query ="SELECT anexo FROM registo_postos_trabalho WHERE idRegisto_Postos_Trabalho = '".$id."'";  
				$resultado = mysql_query($query);  
				$linhas = mysql_fetch_array($resultado);
				
				if($linhas['anexo'] == NULL){
					//echo "sem foto";
					 echo "Sem Anexo";
				}else{
			?>
					
				<div class="item">
					<div class="inner">
						<?php
					
							$sql = mysql_query("SELECT  anexo FROM registo_postos_trabalho WHERE idRegisto_Postos_Trabalho = '$id'");
							 
							while ($img = mysql_fetch_object($sql)) {
								// Exibimos a foto
								echo "<img src='Anexos_Postos_Trabalho/".$img->anexo."' /><br/>";
							}
				}	
						?>
					</div>
				</div>

			</div>
			
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

