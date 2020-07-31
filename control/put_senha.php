<?php

	require_once "../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();

	if($_POST && $access->validaSessionNr())
		main();
	else{
		echo \App\Utility\Tools::response_json('fail','Parâmetros inválidos.');
		http_response_code(400);
	}

	function main()
	{
		//instance discent
		$discent = new \App\Entities\Discent(\App\Bd\Database::conexao());

		$discent->setMatricula($_SESSION['user_matricula']);

		$discent->setSenha($_POST['atual']);

			//echo json_encode(array('status' => 'success', 'msg' => 'Senha Alterada com sucesso!'));
		if($discent->put_senha($_POST['nova']))
			echo \App\Utility\Tools::response_json('success','Senha Alterada com sucesso!','./');
		else{
			echo \App\Utility\Tools::response_json('fail','Senha atual inválida');
			http_response_code(401);
		}
	}