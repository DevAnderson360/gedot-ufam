<?php 

  
	require '../../vendor/autoload.php';

  $log = new \App\Utility\Access();
  $log->validaSession("./");

  //docente
  $docente = "{$_SESSION['user_titulo']} {$_SESSION['user_name']}";

	// reference the Dompdf namespace
	use Dompdf\Dompdf;


	// instantiate and use the dompdf class
	$dompdf = new Dompdf();

  $semestre = $_POST["discente_semestre"] == 1 ? "primeiro" : "segundo";

	$html = '<!DOCTYPE html>
            <html lang="pt-br">
            <head>
              <meta charset="UTF-8">
              <title>DECLARAÇÃO DE AVALIAÇÃO DE TCC
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
                    	<b>TRABALHO DE CONCLUSÃO DE CURSO</b>
            		</td>
                  </tr>
                </table>
                
                <table style="margin-top: 50;">
            		  <tr>
                    <td>
                      <i style="font-size: 25;">DECLARAÇÃO</i>
                    </td>
                  </tr>
                </table>

                <table style="margin-top: 50;">
                  <tr>
                    <td>
                        <p style="text-indent:4em; font-weight: normal; text-align: justify; line-height: 1.5; font-family: \'Times New Roman\', Times, serif; font-size: 14">
                          DECLARAMOS para os devidos fins que o(a) <b>'.$_POST['avaliador_titulo'].' '.$_POST['avaliador_nome'].' ('.$_POST['avaliador_instituicao'].')</b> e o(a) <b>'.$_POST['avaliador2_titulo'].' '.$_POST['avaliador2_nome'].' ('.$_POST['avaliador2_instituicao'].')</b> participaram, no '.$semestre.' semestre acadêmico de '.$_POST["discente_ano"].', como membros da Banca Examinadora do Trabalho de Conclusão de Curso intitulado <b>'.$_POST["tcc_titulo"].'</b>, do(a) discente do curso de Sistemas de Informação <b>'.$_POST["discente_nome"].'</b>, orientado pelo Prof. <b>'.$_POST["orientador_titulo"].' '.$_POST["orientador_nome"].'</b> e defendido no dia '.\App\Utility\Tools::dateFormat($_POST["tcc_data"]).'.
                        </p>
                    </td>
                  </tr>
                </table>
            	
            	<div style="text-align: right; margin-top: 100;">
            		<div>
            			'.\App\Utility\Tools::nowDate().'.
            		</div>
            		<div style="margin-top: 50px; text-align: center">
            			____________________________________________________<br>
            			'.$docente.'<br>
                    	Professora da Disciplina

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