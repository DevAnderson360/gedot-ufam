<?php 
	
	namespace App\Utility;

	/**
	 * Ferramentas de formataçao e etc, rsrs
	 *
	 * @package default
	 * @author Anderson Nogueira silverio 2020 
	 **/
	class Tools 
	{	
		/**
		 * gera um json com dados informados
		 * padrão para o sistema;
		 * @param (status da operação, mensagem, [dados])
		 * @return object json
		 * @author default
		 **/
		static function response_json($status, $msg, $dados = null)
		{
			return json_encode(array('status' => $status, 'msg' => $msg, 'data' => $dados));
		}
	} // END class Tools 