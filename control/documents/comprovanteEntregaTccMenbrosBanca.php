<?php 

	require "../../vendor/autoload.php";

  $log = new \App\Utility\Access();
  $log->validaSession("./");

  //docente
  $docente = "{$_SESSION['user_titulo']} {$_SESSION['user_name']}";

	// reference the Dompdf namespace
	use Dompdf\Dompdf;


	// instantiate and use the dompdf class
	$dompdf = new Dompdf();



	$html = '<!DOCTYPE html>
              <html lang="pt-br">
              <head>
                <meta charset="UTF-8">
                <title>COMPROVANTE DE ENTREGA DO TRABALHO DE CONCLUSÃO DE CURSO PARA OS MEMBROS DA BANCA
              </title>
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
                      <td>
                      	<u>COMPROVANTE DE ENTREGA DO TRABALHO DE CONCLUSÃO<br> DE CURSO PARA OS MEMBROS DA BANCA</u>
              		</td>
                    </tr>
                  </table>
                  
                  <div style="margin-top: 50;">
              		Prezado(a) Membro da Banca,
                  </div>
                  <div style="margin-top: 10;">
              		<p style="text-indent:4em" >
              			Ao cumprimentá-lo(a) cordialmente, venho, por meio deste, entregar uma cópia do Trabalho de Conclusão de Curso, do período <b>'.$_POST["discente_ano"].'/'.$_POST['discente_semestre'].'</b>
              		elaborado pelo(a) aluno(a) <b>'.$_POST['discente_nome'].'.</b>
              		</p>
                  </div>
              	
              	<div style="text-align: center; margin-top: 100;">
              		<div>
              			'.\App\Utility\Tools::nowDate().'.
              		</div>
              		<div style="margin-top: 50px;">
              			____________________________________________________<br>
              			'.$docente.'<br>
                      	Professor(a) da Disciplina

              		</div>
              	</div>

              	<div style="text-align: left; margin-top: 100;">
              		<div>
              			<b>Recebido pelos membros da banca:</b>
              		</div>
              		<div style="margin-top: 10px;">
              			Em: ______/______/__________ &nbsp; &nbsp; &nbsp; ______________________________________________<br><br>
              			Em: ______/______/__________ &nbsp; &nbsp; &nbsp; ______________________________________________<br>

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