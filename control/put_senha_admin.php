<?php

	/**
	 * Altera senha do administrador
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
		if(validaSenhaAtual())
			return update();
			
		http_response_code(401);
		return \App\Utility\Tools::response_json('success','Senha atual não confere!.');
	}

	/**
	 * Valida senha atual
	 *
	 * @return void
	 * @author 
	 **/
	function validaSenhaAtual ()
	{
		$crud = \App\Bd\Crud::getInstance(\App\Bd\Database::conexao(),"administrador");

		$sql = "SELECT id FROM `administrador` WHERE senha = ? AND id = ?";

		$result = $crud->select($sql, array($_POST['atual'], $_SESSION['user_id']),false);

		if(empty($result))
			return false;

		return true;
	}

	/**
	 * altera dados no banco
	 *
	 * @return json
	 * @author Anderson
	 **/
	function update ()
	{
		$crud = \App\Bd\Crud::getInstance(\App\Bd\Database::conexao(),"administrador");

		$result = $crud->update(array("senha" => $_POST['nova']),array("id="=>$_SESSION['user_id']));

		if($result)
			return  \App\Utility\Tools::response_json('success','Senha Alterada com sucesso!','./');

		return \App\Utility\Tools::response_json('success','Erro na atualização! \nTente novamente.');

	}

