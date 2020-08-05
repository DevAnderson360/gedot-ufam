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
			  <title>CRITÉRIOS DE AVALIAÇÃO DO TRABALHO ESCRITO</title>
			  <style>
			    td, th {
			      padding: .2em;
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
			    
			    <table>
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
			          <u>CRITÉRIOS DE AVALIAÇÃO DO TRABALHO ESCRITO</u>
			        </td>
			      </tr>
			    </table>
			    <br>
			    <table  border="1" cellpadding="1" cellspacing="0" style="margin-bottom: 0;">
					<tr>
						<td colspan="3" style="background-color: #C8c8c8; text-align: left;"> 1. Dados da Defesa</td>
					</tr>
					<tr>
						<td style="text-align: left">
							Data:
						</td>
						<td style="text-align: left">
							Hora:
						</td>
						<td style="text-align: left">
							Local:
						</td>
					</tr>
			    </table>
			    <table border="1" cellpadding="1" cellspacing="0">
					<tr>
						<td colspan="3" style="background-color: #C8c8c8; text-align: left;"> 2. Dados de Identificação</td>
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
						<td style="background-color: #C8c8c8; text-align: left; width: 75%"> 3. Critérios de Avaliação do Trabalho Escrito:</td>
						<td style="background-color: #C8c8c8;"> Valor</td>
						<td style="background-color: #C8c8c8;"> Nota</td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: normal"> <b>Redação</b> (Organização das ideias e uso coerente da normatização de trabalhos acadêmicos)</td>
						<td style="font-weight: normal"> 0,0 – 1,0</td>
						<td style="font-weight: normal"></td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: normal"> <b>Contextualização</b> (Definição clara da contextualização e problemática a ser tratada)</td>
						<td style="font-weight: normal"> 0,0 – 0,5</td>
						<td style="font-weight: normal"></td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: normal"> <b>Justificativa</b> (Apresentação de argumentos que caracterizam a relevância do trabalho)</td>
						<td style="font-weight: normal"> 0,0 – 0,5</td>
						<td style="font-weight: normal"></td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: normal"> <b>Objetivos</b> (Descrição clara dos objetivos)</td>
						<td style="font-weight: normal"> 0,0 – 1,0</td>
						<td style="font-weight: normal"></td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: normal"> <b>Metodologia</b> (Métodos e técnicas claramente descritos, viáveis e coerente com os objetivos)</td>
						<td style="font-weight: normal"> 0,0 – 2,0</td>
						<td style="font-weight: normal"></td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: normal"> <b>Fundamentação Teórica</b> (Apresentação detalhada dos conceitos inerentes à área de pesquisa)</td>
						<td style="font-weight: normal"> 0,0 – 1,0</td>
						<td style="font-weight: normal"></td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: normal"> <b>Trabalhos Relacionados</b> (Apresentação da análise crítica dos trabalhos relacionados e quantidade mínima de cinco trabalhos)</td>
						<td style="font-weight: normal"> 0,0 – 1,0</td>
						<td style="font-weight: normal"></td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: normal"> <b>Resultados e Discussões</b> (Coerência com os objetivos, qualidade da apresentação dos resultados e análise crítica e discussão dos resultados)</td>
						<td style="font-weight: normal"> 0,0 – 2,0</td>
						<td style="font-weight: normal"></td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: normal"> <b>Conclusão</b> (Apresentação das considerações finais, descrição das limitações e sugestões de futuros trabalhos)</td>
						<td style="font-weight: normal"> 0,0 – 0,5</td>
						<td style="font-weight: normal"></td>
					</tr>
					<tr>
						<td style="text-align: left; font-weight: normal"> <b>Referências</b> (Científicas, atualizadas, diversificadas e coerentes com o tema)</td>
						<td style="font-weight: normal"> 0,0 – 0,5</td>
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