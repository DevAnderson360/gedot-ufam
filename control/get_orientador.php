<?php 
	
	/**
	 * get dados do tcc
	 * @Param recebe var POST ou GET se não seta com a session
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
		$id_discent = empty($_REQUEST['discent']) ? $_SESSION['user_id']: $_REQUEST['discent'];

		//se existir a request coorientador retorna 2;
		$tipo = empty($_REQUEST['coorientador']) ? 1: 2;

		$tcc->setDiscente($id_discent);

	    echo \App\Utility\Tools::response_json('OK','Success',$tcc->getOrientador($tipo));

	}
