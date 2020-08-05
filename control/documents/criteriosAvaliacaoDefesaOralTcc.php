<?php 

	
	require "../../vendor/autoload.php";

    $log = new \App\Utility\Access();
    $log->validaSession("./");

	// reference the Dompdf namespace
	use Dompdf\Dompdf;


	// instantiate and use the dompdf class
	$dompdf = new Dompdf();



	$html = '<!DOCTYPE html>
				<html lang="pt-br">
				<head>
				  <meta charset="UTF-8">
				  <title>CRITÉRIOS DE AVALIAÇÃO DO TRABALHO ORAL</title>
				  <style>
				    td, th {
				      padding: .5em;
				      margin: 0;
				      /*border: 1px solid #ccc;*/
				      text-align: center;
				    }

				    th{
				      /*background-color: #EEE;*/
				    }
				    td{
				      font-weight:bold;
				      /*background-color: #EEE;*/
				    }

				    table{
				      width: 100%;
				      margin-bottom : .5em;
				      table-layout: fixed;
				      text-align: center;
				    }
				  </style>
				</head>
				<body>
				    
				    <table border="0" cellpadding="1" cellspacing="0">
				      <thead>
				        <tr>
				          <td>
				            <img src="img/brasao.png" style="width: 75px; height: 75px;" alt="">
				          </td>
				          <td style="width:50%">
				              Poder Executivo<br>
				              Ministério da Educação.<br>
				              Universidade Federal do Amazonas.<br>
				              Instituto de Ciências Exatas e Tecnologia.<br>
				          </td>
				          <td>
				            <img src="img/logoufam.jpg" style="width: 75px; height: 75px;" alt="">
				          </td>
				        </tr>
				      </thead>
				    </table>
				    <hr>
				    <table>
				      <tr>
				        <td>TRABALHO DE CONCLUSÃO DE CURSO</td>
				      </tr>
				      <tr>
				        <td>
				          <u>CRITÉRIOS DE AVALIAÇÃO DA DEFESA ORAL</u>
				        </td>
				      </tr>
				    </table>
				    <br>
				    <table border="1" cellpadding="1" cellspacing="0">
						<tr>
							<td colspan="3" style="background-color: #C8c8c8; text-align: left;"> 1. Dados de Identificação</td>
						</tr>
						<tr>
							<td colspan="3" style="text-align: left; font-weight: normal;">
								Aluno(a): <b>'.$_POST["discente_nome"].'</b><br> 
								Título do Trabalho: <b>'.$_POST["tcc_titulo"].'</b><br>
								Professor(a) Orientador(a): <b>'.$_POST["orientador_nome"].'</b><br> 
								Professor(a) Coorientador(a): <b>'.$_POST["coorientador_nome"].'</b><br>
								Período: <b>'.$_POST["discente_ano"].'/'.$_POST["discente_semestre"].'</b><br>
							</td>
						</tr>
						<tr>
							<td style="background-color: #C8c8c8; text-align: left; width: 75%"> 2. Critérios de Avaliação</td>
							<td style="background-color: #C8c8c8;"> Valor</td>
							<td style="background-color: #C8c8c8;"> Nota</td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Capacidade de síntese</td>
							<td style="font-weight: normal"> 0,0 – 0,5</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Uso adequado de recursos didáticos</td>
							<td style="font-weight: normal"> 0,0 – 0,5</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Postura e emprego da modalidade culta da língua oral</td>
							<td style="font-weight: normal"> 0,0 – 0,5</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Uso correto da terminologia aplicada à área do estudo</td>
							<td style="font-weight: normal"> 0,0 – 1,0</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Domínio do conteúdo</td>
							<td style="font-weight: normal"> 0,0 – 1,5</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Conformidade da apresentação com o trabalho escrito</td>
							<td style="font-weight: normal"> 0,0 – 2,0</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Segurança em demonstrar posições na área do estudo</td>
							<td style="font-weight: normal"> 0,0 – 1,0</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Compreensão das questões propostas pelos arguidores e capacidade de responder de forma coerente, lógica e clara</td>
							<td style="font-weight: normal"> 0,0 – 1,0</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Qualidade das informações transmitidas</td>
							<td style="font-weight: normal"> 0,0 – 0,5</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Padronização, formatação e animação dos slides</td>
							<td style="font-weight: normal"> 0,0 – 0,8</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td style="text-align: left; font-weight: normal"> Desenvolvimento e sequência dos slides</td>
							<td style="font-weight: normal"> 0,0 – 0,7</td>
							<td style="font-weight: normal"></td>
						</tr>
						<tr>
							<td colspan="2" style="background-color: #C8c8c8; text-align: right"> TOTAL</td>
							<td></td>
						</tr>
				    </table>
					<br>
					<div style="text-align: right;">
						<div>
							'.\App\Utility\Tools::nowDate().'.
						</div>
						<div style="margin-top: 50px;">
							____________________________________________________<br>
							Avaliador(a)
						</div>
					</div>

				</body>
				</html>';

	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream('document.pdf', array( 'Attachment' => 0 ));