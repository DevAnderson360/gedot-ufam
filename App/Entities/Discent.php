<?php 

	namespace App\Entities;

	/**
	 * Class Discent
	 * Manipula a tabala discent (discente) no banco de dados 
	 */
	class Discent extends \App\Bd\Crud
	{	
		public $id;
		public $nome;
		public $email;
		public $telefone;
		public $matricula;
		public $semestre;
		public $ano;
		public $senha;

		
		//recebe uma conexão com o banco de dados e seta na superclass crud
		function __construct($conexao)
		{
			self::getInstance($conexao);
		}

		//----METHODS SET
	
		/*
		* Method set $nome
		* @Param: nome
		* @Return: Void
		*/
		public function setNome ($nome)
		{
			$this->nome = $nome;
		}


		/*
		* Method set $email
		* @Param: email
		* @Return: Void
		*/
		public function setEmail ($email)
		{
			$this->email = $email;
		}


		/*
		* Method set $telefone
		* @Param: telefone
		* @Return: Void
		*/
		public function setTelefone ($telefone)
		{
			$this->telefone = $telefone;
		}


		/*
		* Method set $matricula
		* @Param: matricula
		* @Return: Void
		*/
		public function setMatricula ($matricula)
		{
			$this->matricula = $matricula;
		}


		/*
		* Method set $semestre
		* @Param: semestre
		* @Return: Void
		*/
		public function setSemestre ($semestre)
		{
			$this->semestre = $semestre;
		}


		/*
		* Method set $ano
		* @Param: ano
		* @Return: Void
		*/
		public function setAno ($ano)
		{
			$this->ano = $ano;
		}


		/*
		* Method set $senha
		* @Param: senha
		* @Return: Void
		*/
		public function setSenha ($senha)
		{
			$this->senha = $senha;
		}

		//----METHODS GET----------------------

		/*
		* Method get $id
		* @Param: void
		* @Return: id
		*/
		public function getId ()
		{
			return $this->id;
		}


		/*
		* Method get $nome
		* @Param: void
		* @Return: nome
		*/
		public function getNome ()
		{
			return $this->nome;
		}


		/*
		* Method get $email
		* @Param: void
		* @Return: email
		*/
		public function getEmail ()
		{
			return $this->email;
		}


		/*
		* Method get $telefone
		* @Param: void
		* @Return: telefone
		*/
		public function getTelefone ()
		{
			return $this->telefone;
		}


		/*
		* Method get $matricula
		* @Param: void
		* @Return: matricula
		*/
		public function getMatricula ()
		{
			return $this->matricula;
		}


		/*
		* Method get $semestre
		* @Param: void
		* @Return: semestre
		*/
		public function getSemestre ()
		{
			return $this->semestre;
		}


		/*
		* Method get $ano
		* @Param: void
		* @Return: ano
		*/
		public function getAno ()
		{
			return $this->ano;
		}


		/*
		* Method get $senha
		* @Param: void
		* @Return: senha
		*/
		public function getSenha ()
		{
			return $this->senha;
		}

		//////////--------------OPERAÇÕES NO BANCO DE DADOS----------/////

		//retorna array com dados do objeto
		private function getArrayData()
		{
			return array(
				"id" 		=> $this->id,
				"nome" 		=> $this->nome,
				"email" 	=> $this->email,
				"telefone"  => $this->telefone,
				"matricula" => $this->matricula,
				"semestre"  => $this->semestre,
				"ano" 		=> $this->ano,
				"senha" 	=> $this->senha,
			);
		}

		/*
		*
		*@Param: Void
		*@Return: json do objeto
		*/
		public function objectJson()
		{
			$this->getBDdiscente(true);
			if($this->id !== null)
				return json_encode($this->getArrayData());
			else
				http_response_code(400);
		}

		/*
		* Method getBDdiscente, busca no banco de dados o discente pela matricula
		* 
		* @Param: set (define se a consulta deve ou não setar os dados no objeto), default: false
		* @Return: senha
		*/
		public function getBDdiscente($set = false)
		{
			$sql = "SELECT * FROM discente WHERE matricula = ?";

			$data = self::$crud->select($sql,array($this->matricula),false);

			if($data !== null){
				
				if($set)
					$this->setDataBd($data);
				
				return true;

			}

			return false;

		}

		/**
		 * seta os dados do banco de dados no objeto
		 * @Param $data
		 * @return void
		 **/
		private function setDataBd ($data)
		{
			$this->id		= $data->id;
			$this->nome		= $data->nome;
			$this->email	= $data->email;
			$this->telefone	= $data->telefone;
			$this->semestre	= $data->semestre;
			$this->ano		= $data->ano;
			$this->senha	= $data->senha;
		}

		//inserir no DB um novo registro
		public function post()
		{
			//seta tabela para operacao
 		    self::$crud->setTableName('discente');

 		    $this->id = self::$crud->insert($this->getArrayData());

	    	if($this->id !== null){
	    		return true;
	    	}

	    	return false;
		}


	}