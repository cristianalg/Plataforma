<?php
# Informa qual o conjunto de caracteres será usado.
header('Content-Type: text/html; charset=utf-8');

# Conecta ao banco de dados
// or die - Equivalente/abreviatura a exit() || imprime uma mensagem e sai do script atual
$conectar = mysql_connect("localhost","root","") or die ("Erro na conexão");
mysql_select_db("plataforma")or die ("Base de dados não encontrada");

# Codificacao 
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');

?>