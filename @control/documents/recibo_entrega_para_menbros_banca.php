<?php 
	
	include "Fpdf/Fpdf.php";

	class Pdf extends \App\Fpdf\FPDF
	{
		function header(){
			$this->setFont('Arial','B',12);
	  		$this->Cell(0,5,utf8_decode('Universidade Federal do Amazonas'),0,1,'C');
	  		$this->Cell(0,5,utf8_decode('Instituto de Ciências Exatas e Tecnologia'),'B',1,'C');
	  		$this->Ln(10);
	  		$this->setFont('Arial','BU',12);
	  		$this->Cell(0,5,utf8_decode('COMPROVANTE DE ENTREGA DO TRABALHO DE CONCLUSÃO'),0,1,'C');
	  		$this->Cell(0,5,utf8_decode('DE CURSO PARA OS MEMBROS DA BANCA'),0,1,'C');
	  		
		}

		function body($aluno,$semestre,$ano,$dataDocumento,$mestre){
			$this->Ln(15);
	  		
	  		$this->setFont('Arial','',12);
	  		
	  		$this->Cell(0,10,utf8_decode('Prezado(a) Membro da Banca,'),0,1,'L');
	  		
	  		$this->Cell(0,6,utf8_decode('            Ao  cumprimentá-lo(a)  cordialmente,  venho,  por meio deste, entregar  uma  cópia  do'),0,1,'J');
	  		$this->Cell(100,6,utf8_decode('do   Trabalho    de    Conclusão    de   Curso, do'),0,0,'J');
	  		$this->setFont('Arial','BU',12);
	  		$this->Cell(0,6,utf8_decode($semestre.' semestre acadêmico de '.$ano),0,1,'J');
	  		$this->setFont('Arial','',12);
	  		$this->Cell(55,6,utf8_decode('elaborado pelo(a) aluno(a)'),0,0,'J');
	  		
	  		$this->setFont('Arial','BU',12);
	  		
	  		$this->Cell(0,6,utf8_decode($aluno.'.'),0,1,'L');

	  		$this->Ln(10);
	  		
	  		$this->setFont('Arial','',12);
	  		
	  		$this->Cell(0,6,utf8_decode('Itacoatiara, '.$dataDocumento),0,1,'C');	

	  		$this->Ln(15);
	  		
	  		$this->setFont('Arial','',12);
	  		
	  		$this->Cell(0,6,utf8_decode('_______________________________________________'),0,1,'C');
	  		$this->Cell(0,6,utf8_decode($mestre),0,1,'C');
	  		$this->Cell(0,6,utf8_decode('Professor(a) da Disciplina'),0,1,'C');
	  		
	  		$this->Ln(15);

	  		$this->setFont('Arial','B',12);
	  		
	  		$this->Cell(0,6,utf8_decode('Recebido pelos membros da banca:'),0,1,'L');

	  		$this->setFont('Arial','',12);

	  		$this->Cell(50,15,utf8_decode('Em: ______ / ______ / _______'),0,0,'L');	  		
	  		$this->Cell(20,15,utf8_decode(''),0,0,'L');	  		
	  		$this->Cell(0,15,utf8_decode('__________________________________________'),0,1,'L');

	  		$this->Cell(50,15,utf8_decode('Em: ______ / ______ / _______'),0,0,'L');	  		
	  		$this->Cell(20,15,utf8_decode(''),0,0,'L');	  		
	  		$this->Cell(0,15,utf8_decode('__________________________________________'),0,1,'L');	  		
		}
	}

	$aluno = 'ANDERSON NOGUEIRA SILVÉRIO';
	$semestre = 'primeiro';
	$ano = '2020';
	$dataDocumento = '10 de Junho de 2020';
	$mestre = 'Profa. Dra. Odette Mestrinho Passos';

	//instancia para novo documento
	$pdf = new Pdf();

	//seta nova pagina
	$pdf->AddPage('P','A4',0);

	//$pdf->SetMargins($left, $top, $right=null);
	$pdf->SetMargins('15', 5);

	$pdf->body($aluno,$semestre,$ano,$dataDocumento,$mestre);

	//printSaida
	$pdf->Output();