<?php
	session_start();

	include "conexao.php";

/*	$_POST['atual'] = '123';

	$_POST['nova']  = '1419ad';
	
	$_POST['verificacao']  = '1419ad';*/

	if($_POST)
		echo main();

	function main()
	{
		if(validaSenhaAtual()){
			if(validaNovaSenha()){
				return update();
			}			
			return json('error','Nova senha não é identica à senha valídação!');	
		}

		return json('error','Senha atual não confere!');
	}

	/**
	 * Valida senha atual
	 *
	 * @return void
	 * @author 
	 **/
	function validaSenhaAtual ()
	{
		$sql = "SELECT id FROM discente WHERE id = ? AND senha = ?";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		$query->bind_param('ss',$_SESSION['id'],$_POST['atual']);

		$query->execute();

		$result = $query->get_result();

		if($result->num_rows > 0)
			return true;

		return false;
	}

	function validaNovaSenha()
	{
		if($_POST['nova'] === $_POST['verificacao'])
			return true;

		return false;
	}

	/**
	 * altera dados no banco
	 *
	 * @return json
	 * @author Anderson
	 **/
	function update ()
	{
		$sql = "UPDATE `discente` SET `senha` = ? WHERE id = ?";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		$query->bind_param('ss',$_POST['nova'],$_SESSION['id']);

		if($query->execute())
			return json('success','Dados alterados com sucesso!');

		return json('error','Erro na atualização! \nTente novamente...');

	}

	function json($status, $msg)
	{
		return json_encode(array("status"=>$status,"msg"=>$msg));
	}

