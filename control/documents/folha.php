<?php 

	require '../../vendor/autoload.php';

	// reference the Dompdf namespace
	use Dompdf\Dompdf;


	// instantiate and use the dompdf class
	$dompdf = new Dompdf();



	$html = '<!DOCTYPE html>
            <html lang="pt-br">
            <head>
              <meta charset="UTF-8">
              <title>Folha
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
              <table style="margin-top: 50;">
                <tr>
                  <td>
                  	<b style="text-transform: uppercase; font-size: 15;">'.$_POST["discente_nome"].'</b>
            		  </td>
                </tr>
              </table>
              
              <table style="margin-top: 50;">
          		  <tr>
                  <td>
                    <i style="font-size: 15;">TITULO DO TRABALHO</i>
                  </td>
                </tr>
              </table>

              <table>
                <tr>
                <td></td>
                  <td>
                    <p style="font-weight: normal; text-align: justify; line-height: 1.5; /*font-family: \'Times New Roman\',*/ Times, serif; font-size: 14">
                     Monografia apresentada ao Instituto de Ciências Exatas e Tecnologia da Universidade Federal do Amazonas como parte dos requisitos necessários para obtenção do título de Bacharel em Sistemas de Informação.
                    </p>
                  </td>
                </tr>
              </table>

              <table>
                <tr>
                  <td>
                    <b>Aprovado em 12 de agosto de 2020</b>
                  </td>
                  <td></td>
                </tr>
              </table>

              <table>
                <tr>
                  <td><b>BANCA EXAMINADORA</b></td>
                </tr>
              </table>

              <table style="margin-top: 40;">
                <tr>
                  <td style="font-weight: normal;">'.$_POST["orientador_titulo"].' '.$_POST["orientador_nome"].', Presidente<br>'.$_POST["orientador_instituicao"].'</td>
                </tr>
              </table>
              <table style="margin-top: 40;">
                <tr>
                  <td style="font-weight: normal;">'.$_POST["avaliador_titulo"].' '.$_POST["avaliador_nome"].', Membro<br>'.$_POST["avaliador_instituicao"].'</td>
                </tr>
              </table>
              <table style="margin-top: 40;">
                <tr>
                  <td style="font-weight: normal;">'.$_POST["avaliador2_titulo"].' '.$_POST["avaliador2_nome"].', Membro<br>'.$_POST["avaliador2_instituicao"].'</td>
                </tr>
              </table>
            </body>
            </html>';

	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'portrait');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream('document.pdf', array( 'Attachment' => 0 ));