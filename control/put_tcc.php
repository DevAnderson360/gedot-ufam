<?php 
	
	/**
	 * altera registro no DB tabela tcc
	 *
	 **/

	require_once "../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();

	if($_POST && $access->validaSessionNr())
		main();
	else
		http_response_code(400);

	function main()
	{

		//instance discent
		$tcc = new \App\Entities\Tcc(\App\Bd\Database::conexao());

		//set data
		//falta lançar validação
		//$tcc->setId($_POST['titulo']);

		$tcc->setTitulo($_POST['titulo']);

		$tcc->setDiscente($_SESSION['user_id']);

		$tcc->setDataAvaliacao($_POST['data_avaliacao']);

		if($tcc->put())
			echo json_encode(array('status' => 'success', 'msg' => 'Sucesso ao salvar.'));
		else
			echo json_encode(array('status' => 'fail', 'msg' => 'Erro ao salvar. Tente novamente!'));

	   /* if(!$discent->getBDdiscente()){
			if($discent->post())
				echo json_encode(array('status' => 'success', 'msg' => 'Cadastro realizado com sucesso.', "id" => $discent->id));
			else
				echo json_encode(array('status' => 'fail', 'msg' => 'Erro no cadastro.'));
		}else{
			echo json_encode(array('status' => 'fail', 'msg' => 'Matrícula já está cadastrada.'));
		}*/

	}


