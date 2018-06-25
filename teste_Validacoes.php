<?php
session_start();
include_once("seguranca.php");
include_once("conexao.php");

// if(isset($_GET['id']))
// {
     // $sql = "DELETE FROM tecnico WHERE idTecnico=".$_GET['id'];
     // $mysql->query($sql);
 // echo 'Deleted successfully.';
// }

// $id = $_GET["id"];

// $query = "DELETE FROM tecnico WHERE idTecnico = $id";
// $resultado = mysql_query($query);
// $linhas = mysql_affected_rows();

 if(isset($_GET['id'])){
	$query = "DELETE FROM tecnico WHERE idTecnico = $id";
	$resultado = mysql_query($query);
	$linhas = mysql_affected_rows();
 }


?>