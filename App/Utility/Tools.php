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

		/**
		 * retorna data atual
		 *
		 * @return string 
		 * @author Barbara Milena
		 **/
		static function nowDate()
		{
			setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
			date_default_timezone_set('America/Manaus');
			return strftime('Itacoatiara, %d de %B de %Y', strtotime('today'));
		}

		/**
		 * converte data atual
		 *
		 * @return string 
		 * @author Barbara Milena
		 **/
		static function dateFormat($date)
		{
			setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
			date_default_timezone_set('America/Manaus');
			return strftime('%d de %B de %Y', strtotime($date));
		}
	} // END class Tools 