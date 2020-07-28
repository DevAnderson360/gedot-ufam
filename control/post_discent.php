<?php 
	
	/**
	 * inserir novo registro no DB tabela discent
	 *
	 **/

	if($_POST)
		main();
	else
		http_response_code(400);

	function main()
	{
		require_once "../vendor/autoload.php";

		//instance discent
		$discent = new \App\Entities\Discent(\App\Bd\Database::conexao());

		//set data
		//falta lançar validação
		$discent->setNome( $_POST['nome']);
		$discent->setEmail( $_POST['email']);
		$discent->setTelefone( $_POST['telefone']);
		$discent->setMatricula( $_POST['matricula']);
		$discent->setSemestre( $_POST['semestre']);
		$discent->setAno( $_POST['ano']);
		$discent->setSenha( $_POST['senha']);

	    if(!$discent->getBDdiscente()){
			if($discent->post())
				echo json_encode(array('status' => 'success', 'msg' => 'Cadastro realizado com sucesso.', "id" => $discent->id));
			else
				echo json_encode(array('status' => 'fail', 'msg' => 'Erro no cadastro.'));
		}else{
			echo json_encode(array('status' => 'fail', 'msg' => 'Matrícula já está cadastrada.'));
			http_response_code(400);
		}

	}


