<?php 
	
	/**
	 * inserir novo registro no DB tabela discent
	 *
	 **/

	if($_GET)
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
		$discent->setMatricula($_GET['matricula']);

	    echo $discent->objectJson();

	}


