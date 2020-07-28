<?php 
	
	/**
	 * get dados do tcc
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

		//instance tcc
		$tcc = new \App\Entities\Tcc(\App\Bd\Database::conexao());

		//set data
		//falta lançar validação
		$tcc->setDiscente($_SESSION['user_id']);

	    echo $tcc->objectJson();

	}
