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
		private function getArrayData()
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

			return json_encode($this->getArrayData());
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

	}//end class	