<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    
  <link rel="stylesheet" href="dist/css/bootstrap-submenu.css">
  <script src="dist/js/bootstrap-submenu.js" defer></script>
  

	<!--Rodapé-->
<style type="text/css" media="screen">
*  {
	margin:0;
	padding:0;
}

html, body {height:100%;}

.geral {
	min-height:100%;
	position:relative;
	width:800px;
}

.footer {
	position:fixed;
	bottom:0;
	width:100%;
}

.content {overflow:hidden;}
.aside {width:200px;}
.fleft {float:left;}
.fright {float:right;}
</style>
</head>

<!-- Inicio navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="pagina_Inicial.php">Câmara Municipal</a>  <!--Volta à pagina incial, não à de login -->
	</div>

	<div id="navbar" class="navbar-collapse collapse">
	  <ul class="nav navbar-nav">    
		
	
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TABELAS <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			  <li><a href="tecnico_Listar.php">TÉCNICOS</a></li>
			  <li class="divider"></li>
			  <li><a href="#">REQUERENTES</a></li> 
			  <li><a href="tipo_Requerente_Listar.php">  &nbsp Tipo de requerente</a></li>
			  <li><a href="requerente_Listar.php">  &nbsp Requerentes</a></li> 
			  <li class="divider"></li> 	
			  <li><a href="#">POSTOS DE TRABALHO</a></li> 
			  <li><a href="departamento_Listar.php">  &nbsp Departamentos</a></li>
			  <li><a href="posto_Trabalho_Listar.php">  &nbsp Postos de Trabalho</a></li> 
			  <li class="divider"></li>
			  <li><a href="#">EQUIPAMENTOS</a></li> 
			  <li><a href="tipo_Equipamento_Listar.php">  &nbsp Tipo de Equipamentos</a></li>
			  <li><a href="equipamentos_Listar.php">  &nbsp Equipamentos</a></li> 
		  </ul>
		</li>
	
	
	
	
		
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Assistências Técnicas <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a>ASSISTÊNCIAS</a></li> 
			  <li><a href="tipo_Assistencia_Listar.php">  &nbsp Tipo de Assistências</a></li>
			  <li><a href="#">  &nbsp Assistências</a></li> 
			  <li class="divider"></li>
			<li><a href="teste_Inicio.php">Inserir Instalação Computadores</a></li>
			<li><a href="teste_Inicio.php">Listar Instalação Computadores</a></li>
			
			<li><a href="aaaa.php">Inserir Configuração Equipamentos</a></li>  
			<li><a href="teste_Inicio.php">Listar Configuração Equipamentos</a></li>
		  </ul>
		</li>
		
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Sistema <span class="caret"></span></a>
		  <ul class="dropdown-menu">
			<li><a href="#">Software</a></li>     
			<li><a href="sistema_Operativo_Listar.php">Sistema Operativo</a></li>
			<li><a href="office_Listar.php">Office</a></li>
			<li><a href="#">Aplicativos & AIRC</a></li>
		  </ul>
		</li>
		
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Requerimentos<span class="caret"></span></a>
		  <ul class="dropdown-menu">
		  <li><a href="aaaa.php">Inserir Requerimento</a></li>   
			<li><a href="teste_Inicio.php">Listar Requerimentos</a></li>             
		  </ul>
		</li>
		
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Relatório Atividades<span class="caret"></span></a>
		  <ul class="dropdown-menu">
		  <li><a href="aaaa.php">Inserir</a></li>   
			<li><a href="teste_Inicio.php">Listar</a></li>             
		  </ul>
		</li>
		

		 
		<li><a href="sair.php"><img src="imagens/LOGOUT.png">&nbsp Sair</a></li> 
		
	</div><!--/.nav-collapse -->
  </div>
</nav>
<!-- Fim navbar -->


  <!--Rodapé -->
<div class="content">
	<div class="footer">
		<font class="footer text-left"  face="Brush Script">©Cristiana Gabriel</font>
		<font class="footer text-center" face="Brush Script">|| Projeto em Contexto de Estágio ||</font>
		<font class="footer text-right" face="Brush Script">Engenharia Informática - IPG</font>
	</div>
</div>
	
</html>