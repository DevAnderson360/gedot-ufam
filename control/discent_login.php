<?php 
	
	/**
	 * Realiza login no sistema
	 **/

	require_once "../vendor/autoload.php";

	if($_POST)
		validationRequest();
	else
		http_response_code(400);

	function validationRequest()
	{
		if(empty($_POST['registration']) OR empty($_POST['password'])){
			echo \App\Utility\Tools::response_json('fail','Parâmetros do formulário informados inválidos');
			http_response_code(401);
			exit;
		}
		
		main();
		
	}



	function main()
	{
		//objeto para realizar o login
		$login = new \App\Utility\Access();

		$login->setData("discente","matricula","senha");

		//objeto da classe conexao
        $conexao = \App\Bd\Database::conexao();


        /**
         * Verificar login e senha no banco de dados e retorna status code 201 ou 401 para não autorizado
         *
         **/
        
        if($login->validar($_POST['registration'], $_POST['password'],$conexao)){
			echo \App\Utility\Tools::response_json('success','Sucesso! Você será redirecionado!','./workspace/discent');
        	return http_response_code(201);
        }

			echo \App\Utility\Tools::response_json('fail','Matrícula ou senha inválidos');
        return http_response_code(401);
	}