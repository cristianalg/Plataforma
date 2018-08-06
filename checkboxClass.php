<?php
require_once 'connectionClass.php';

class checkboxClass extends connectionClass{
   
   
    public function listCheckbox($query){
        $list="select * from instalacao_computadores $query";
        $result=  $this->query($list);
        $count=  $result->num_rows;
        if($count < 1){}else{
            while($row= $result->fetch_array(MYSQLI_BOTH)){
                $arr[]= $row;
            }
            return $arr;
        }
    }
	

	 public function listCheckbox_AIRC($query_AIRC){
        $list_AIRC="select * from instalacao_computadores $query_AIRC";
        $result_AIRC=  $this->query($list_AIRC);
        $count_AIRC=  $result_AIRC->num_rows;
        if($count_AIRC < 1){}else{
            while($row_AIRC= $result_AIRC->fetch_array(MYSQLI_BOTH)){
                $arr_AIRC[]= $row_AIRC;
            }
            return $arr_AIRC;
        }
    }
    

	//***************Formulario Editar************************************************
   public function updateCheckbox($value_aplicativo, $value_airc,$id){
	  
		$nome_instalacao						= $_POST["nome_instalacao"];
		$nome_rede								= $_POST["nome_rede"];
		$impressora								= $_POST["impressora"];
		$antivirus								= $_POST["antivirus"];
		$data_instalacao_computadores			= $_POST["data_instalacao_computadores"];
		$observacao_instalacao_computadores		= $_POST["observacao_instalacao_computadores"];
			
		$idsistema_operativo					= $_POST["idsistema_operativo"];
		$idoffice								= $_POST["idoffice"];
		$idestado								= $_POST["idestado"];
			
        $update= utf8_decode("update instalacao_computadores set Aplicativo='$value_aplicativo', AIRC='$value_airc', nome_instalacao='$nome_instalacao', nome_rede ='$nome_rede', antivirus ='$antivirus', observacao_instalacao_computadores ='$observacao_instalacao_computadores',
		data_instalacao_computadores ='$data_instalacao_computadores', Sistema_Operativo_idSistema_Operativo  ='$idsistema_operativo', Office_idOffice ='$idoffice', Estado_idEstado ='$idestado',impressora ='$impressora'
 
		Where idInstalacao_Computadores='$id'");
        $result=$this->query($update);
        if($result){
            echo "
				<script type=\"text/javascript\">
						alert('Editada com sucesso!'); 
						 window.location.replace('instalacao_Computadores_Listar.php'); </script>
				</script>
				";
        }
		 else {
			 echo " 
						
						<script type=\"text/javascript\">
						alert('Não alterou nenhum campo!'); 
						window.location.replace('instalacao_Computadores_Listar.php'); </script>
						</script>
					";		   
		 }
			}
}
?>