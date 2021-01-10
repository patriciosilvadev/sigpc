<?php



AXL::check_access('axl.relatorios');
try {
	$formato = $_GET['formato'];
	if ($formato == "pdf") {
		$rel = new RelatorioPDF();
	}
	else {
		$rel = new RelatorioHTML();
	}
	
	$rel->setTitulo("Relatório senhas encerradas");
	
	$dt_min = explode('/', $_GET['dt_min']);
	$dt_max = explode('/', $_GET['dt_max']);
	
	$tm_min = mktime(0, 0, 0, $dt_min[1], $dt_min[0], $dt_min[2]);
	$tm_max = mktime(23, 59, 59, $dt_max[1], $dt_max[0], $dt_max[2]);
	
	$dt_min = date("Y-m-d H:i:s", $tm_min);
	$dt_max = date("Y-m-d H:i:s", $tm_max);
	
	$rel->setSubTitulo('Período: '.date("d/m/Y", $tm_min)." - ".date("d/m/Y", $tm_max));
	
    $id_grupo = $_GET['idGrupo'];
    
    $tmp = DB::getInstance()->get_unidades_by_grupos($id_grupo);
    
    $unidades = array();
    foreach ($tmp as $u) {
    	$unidades[] = $u->get_id();
    }
	$tabelas = Estatistica::get_estat_atendimentos_encerradas($unidades,$dt_min,$dt_max);
	if ($tabelas != null){
        $legenda = new Tabela("Legenda", 2, null, 30, "ffcc33");
        $legenda->addRow(array(" ", "Atendimento com apenas um serviço codificado"));
        $legenda->setColWidth(0, 0.1);
        $legenda->setRowFontColor(0, array(0,0,0));
        $legenda->setCellBgColor(0, 0, array(0,0,0));
        $legenda->addRow(array(" ", "Atendimento com mais de um serviço codificado"));
        $legenda->setColWidth(1, 0.1);
        $legenda->setRowFontColor(1, array(250,0,0));
        $legenda->setCellBgColor(1, 0, array(250,0,0));
        
		foreach($tabelas as $tab){
			$rel->addComponente($tab);
			$rel->addComponente(Separador::getInstance());
		}
		$rel->addComponente($legenda);
	}
	
    $rel->output();
	
}
catch (Exception $e){
	Template::display_exception($e);
}

?>