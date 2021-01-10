<?php



AXL::check_login('axl.triagem');
/**
 * Exibe a interface de cancelar senha por serviço
 */
try {
	
	
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	$servicos = DB::getInstance()->get_servicos_unidade($id_uni, array(Servico::SERVICO_ATIVO));
	

	$tmp = array();
	$tmp[-1] = 'Serviços';
	/** 
	* array passado como parametro onde a chave é o id do serviço 
	* e o valor é uma string com sigla e nome do serviço 
	*/
	foreach ($servicos as $s) {
		$tmp[$s->get_id()] = $s->get_nome(); 
	}
	
	TTriagem::exibir_cancelar_senha_por_servico($tmp);
	
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>