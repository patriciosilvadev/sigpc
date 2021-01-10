<?php



AXL::check_login('axl.monitor');
/**
 * Exibe conteudo da busca de um atendimento por senha 
 */
try {
	if(!isset ($_POST["num_senha"]) ){
		throw new Exception("Senha não especificada");
	}
	$num_senha = $_POST["num_senha"];
	
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	$atendimento = DB::getInstance()->get_atendimento_por_senha($num_senha, $id_uni);
	if($atendimento == false){
		echo "Senha não encontrada.";
	}else{
		echo TMonitor::exibir_atendimento($atendimento);
	}
	
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>
