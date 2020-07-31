<?php 

	namespace App\Entities;
	/**
	 * Class TCC jhty kgfkklfglk fg k
	 * Manipula a tabala tcc no banco de dados 
	 * @author Anderson nogueira silverio
	 */
	class Tcc extends \App\Bd\Crud
	{
		private $id;
		private $titulo;
		private $discente;
		private $data_avaliacao;
		private $registro;
		private $orientador;
		private $coorientador;
		private $avaliadores;

		//recebe uma conexão com o banco de dados e seta na superclass crud
		function __construct($conexao)
		{
			self::getInstance($conexao,'tcc');
		}

		//----METHODS SET-------------

		/**
		 * seta id do tcc a partir do banco de dados;
		 *
		 * @return void;
		 * @author default
		 **/
		private function setId ()
		{
			$sql = "SELECT id FROM `tcc` WHERE tcc.discente = ?";

			$data = self::$crud->select($sql,array($this->discente),false);

			$this->id = $data->id;
		}
	
		
		/*
		*Method set $titulo
		* @Param: $titulo
		* @Return:Void
		*/
		public function setTitulo ($titulo)
		{
			$this->titulo = $titulo;
		}
		
		/*
		*Method set $discente
		* @Param: $discente
		* @Return:Void
		*/
		public function setDiscente ($discente)
		{
			$this->discente = $discente;
		}
		
		/*
		*Method set $data_avaliacao
		* @Param: $data_avaliacao
		* @Return:Void
		*/
		public function setDataAvaliacao ($data_avaliacao)
		{
			$this->data_avaliacao = $data_avaliacao;
		}
		
		//----METHODS GET
	
		
		/*
		*Method get $titulo
		* @Param: Void
		* @Return:titulo
		*/
		public function getTitulo ()
		{
			return $this->titulo;
		}
		
		/*
		*Method get $discente
		* @Param: Void
		* @Return:discente
		*/
		public function getDiscente ()
		{
			return $this->discente;
		}
		
		/*
		*Method get $data_avaliacao
		* @Param: Void
		* @Return:data_avaliacao
		*/
		public function getDataAvaliacao ()
		{
			return $this->data_avaliacao;
		}
		
		/*
		*Method get $registro
		* @Param: Void
		* @Return:registro
		*/
		public function getRegistro ()
		{
			return $this->registro;
		}

		///--------------------------
		///--------------------------
		///--------------------------

		//////////--------------OPERAÇÕES NO BANCO DE DADOS----------/////

		//retorna array com dados do objeto
		public function getArrayData()
		{
			return array(
				"id" 			 => $this->id,
				"titulo" 		 => $this->titulo,
				"discente" 		 => $this->discente,
				"data_avaliacao" => $this->data_avaliacao,
				"registro"       => $this->registro,
			);
		}


		/**
		 * get Tcc no banco de dados se exisitir
		 *
		 * @return void
		 * @author default
		 **/
		function getBDTcc ($set = false)
		{
			$sql = "SELECT * FROM `tcc` WHERE tcc.discente = ?";

			$data = self::$crud->select($sql,array($this->discente),false);

			if($data !== null){
				if($set){
					$this->setDataBd($data);
					$this->orientador   = $this->getOrientador();
					$this->coorientador = $this->getOrientador(2);
					$this->avaliadores = $this->getAvaliadores();

				}
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
			$this->id 			   = $data->id;
			$this->titulo 		   = $data->titulo;
			$this->discente        = $data->discente;
			$this->registro        = $data->registro;
			$this->data_avaliacao  = $data->data_avaliacao;
		}

		/*
		*
		*@Param: Void
		*@Return: json do objeto
		*/
		public function objectJson()
		{
			$this->getBDTcc(true);

			return json_encode(
								array(
										"tcc" => $this->getArrayData(),
										"orientador" => $this->orientador,
										"coorientador" => $this->coorientador,
										"avaliadores" => $this->avaliadores,
									)
							);
		}

		//inserir no DB um novo registro
		public function post()
		{
			//seta tabela para operacao
 		    self::$crud->setTableName('tcc');

 		    $this->id = self::$crud->insert($this->getArrayData());

	    	if($this->id !== null){
	    		return true;
	    	}

	    	return false;
		}

		//alterar no DB um registro
		//return boolean
		public function put()
		{
			//seta tabela para operacao
 		    self::$crud->setTableName('tcc');

 		    //seta o id do tcc;
 		    $this->setId ();

 		    return self::$crud->update($this->getArrayData(),array('id=' => $this->id));

		}

		/**
		 * Atualiza no banco de dados o orientador
		 * @param $id, $nome, $titulo, $instituicao, $telefone, $email
		 * @return boolean
		 * @author default
		 **/
		function put_orientador($id, $nome, $titulo, $instituicao, $telefone, $email)
		{
			//seta tabela para operacao
 		    self::$crud->setTableName('orientador');

 		    return self::$crud->update(
 		    							array(
 		    								"nome" => $nome,
 		    								"titulo" => $titulo,
 		    								"instituicao" => $instituicao,
 		    								"telefone" => $telefone, 
 		    								"email" => $email
 		    							),
 		    							array('id=' => $id));

		}

		/**
		 * Atualiza no banco de dados o avaliador
		 * @param $id, $titulo, $nome, $instituicao, $telefone, $email, $cidade, $cargo
		 * @return boolean
		 * @author default
		 **/
		function put_avaliador($id, $titulo, $nome, $instituicao, $telefone, $email, $cidade, $cargo = null)
		{
			//seta tabela para operacao
 		    self::$crud->setTableName('avaliador');


 		    return self::$crud->update(
 		    							array(
 		    								"nome" 		  => $nome, 
 		    								"email" 	  => $email, 
 		    								"cargo" 	  => $cargo, 		    								
 		    								"titulo"      => $titulo, 
 		    								"cidade"      => $cidade, 
 		    								"telefone"    => $telefone, 
 		    								"instituicao" => $instituicao, 
 		    							),
 		    							array('id=' => $id));

		}

		/**
		 * inserir no banco de dados um novo regitro de orientador
		 * @param $titulo, $nome, $instituicao, $telefone, $email, $cidade,[ $tipo = 1]
		 * @return boolean
		 * @author defaul
		 **/
		function post_orientador($titulo, $nome, $instituicao, $telefone, $email, $tipo = 1)
		{
			//seta tabela para operacao
 		    self::$crud->setTableName('orientador');

 		    //seta o id do tcc;
 		    $this->setId ();

 		    $this->id = self::$crud->insert(
 		    									array(
 		    										"tcc"		  => $this->id,
 		    										"tipo"		  => $tipo,
		 		    								"nome" 		  => $nome, 
		 		    								"email" 	  => $email, 
		 		    								"titulo"      => $titulo, 
		 		    								"telefone"    => $telefone, 
		 		    								"instituicao" => $instituicao, 
		 		    							)
 		    								);

	    	if($this->id !== null){
	    		return true;
	    	}

	    	return false;
		}

		/**
		 * inserir no banco de dados o avaliador
		 * @param  $titulo, $nome, $instituicao, $telefone, $email, $cidade, $cargo
		 * @return boolean
		 * @author default
		 **/
		function post_avaliador($titulo, $nome, $instituicao, $telefone, $email, $cidade, $cargo = null)
		{
			//seta tabela para operacao
 		    self::$crud->setTableName('avaliador');

 		    //seta o id do tcc;
 		    $this->setId ();

 		    $this->id = self::$crud->insert(
 		    									array(
 		    										"tcc"		  => $this->id,
 		    										"nome" 		  => $nome, 
		 		    								"email" 	  => $email, 
		 		    								"cargo" 	  => $cargo, 		    								
		 		    								"titulo"      => $titulo, 
		 		    								"cidade"      => $cidade, 
		 		    								"telefone"    => $telefone, 
		 		    								"instituicao" => $instituicao,
		 		    							)
 		    								);

	    	if($this->id !== null){
	    		return true;
	    	}

	    	return false;

		}

		/**
		 * busca no banco de dados pelos orientadores
		 * @default $tipo = 1 orientador
		 * @param $tipo = 1 para orientador ou 2 para coorientador
		 * @return orientadores
		 * @author default
		 **/
		function getOrientador($tipo = 1)
		{
 		    //seta o id do tcc;
 		    $this->setId ();

			$sql = "SELECT tipo, id, tcc, nome,titulo,instituicao, telefone, email, tipo, registro FROM `orientador` WHERE orientador.tcc = ? and orientador.tipo = ?";

			return self::$crud->select($sql,array($this->id, $tipo),false);

		}

		/**
		 * busca no banco de dados pelos avaliadores
		 * @default $tipo = 1 orientador
		 * @param $tipo = 1 para orientador ou 2 para coorientador
		 * @return avaliadores
		 * @author default
		 **/
		function getAvaliadores()
		{
 		    //seta o id do tcc;
 		    $this->setId ();

			$sql = "SELECT * FROM `avaliador` WHERE avaliador.tcc = ?";

			return self::$crud->select($sql,array($this->id),true);

		}


	}//end class	