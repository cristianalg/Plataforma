<?php
session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
include_once("seguranca.php");
include_once("conexao.php");

//********Aplicativos e AIRC - CheckBox ***************************************************
error_reporting(E_ALL & ~E_NOTICE & ~E_USER_NOTICE);
include_once 'checkboxClass.php';
$checkBoxClass=new checkboxClass();



if(isset($_POST["submit"])){
	$countryValue_aplicativo =  implode(",",$_POST["Country"]);
	$countryValue_airc =  implode(",",$_POST["chkbox"]);
   //echo $checkBoxClass->updateCheckbox($countryValue_apli, $countryValue, $_GET["id"]);
     echo $checkBoxClass->updateCheckbox($countryValue_aplicativo, $countryValue_airc, $_GET["id"]);
}

$list=$checkBoxClass->listCheckbox("WHERE idInstalacao_Computadores ='$_GET[id]'");
$checkboxvalues =  explode(",", $list[0]["Aplicativo"]);



$list_AIRC =$checkBoxClass->listCheckbox_AIRC("WHERE idInstalacao_Computadores ='$_GET[id]'");
$checkboxvalues_AIRC =  explode(",", $list_AIRC[0]["AIRC"]);

?>
<!DOCTYPE html>
<html lang="pt-pt">
  <head>
   <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Página Inicial">
    <meta name="author" content="Cristiana">

    <title>Instalação de Computadores</title>
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
		$result = mysql_query("SELECT * FROM instalacao_computadores WHERE idInstalacao_Computadores = '$id'");
		$resultado = mysql_fetch_assoc($result);  //mysql_fetch_assoc - Obtém uma linha do resultado como um array associativo
	?>

		
<!--********************DATA***************************************************************-->
<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" /> 
<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />
<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>


<div class="container theme-showcase" role="main">      
  <div class="page-header">
	<h1>Editar Instalação de Computadores</h1>
  </div>
	
  <div class="row">
	<div class="col-md-12">
	
	<?php
		//********Aplicativos - CheckBox ***************************************************
		if(in_array("Adobe Reader", $checkboxvalues)){
            $checkedValue="checked='checked'";
        }
        if(in_array("7 ZIP", $checkboxvalues)){
            $checkedValue1="checked='checked'";
        }
        if(in_array("Java", $checkboxvalues)){
            $checkedValue2="checked='checked'";
        }
        if(in_array("Google Chrome", $checkboxvalues)){
            $checkedValue3="checked='checked'";
        }
        if(in_array("Mozilla Firefox", $checkboxvalues)){
            $checkedValue4="checked='checked'";
        }
		if(in_array("Opera Browser", $checkboxvalues)){
            $checkedValue5="checked='checked'";
        }
	
		//********AIRC - CheckBox ***************************************************
        if(in_array("Guias de Receita Gerais", $checkboxvalues_AIRC)){
            $checkedValue_AIRC="checked='checked'";
        }
        if(in_array("Gestão de Mercados", $checkboxvalues_AIRC)){
            $checkedValue_AIRC1="checked='checked'";
        }
        if(in_array("Gestão de Publicidade", $checkboxvalues_AIRC)){
            $checkedValue_AIRC2="checked='checked'";
        }
        if(in_array("Obras por Administração Directa", $checkboxvalues_AIRC)){
            $checkedValue_AIRC3="checked='checked'";
        }
        if(in_array("Sistema de Tratamento de Actas", $checkboxvalues_AIRC)){
            $checkedValue_AIRC4="checked='checked'";
        }
		if(in_array("Sistema de Beneficiários da ADSE", $checkboxvalues_AIRC)){
            $checkedValue_AIRC5="checked='checked'";
        }
		if(in_array("Sistema de Avaliação de Desempenho ", $checkboxvalues_AIRC)){
            $checkedValue_AIRC6="checked='checked'";
        }
		if(in_array("Gestão de Tesouraria", $checkboxvalues_AIRC)){
            $checkedValue_AIRC7="checked='checked'";
        }
		if(in_array("Sistema de Controlo de Empreitadas", $checkboxvalues_AIRC)){
            $checkedValue_AIRC8="checked='checked'";
        }
		if(in_array("Gestão Documental Registo de Correspondência", $checkboxvalues_AIRC)){
            $checkedValue_AIRC9="checked='checked'";
        }
		if(in_array("Sistema de Inventário e Cadastro Patrimonial", $checkboxvalues_AIRC)){
            $checkedValue_AIRC10="checked='checked'";
        }
		if(in_array("Gestão de Stocks", $checkboxvalues_AIRC)){
            $checkedValue_AIRC11="checked='checked'";
        }
		if(in_array("Gestão de Pessoal", $checkboxvalues_AIRC)){
            $checkedValue_AIRC12="checked='checked'";
        }
		if(in_array("Sistema de Gestão de Água", $checkboxvalues_AIRC)){
            $checkedValue_AIRC13="checked='checked'";
        }
		if(in_array("Sistema de Contabilidade Autárquica", $checkboxvalues_AIRC)){
            $checkedValue_AIRC14="checked='checked'";
        }
		if(in_array("Sistema de Processos de Obras", $checkboxvalues_AIRC)){
            $checkedValue_AIRC15="checked='checked'";
        }
		if(in_array("Administração de Aplicações AIRC", $checkboxvalues_AIRC)){
            $checkedValue_AIRC16="checked='checked'";
        }
        ?>
	  <form class="form-horizontal" method="POST" action="<?php echo $_SERVER["PHP_SELF"]."?id=$_GET[id]"; ?>">

		<br><br>
		<div class="form-group">
			<label class="control-label col-sm-2 requiredField" for="date">Data da Instalação<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-3">
				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-calendar">
						</i>
					</div>
					<input class="form-control" onclick="func_data()" id="data_instalacao_computadores" name="data_instalacao_computadores" placeholder="YYYY/MM/DD" type="text" value="<?php echo $resultado['Data_Instalacao_Computadores']; ?>"/>
				</div>
			</div>
		</div>
	  
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Nome de Instalação<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="nome_instalacao" placeholder="Nome da Instalação " value="<?php echo $resultado['Nome_Instalacao']; ?>">
			</div>
		  </div>
	
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Nome de Rede<font color="red" size="4">&nbsp*</font></label>
			<div class="col-sm-10">
			  <input type="text" class="form-control" name="nome_rede" placeholder="Nome da Rede" value="<?php echo $resultado['Nome_Rede']; ?>">
			</div>
		  </div>
		  
		  <div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label"> Impressora Follow Me</label>
			<div class="col-sm-10">
				<input type="radio" name="impressora" value="1" <?php if($resultado['Impressora'] == 1){ echo "checked";}?>/>Sim &nbsp &nbsp
				<input type="radio" name="impressora" value="0" <?php if($resultado['Impressora'] == 0){ echo "checked";}?>/>Não
			</div>
		</div>
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Antivirus</label>
			<div class="col-sm-10">
				<input type="radio" name="antivirus" value="1" <?php if($resultado['Antivirus'] == 1){ echo "checked";}?>/>Sim &nbsp &nbsp
				<input type="radio" name="antivirus" value="0" <?php if($resultado['Antivirus'] == 0){ echo "checked";}?>/>Não
			</div>
		</div>
	    


		<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Aplicativos</label>
				<div class="col-sm-10">			
				<input type="checkbox" id="Country" name="Country[]" <?php echo $checkedValue; ?> value="Adobe Reader">&nbsp Adobe Reader &nbsp &nbsp &nbsp
					<input type="checkbox" id="Country" name="Country[]" <?php echo $checkedValue1; ?> value="7 ZIP">&nbsp 7 ZIP &nbsp &nbsp &nbsp
					<input type="checkbox" id="Country" name="Country[]" <?php echo $checkedValue2; ?> value="Java">&nbsp Java &nbsp &nbsp &nbsp
					<input type="checkbox" id="Country" name="Country[]" <?php echo $checkedValue3; ?> value="Google Chrome">&nbsp Google Chrome &nbsp &nbsp &nbsp
					<input type="checkbox" id="Country" name="Country[]" <?php echo $checkedValue4; ?> value="Mozilla Firefox">&nbsp Mozilla Firefox &nbsp &nbsp &nbsp
					<input type="checkbox" id="Country" name="Country[]" <?php echo $checkedValue5; ?> value="Opera Browser">&nbsp Opera Browser &nbsp &nbsp &nbsp
				</div>
			</div>
			

	  
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">AIRC</label>
				<div class="col-sm-10">
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC; ?>		value="Guias de Receita Gerais"> &nbsp Guias de Receita Gerais &nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC1; ?> 		value="Gestão de Mercados"> &nbsp Gestão de Mercados &nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox" name="chkbox[]"	<?php echo $checkedValue_AIRC2; ?>		value="Gestão de Publicidade"> &nbsp Gestão de Publicidade &nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC3; ?>		value="Obras por Administração Directa"> &nbsp Obras por Administração Directa &nbsp &nbsp &nbsp </br>
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC4; ?>		value="Sistema de Tratamento de Actas"> &nbsp Sistema de Tratamento de Actas &nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC5; ?> 		value="Sistema de Beneficiários da ADSE"> &nbsp Sistema de Beneficiários da ADSE &nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC6; ?> 		value="Sistema de Avaliação de Desempenho"> &nbsp Sistema de Avaliação de Desempenho &nbsp &nbsp &nbsp </br>
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC7; ?> 		value="Gestão de Tesouraria"> &nbsp Gestão de Tesouraria &nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC8; ?> 		value="Sistema de Controlo de Empreitadas"> &nbsp Sistema de Controlo de Empreitadas &nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox"  name="chkbox[]" <?php echo $checkedValue_AIRC9; ?> 		value="Gestão Documental Registo de Correspondência"> &nbsp Gestão Documental Registo de Correspondência &nbsp &nbsp &nbsp </br>
					<input type="checkbox" id="chkbox"  name="chkbox[]" <?php echo $checkedValue_AIRC10; ?> 	value="Sistema de Inventário e Cadastro Patrimonial"> &nbsp Sistema de Inventário e Cadastro Patrimonial &nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox" name="chkbox[]"	<?php echo $checkedValue_AIRC11; ?> 	value="Gestão de Stocks"> &nbsp  Gestão de Stocks &nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC12; ?> 	value="Gestão de Pessoal"> &nbsp Gestão de Pessoal &nbsp &nbsp &nbsp 
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC13; ?> 	value="Sistema de Gestão de Água"> &nbsp Sistema de Gestão de Água &nbsp &nbsp &nbsp </br>
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC14; ?>		value="Sistema de Contabilidade Autárquica"> &nbsp Sistema de Contabilidade Autárquica &nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox" name="chkbox[]" 	<?php echo $checkedValue_AIRC15; ?>		value="Sistema de Processos de Obras"> &nbsp Sistema de Processos de Obras&nbsp &nbsp &nbsp
					<input type="checkbox" id="chkbox" name="chkbox[]"	<?php echo $checkedValue_AIRC16; ?> 	value="Administração de Aplicações AIRC"> &nbsp Administração de Aplicações AIRC &nbsp &nbsp &nbsp
				</div>
			</div>

			<?php $sistemaFK_id = $resultado['Sistema_Operativo_idSistema_Operativo'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Sistema Operativo</label>
			<div class="col-sm-10">
			<select class="form-control" name="idsistema_operativo">
				<?php 
						$result =mysql_query("SELECT idSistema_Operativo, Nome_Sistema_Operativo  FROM sistema_operativo");
						while($dados = mysql_fetch_assoc($result)){
							$id_sistemaPK = $dados['idSistema_Operativo'];
							?>
								<option value="<?php echo $dados["idSistema_Operativo"]; ?>"
								<?php if($id_sistemaPK == $sistemaFK_id){ echo 'selected'; } ?>
								><?php echo $dados["Nome_Sistema_Operativo"];?></option>
							<?php
						}
				?>	
			</select>
			</div>
		</div> 
		
				
		<?php $officeFK_id = $resultado['Office_idOffice'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Sistema Operativo</label>
			<div class="col-sm-10">
			<select class="form-control" name="idoffice">
				<?php 
						$result =mysql_query("SELECT idOffice, Nome_Office  FROM office");
						while($dados = mysql_fetch_assoc($result)){
							$id_officePK = $dados['idOffice'];
							?>
								<option value="<?php echo $dados["idOffice"]; ?>"
								<?php if($id_officePK == $officeFK_id){ echo 'selected'; } ?>
								><?php echo $dados["Nome_Office"];?></option>
							<?php
						}
				?>	
			</select>
			</div>
		</div> 
	    
		
			<?php $estadoFK_id = $resultado['Estado_idEstado'];?>
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Estado</label>
			<div class="col-sm-10">
			<select class="form-control" name="idestado">
				<?php 
						$result =mysql_query("SELECT idEstado, Nome_Estado_Assistencia  FROM estado");
						while($dados = mysql_fetch_assoc($result)){
							$id_estadoPK = $dados['idEstado'];
							?>
								<option value="<?php echo $dados["idEstado"]; ?>"
								<?php if($id_estadoPK == $estadoFK_id){ echo 'selected'; } ?>
								><?php echo $dados["Nome_Estado_Assistencia"];?></option>
							<?php
						}
				?>	
			</select>
			</div>
		</div> 
		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Observação</label>
			<div class="col-sm-10">
				<?php
					echo '<textarea class="form-control" rows="3" name="observacao_instalacao_computadores">'. $resultado['Observacao_Instalacao_Computadores']. '</textarea>';
				?>
			</div>
		</div>
		
		
		 <input type="hidden" name="numeroid" value="<?php echo $resultado['idInstalacao_Computadores']; ?>">
		  <div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
			 <!-- <button type="submit" class="btn btn-danger">Editar</button> -->
			  <input type="submit" id="submit" name="submit" value="Editar" class="btn btn-danger">
			</div>
		  </div>
		  
	
		</form>
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




<!--********************DATA***************************************************************-->
<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
	function func_data(){
	//$(document).ready(function(){
		var date_input=$('input[name="data_instalacao_computadores"]'); //our date input has the name "date"
		var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
		date_input.datepicker({
			format: 'yyyy/mm/dd',
			container: container,
			todayHighlight: true,
			autoclose: true,
		})
	//})
	}
	
</script>



