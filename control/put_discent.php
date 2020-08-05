<?php 
	
	/**
	 * altera um registro no DB tabela discent
	 *
	 **/

	require_once "../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();

	if($access->validaSessionNr() && $_POST)
		main();
	else{
		echo \App\Utility\Tools::response_json('fail','Sessão inválida!');
		http_response_code(400);
	}

	function main()
	{

		//instance discent
		$discent = new \App\Entities\Discent(\App\Bd\Database::conexao());

		//set data
		//falta lançar validação
		$discent->setId($_SESSION['user_id']);
		$discent->setNome( $_POST['nome']);
		$discent->setEmail( $_POST['email']);
		$discent->setTelefone( $_POST['telefone']);
		$discent->setSemestre( $_POST['semestre']);
		$discent->setAno($_POST['ano']);
		$discent->setCurso($_POST['curso']);



		if($discent->put())
			echo json_encode(array('status' => 'success', 'msg' => 'Sucesso!'));
		else
			echo json_encode(array('status' => 'fail', 'msg' => 'Erro no Atualização.'));

	}


