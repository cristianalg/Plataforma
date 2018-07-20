<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

$id   								= $_POST["numeroid"];
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


$query = mysql_query("UPDATE requerimento set festa ='$festa', data_requerimento ='$data_requerimento',  data_festividade = '$data_festividade', observacao_requerimento = '$observacao_requerimento', elaboracao_cartazes_alusivos = '$elaboracao_cartazes_alusivos',
impressao_cartazes = '$impressao_cartazes', tamanho_a4 = '$tamanho_a4', tamanho_a3 = '$tamanho_a3', site_municipio ='$site_municipio', mupis_publicidade ='$mupis_publicidade', agenda_boletim ='$agenda_boletim',  
outros_apoios_1 ='$outros_apoios_1', outros_apoios_2 ='$outros_apoios_2', outros_apoios_3 ='$outros_apoios_3', outros_apoios_4 ='$outros_apoios_4', outros_apoios_5 ='$outros_apoios_5', outros_apoios_6 ='$outros_apoios_6', 
Requerente_Tipo_Requerente_idTipo_Requerente ='$idtipo_requerente', Requerente_idRequerente ='$idrequerente' WHERE 	idRequerimento='$id'");


if (mysql_affected_rows() != 0 ){	
			echo "
				
				<script type=\"text/javascript\">
						alert('Requerimento editado com sucesso!'); 
						 window.location.replace('requerimento_Listar.php'); </script>
				</script>
			";		   
		}
		 else{ 	
				echo "
				
				<script type=\"text/javascript\">
				alert('Não alterou nenhum campo!'); 
				window.location.replace('requerimento_Listar.php'); </script>
				</script>
			";		   

		}

		mysql_query($query) OR DIE(mysql_error());
?>