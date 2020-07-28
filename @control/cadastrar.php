<?php 
	include "conexao.php";

	main();

	function main(){

		if(!validaMatricula($_POST['matricula']))
		echo json('error','Já existe cadastro para essa matrícula!');
		else
			echo insert(
				$_POST["nome"],
				$_POST["email"],
				$_POST["telefone"],
				$_POST["matricula"],
				$_POST["ano"],
				$_POST["semestre"],
				$_POST["senha"]);		

	}

	/**
	 * cadastrar dados no banco
	 *
	 * @return boolean
	 * @author Anderson
	 **/
	function insert ($nome, $email,$telefone,$matricula,$ano,$semestre,$senha)
	{
		$sql = "INSERT INTO `discente`(`nome`, `email`, `telefone`, `matricula`, `ano`, `semestre`, `senha`) VALUES (?,?,?,?,?,?,?)";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		/*Remove caracteres especiais da string telefone*/		
		$telefone = str_replace(' ', '', str_replace('(', '', str_replace(')', '', str_replace('-', '', $telefone))));

		$query->bind_param('sssssss',
									$nome,
									$email,
									$telefone,
									$matricula,
									$ano,
									$semestre,
									$senha);

		if($query->execute())
			return json('success','Cadastro realizado com sucesso!');

		return json('error','Erro no cadastro! \\nTente novamente...');

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
	 * valida a matricula para não ter duplicação
	 *
	 * @return boolean
	 * @author anderson
	 **/
	function validaMatricula ($matricula)
	{


		$sql = "SELECT id FROM discente WHERE matricula = ?";

		$conn = Database::conexao();

		$query = $conn->prepare($sql);

		$query->bind_param('s',$matricula);

		$query->execute();

		$result = $query->get_result();

		if($result->num_rows > 0)
			return false;

		return true;
	}
