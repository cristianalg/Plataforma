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

    <title>Requisição de Material</title>
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
	$result = mysql_query("SELECT * FROM requisicao_material WHERE idRequisicao_Material = '$id'");
	$resultado = mysql_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Requisição de Material</h1>
	</div>
	
	 <div class="row">
		<div class="pull-right">
			<a href='requisicao_Material_Listar.php'><img src="imagens/list.png" width="30px"></a></a>
			<a href='requisicao_Material_Editar_Formulario.php?id=<?php echo $resultado['idRequisicao_Material']; ?>'><img src="imagens/edit.ico" width="30px"></a></a>
			<a href='requisicao_Material_Eliminar.php?id=<?php echo $resultado['idRequisicao_Material']; ?>'><img src='imagens/edit_delete.png' width='30px'></a>
		</div>
	</div> 
	
	<div class="row">
		<div class="col-md-12">
				<div>
				<b>Id:</b>
				<?php echo $resultado['idRequisicao_Material']; ?>
			</div>
			<br>
			
			<div>
				<b>Tipo de Equipamento:</b>
			<?php
				$result_cat =mysql_query("SELECT Nome_Tipo_Equipamento FROM tipo_equipamento INNER JOIN 
				requisicao_material ON tipo_Equipamento.idTipo_Equipamento= requisicao_material.Equipamentos_Tipo_Equipamento_idTipo_Equipamento 
				where requisicao_material.idRequisicao_Material = ".$resultado['idRequisicao_Material'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Tipo_Equipamento']."</td>";
				}
			?>
			</div>
			<br>
			
			<div>
				<b>Equipamento:</b>
			<?php
				$result_cat =mysql_query("SELECT Nome_Equipamento FROM equipamentos INNER JOIN 
				requisicao_material ON Equipamentos.idEquipamentos = requisicao_material.Equipamentos_idEquipamentos 
				where requisicao_material.idRequisicao_Material = ".$resultado['idRequisicao_Material'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Equipamento']."</td>";
				}
			?>
			</div>
			<br>
			
			<div>
				<b>Tipo de Requerente:</b>
			<?php
				$result_cat =mysql_query("SELECT Nome_Tipo_Requerente FROM tipo_requerente INNER JOIN 
				requisicao_material ON tipo_Requerente.idTipo_Requerente = requisicao_material.Requerente_Tipo_Requerente_idTipo_Requerente 
				where requisicao_material.idRequisicao_Material = ".$resultado['idRequisicao_Material'].";");
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
				requisicao_material ON Requerente.idRequerente = requisicao_material.Requerente_idRequerente 
				where requisicao_material.idRequisicao_Material = ".$resultado['idRequisicao_Material'].";");
				while($dados = mysql_fetch_assoc($result_cat)){
					echo "<td>".$dados['Nome_Requerente']."</td>";
				}
			?>
			</div>
			<br>
			
			 
			
			<div>
				<b>Data Requisição:</b>
			<?php echo $resultado['Data_Requisicao']; ?>
			</div>
			<br>
			
			<div>
				<b>Data Prevista de Devolução</b>
				<?php echo $resultado['Data_Prevista_Devolucao']; ?>
			</div>
			<br>
			
			<div>
				<b>Secção:</b>
				<?php echo $resultado['Seccao']; ?>
			</div>
			<br>
			
			 <div>
				<b>Data de Devolução:</b>
			<?php 
				$sem_Data = "Equipamento não devolvido";
				if($resultado['Data_Devolucao'] == NULL){
					echo "<td>".$sem_Data. "</td>";
				}else{
					echo "<td>".$resultado['Data_Devolucao']."</td>";
				}
			?>
			</div>	
			<br>
			
			 <div>
				<b>Estado do Material Devolvido:</b>
			<?php 
				$sem_estado = "Equipamento não devolvido";
				if($resultado['Estado_Material_Devolvido'] == NULL){
					echo "<td>".$sem_estado."</td>";
				}else{
					echo "<td>".$resultado['Estado_Material_Devolvido']."</td>";
				}
			?>
			</div>	
			<br>
			
			 <div>
				<b>Estado da Requisição:</b>
			<?php 
				$sem = "Não Entregue";
				$com = "Entregue";
				if($resultado['Estado_Requisicao'] == 0){
					echo "<td>".$sem. "</td>";
				}else{
					echo "<td>".$com."</td>";
				}
			?>
			</div>	
			<br>
			
			
			<div>
				<b>Observação:</b>
			<?php echo $resultado['Observacao_Requisicao_Material']; ?>
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

