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

    <title>Requerimento</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
  </head>

  <body role="document">
<?php
	include_once("menu_Pagina_Inicial.php");	
	$id = $_GET['id'];
	//Executa consulta
	$result = mysql_query("SELECT * FROM requerimento WHERE idRequerimento= '$id'");
	$resultado = mysql_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Requerimento</h1>
	</div>
	
	 <div class="row">
		<div class="pull-right">
			<a href='requerimento_Listar.php'><img src="imagens/list.png" width="30px"></a></a>
			<a href='requerimento_Editar_Formulario.php?id=<?php echo $resultado['idRequerimento']; ?>'><img src="imagens/edit.ico" width="30px"></a></a>
			<a href='requerimento_Eliminar.php?id=<?php echo $resultado['idRequerimento']; ?>'><img src='imagens/edit_delete.png' width='30px'></a>
		</div>
	</div> 
	
	<div class="row">
		<div class="col-md-12">
				<div>
				<b>Id:</b>
				<?php echo $resultado['idRequerimento']; ?>
			</div>
			<br>
			
			
			<div>
				<b>Tipo de Requerente:</b>
			<?php
				$result_cat =mysql_query("SELECT Nome_Tipo_Requerente FROM tipo_requerente INNER JOIN 
				requerimento ON tipo_Requerente.idTipo_Requerente = requerimento.Requerente_Tipo_Requerente_idTipo_Requerente 
				where requerimento.idRequerimento =  ".$resultado['idRequerimento'].";");
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
				requerimento ON Requerente.idRequerente = requerimento.Requerente_idRequerente 
				where requerimento.idRequerimento = ".$resultado['idRequerimento'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Requerente']."</td>";
				}
			?>
			</div>
			<br>
			
			 
			
			<div>
				<b>Data do Pedido:</b>
				<?php echo $resultado['Data_Requerimento']; ?>
			</div>
			<br>
			
			
			<div>
				<b>Data da Festividade:</b>
				<?php echo $resultado['Data_Festividade']; ?>
			</div>
			<br>
			
			<div>
				<b>Festa:</b>
				<?php echo $resultado['Festa']; ?>
			</div>
			<br>
			
			 <div>
				<b>Elaboração de Cartazes Alusivos:</b>
			<?php 
				$sem = "Não";
				$com = "Sim";
				if($resultado['Elaboracao_Cartazes_Alusivos'] == 0){
					echo "<td>".$sem. "</td>";
				}else{
					echo "<td>".$com."</td>";
				}
			?>
			</div>	
			<br>
			
			 <div>
				<b>Impressão de Cartazes:</b>
			<?php 
				$sem = "Não";
				$com = "Sim";
				if($resultado['Impressao_Cartazes'] == 0){
					echo "<td>".$sem. "</td>";
				}else{
					echo "<td>".$com."</td>";
				}
			?>
			</div>	
			<br>
			
			
			<div>
				<b>Tamanho A3:</b>
				<?php echo $resultado['Tamanho_A3']; ?>
			</div>
			<br>
			
			<div>
				<b>Tamanho A4:</b>
				<?php echo $resultado['Tamanho_A4']; ?>
			</div>
			<br>
			
			
			 <div>
				<b>Site Município:</b>
			<?php 
				$sem = "Não";
				$com = "Sim";
				if($resultado['Site_Municipio'] == 0){
					echo "<td>".$sem. "</td>";
				}else{
					echo "<td>".$com."</td>";
				}
			?>
			</div>	
			<br>
			
			<div>
				<b>Mupis de Publicidade:</b>
			<?php 
				$sem = "Não";
				$com = "Sim";
				if($resultado['Mupis_Publicidade'] == 0){
					echo "<td>".$sem. "</td>";
				}else{
					echo "<td>".$com."</td>";
				}
			?>
			</div>	
			<br>
			
			<div>
				<b>Agenda/Boletim:</b>
			<?php 
				$sem = "Não";
				$com = "Sim";
				if($resultado['Agenda_Boletim'] == 0){
					echo "<td>".$sem. "</td>";
				}else{
					echo "<td>".$com."</td>";
				}
			?>
			</div>	
			<br>
			
			<div>
				<b>Observação:</b>
			<?php echo $resultado['Observacao_Requerimento']; ?>
			</div>
			<br>
			
			<div>
				<b>Apoios 1:</b>
				<?php echo $resultado['Outros_Apoios_1']; ?>
			</div>
			<br>
			
			<div>
				<b>Apoios 2:</b>
				<?php echo $resultado['Outros_Apoios_2']; ?>
			</div>
			<br>
			
			<div>
				<b>Apoios 3:</b>
				<?php echo $resultado['Outros_Apoios_3']; ?>
			</div>
			<br>
			
			<div>
				<b>Apoios 4:</b>
				<?php echo $resultado['Outros_Apoios_4']; ?>
			</div>
			<br>
			
			<div>
				<b>Apoios 5:</b>
				<?php echo $resultado['Outros_Apoios_5']; ?>
			</div>
			<br>
			
			<div>
				<b>Apoios 6:</b>
				<?php echo $resultado['Outros_Apoios_6']; ?>
			</div>
			<br>
			
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

