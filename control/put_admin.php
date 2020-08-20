<?php

	/**
	 * Altera dados do administrador
	 *
	 * @author Barbara Milena
	 **/


	require_once "../vendor/autoload.php";

	#valida a sessao
    $access = new \App\Utility\Access();

	$access->validaSessionNr();

	if($_POST)
		echo main();


	function main()
	{
		$crud = \App\Bd\Crud::getInstance(\App\Bd\Database::conexao(),"administrador");

		$dados = array(
			"nome" => $_POST['nome'],
			"titulo" => $_POST['titulo'],
			"email" => $_POST['email'],
			"matricula" => $_POST['matricula']
		);

		$result = $crud->update($dados,array("id="=>$_SESSION['user_id']));

		if($result)
			return  \App\Utility\Tools::response_json('success','Dados alterados com sucesso!','./meusdados.php');

		return \App\Utility\Tools::response_json('success','Erro na atualização! \nTente novamente.');

	}

