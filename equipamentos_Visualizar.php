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

    <title>Equipamentos</title>
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
	$result = mysql_query("SELECT * FROM equipamentos WHERE idEquipamentos = '$id'");
	$resultado = mysql_fetch_assoc($result);
?>
<div class="container theme-showcase" role="main">      
	<div class="page-header">
		<h1>Visualizar Equipamento</h1>
	</div>
	
	 <div class="row">
		<div class="pull-right">
			<a href='equipamentos_Listar.php'><img src="imagens/list.png" width="30px"></a></a>
			<a href='equipamentos_Editar_Formulario.php?id=<?php echo $resultado['idEquipamentos']; ?>'><img src="imagens/edit.ico" width="30px"></a></a>
			<a href='equipamentos_Eliminar.php?id=<?php echo $resultado['idEquipamentos']; ?>'><img src='imagens/edit_delete.png' width='30px'></a>
		</div>
	</div> 
	
	<div class="row">
		<div class="col-md-12">
				<div>
				<b>Id:</b>
				<?php echo $resultado['idEquipamentos']; ?>
			</div>
			<br>
			
			<div>
				<b>Tipo de Equipamento:</b>
			
				<?php
					$result_cat =mysql_query("SELECT Nome_Tipo_Equipamento FROM tipo_equipamento INNER JOIN 
									equipamentos ON tipo_equipamento.idTipo_Equipamento = equipamentos.Tipo_Equipamento_idTipo_Equipamento where equipamentos.idEquipamentos = ".$resultado['idEquipamentos'].";");
					while($dados = mysql_fetch_assoc($result_cat)){
						echo "<td>".$dados['Nome_Tipo_Equipamento']."</td>";
					}
				?>
			</div>
			<br>
			
			<div>
				<b>Nome do Equipamento:</b>
			<?php echo $resultado['Nome_Equipamento']; ?>
			</div>
			<br>
			
			<div>
				<b>Departamento:</b>
			
				<?php
					$result_cat =mysql_query("SELECT Nome_Departamento FROM departamento INNER JOIN 
									equipamentos ON departamento.idDepartamento = equipamentos.Registo_Postos_Trabalho_Departamento_idDepartamento where equipamentos.idEquipamentos = ".$resultado['idEquipamentos'].";");
					while($dados = mysql_fetch_assoc($result_cat)){
						echo "<td>".$dados['Nome_Departamento']."</td>";
					}
				?>
			</div>
			<br>
			
				<div>
				<b>Posto de Trabalho:</b>
			
				<?php
					$result_cat =mysql_query("SELECT Cargo FROM registo_postos_trabalho INNER JOIN 
									equipamentos ON registo_postos_trabalho.idRegisto_Postos_Trabalho = equipamentos.Registo_Postos_Trabalho_idRegisto_Postos_Trabalho where equipamentos.idEquipamentos = ".$resultado['idEquipamentos'].";");
					while($dados = mysql_fetch_assoc($result_cat)){
						echo "<td>".$dados['Cargo']."</td>";
					}
				?>
			</div>
			<br>
			
				<div>
				<b>Tipo de Requerente:</b>
			
				<?php
					$result_cat =mysql_query("SELECT Nome_Tipo_Requerente FROM tipo_requerente INNER JOIN 
									equipamentos ON tipo_requerente.idTipo_Requerente = equipamentos.Registo_Postos_Trabalho_idTipo_Requerente where equipamentos.idEquipamentos = ".$resultado['idEquipamentos'].";");
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
									equipamentos ON requerente.idRequerente = equipamentos.Registo_Postos_Trabalho_Requerente_idRequerente where equipamentos.idEquipamentos = ".$resultado['idEquipamentos'].";");
					while($dados = mysql_fetch_assoc($result_cat)){
						echo "<td>".$dados['Nome_Requerente']."</td>";
					}
				?>
			</div>
			<br>
			
			<div>
				<b>Número de Série:</b>
			<?php echo $resultado['Numero_Serie']; ?>
			</div>
			<br>
			
			<div>
				<b>Marca:</b>
			<?php echo $resultado['Marca']; ?>
			</div>
			<br>
			
			<div>
				<b>Modelo:</b>
			<?php echo $resultado['Modelo']; ?>
			</div>
			<br>	
			
			<div>
				<b>Número de Inventário:</b>
			<?php echo $resultado['Numero_Inventario']; ?>
			</div>
			<br>
			
			<div>
				<b>Local de Instalação:</b>
			<?php echo $resultado['Local_Instalacao']; ?>
			</div>
			<br>
			
			<div>
				<b>Contacto:</b>
			<?php echo $resultado['Contacto']; ?>
			</div>
			<br>
			
			<div>
				<b>Estado do Material:</b>
			<?php echo $resultado['Estado_Material']; ?>
			</div>
			<br>
			
			<div>
				<b>User de Acesso à Internet:</b>
			<?php echo $resultado['User_Acesso_Internet']; ?>
			</div>
			<br>
			
			<div>
				<b>Password de Acesso à Internet:</b>
			<?php echo $resultado['Password_Acesso_Internet']; ?>
			</div>
			<br>
			
			<div>
				<b>Username do Equipamento:</b>
			<?php echo $resultado['Username_Equipamento']; ?>
			</div>
			<br>
			
			<div>
				<b>Password do Equipamento:</b>
			<?php echo $resultado['Password_Equipamento']; ?>
			</div>
			<br>
			
			<div>
				<b>Contacto de Suporte:</b>
			<?php echo $resultado['Contacto_Suporte']; ?>
			</div>
			<br>
			
			<div>
				<b>Observação:</b>
			<?php echo $resultado['Observacao_Equipamento']; ?>
			</div>
			<br>
			
			
			<div><b>Cópia da Fatura:</b>
			
			<?php
				$id = $_GET["id"];

				$query ="SELECT Copia_Fatura FROM equipamentos WHERE idEquipamentos = '".$id."'";  
				$resultado = mysql_query($query);  
				$linhas = mysql_fetch_array($resultado);
				
				if($linhas['Copia_Fatura'] == NULL){
					//echo "sem foto";
					 echo "Sem Cópia da Fatura.";
				}else{
					echo "Pode visualizar a cópia da fatura na pasta <b><i>Anexos_Equipamentos</i></b> 
					do servidor com o seguinte nome: <b><i>".$linhas['Copia_Fatura']." </i></b>";
					//echo $linhas['Copia_Fatura']; 
				}
			?>
			</div>
			<br>
			
			<div><b>Ficheiro de Configuração:</b>
			
			<?php
				$id = $_GET["id"];

				$query ="SELECT Ficheiro_Configuracao FROM equipamentos WHERE idEquipamentos = '".$id."'";  
				$resultado = mysql_query($query);  
				$linhas = mysql_fetch_array($resultado);
				
				if($linhas['Ficheiro_Configuracao'] == NULL){
					//echo "sem foto";
					 echo "Sem ficheiro de configuração.";
				}else{
					echo "Pode visualizar o ficheiro de configuração na pasta <b><i>Anexos_Equipamentos</i></b> 
					do servidor com o seguinte nome: <b><i>".$linhas['Ficheiro_Configuracao']." </i></b>";
					//echo $linhas['Copia_Fatura']; 
				}
			?>
			</div>
			<br><br>
	
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

