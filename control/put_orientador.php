<?php 
	
	/**
	 * altera registro no DB tabela orientador
	 *
	 **/

	require_once "../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();

	if($_POST && $access->validaSessionNr())
		main();
	else{
		echo json_encode(array('status' => 'fail', 'msg' => 'Parâmetros inválidos.'));
		http_response_code(400);
	}

	function main()
	{

		//instance discent
		$tcc = new \App\Entities\Tcc(\App\Bd\Database::conexao());

		//set data
		//falta lançar validação
		//$tcc->setId($_POST['titulo']);

		$id 		 = $_POST['id'];
		$nome 		 = $_POST['nome'];
		$email 	     = $_POST['email'];
		$titulo 	 = $_POST['titulo'];
		$telefone 	 = $_POST['telefone'];
		$instituicao = $_POST['instituicao'];

		
		if($tcc->put_orientador($id, $nome, $titulo, $instituicao, $telefone, $email))
			echo json_encode(array('status' => 'success', 'msg' => 'Sucesso ao salvar.'));
		else
			echo json_encode(array('status' => 'fail', 'msg' => 'Erro ao salvar. Tente novamente!'));
	}


