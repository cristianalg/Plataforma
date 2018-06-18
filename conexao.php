<?php
// or die - Equivalente/abreviatura a exit() || imprime uma mensagem e sai do script atual
$conectar = mysql_connect("localhost","root","") or die ("Erro na conexão");
mysql_select_db("plataforma")or die ("Base de dados não encontrada");
?>