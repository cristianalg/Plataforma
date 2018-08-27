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

    <title>Assistências Técnicas</title>
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
	$result = mysql_query("SELECT * FROM assistencia_tecnica WHERE idAssistencia_Tecnica = '$id'");
	$resultado = mysql_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Assistência Técnica</h1>
	</div>
	
	 <div class="row">
		<div class="pull-right">
			<a href='assistencia_tecnica_Listar.php'><img src="imagens/list.png" width="30px" title="Listar"></a></a>
			<a href='assistencia_tecnica_Editar_Formulario.php?id=<?php echo $resultado['idAssistencia_Tecnica']; ?>'><img src="imagens/edit.ico" width="30px" title="Editar"></a>
			<a href="#" onclick="javascript: if (confirm('Deseja remover este registo?'))location.href='assistencia_tecnica_Eliminar.php?id=<?php echo $resultado['idAssistencia_Tecnica']; ?>'"><img src='imagens/edit_delete.png' width='30px' title="Eliminar"></a>
		</div>
	</div> 
	
	<div class="row">
		<div class="col-md-12">
			<div>
				<b>Id:</b>
				<?php echo $resultado['idAssistencia_Tecnica']; ?>
			</div>
			<br>
			
			<div>
				<b>Descrição da Avaria:</b>
				<?php echo $resultado['Descricao_Avaria']; ?>
			</div>
			<br>
			
			<div>
				<b>Data do Pedido</b>
				<?php echo $resultado['Data_Pedido']; ?>
			</div>
			<br>
			
			<div>
				<b>Data Prevista da Resolução</b>
				<?php echo $resultado['Data_Prevista_Entrega']; ?>
			</div>
			<br>
			
			<div>
				<b>Tipo de Assistência:</b>
			<?php
				$result_cat =mysql_query("SELECT Nome_Tipo_Assistencia FROM tipo_assistencia INNER JOIN 
				assistencia_tecnica ON tipo_assistencia.idTipo_Assistencia = assistencia_tecnica.Tipo_Assistencia_idTipo_Assistencia
				where assistencia_tecnica.idAssistencia_Tecnica  = ".$resultado['idAssistencia_Tecnica'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Tipo_Assistencia']."</td>";
				}
			?>
			</div>
			<br>
			
				<div>
				<b>Estado da Assistência:</b>
			<?php
				$result_cat =mysql_query("SELECT Nome_Estado_Assistencia FROM estado INNER JOIN 
				assistencia_tecnica ON estado.idEstado = assistencia_tecnica.Estado_idEstado 
				where assistencia_tecnica.idAssistencia_Tecnica   = ".$resultado['idAssistencia_Tecnica'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Estado_Assistencia']."</td>";
				}
			?>
			</div>
			<br>
			
			<div>
				<b>Técnico da Assistência:</b>
			<?php
				$result_cat =mysql_query("SELECT Nome FROM tecnico INNER JOIN 
				assistencia_tecnica ON tecnico.idTecnico = assistencia_tecnica.Tecnico_idTecnico 
				where assistencia_tecnica.idAssistencia_Tecnica = ".$resultado['idAssistencia_Tecnica'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome']."</td>";
				}
			?>
			</div>
			<br>
			
				<div>
				<b>Tipo do Requerente:</b>
			<?php
				$result_cat =mysql_query("SELECT Nome_Tipo_Requerente FROM tipo_requerente INNER JOIN 
				assistencia_tecnica ON tipo_requerente.idTipo_Requerente = assistencia_tecnica.Requerente_Tipo_Requerente_idTipo_Requerente 
				where assistencia_tecnica.idAssistencia_Tecnica = ".$resultado['idAssistencia_Tecnica'].";");
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
				assistencia_tecnica ON requerente.idRequerente = assistencia_tecnica.Requerente_idRequerente 
				where assistencia_tecnica.idAssistencia_Tecnica = ".$resultado['idAssistencia_Tecnica'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Requerente']."</td>";
				}
			?>
			</div>
			<br>
			
			
			
			
			 <div>
				<b>Histórico do Serviço:</b>
			<?php 
				$sem_estado = "Sem Histórico.";
				if($resultado['Historico_Servico'] == NULL){
					echo "<td>".$sem_estado."</td>";
				}else{
					echo "<td>".$resultado['Historico_Servico']."</td>";
				}
			?>
			</div>	
			<br>
			
			<div>
				<b>Observação:</b>
			<?php echo $resultado['Observacao_Assistencia']; ?>
			</div>
			<br>
			
			<div>
				<b>Imprimir Relatório:</b>
			<?php 
				$sem = "Não";
				$com = "Sim";
				if($resultado['Imprimir_Relatorio'] == 0){
					echo "<td>".$sem. "</td>";
				}else{
					echo "<td>".$com."</td>";
				}
			?>
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

