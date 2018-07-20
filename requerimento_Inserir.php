<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

			$festa								= $_POST["festa"];
			$data_requerimento					= $_POST["data_requerimento"];
			$data_festividade					= $_POST["data_festividade"];
			$observacao_requerimento			= $_POST["observacao_requerimento"];
			$elaboracao_cartazes_alusivos		= $_POST["elaboracao_cartazes_alusivos"];
			$impressao_cartazes					= $_POST["impressao_cartazes"];
			$tamanho_a4							= $_POST["tamanho_a4"];
			$tamanho_a3							= $_POST["tamanho_a3"];
			$site_municipio						= $_POST["site_municipio"];
			$mupis_publicidade					= $_POST["mupis_publicidade"];
			$agenda_boletim						= $_POST["agenda_boletim"];
			
			$outros_apoios_1					= $_POST["outros_apoios_1"];
			$outros_apoios_2					= $_POST["outros_apoios_2"];
			$outros_apoios_3					= $_POST["outros_apoios_3"];
			$outros_apoios_4					= $_POST["outros_apoios_4"];
			$outros_apoios_5					= $_POST["outros_apoios_5"];
			$outros_apoios_6					= $_POST["outros_apoios_6"];
			
			$idtipo_requerente					= $_POST["idtipo_requerente"];
			$idrequerente						= $_POST["idrequerente"];

		
 
			

if($festa == "" || $data_requerimento == "" || $data_festividade == "" || $idtipo_requerente == ""  || $idrequerente == "")
{
	echo "<script language='javascript' type='text/javascript' text-align:'center' > 
		alert('Os campos com (*) são de preenchimento obrigatório.'); ";
	
	// session_start();
	$_SESSION['post_data'] = $_POST;
	
	echo "window.location.replace('requerimento_Inserir_Formulario.php'); </script>";  
	return;
}

	try
    {
        //insere na BD
		
			$sql = "INSERT INTO requerimento (festa, data_requerimento, data_festividade, observacao_requerimento, elaboracao_cartazes_alusivos,
			impressao_cartazes, tamanho_a4, tamanho_a3, site_municipio, mupis_publicidade, agenda_boletim, outros_apoios_1, outros_apoios_2, outros_apoios_3,
			outros_apoios_4, outros_apoios_5, outros_apoios_6, Requerente_idRequerente,	Requerente_Tipo_Requerente_idTipo_Requerente	) VALUES 
			('".trim($festa)."', '".trim($data_requerimento)."', '".trim($data_festividade)."', '".trim($observacao_requerimento)."', '".trim($elaboracao_cartazes_alusivos)."',
			'".trim($impressao_cartazes)."', '".trim($tamanho_a4)."', '".trim($tamanho_a3)."', '".trim($site_municipio)."', '".trim($mupis_publicidade)."',
			'".trim($agenda_boletim)."', '".trim($outros_apoios_1)."', '".trim($outros_apoios_2)."', '".trim($outros_apoios_3)."', '".trim($outros_apoios_4)."', '".trim($outros_apoios_5)."',
			'".trim($outros_apoios_6)."', '".trim($idrequerente)."', '".trim($idtipo_requerente)."')";
		
		$result = mysql_query($sql) or die(mysql_error());
 
        //retorna 1 para no sucesso do ajax saber que foi com inserido sucesso
        //echo "1";
		
		$_SESSION['post_data']=NULL;
		//session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Requerimento inserido com sucesso!'); 
				  window.location.replace('requerimento_Listar.php');
			   </script>";

    } 
    catch (Exception $ex)
    {
        //retorna 0 para no sucesso do ajax saber que foi um erro
       // echo "0";
	   
	   $_SESSION['post_data']=NULL;
	   //session_destroy();
		echo "<script language='javascript' type='text/javascript' text-align:'center' > 
				  alert('Requerimento não inserido!'); 
				  window.location.replace('requerimento_Listar.php'); 
			 </script>";
    }
	
?>