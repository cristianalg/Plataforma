<?php  
	session_start(); //cria uma sessão ou resume a sessão atual baseado num id de sessão passado via POST
	include_once("seguranca.php");
	include_once("conexao.php");
	
	$imprimir						= $_POST["imprimir"];
	$data_pedido					= $_POST["data_pedido"];
	$data_prevista_entrega			= $_POST["data_prevista_entrega"];	
	
	//*************Data do sistema para assinatura do relatorio**********************
	setlocale(LC_TIME, 'pt', 'pt.utf-8', 'pt.utf-8', 'portuguese');
	date_default_timezone_set('europe/lisbon');
	$data_Sistema = strftime("%d de %B de %Y", strtotime("today"));
	//echo strftime("%A, %d de %B de %Y", strtotime("today"));
	/*
	%A: dia da semana por extenso.
	%d: dia do mês representado com dois digitos.
	%B: mês por extenso.
	%Y: ano representado com quatro digitos.
	*/
	
 
	//*******Tópico 1 - Ao Nível do Apoio Técnico (Hardware e software)***************
	$result_Topico_1 ="select * from assistencia_tecnica WHERE Imprimir_Relatorio = 1 && Tipo_Assistencia_idTipo_Assistencia = 1 and Data_Pedido BETWEEN '".$data_pedido."' and '".$data_prevista_entrega."'";
	$resultado_Topico_1 = mysql_query($result_Topico_1);
		
	$exibe = mysql_query($result_Topico_1) or die (mysql_error());
	$verificar=mysql_num_rows($exibe);
	if($verificar > 0){  
	
		echo "<br>";
		$topico_1 = '<p><b>Ao Nível do Apoio Técnico (Hardware e software)</b></p>'; 
		
		$topico_1.= '<table border=1';	
		$topico_1.= '<thead>';
		$topico_1.= '<tr>';
		$topico_1.= '<th>Nome Requerente</th>';
		$topico_1.= '<th>Estado</th>';
		$topico_1.= '<th>Descrição</th>';
		$topico_1.= '<th>Data Resolução</th>';
		$topico_1.= '</tr>';
		$topico_1.= '</thead>';
		$topico_1.= '<tbody>';
		
		
		while($row_Topico_1 = mysql_fetch_array($resultado_Topico_1)){

			//nome de requerente
			$result_cat =mysql_query("SELECT Nome_Requerente FROM requerente INNER JOIN 
			assistencia_tecnica ON requerente.idRequerente = assistencia_tecnica.Requerente_idRequerente 
			where assistencia_tecnica.idAssistencia_Tecnica = ".$row_Topico_1['idAssistencia_Tecnica'].";");
			while($dados = mysql_fetch_assoc($result_cat)){
				$topico_1.= '<tr><td style="text-align: center;">'.$dados['Nome_Requerente']."</td>";
			}
				
								
			//Estado da assistencia
			$result_cat =mysql_query("SELECT Nome_Estado_Assistencia FROM estado INNER JOIN 
			assistencia_tecnica ON estado.idEstado = assistencia_tecnica.Estado_idEstado 
			where assistencia_tecnica.idAssistencia_Tecnica = ".$row_Topico_1['idAssistencia_Tecnica'].";");
			while($dados = mysql_fetch_assoc($result_cat)){
				$topico_1.= '<td style="text-align: center;">'.$dados['Nome_Estado_Assistencia']. "</td>";
			}
				
				
			$topico_1.= '<td>'.$row_Topico_1['Descricao_Avaria'] . "</td>";
			$topico_1.= '<td style="text-align: center;">'.$row_Topico_1['Data_Prevista_Entrega'] . "</td>";
		}
			
			$topico_1.= '</tbody>';
			$topico_1.= '</table';
	
	}
	else{	
		//$topico_1 = "Não ocorreram asistências técnicas ao nível do apoio técnico (Hardware e software) da data ".$data_pedido." à data ".$data_prevista_entrega.".";
		$topico_1 = "";
	}
	
	//*******Tópico 2 - Ao Nível da Web***************
	$result_Topico_2 ="select * from assistencia_tecnica WHERE Imprimir_Relatorio = 1 && Tipo_Assistencia_idTipo_Assistencia = 2 and Data_Pedido BETWEEN '".$data_pedido."' and '".$data_prevista_entrega."'";
	$resultado_Topico_2 = mysql_query($result_Topico_2);
	
	$exibe = mysql_query($result_Topico_2) or die (mysql_error());
	$verificar=mysql_num_rows($exibe);
	if($verificar > 0){  
	
		echo "<br>";
		$topico_2 = '<p><b>Ao Nível da Web</b></p>'; 
		
		
		$topico_2.= '<table border=1';	
		$topico_2.= '<thead>';
		$topico_2.= '<tr>';
		$topico_2.= '<th>Nome Requerente</th>';
		$topico_2.= '<th>Estado</th>';
		$topico_2.= '<th>Descrição</th>';
		$topico_2.= '<th>Data Resolução</th>';
		$topico_2.= '</tr>';
		$topico_2.= '</thead>';
		$topico_2.= '<tbody>';
		
		while($row_Topico_2 = mysql_fetch_array($resultado_Topico_2)){
			
				
			//nome de requerente
			$result_cat =mysql_query("SELECT Nome_Requerente FROM requerente INNER JOIN 
			assistencia_tecnica ON requerente.idRequerente = assistencia_tecnica.Requerente_idRequerente 
			where assistencia_tecnica.idAssistencia_Tecnica = ".$row_Topico_2['idAssistencia_Tecnica'].";");
			while($dados = mysql_fetch_assoc($result_cat)){
				$topico_2.= '<tr><td style="text-align: center;">'.$dados['Nome_Requerente']."</td>";
			}
				
								
			//Estado da assistencia
			$result_cat =mysql_query("SELECT Nome_Estado_Assistencia FROM estado INNER JOIN 
			assistencia_tecnica ON estado.idEstado = assistencia_tecnica.Estado_idEstado 
			where assistencia_tecnica.idAssistencia_Tecnica = ".$row_Topico_2['idAssistencia_Tecnica'].";");
			while($dados = mysql_fetch_assoc($result_cat)){
				$topico_2.= '<td style="text-align: center;">'.$dados['Nome_Estado_Assistencia']. "</td>";
			}
		

			$topico_2.= '<td>'.$row_Topico_2['Descricao_Avaria'] . "</td>";
			$topico_2.= '<td style="text-align: center;">'.$row_Topico_2['Data_Prevista_Entrega'] . "</td>";
		}
			
		$topico_2.= '</tbody>';
		$topico_2.= '</table';
	}
	else{
		$topico_2 = "";
	}
		
	//*******Tópico 3 - Arte e Design***************
	$result_Topico_3 ="select * from assistencia_tecnica WHERE Imprimir_Relatorio = 1 && Tipo_Assistencia_idTipo_Assistencia = 3 and Data_Pedido BETWEEN '".$data_pedido."' and '".$data_prevista_entrega."'";
	$resultado_Topico_3 = mysql_query($result_Topico_3);
		
	$exibe = mysql_query($result_Topico_3) or die (mysql_error());
	$verificar=mysql_num_rows($exibe);
	if($verificar > 0){  
		
		echo "<br>";
		$topico_3 = '<p><b>Arte e Design</b></p>'; 
		
		$topico_3.= '<table border=1';	
		$topico_3.= '<thead>';
		$topico_3.= '<tr>';
		$topico_3.= '<th>Nome Requerente</th>';
		$topico_3.= '<th>Estado</th>';
		$topico_3.= '<th>Descrição</th>';
		$topico_3.= '<th>Data Resolução</th>';
		$topico_3.= '</tr>';
		$topico_3.= '</thead>';
		$topico_3.= '<tbody>';
		
			
		while($row_Topico_3 = mysql_fetch_array($resultado_Topico_3)){
			
				
			//nome de requerente
			$result_cat =mysql_query("SELECT Nome_Requerente FROM requerente INNER JOIN 
			assistencia_tecnica ON requerente.idRequerente = assistencia_tecnica.Requerente_idRequerente 
			where assistencia_tecnica.idAssistencia_Tecnica = ".$row_Topico_3['idAssistencia_Tecnica'].";");
			while($dados = mysql_fetch_assoc($result_cat)){
				$topico_3.= '<tr><td style="text-align: center;">'.$dados['Nome_Requerente']."</td>";
			}
				
								
			//Estado da assistencia
			$result_cat =mysql_query("SELECT Nome_Estado_Assistencia FROM estado INNER JOIN 
			assistencia_tecnica ON estado.idEstado = assistencia_tecnica.Estado_idEstado 
			where assistencia_tecnica.idAssistencia_Tecnica = ".$row_Topico_3['idAssistencia_Tecnica'].";");
			while($dados = mysql_fetch_assoc($result_cat)){
				$topico_3.= '<td style="text-align: center;">'.$dados['Nome_Estado_Assistencia']. "</td>";
			}
				
			$topico_3.= '<td>'.$row_Topico_3['Descricao_Avaria'] . "</td>";
			$topico_3.= '<td style="text-align: center;">'.$row_Topico_3['Data_Prevista_Entrega'] . "</td>";
		}
			
		$topico_3.= '</tbody>';
		$topico_3.= '</table';
	}
	else{
		$topico_3 = "";
	}	
		
	//*******Tópico 4 - Outras Atividades***************
	$result_Topico_4 ="select * from assistencia_tecnica WHERE Imprimir_Relatorio = 1 && Tipo_Assistencia_idTipo_Assistencia = 4 and Data_Pedido BETWEEN '".$data_pedido."' and '".$data_prevista_entrega."'";
	$resultado_Topico_4 = mysql_query($result_Topico_4);
	
	$exibe = mysql_query($result_Topico_4) or die (mysql_error());
	$verificar=mysql_num_rows($exibe);
	if($verificar > 0){  
		
		echo "<br>";
		$topico_4= '<p><b>Outras Atividades</b></p>'; 
		
		$topico_4.= '<table border=1';	
		$topico_4.= '<thead>';
		$topico_4.= '<tr>';
		$topico_4.= '<th>Nome Requerente</th>';
		$topico_4.= '<th>Estado</th>';
		$topico_4.= '<th>Descrição</th>';
		$topico_4.= '<th>Data Resolução</th>';
		$topico_4.= '</tr>';
		$topico_4.= '</thead>';
		$topico_4.= '<tbody>';
		
		
		while($row_Topico_4 = mysql_fetch_array($resultado_Topico_4)){
			
				
			//nome de requerente
			$result_cat =mysql_query("SELECT Nome_Requerente FROM requerente INNER JOIN 
			assistencia_tecnica ON requerente.idRequerente = assistencia_tecnica.Requerente_idRequerente 
			where assistencia_tecnica.idAssistencia_Tecnica = ".$row_Topico_4['idAssistencia_Tecnica'].";");
			
			while($dados = mysql_fetch_assoc($result_cat)){
				$topico_4.= '<tr><td style="text-align: center;">'.$dados['Nome_Requerente']."</td>";
			}
					
									
			//Estado da assistencia
			$result_cat =mysql_query("SELECT Nome_Estado_Assistencia FROM estado INNER JOIN 
			assistencia_tecnica ON estado.idEstado = assistencia_tecnica.Estado_idEstado 
			where assistencia_tecnica.idAssistencia_Tecnica = ".$row_Topico_4['idAssistencia_Tecnica'].";");
			while($dados = mysql_fetch_assoc($result_cat)){
				$topico_4.= '<td style="text-align: center;">'.$dados['Nome_Estado_Assistencia']. "</td>";
			}
			
			$topico_4.= '<td>'.$row_Topico_4['Descricao_Avaria'] . "</td>";
			$topico_4.= '<td style="text-align: center;">'.$row_Topico_4['Data_Prevista_Entrega'] . "</td>";
		
		}
		$topico_4.= '</tbody>';
		$topico_4.= '</table';
	}
	else{
		$topico_4 = "";
	}
		
		
	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();
	
	// Carrega o HTML
	$dompdf->load_html('
		<html>
			<head>
				<style>
					/** Define now the real margins of every page in the PDF **/
					body {
						margin-top: 5cm;
						margin-left: 2cm;
						margin-right: 2cm;
						margin-bottom: 2cm;
					}

					/** Define the header rules **/
					header {
						position: fixed;
						top: 0cm;
						left: 0cm;
						right: 0cm;
						height: 50cm;

						/** Extra personal styles **/
						color: black;
						text-align: center;
						line-height: 0.25cm;
					}
				</style>
			</head>
		
			<body>
				<header>
					<p style="text-align: center;">
					<img src="imagens/Celorico_Logo_150.png" width="100" >
					</p>
					<p style="text-align: center;"><font size="3">Câmara Municipal de Celorico da Beira</font></p>
					<p style="text-align: center;"><font size="3">Gabinete de Informática</font></p>
				</header>
				
					<h3 style="text-align: center;">Relatório de Atividades</h3>
					<p><b>Assunto:</b> '.$imprimir.'</p>
					
					'. $topico_1.'
					
					<br>
					'. $topico_2.'
					
					<br>
					'. $topico_3.'
					
					<br>
					'. $topico_4.'
					<br>
					
					<p>Celorico da Beira, '.$data_Sistema.'</p>
					
					<p style="text-align: right;"><i>O Gabinete de Informática</i><font color="white" size="4">-------</font></p>
					
					<p style="text-align: right;">_______________________________</p>
					
					<p style="text-align: right;">_______________________________</p>
					
					<p style="text-align: right;">_______________________________</p>
							
				
			</body>
		</html>
					
	');
	
	
	
	//Renderizar o html
	$dompdf->render();

	//Definir numero de paginas
	$canvas = $dompdf ->get_canvas();
	$canvas->page_text(275, 770, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));
	
	
	//Exibibir a página
	$dompdf->stream(
		"relatorio_atividades_'$data_Sistema'", //nome para o pdf
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
		
		
		
	);
	
?>