<?php 
	
	/**
	 * busca no banco dados da tabela discent
	 *
	 **/

	require_once "../vendor/autoload.php";

    #valida a sessao
    $access = new \App\Utility\Access();

	if($access->validaSessionNr())
		main();
	else{
		echo \App\Utility\Tools::response_json('fail','Sessão inválida!');
		http_response_code(400);
	}

	function main()
	{
		require_once "../vendor/autoload.php";

		//instance discent
		$discent = new \App\Entities\Discent(\App\Bd\Database::conexao());

		
		$matricula = empty($_REQUEST['matricula']) ? $_SESSION['user_matricula']: $_REQUEST['matricula'];

		//set data
		//falta lançar validação
		$discent->setMatricula($matricula);

	    echo $discent->objectJson();

	}


