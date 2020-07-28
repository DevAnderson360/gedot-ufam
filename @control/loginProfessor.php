<?php 
	session_start();
	//controla login
	include "conexao.php";

	//verifica se tem $_POST
	if($_POST){
		echo main();
	}else{
		echo json("error","Identificador não recebido para operação!");
	}

	/**
	 * Cria a seta a sessão
	 * @return void
	 * @author Anderson
	 **/
	function main ()
	{	
		//verifica se validas
		if(empty($_POST['matricula']) || empty($_POST['senha']))
			return json("error","Matricula ou senhas inválidos!");
		return login();
	}



	/**
	 * 
	 *
	 * @return retorna uma dados em json
	 * @author anderson
	 **/
	function json($status, $msg)
	{
		return json_encode(array("status"=>$status,"msg"=>$msg));
	}

	/**
	 * realiza o login
	 *
	 * @return void
	 * @author 
	 **/
	function login()
	{
		if(setDadosBanco()){
			return json('success','Sucesso ao logar \n Você será redirecionado');
		}
		return json('error','Matricula ou senhas inválidos!');
	}

	function setDadosBanco()
	{
		$matricula = $_POST['matricula'];
		
		$senha = $_POST['senha'];

		$sql = "SELECT id,nome,email FROM administrador WHERE matricula = ? AND senha = ?";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		$query->bind_param('ss',$matricula,$senha);

		$query->execute();


		$result = $query->get_result();

		if($result->num_rows > 0){
			setSessao($result->fetch_assoc());
			return true;
		}
			
		$query->close();
		session_destroy();
		return false;
	}

	function setSessao($dados){
		$_SESSION['status'] = true;
		$_SESSION['id'] = $dados['id'];
		$_SESSION['nome'] = $dados['nome'];
		$_SESSION['email'] = $dados['email'];
	}