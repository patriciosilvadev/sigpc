<?php //Breno Cruvinel - breno.cruvinel09@gmail.com
//valida pagina se aberto separadamente
include "valida_pagina_sem_quadro.php";













//++++++++++++++++++++++AJAX QUE EXIBE [[BUSCA AVANÇADA]] ----------------------------########################################-------------------------------------->>>
if($ajax == "buscaAvancada"){
    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formBusca = "formBusc".$array_temp;
	
?>
<script>
$(document).ready(function(){
//JQUERY executa com ENTER
	/* ao pressionar uma tecla em um campo*/
	$("#<?=$formBusca?>").keypress(function(e){
		var tecla = (e.keyCode?e.keyCode:e.which);
		/* verifica se a tecla pressionada foi o ENTER */
		if(tecla == 13){//codigo a executar	
			bAvancada<?=$INC_FAISHER["div"]?>();
			return false;/* impede o sumbit caso esteja dentro de um form */
		}
	})
//FIM JQUERY executa com ENTER
});
//limpa campos
$('#<?=$formBusca?> .limpaCampo').click(function(){
	$(this).hide();
	content = $(this).parents('#<?=$formBusca?> .input-append').find("input");
	content.val('');
	bAvancada<?=$INC_FAISHER["div"]?>();
});
$("#<?=$formBusca?> .limpaInput").on("change", function(e){	bAvancada<?=$INC_FAISHER["div"]?>(); });
function pCbusca<?=$INC_FAISHER["div"]?>(v_id){
	content = $('#<?=$formBusca?> #'+v_id).parents('#<?=$formBusca?> .input-append').find("button");
	content.fadeIn();
}
function lCbusca<?=$INC_FAISHER["div"]?>(v_id){
	$('#<?=$formBusca?> #'+v_id).val('');
	content = $('#<?=$formBusca?> #'+v_id).parents('#<?=$formBusca?> .input-append').find("button");
	content.hide();
}

//buscas avancada
function bAvancada<?=$INC_FAISHER["div"]?>(){
	var v_get = '';
	<?php $idCJ = "tipo_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); }
	<?php $idCJ = "nome_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "code_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "datai_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "dataf_b";?>if($("#<?=$formBusca?> #<?=$idCJ?>").val() != ""){ v_get = v_get+'&<?=$idCJ?>='+$("#<?=$formBusca?> #<?=$idCJ?>").val(); pCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }

	loaderFoco('divConteiner_lista<?=$INC_FAISHER["div"]?>','dAjax_lista<?=$INC_FAISHER["div"]?>_load','Filtrando dados...');//cria um loader dinamico
	faisher_ajax('divAjax_lista<?=$INC_FAISHER["div"]?>', 'dAjax_lista<?=$INC_FAISHER["div"]?>_load', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=lista&'+v_get, 'get', 'ADD');
}//bAvancada

function bAvancada<?=$INC_FAISHER["div"]?>Remove(v_remove){
	<?php $idCJ = "tipo_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ $('#<?=$formBusca?> #<?=$idCJ?>').select2("data", ''); }
	<?php $idCJ = "nome_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "code_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('<?=$idCJ?>'); }
	<?php $idCJ = "data_b";?>if(v_remove == "<?=$idCJ?>" || v_remove == "all"){ lCbusca<?=$INC_FAISHER["div"]?>('datai_b'); lCbusca<?=$INC_FAISHER["div"]?>('dataf_b'); }

	bAvancada<?=$INC_FAISHER["div"]?>();	
}//bAvancadaRemove
</script>
<form action="#" id="<?=$formBusca?>" method="POST" class='form-horizontal form-column form-bordered' onsubmit="return false;">
		<div class="control-group">
			<label class="control-label">Tipo empresa</label>
			<div class="controls">
<input type='hidden' value="" name='tipo_b' id='tipo_b' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formBusca?> #tipo_b').select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar um tipo >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=tipojuridica&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	$("#<?=$formBusca?> #tipo_b").on("change", function(e){ bAvancada<?=$INC_FAISHER["div"]?>(); });
});
</script>
			</div>
		</div>
	<div class="span6">
		<div class="control-group">
			<label class="control-label">Nome</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="nome_b" id="nome_b" placeholder="Informe nome ou parte do nome" class="input-xlarge limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?=SYS_CONFIG_RM_LEG_HTML?></label>
			<div class="controls">
				<div class="input-append"><input type="text" name="code_b" id="code_b" placeholder="Informe <?=minusculo(SYS_CONFIG_RM_LEG)?>" class="input-xlarge limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
		</div>
	</div><!-- End .span6 -->
    
	<div class="span6">
		<div class="control-group">
			<label class="control-label">Data de cadastro</label>
			<div class="controls">
				<div class="input-append"><input type="text" name="datai_b" id="datai_b" placeholder="Data inicial" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div> até 
				<div class="input-append"><input type="text" name="dataf_b" id="dataf_b" placeholder="Data final" class="input-medium mask_date datepick limpaInput"><button class="btn limpaCampo" type="button" style="display:none;" rel="tooltip" title="Limpar"><i class="icon-trash"></i></button></div>
			</div>
		</div>
	</div><!-- End .span6 -->
    
	<div class="span12">
		<div class="form-actions">
			<button type="button" class="btn btn-primary enviaBt" onclick="bAvancada<?=$INC_FAISHER["div"]?>();"><i class="icon-search"></i> Buscar agora</button>
			<button type="button" class="btn" onclick="bAvancada<?=$INC_FAISHER["div"]?>Remove('all');$('#dAbusca<?=$INC_FAISHER["div"]?> .bt_expandebusca').click();">Cancelar/Ocultar</button>
		</div>
	</div>
</form>
<?php	
	

}//fim ajax  -------------------------------------------- <<<






















































































//AJAX (lista/preenche combox logradouro) ------------------------------------------------------------------>>>
if($ajax == "selLogradouro"){
	if(isset($_GET["page_limit"])){ $page_limit = $_GET["page_limit"]; }else{ $page_limit = "30"; }
	$sql_busca = "";
	//verifica se recebeu uma solicitação de busca por nome
	if((isset($_GET['term']) && strlen($_GET['term']) > 0)){
		$term = $_GET["term"];
		$sql_busca = " `logradouro` LIKE '%$term%'"; //condição
	}//fim da busca por nome

	
	//cria array de retorno
	$return_arr = array();
	$row_array = array();
	$ret = array();
	
	
	
	//verifica selecao de cidade
	if(isset($_GET["cidade"])){
		$cidade_id_b = $_GET["cidade"];
		if($sql_busca != ""){$sql_busca .= " AND ";}
		$sql_busca .= "`cidade_id` = '".$cidade_id_b."'";
		if($cidade_id_b == ""){
			//alimenta array de retorno
			$row_array['id'] = "0";
			$row_array['text'] = "Selecione primeiro uma cidade";
			array_push($return_arr,$row_array);
			
			//imprime JSON de retorno
			$ret['results'] = $return_arr;
			echo json_encode($ret);
			exit(0);
		}
	}//if(isset($_GET["cidade"])){
	
	if(strlen($term) <= 1){
		//alimenta array de retorno
		$row_array['id'] = "";
		$row_array['text'] = "Comece a digitar para buscar ou adicionar novo...";
		array_push($return_arr,$row_array);
	}else{
	
		//verifica se adiciona itens
		if((isset($_GET["add"])) and strlen($_GET['term']) > 0){
			if(ereg('[^0-9]',$term)){//so imprime se nao for numero
				//alimenta array de retorno
				$row_array['id'] = maiusculo($_GET['term']);
				$row_array['text'] = "NOVO: <b>".maiusculo($_GET['term'])."</b>";
				array_push($return_arr,$row_array);
			}
		}
		
//lista ALERTAS
	$campos = "logradouro";
	$tabela = "cad_candidato_juridico_endereco";
	$where = $sql_busca;
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "GROUP BY logradouro ORDER BY logradouro ASC",$page_limit);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$legenda = $linha["logradouro"];
		
		//alimenta array de retorno
		$row_array['id'] = $legenda;
		$row_array['text'] = $legenda;
		array_push($return_arr,$row_array);

	}//fim while
	
	}//fim if(strlen($id) == 0){
	

	//imprime JSON de retorno
    $ret['results'] = $return_arr;
	echo json_encode($ret);


}//fim ajax -------------------<<<<


















































//AJAX (aiciona linha de socio pessoa física) ------------------------------------------------------------------>>>
if($ajax == "addLinhaSocioFisico"){
	$formCadastroPincipal = $_GET["formCadastroPincipal"];
	$cont = $_GET["cont"];
?>

<script>
$.doTimeout('vTimerDefalt0<?=$INC_FAISHER["div"]?>', 500, function(){
    $("#tabela_itens_socios_fisico<?=$INC_FAISHER["div"]?> tbody").append('<tr id="tr<?=$cont?>"><td class="select2-full"><input type="hidden" value="" name="fisico_id<?=$cont?>" id="fisico_id<?=$cont?>" style="width:98%;"/></td><td><div class="input-append"><input type="text" name="fisico_cotas<?=$cont?>" id="fisico_cotas<?=$cont?>" value="" maxlength="6" class="span6"><span class="add-on">%</span></div></td><td><button type="button" class="btn" onclick="delLinhaSocioFisico<?=$INC_FAISHER["div"]?>(\'<?=$cont?>\');"><i class="icon-trash"></i></button></td></tr>');

	//dados de combobox
	$("#<?=$formCadastroPincipal?> #fisico_id<?=$cont?>").select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Adicionar um candidato >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=candidatofisico<?php if(!isset($_GET["POP"])){ echo "&add"; }?>&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	$("#<?=$formCadastroPincipal?> #fisico_id<?=$cont?>").select2('open');	
	$("#<?=$formCadastroPincipal?> #fisico_id<?=$cont?>").on("change", function(e){
		if($(this).val() == "NOVO"){ $(this).select2("data", '');
			pmodalHtml('<i class=icon-user></i> CADASTRAR NOVO CANDIDATO','<?=$AJAX_PAG?>','get','faisher=3_con_candidatofisico&ajax=registro&id_a=0&POP=<?=fGERAL::cptoFaisher("addNovoContibuinte".$INC_FAISHER["div"]."('{ID}','{TXT}', 'fisico_id".$cont."');", "enc")?>');
		}
		if(($(this).val() != "NOVO") && ($(this).val() != "")){ $.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 500, function(){ $("#<?=$formCadastroPincipal?> #fisico_cotas<?=$cont?>").focus(); }); }
	});	
	
	$("#<?=$formCadastroPincipal?> #fisico_cotas<?=$cont?>").keypress(verificaNumeroVirg);
});
</script>    
    
<?php


}//fim ajax -------------------<<<<
















































//AJAX (aiciona linha de socio pessoa jurídica) ------------------------------------------------------------------>>>
if($ajax == "addLinhaSocioJuridico"){
	$formCadastroPincipal = $_GET["formCadastroPincipal"];
	$cont = $_GET["cont"];
?>

<script>
$.doTimeout('vTimerDefalt0j<?=$INC_FAISHER["div"]?>', 500, function(){
    $("#tabela_itens_socios_juridico<?=$INC_FAISHER["div"]?> tbody").append('<tr id="tr<?=$cont?>"><td class="select2-full"><input type="hidden" value="" name="juridico_id<?=$cont?>" id="juridico_id<?=$cont?>" style="width:98%;"/></td><td><div class="input-append"><input type="text" name="juridico_cotas<?=$cont?>" id="juridico_cotas<?=$cont?>" value="" maxlength="6" class="span6"><span class="add-on">%</span></div></td><td><button type="button" class="btn" onclick="delLinhaSocioJuridico<?=$INC_FAISHER["div"]?>(\'<?=$cont?>\');"><i class="icon-trash"></i></button></td></tr>');

	//dados de combobox
	$("#<?=$formCadastroPincipal?> #juridico_id<?=$cont?>").select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Adicionar um candidato jurídico >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=candidatojuridico<?php if(!isset($_GET["POP"])){ echo "&add"; }?>&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	$("#<?=$formCadastroPincipal?> #juridico_id<?=$cont?>").select2('open');	
	$("#<?=$formCadastroPincipal?> #juridico_id<?=$cont?>").on("change", function(e){
		if($(this).val() == "NOVO"){ $(this).select2("data", '');
			pmodalHtml('<i class=icon-user></i> CADASTRAR NOVO CANDIDATO JURÍDICO','<?=$AJAX_PAG?>','get','faisher=3_con_candidatojuridico&ajax=registro&id_a=0&POP=<?=fGERAL::cptoFaisher("addNovoContibuinte".$INC_FAISHER["div"]."('{ID}','{TXT}', 'juridico_id".$cont."');", "enc")?>');
		}
		if(($(this).val() != "NOVO") && ($(this).val() != "")){ $.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 500, function(){ $("#<?=$formCadastroPincipal?> #juridico_cotas<?=$cont?>").focus(); }); }
	});	
	
	$("#<?=$formCadastroPincipal?> #juridico_cotas<?=$cont?>").keypress(verificaNumeroVirg);
});
</script>    
    
<?php


}//fim ajax -------------------<<<<
















































//AJAX (aiciona linha de procurador pessoa física) ------------------------------------------------------------------>>>
if($ajax == "addLinhaProcuradorFisico"){
	$formCadastroPincipal = $_GET["formCadastroPincipal"];
	$cont = $_GET["cont"];
?>
<script>
$.doTimeout('vTimerDefalt0<?=$INC_FAISHER["div"]?>', 500, function(){
    $("#tabela_itens_procurador_fisico<?=$INC_FAISHER["div"]?> tbody").append('<tr id="tr<?=$cont?>"><td class="select2-full"><input type="hidden" value="" name="procurador_fisico_id<?=$cont?>" id="procurador_fisico_id<?=$cont?>" class="candidato_fisico" style="width:98%;"/></td><td><input type="text" name="procurador_data<?=$cont?>" id="procurador_data<?=$cont?>" class="span12 mask_date datepick"></td><td><button type="button" class="btn" onclick="delLinhaProcuradorFisico<?=$INC_FAISHER["div"]?>(\'0\'\'<?=$cont?>\');"><i class="icon-trash"></i></button></td></tr>');
	//dados de combobox
	$("#<?=$formCadastroPincipal?> #procurador_fisico_id<?=$cont?>").select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Adicionar um candidato >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=candidatofisico<?php if(!isset($_GET["POP"])){ echo "&add"; }?>&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	$("#<?=$formCadastroPincipal?> #procurador_fisico_id<?=$cont?>").select2('open');	
	$("#<?=$formCadastroPincipal?> #procurador_fisico_id<?=$cont?>").on("change", function(e){
		if($(this).val() == "NOVO"){ $(this).select2("data", '');
			pmodalHtml('<i class=icon-user></i> CADASTRAR NOVO CANDIDATO','<?=$AJAX_PAG?>','get','faisher=3_con_candidatofisico&ajax=registro&id_a=0&POP=<?=fGERAL::cptoFaisher("addNovoContibuinte".$INC_FAISHER["div"]."('{ID}','{TXT}', 'procurador_fisico_id".$cont."');", "enc")?>');
		}
		if(($(this).val() != "NOVO") && ($(this).val() != "")){ $.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 500, function(){ $("#<?=$formCadastroPincipal?> #procurador_data<?=$cont?>").focus(); }); }
	});	
});
</script>   
<?php


}//fim ajax -------------------<<<<






























































//AJAX (add DOCs) ------------------------------------------------------------------>>>
if($ajax == "addDOCs"){
	$formCadastroPincipal = $_GET["formCadastroPincipal"];
	$array_temp = $_GET["array_temp"];
	$id_a = $_GET["id_a"];




?>
<?php

/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"]."docs";
include "inc/inc_js-exclusivo.php";



?>
<div style="margin-bottom:50px;" id="formDOCs<?=$INC_FAISHER["div"]?>">
	<table class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th colspan="2"><i class="icon-edit"></i> ADICIONAR NOVO ANEXO/DOCUMENTO <button type="button" class="btn" style="float:right;" onclick="addDOCdiv<?=$INC_FAISHER["div"]?>('close');" rel="tooltip" data-placement="left" data-original-title="Cancelar novo documento"><i class="icon-remove"></i></button></th>
			</tr>
		</thead>
        <tbody>
            <tr>
                <td>Tipo de documento</td>
                <td>
<input type='hidden' value="" name='tipo_id_i' id='tipo_id_i' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #tipo_id_i').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar um tipo de documento >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=candidatoDocsTipo&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
});
</script>
<span class="help-block"><i class="icon-info-sign"></i> Caso o tipo de documento a enviar não estaja na lista, solicite a administração.</span>
                <div id="tipo_msg"></div></td>
            </tr>
            <tr>
                <td>Data validade</td>
                <td>
					<div class="input-append">
						<input type="text" name="data_validade_i" id="data_validade_i" value="" class='input-small mask_date datepick'>
						<span class="add-on icon-calendar"></span>
					</div></td>
            </tr>
            <tr>
                <td>Observações ao documento</td>
                <td><textarea name="obs_i" id="obs_i" rows="2" class="input-block-level cssFonteMai" placeholder="Observações (opcional)"></textarea></td>
            </tr>
            <tr>
                <td>Original</td>
                <td>
					<div class="check-line">
						<input name="original_i" type="checkbox" class='<?=$INC_FAISHER["div"]?>docs-icheck' id="original_i" value="1" data-skin="square" data-color="blue"> <label class='inline display' for="original_i">É cópia autenticada ou conferido com original</label>
					</div>
               </td>
            </tr>
            <tr>
                <td>Verificação extra</td>
                <td>
					<div class="check-line">
						<input name="validacao_i" type="checkbox" class='<?=$INC_FAISHER["div"]?>docs-icheck' id="validacao_i" value="1" data-skin="square" data-color="blue"> <label class='inline display' for="validacao_i">Solicitar verificação extra de autenticidade do documento</label>
					</div>
					<span class="help-block"><i class="icon-info-sign"></i> <b>ATENÇÃO!</b> A verificação extra é realizada por uma equipe de apoio, <span style="color:#FF0000;">utilizar em casos especiais</span>.</span>
               </td>
            </tr>
            <tr>
                <td>Sobre o envio</td>
                <td>
					<div class="check-medio-col">
						<div class="check-line">
							<input name="scanner_i" type="radio" class='<?=$INC_FAISHER["div"]?>docs-icheck' id="scanner1_i" onChange="scannerCheck<?=$INC_FAISHER["div"]?>();" value="0" data-skin="square" data-color="blue" checked="checked"> <label class='inline' for="scanner1_i">Enviar arquivo agora</label>
						</div>
					</div>
					<div class="check-medio-col">
						<div class="check-line">
							<input name="scanner_i" type="radio" class='<?=$INC_FAISHER["div"]?>docs-icheck' id="scanner2_i" onChange="scannerCheck<?=$INC_FAISHER["div"]?>();" value="1" data-skin="square" data-color="blue"> <label class='inline' for="scanner2_i">Solicitar ao Depto de Scanner</label>
						</div>
					</div>
					<span class="help-block scannerOn" style="color:#FF0000; clear:both; display:none;"><i class="icon-info-sign"></i> <b>ATENÇÃO!</b> Após adicionar anote o Número do Scanner para etiquetar seu documento para envio ao scanner.</span>
               </td>
            </tr>
            <tr class="scannerOn" style="display:none;">
                <td>Observações ao scanner</td>
                <td><textarea name="scanner_obs_i" id="scanner_obs_i" rows="2" class="input-block-level cssFonteMai" placeholder="Observações ao depto de scanner (opcional)"></textarea>
					<span class="help-block"><i class="icon-info-sign"></i> Alguma observação ao departamento de scanner sobre o documento.</span></td>
            </tr>
            <tr class="scannerOff">
                <td>Arquivo</td>
                <td>

				<?php
				//montar IFRAME
				$idTemp = $array_temp;//id do retorno
				$idIframe = "anexoDOCs".$array_temp;//id do iframe
				$arqTipo = "todos";//tipos de arquivos
				$n_arqQtd = "1";//quantidade de arquivos maximo
				$desc = "0";//ativar descicao, 1 ligado, 0 desligado
				$funcao = "contfAdd".$INC_FAISHER["div"];//executar funcao
				?>
				<iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>&funcao=<?=$funcao?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
                <input type="hidden" name="contf_i" id="contf_i" value="0">
                <div id="arquivo_msg"></div>
                <span class="help-block"><i class="icon-info-sign"></i> Indicado o envio de arquivos no formato PDF, podendo conter páginas.</span>
                </td>
            </tr>
            <tr>
                <td>Ações</td>
                <td>
				<button type="button" class="btn btn-large btn-inverse" onclick="formAddDOCs<?=$INC_FAISHER["div"]?>();">Adicionar Novo Anexo <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvarAddDOCs<?=$array_temp?>" /></button>
				<button type="button" class="btn btn-large" onclick="addDOCdiv<?=$INC_FAISHER["div"]?>('close');">Cancelar</button>
                </td>
            </tr>
    
        </tbody>
	</table>
</div>
<script>
$.doTimeout('vTimerLoadAdd<?=$INC_FAISHER["div"]?>', 0, function(){ ancoraHtml('#div_addDOCs<?=$INC_FAISHER["div"]?>',60); addDOCdiv<?=$INC_FAISHER["div"]?>('open'); });//TIMER
function contfAdd<?=$INC_FAISHER["div"]?>(cont){
	$('#<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> #contf_i').val(cont);
}//contfAdd

function scannerCheck<?=$INC_FAISHER["div"]?>(){
	scanner_i = valCampo('scanner_i','<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?>');
	if(scanner_i == "1"){
		$('#<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> .scannerOff').hide();
		$('#<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> .scannerOn').fadeIn();
	}else{
		$('#<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> .scannerOn').hide();
		$('#<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> .scannerOff').fadeIn();		
	}
}//formAddDOCs

function formAddDOCs<?=$INC_FAISHER["div"]?>(){
	var valida = "1";
	tipo_id_i = $('#<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> #tipo_id_i').val();
	original_i = valCampo('original_i','<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?>');
	data_validade_i = $('#<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> #data_validade_i').val();
	obs_i = $('#<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> #obs_i').val();
	validacao_i = valCampo('validacao_i','<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?>');
	scanner_i = valCampo('scanner_i','<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?>');
	scanner_obs_i = $('#<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> #scanner_obs_i').val();
	contf_i = $('#<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> #contf_i').val();

	if((tipo_id_i == "") && (valida == "1")){ valida = "0";
		exibMensagem('<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> #tipo_msg','erro','Informe um tipo de documento/anexo!',20000);
	}
	if((contf_i == "0") && (scanner_i == "0") && (valida == "1")){ valida = "0";
		exibMensagem('<?=$formCadastroPincipal?> #formDOCs<?=$INC_FAISHER["div"]?> #arquivo_msg','erro','É obrigatório o envio de um arquivo!',20000);
	}

	if(valida == "1"){
		faisher_ajax('<?=$formCadastroPincipal?> #div_listaDOCs<?=$INC_FAISHER["div"]?>', 'btSalvarAddDOCs<?=$array_temp?>', '<?=$AJAX_PAG?>', '<?=$faisherGet?>ajax=listaDOCs&formCadastroPincipal=<?=$formCadastroPincipal?>&array_temp=<?=$array_temp?>&id_a=<?=$id_a?>&adicionar='+contf_i+'&tipo_id='+tipo_id_i+'&original='+original_i+'&data_validade='+data_validade_i+'&obs='+obs_i+'&validacao='+validacao_i+'&scanner='+scanner_i+'&scanner_obs='+scanner_obs_i, 'get', 'ADD');
	}
}//formAddDOCs
</script>
<?php


	


}//fim ajax -------------------<<<<
























//AJAX (ver validação de docs) ------------------------------------------------------------------>>>
if($ajax == "valDocsVer"){
	$id = $_GET["id"];
	$file = $_GET["file"];
	$arquivoValida = "";

	//preparando o nome de caminho
	$arrRet = fTBL::caminhoDocs("cad_candidato_juridico_docs",$id,$file,"valida");
	if(($arrRet["caminho"] != "") and ($arrRet["valida"] != "")){
		$arquivoValida = $arrRet["caminho"].$arrRet["valida"];
	}		
	
	//verifica se nao encontrou nada
	if($arquivoValida == ""){	
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Erro na localização dos dados, atualize sua janela!<br>NÃO FOI LOCALIZADO ARQUIVO DE VALIDAÇÃO!");
		//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
		$cMSG->imprimirMSG();//imprimir mensagens criadas
		exit(0);
	}//verifica se nao encontrou nada
	
	$file_ret = file_get_contents($arquivoValida);
	$validacao = fGERAL::logFile($file_ret,"get");

?>  
<div id="verValDoc<?=$INC_FAISHER["div"]?>">
	<div style="clear:both; padding:20px 10px 10px 10px; border-bottom:#CCC 1px solid;">Parecer:</div>
	<div style="padding:5px; border:#CCC 1px solid;"><?=$validacao?><br><br></div>  
<div style="clear:both; height:5px;"></div>
</div> 
<?php

}//fim ajax -------------------<<<<










//AJAX (lista DOCs) ------------------------------------------------------------------>>>
if($ajax == "listaDOCs"){
	$formCadastroPincipal = $_GET["formCadastroPincipal"];
	$array_temp = $_GET["array_temp"];
	$id_a = $_GET["id_a"];
	if(isset($_GET["view"])){ $view = $_GET["view"]; }else{ $view = "0"; }
	if(isset($_GET["limit"])){ $limit = $_GET["limit"]; }else{ $limit = "0"; }
	$limit_total = "5";//limite de maximo de linhas a exibir por load

	//adicionar novo
	if(isset($_GET["adicionar"])){
		$tipo_id = getpost_sql($_GET["tipo_id"]);
		$original = getpost_sql($_GET["original"]);
		$data_validade = getpost_sql($_GET["data_validade"], "DATA");
		$obs = getpost_sql($_GET["obs"], "NULL");
		$validacao = getpost_sql($_GET["validacao"]);
		if($validacao >= "1"){ $validacao = "1"; }else{ $validacao = "NULL"; }
		$scanner = getpost_sql($_GET["scanner"]);
		$scanner_obs = getpost_sql($_GET["scanner_obs"]);
		
		$linhaTipo = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_docs_tipo", "id = '$tipo_id'", "");
		if($id_a >= "1"){
			$timeEx = time(); $temp = 'NULL';
		}else{
			$timeEx = time()+3600; $temp = $array_temp;
		}
		
		//veirifia se não pe scanner
		if($scanner == "0"){
		//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
			$cont_arquivo = "0";
			//verifica se existem arquivos temp no sistema
			$upload_dir_temp = VAR_DIR_FILES."files/temp/";
			$campos = "id,titulo,nome,arquivo";
			$tabela = "sys_arquivos_temp";
			$where = "acao = '$array_temp' AND form = 'anexoDOCs".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$id_e = $linha["id"];
				$titulo_e = $linha["titulo"];
				$nome_e = $linha["nome"];
				$arquivo_e = $linha["arquivo"];
				if(file_exists($upload_dir_temp.$arquivo_e)){
					$cont_arquivo++;//faz contagem de arquivos enviados
					//VARS insert simples SQL
					$tabela = "cad_candidato_juridico_docs";
					//busca ultimo id para insert
					$id_f = fSQL::SQL_SELECT_INSERT($tabela, "id");
					$campos = "id,candidato_juridico_id,tipo_id,obs,original,data_validade,file,validacao,user,time,temp";
					$valores = array($id_f,$id_a,$tipo_id,$obs,$original,$data_validade,$arquivo_e,$validacao,$cVLogin->userReg(),$timeEx,$temp);
					$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
					
					//preparando o envio do arquivo temp para o definitivo
					$upload_dir = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_docs/";
					$pasta_c = fGERAL::criaPasta($upload_dir);
					if($pasta_c == 1){ fBKP::bkpAddFolder($upload_dir); }//(confirma a criação da pasta)adiciona criação de pasta em lista de BACKUP
					$arquivo_n = "doc-".$id_f.".".fGERAL::mostraExtensao($arquivo_e); //monta nome do novo arquivo
					//move o arquivo para o novo local e exclue o temp
					rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_n);
					fBKP::bkpFile($upload_dir.$arquivo_n);//adiciona arquivo em lista de arquivo BACKUP
					
					//verifica validacao extra
					if($validacao >= "1"){
						//VARS insert simples SQL
						$tabela = "apoio_docs_validacao";
						//busca ultimo id para insert
						$id_fv = fSQL::SQL_SELECT_INSERT($tabela, "id");
						$rand_fv = fGERAL::codeRand(4);
						$cont_fv = fSQL::SQL_SELECT_INSERT($tabela, "cont","ano = '".date('Y')."' AND mes = '".date('m')."' AND dia = '".date('d')."'");
						$campos = "id,perfil_id,ano,mes,dia,cont,rand,rm,tabela,docs_id,tipo,original,data_validade,obs,file,depto_id,status,user,time,sync";
						$valores = array($id_fv,$cVLogin->getVarLogin("SYS_USER_PERFIL_ID"),date('Y'),date('m'),date('d'),$cont_fv,$rand_fv,fRM::getRMCandidato($id_a,"F",1),"cad_candidato_juridico_docs",$id_f,$linhaTipo["legenda"],$original,$data_validade,$obs,$arquivo_e,$cVLogin->loginDeptos("principal"),"1",$cVLogin->userReg(),time(),time());
						$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
					}//if($validacao >= "1"){
		
					//exclue o registro
					$tabela = "sys_arquivos_temp";
					$condicao = "id = '$id_e'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
			}//fim while
			if($cont_arquivo >= "1"){
				//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
				$cMSG->addMSG("SUCESSO","Adicionado com sucesso!");
			}
		//########################################### iFRAME TEMP ####################################<<<<<<<<<<<
		}else{//if($scanner == "0"){
			//VARS insert simples SQL
			$tabela = "cad_candidato_juridico_docs";
			//busca ultimo id para insert
			$id_f = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,candidato_juridico_id,tipo_id,obs,original,data_validade,validacao,scanner_time,user,time,temp";
			$valores = array($id_f,$id_a,$tipo_id,$obs,$original,$data_validade,$validacao,"1",$cVLogin->userReg(),$timeEx,$temp);
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			//VARS insert simples SQL
			$tabela = "apoio_scanner_pla";
			//busca ultimo id para insert
			$id_fs = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$cont_fs = fSQL::SQL_SELECT_INSERT($tabela, "cont","ano = '".date('Y')."' AND mes = '".date('m')."' AND dia = '".date('d')."'");
			$rand = fGERAL::codeRand(4);
			$campos = "id,ano,mes,dia,cont,rand,rm,tabela,docs_id,original,validacao,tipo,data_validade,obs,obs_scanner,depto_id,user,time";
			$valores = array($id_fs,date('Y'),date('m'),date('d'),$cont_fs,$rand,fRM::getRMCandidato($id_a,"F",1),"cad_candidato_juridico_docs",$id_f,$original,$validacao,$linhaTipo["legenda"],$data_validade,$obs,$scanner_obs,$cVLogin->loginDeptos("principal"),$cVLogin->userReg(),time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			$numero_scanner = fGERAL::legNumCont(date('Y'),date('m'),date('d'),$rand,$cont_fs);
			
			//atualiza dados da tabela no DB
			$campos = "scanner_user";
			$tabela = "cad_candidato_juridico_docs";
			$valores = array(fGERAL::limpaCode($numero_scanner));
			$condicao = "id='$id_f'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
			
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO","Solicitação de scanner adicionada com sucesso, anexe o número ao documento!");
			$cMSG->addMSG("ALERTA","ANOTE O NÚMERO DO SCANNER PARA ETIQUETA:<br><h3><b>$numero_scanner</b></h3>",40000);
		}//else{//if($scanner == "0"){
	}//if(isset($_GET["adicionar"])){


	//excluir temp
	if(isset($_GET["excluir"])){
		$excluir = getpost_sql($_GET["excluir"]);		
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id,file", "cad_candidato_juridico_docs", "id = '$excluir'", "");
		while($linha = fSQL::FETCH_ASSOC($resu1)){
			$id_e = $linha["id"];
			$file_e = $linha["file"];
			$caminho_arq = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_docs/";
			$arquivoD = $caminho_arq."doc-".$id_e.".".fGERAL::mostraExtensao($file_e);
			//exclue o arquivo
			if(($arquivoD != "") and (file_exists($arquivoD))){
				delete($arquivoD);
				fBKP::bkpDelFile($arquivoD);//adiciona arquivo em lista de excluídos BACKUP	
			}
			$arquivoD = $caminho_arq."valida-".$id_e;
			//exclue a validação
			if(($arquivoD != "") and (file_exists($arquivoD))){
				delete($arquivoD);
				fBKP::bkpDelFile($arquivoD);//adiciona arquivo em lista de excluídos BACKUP	
			}
			//exclue o registro
			$tabela = "cad_candidato_juridico_docs";
			$condicao = "id = '$id_e'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			
			//exclue o registros de validação
			$tabela = "apoio_docs_validacao";
			$condicao = "tabela = 'cad_candidato_juridico_docs' AND docs_id = '$id_e'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			//exclue o registros de validação
			$tabela = "apoio_scanner_pla";
			$condicao = "tabela = 'cad_candidato_juridico_docs' AND docs_id = '$id_e'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);

			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO","Excluido com sucesso!");
		}//fim while fetch
	}//if(isset($_GET["excluir"])){





//verifica se existem arquivos inutilizados no sistema --------------------------------------------------- >>>
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,file,time", "cad_candidato_juridico_docs", "candidato_juridico_id = '0' AND time < '".time()."'", "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$file_e = $linha["file"];
		$time_e = $linha["time"];
		$arquivo_n = "doc-".$id_e.".".fGERAL::mostraExtensao($file_e); //monta nome do novo arquivo
		$arquivoD = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_docs/".$arquivo_n;
		//exclue o arquivo
		if(($arquivoD != "") and (file_exists($arquivoD))){
			delete($arquivoD);
			fBKP::bkpDelFile($arquivoD);//adiciona arquivo em lista de excluídos BACKUP	
		}		
		//exclue o registro
		$tabela = "cad_candidato_juridico_docs";
		$condicao = "id = '$id_e'";
		fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			
		//exclue o registros de validação
		$tabela = "apoio_docs_validacao";
		$condicao = "tabela = 'cad_candidato_juridico_docs' AND docs_id = '$id_e'";
		fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
		//exclue o registros de validação
		$tabela = "apoio_scanner_pla";
		$condicao = "tabela = 'cad_candidato_juridico_docs' AND docs_id = '$id_e'";
		fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	}//fim while fetch*/
//verifica se existem arquivos inutilizados no sistema --------------------------------------------------- <<<

?>
<?php	
	

//ID de controle ---  ########### rolagem faisher ################# ++++
$id_Content = "div_listaDOCs".$INC_FAISHER["div"];
$id_Rolagem = "div_listaDOCs".$INC_FAISHER["div"];
$id_Tabela = "tabela-docs".$INC_FAISHER["div"];
$get_Pg = $faisherGet."ajax=listaDOCs&id_a=".$id_a."&formCadastroPincipal=".$formCadastroPincipal."&array_temp=".$array_temp."&view=".$view;
$docs_b = ""; if((isset($_GET["docs_b"])) and ($_GET["docs_b"] != "")){ $docs_b = getpost_sql($_GET["docs_b"]); }

//verifica se exibe cabeçalho
if($limit == "0"){
?>
<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas
?>
<script>
<?php if(isset($_GET["adicionar"])){?>$.doTimeout('vTimerLoad<?=$id_Rolagem?>', 500, function(){ addDOCdiv<?=$INC_FAISHER["div"]?>('close'); });//TIMER<?php }?>

//ao redimencionar a pagina
function resize_Tela<?=$id_Rolagem?>() {
	var v_largura = $("#<?=$id_Content?>").width();	$("#divRol<?=$id_Rolagem?>").css('width',v_largura+'px');
	var v_altura = $("#<?=$id_Tabela?>").height()+30;	$("#divRol<?=$id_Rolagem?>").css('height',v_altura+'px');
	//atualiza rolagem da caixa
	rolagemFaisher('divRol<?=$id_Rolagem?>','setasH');//rolagem
}//resize_TelaRelato
$(window).resize(function(){ resize_Tela<?=$id_Rolagem?>(); });


function buscaDOCs<?=$INC_FAISHER["div"]?>(){
	var docs_b = $('#<?=$formCadastroPincipal?> #docs_b<?=$INC_FAISHER["div"]?>').val();
	faisher_ajax('<?=$formCadastroPincipal?> #div_listaDOCs<?=$INC_FAISHER["div"]?>', 'btAddDOCs<?=$array_temp?>', '<?=$AJAX_PAG?>', '<?=$get_Pg?>&docs_b='+docs_b, 'get', 'ADD');
}//buscaDOCs
$(document).ready(function(){
//JQUERY executa com ENTER
	$("#<?=$formCadastroPincipal?> #docs_b<?=$INC_FAISHER["div"]?>").keypress(function(e){
		var tecla = (e.keyCode?e.keyCode:e.which);
		/* verifica se a tecla pressionada foi o ENTER */
		if(tecla == 13){//codigo a executar	
			if($("#<?=$formCadastroPincipal?> #docs_b<?=$INC_FAISHER["div"]?>").val() == ""){
				$("#<?=$formCadastroPincipal?> #docs_b<?=$INC_FAISHER["div"]?>").attr('placeholder', 'Buscar... (DIGITE ALGO!)');
			}else{
				buscaDOCs<?=$INC_FAISHER["div"]?>();
			}
			return false;/* impede o sumbit caso esteja dentro de um form */
		}
	})
//FIM JQUERY executa com ENTER
	
});

function delLinhaDOCs<?=$INC_FAISHER["div"]?>(v_id,v_temp,v_div){
	v_total = Number($("#tPg<?=$id_Rolagem?>").html()); v_total--;
	$("#tPg<?=$id_Rolagem?>").html(v_total);
	if(v_temp == ""){
		var del_docs = $('#<?=$formCadastroPincipal?> #del_docs').val();
		if(del_docs != ""){ del_docs = del_docs+','; } del_docs = del_docs+v_id;
		$('#<?=$formCadastroPincipal?> #del_docs').val(del_docs);
		$('#<?=$formCadastroPincipal?> #'+v_div).fadeOut();
	}else{
		faisher_ajax('<?=$formCadastroPincipal?> #div_listaDOCs<?=$INC_FAISHER["div"]?>', 'btAddDOCs<?=$array_temp?>', '<?=$AJAX_PAG?>', '<?=$get_Pg?>&excluir='+v_id, 'get', 'ADD');
	}
}//delLinhaDOCs
</script>
<div id="divRol<?=$id_Rolagem?>" style="width:100%; overflow:auto;"><div style="width:100%; min-width:980px; padding-top:0px;" id="divRol<?=$id_Rolagem?>Cont">
	<table class="table table-hover table-bordered" style="margin-top:0;" id="tabela-docs<?=$INC_FAISHER["div"]?>">
		<thead>
			<tr>
				<th colspan="4">
					<div class="input-append input-prepend" style="float:left;">
						<span class="add-on"><i class="icon-search"></i></span>
						<input name="docs_b<?=$INC_FAISHER["div"]?>" type="text" class='input-large' id="docs_b<?=$INC_FAISHER["div"]?>" placeholder="Buscar documentos/anexos...">
						<button class="btn" type="button" onclick="buscaDOCs<?=$INC_FAISHER["div"]?>();">Buscar</button>
					</div>
                    <?php if($_GET["docs_b"] != ""){ ?>
					<div style="float:left; margin-left:10px;">
						<button class="btn" type="button" onclick="$('#<?=$formCadastroPincipal?> #docs_b<?=$INC_FAISHER["div"]?>').val('');buscaDOCs<?=$INC_FAISHER["div"]?>();" rel="tooltip" data-placement="right" title="Remover busca/mostrar todos">Buscando: <?=$_GET["docs_b"]?> <i class="icon-remove"></i></button>
					</div>                    
                    <?php }?>
                    </th>
			</tr>
			<tr>
				<th style="width:100px;">ICO</th>
				<th>Dados</th>
				<th>Vínculo a <?=SYS_CONFIG_RM_SIGLA?></th>
				<th style="width:20px;">Ação</th>
			</tr>
		</thead>
        <tbody> 
<?php
}//if($limit == "0"){

?> 
<?php
$i_cont = "0";

if($id_a >= "1"){
	
	
	$SQL_tabela = "cad_candidato_juridico_docs D, cad_candidato_docs_tipo T";
	$SQL_where = "D.candidato_juridico_id = '$id_a' AND D.tipo_id = T.id";
	if($docs_b != ""){ $SQL_where .= " AND ( D.`data_validade` LIKE '%$docs_b%' OR D.`obs` LIKE '%$docs_b%' OR D.`file` LIKE '%$docs_b%' OR D.`scanner_user` LIKE '%$docs_b%' OR D.`user` LIKE '%$docs_b%' OR T.`legenda` LIKE '%$docs_b%' )"; }
	$SQL_group = "GROUP BY D.id ";
	$contTotalPGs = fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", $SQL_group);
	$resuM = fSQL::SQL_SELECT_SIMPLES("D.id,D.rm,D.original,D.data_validade,D.obs,D.file,D.validacao,D.scanner_user,D.scanner_time,D.user,D.time,T.legenda AS tipo",$SQL_tabela , $SQL_where, $SQL_group."ORDER BY D.time DESC", $limit.",".$limit_total);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$rm = $linha["rm"];
		$original = $linha["original"];
		$data_validade = data_mysql($linha["data_validade"]);
		$obs = $linha["obs"];
		$file = $linha["file"];
		$validacao = $linha["validacao"];
		$scanner_user = $linha["scanner_user"];
		$scanner_time = $linha["scanner_time"];
		$user = $linha["user"];
		$time = $linha["time"];
		$tipo = $linha["tipo"];
		if($original >= "1"){ $original = " - [<i class=\"icon-ok\"></i> ORIGINAL]"; }else{ $original = ""; }
		if($data_validade != ""){ $data_validade = ", Validade: ".$data_validade; }
		if($obs != ""){ $obs = "<i>".$obs."</i><br>"; }
		
		$validacao_leg = legValDOCs($validacao);
		if($validacao >= "2"){ 
			$validacao_leg .= ' <button type="button" class="btn btn-small" rel="tooltip" data-placement="top" title="Ver detalhes" onClick="pmodalHtml(\'<i class=icon-tag></i> DETALHES DA VALIDAÇÃO REALIZADA\',\''.$AJAX_PAG.'\',\'get\',\''.$faisherGet.'&ajax=valDocsVer&id='.$id.'&file='.$file.'\');"><i class="icon-external-link"></i> Detalhes</button>';
		}
		if($validacao_leg != ""){ $validacao_leg = $validacao_leg."<br>"; }
		
		$i_cont++;		
		$caminho_file = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_docs/doc-".$id.".".fGERAL::mostraExtensao($file);
		if(!file_exists($caminho_file)){ $caminho_file = ""; }

?>
            <tr id="tr<?=$INC_FAISHER["div"]?><?=$id?>">
                <td style="text-align:center;"><?php if($caminho_file == ""){ echo 'SEM ICO'; }else{?><a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="img_<?=$id?>"><?=$cVLogin->icoFile($caminho_file, "")?></a><br><?=fGERAL::tmFile($caminho_file)?><?php }?></td>
              <td><div class="display"><?php if($scanner_time == "1"){?><div style="color:#FD0004;">AGUARDANDO INSERÇÃO DO DEPTO DE SCANNER (nº<?=$scanner_user?>)</div><?php }?>
			  <?=$tipo?><?=$data_validade?><?=$original?></div><?=$validacao_leg?><?=$obs?><span style="font-size:9px;"><?=$user?> - <?=date("d/m/Y H:i",$time)?>h</span>
              <?php if($scanner_time > "10"){?><div style="color:#006008; font-size:9px;">SCANNER POR <?=$scanner_user?> - <?=date("d/m/Y H:i",$scanner_time)?>h</div><?php }?></td>
              	<td><div class="display"><?php if($rm != ""){ echo SYS_CONFIG_RM_SIGLA." ".$rm; }else{ echo '- -'; }?></div></td>
                <td style="text-align:center;"><?php if($view == "1"){}else{ if($rm == ""){?><button type="button" class="btn" onclick="delLinhaDOCs<?=$INC_FAISHER["div"]?>('<?=$id?>','','tr<?=$INC_FAISHER["div"]?><?=$id?>');" rel="tooltip" data-placement="left" title="Excluir"><i class="icon-trash"></i></button><?php }}?>
                <?php if($caminho_file != ""){?><div style="margin-top:2px;"><a href="downloads.php?<?=$cVLogin->varsDownalod($caminho_file, $file)?>" class="btn" rel="tooltip" data-placement="left" title="Download"><i class="icon-download-alt"></i></a></div><?php }?></td>
            </tr>
<?php

	
	}//fim while

}else{//if($id_a >= "1"){


	$SQL_tabela = "cad_candidato_juridico_docs D, cad_candidato_docs_tipo T";
	$SQL_where = "D.candidato_juridico_id = '0' AND temp = '$array_temp' AND D.tipo_id = T.id";
	if($docs_b != ""){ $SQL_where .= " AND ( D.`data_validade` LIKE '%$docs_b%' OR D.`obs` LIKE '%$docs_b%' OR D.`file` LIKE '%$docs_b%' OR D.`scanner_user` LIKE '%$docs_b%' OR D.`user` LIKE '%$docs_b%' OR T.`legenda` LIKE '%$docs_b%' )"; }
	$SQL_group = "GROUP BY D.id ";
	$contTotalPGs = fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", $SQL_group);
	$resuM = fSQL::SQL_SELECT_SIMPLES("D.id,D.rm,D.original,D.data_validade,D.obs,D.file,D.validacao,D.scanner_user,D.scanner_time,D.user,D.time,T.legenda AS tipo",$SQL_tabela ,$SQL_where , $SQL_group."ORDER BY D.time DESC", $limit.",".$limit_total);
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$rm = $linha["rm"];
		$original = $linha["original"];
		$data_validade = $linha["data_validade"];
		$obs = $linha["obs"];
		$file = $linha["file"];
		$validacao = $linha["validacao"];
		$scanner_user = $linha["scanner_user"];
		$scanner_time = $linha["scanner_time"];
		$user = $linha["user"];
		$time = $linha["time"];
		$tipo = $linha["tipo"];
		if($original >= "1"){ $original = " - [<i class=\"icon-ok\"></i> ORIGINAL]"; }else{ $original = ""; }
		if($data_validade != ""){ $data_validade = ", Validade: ".$data_validade; }
		if($obs != ""){ $obs = "<i>".$obs."</i><br>"; }
		$validacao = legValDOCs($validacao);
		if($validacao != ""){ $validacao = $validacao."<br>"; }
		$i_cont++;		
		$caminho_file = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_docs/doc-".$id.".".fGERAL::mostraExtensao($file);
		if(!file_exists($caminho_file)){ $caminho_file = ""; }

?>
          <tr id="tr<?=$INC_FAISHER["div"]?><?=$id?>">
                <td style="text-align:center;"><?php if($caminho_file == ""){ echo 'SEM ICO'; }else{?><a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="img_<?=$id?>"><?=$cVLogin->icoFile($caminho_file, "")?></a><br><?=fGERAL::tmFile($caminho_file)?><?php }?></td>
                <td><div class="display"><?php if($scanner_time == "1"){?><div style="color:#FD0004;">AGUARDANDO INSERÇÃO DO DEPTO DE SCANNER (nº<?=$scanner_user?>)</div><?php }?>
				<?=$tipo?><?=$data_validade?><?=$original?></div>
				<?=$validacao?><?=$obs?><span style="font-size:9px;"><?=$user?> - <?=date("d/m/Y H:i",$time)?>h</span></td>
              	<td><div class="display"><?php if($rm != ""){ echo SYS_CONFIG_RM_SIGLA." ".$rm; }else{ echo '- -'; }?></div></td>
                <td style="text-align:center;"><button type="button" class="btn" onclick="delLinhaDOCs<?=$INC_FAISHER["div"]?>('<?=$id?>','<?=$array_temp?>','tr<?=$INC_FAISHER["div"]?><?=$id?>');" rel="tooltip" data-placement="left" title="Excluir"><i class="icon-trash"></i></button>
                <?php if($caminho_file != ""){?><div style="margin-top:2px;"><a href="downloads.php?<?=$cVLogin->varsDownalod($caminho_file, $file)?>" class="btn" rel="tooltip" data-placement="left" title="Download"><i class="icon-download-alt"></i></a></div><?php }?></td>
            </tr>
<?php

	
	}//fim while

}//if($id_a >= "1"){
	









$limitGet = $i_cont+$limit;
if($limitGet < $contTotalPGs){
	$faltam = $contTotalPGs-$limitGet;
	if($faltam > $limit_total){ $faltam = $limit_total; }
?>
	<tr>
		<td colspan="4" style="text-align:center;" id="bt<?=$limit?>-docs<?=$INC_FAISHER["div"]?>">
<button type="button" class="btn" rel="tooltip" data-original-title="Carregar mais linhas de documentos" onclick="faisher_ajax('tabela-docs<?=$INC_FAISHER["div"]?>', 'div_listaDOCs<?=$INC_FAISHER["div"]?>load', '<?=$AJAX_PAG?>', '<?=$get_Pg?>&limit=<?=$limitGet?>&docs_b=<?=$docs_b?>&scriptoff', 'get', 'ON');$('#bt<?=$limit?>-docs<?=$INC_FAISHER["div"]?>').fadeOut();"><i class="icon-double-angle-down"></i> carregar mais <?=$faltam?> linha(s) <i class="icon-double-angle-down"></i></button> 
        </td>
	</tr>
<?php
}//if($limitGet < $contTotalPGs){	
if(($i_cont == "0") and ($limit == "0")){
?>
            <tr>
                <td colspan="4"><br>:: Sem documentos ou anexos localizados ::<br><br><br>
				<?php if(($view == "1") and (isset($_GET["hide"]))){?>
<script>
$.doTimeout('vTimerDocsClose', 500, function(){ $('#<?=$_GET["hide"]?>').hide(); });//TIMER
</script>
				<?php }?>
                </td>
            </tr>
<?php
}//fim if(($i_cont == "0") and ($limit == "0")){
	
	
	
//executar script de load rolagem ---  ########### rolagem faisher ################# ++++
?>
	<tr>
		<td colspan="4" style="display:none;">
<script>
$.doTimeout('vTimerRol<?=$id_Rolagem?>', 1000, function(){ resize_Tela<?=$id_Rolagem?>(); });//TIMER
</script>
        </td>
	</tr>
<?php
	
	
	
	

	
//verifica se exibe cabeçalho
if($limit == "0"){
?>
		</tbody>
	</table>
</div></div>
	<span class="help-block"><i class="icon-info-sign"></i> Localizados <b><span id="tPg<?=$id_Rolagem?>"><?=$contTotalPGs?></span></b> documento(s).</span>
<?php


}//if($limit == "0"){
	
?>
<?php


	


}//fim ajax -------------------<<<<



























































//* ------------------------------------- ##### DADOS DO REGISTRO PADRAO #### --------------------------------------------*//





//AJAX QUE VISUALIZA REGISTRO ------------------------------------------------------------------>>>
if($ajax == "visualizar"){
	$id_a = $_GET["id_a"];
	$cont_encontrou = "0";

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formVisualizaPincipal = "formVisualizaPincipal".$array_temp;
	$tabela_lerLog = "cad_candidato_juridico";

	//faz o proximo e anterior
	$anterior = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$id_a'", "ORDER BY id DESC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $anterior = $linha1["id"]; }//fim while
	$proximo = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$id_a'", "ORDER BY id ASC", "1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $proximo = $linha1["id"]; }//fim while
	

if($id_a != "0"){
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_DUPLO($campos, "cad_candidato_juridico", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$code_a = $linha1["code"];
	$propriedade_id_a = $linha1["propriedade_id"];
	$tipo_id_a = $linha1["tipo_id"];
	$natureza_id_a = $linha1["natureza_id"];
	$nome_a = $linha1["nome"];
	$fantasia_a = $linha1["fantasia"];
	$insc_estadual_a = $linha1["insc_estadual"];
	$insc_municipal_a = $linha1["insc_municipal"];
	$data_abertura_a = data_mysql($linha1["data_abertura"]);
	$time_baixa_a = $linha1["time_baixa"];
	$insc_junta_a = $linha1["insc_junta"];
	$data_junta_a = data_mysql($linha1["data_junta"]);
	$endereco_correspondencia_id_a = $linha1["endereco_correspondencia_id"];
	$admin_candidato_fisico_id_a = $linha1["admin_candidato_fisico_id"];
	$admin_candidato_juridico_id_a = $linha1["admin_candidato_juridico_id"];
	$admin_candidato_cotas_a = $linha1["admin_candidato_cotas"];
	$socio_candidato_fisico_a = arrayDB($linha1["socio_candidato_fisico"]);
	$socio_candidato_juridico_a = arrayDB($linha1["socio_candidato_juridico"]);
	$declara_dms_a = $linha1["declara_dms"];
	$simples_time_ini_a = $linha1["simples_time_ini"];
	$simples_time_fim_a = $linha1["simples_time_fim"];
	$cnae_principal_a = $linha1["cnae_principal"];
	$cnae_objetivo_a = $linha1["cnae_objetivo"];
	$obs_geral_a = $linha1["obs_geral"];
	$codigo_energia_a = $linha1["codigo_energia"];	
	$referencia_a = $linha1["referencia"];		
	$user_a = $linha1["user"];//quem realizou o cadastro
	$time_a = $linha1["time"]; //quando foi realizado o cadastro
	$user_a_a = $linha1["user_a"];//quel alterou o cadastro
	$sync_a = $linha1["sync"]; //quando foi alterado o cadastro
	$cont_encontrou++;
	}//fim while

}//fim do if if($id_a != "0"){





//verifica se nao encontrou nada
if($cont_encontrou == "0"){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!");
	//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
	$cMSG->imprimirMSG();//imprimir mensagens criadas
	exit(0);
}//verifica se nao encontrou nada
	
	
	
	
	

	



	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,legenda", "cad_candidato_juridico_tipo", "id = '$tipo_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$legenda_i = $linha["legenda"];
		$tipo_id_a_n = $id_i.' - <b>'.$legenda_i.'</b>';
	}//fim while



	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,codigo,legenda", "cad_candidato_juridico_natureza", "id = '$natureza_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$codigo = $linha["codigo"];
		$legenda_i = $linha["legenda"];
		$natureza_id_a_n = $codigo.' - <b>'.$legenda_i.'</b>';
	}//fim while
	
	

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,codigo,legenda", "combo_cnae_subclasse", "id = '$cnae_principal_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$codigo_i = $linha["codigo"];
		$legenda_i = $linha["legenda"];
		$cnae_principal_a_n = 'Código: '.$codigo_i.'<br><b>'.$legenda_i.'</b>';
	}//fim while
	

	//monta array de dados
	$cnae_secundaria_a_n = "";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("S.id,S.codigo,S.legenda", "cad_candidato_juridico_cnae C, combo_cnae_subclasse S", "C.candidato_juridico_id = '$id_a' AND C.cnae_subclasse_id = S.id","GROUP BY C.id");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$codigo_i = $linha["codigo"];
		$legenda_i = $linha["legenda"];
		if($cnae_secundaria_a_n != ""){ $cnae_secundaria_a_n .= '<div style="clear:both; border-bottom:#CCC 2px solid; height:10px;"></div>'; }
		$cnae_secundaria_a_n .= 'Código: '.$codigo_i.'<br><b>'.$legenda_i.'</b>';
	}//fim while
	//fim for exibe array
	


	

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,code,nome", "cad_candidato_fisico", "id = '$admin_candidato_fisico_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id = $linha["id"];
		$code = $linha["code"];
		$legenda = $linha["nome"];
		$admin_candidato_fisico_id_a_n = $cVLogin->popDetalhes("V",$id,"3_con_candidatofisico","DETALHES DO CANDIDATO").fGERAL::legCode($id,$code)." - <b>".$legenda."</b><br>".SYS_CONFIG_RM_SIGLA.". ".$code."<div style='clear:both; border-top:#E0E0E0 1px solid;'></div>";
	}//fim while



	$candidato_responsavel_a = "";
	if($admin_candidato_fisico_id_a >= "1"){
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES("id,code,nome", "cad_candidato_fisico", "id = '$admin_candidato_fisico_id_a'");
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["id"];
			$code = $linha["code"];
			$legenda = $linha["nome"];
			$admin_candidato_id_n = $cVLogin->popDetalhes("V",$id,"3_con_candidatofisico","DETALHES DO CANDIDATO").fGERAL::legCode($id,$code)." - <b>".$legenda."</b><br>".SYS_CONFIG_RM_SIGLA.". ".$code;
		}//fim while
		$candidato_responsavel_a = "FÍSICO";
	}//if($admin_candidato_fisico_id_a >= "1"){

	
	
	if($admin_candidato_juridico_id_a >= "1"){
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES("id,code,nome", "cad_candidato_juridico", "id = '$admin_candidato_juridico_id_a'");
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["id"];
			$code = $linha["code"];
			$legenda = $linha["nome"];
			$admin_candidato_id_n = $cVLogin->popDetalhes("V",$id,"3_con_candidatofisico","DETALHES DO CANDIDATO").fGERAL::legCode($id,$code)." - <b>".$legenda."</b>".$code;
		}//fim while
		$candidato_responsavel_a = "JURÍDICO";
	}//if($admin_candidato_juridico_id_a >= "1"){
		
	
	
//dados endereço de sede
	$resu1 = fSQL::SQL_SELECT_SIMPLES("*", "cad_candidato_juridico_endereco", "candidato_juridico_id = '$id_a'", "","1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$sede_id_end = $linha1["id"];
		$sede_pais_a = $linha1["pais"];
		$sede_uf_a = $linha1["uf"];
		$sede_cidade_id_a = $linha1["cidade_id"];
		$sede_bairro_a = $linha1["bairro"];
		$sede_logradouro_a = $linha1["logradouro"];
		$sede_quadra_a = $linha1["quadra"];
		$sede_lote_a = $linha1["lote"];
		$sede_numero_a = $linha1["numero"];
		$sede_complemento_a = $linha1["complemento"];
		$sede_bloco_a = $linha1["bloco"];
		$sede_sala_a = $linha1["sala"];
		$sede_cep_a = $linha1["cep"];
	}//fim while

	//busca UF
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("uf_sigla,uf_nome", "combo_uf", "uf_sigla = '$sede_uf_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["uf_sigla"];
		$legenda_i = $linha["uf_nome"];
		$sede_uf_a_n = $legenda_i;
	}//fim while

	//busca CIDADE
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,cidade_nome,uf", "combo_cidades", "id = '$sede_cidade_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$legenda_i = $linha["cidade_nome"];
		$uf_i = $linha["uf"];
		$sede_cidade_id_a_n = $legenda_i.'/'.$uf_i;
	}//fim while	
	
		



	if($propriedade_id_a >= "1"){
		$campos = "P.id,P.code,P.candidato_cotas,P.sync,T.legenda AS tipo,CF.nome AS fis_nome,CF.datan AS fis_data,CJ.fantasia AS jur_nome,CJ.data_abertura AS jur_data,A.quadra,A.lote,L.legenda AS logradouro,N.numero";
		$SQL_join = "INNER JOIN geo_propriedade_tipo T INNER JOIN geo_area A INNER JOIN geo_area_logradouro L LEFT JOIN cad_candidato_fisico CF ON P.candidato_fisico_id = CF.id LEFT JOIN cad_candidato_juridico CJ ON P.candidato_juridico_id = CJ.id LEFT JOIN geo_propriedade_numerooficial N ON P.id = N.propriedade_id AND N.principal = '1'"; //join
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, "geo_propriedade P", "P.id = '$propriedade_id_a' AND P.tipo_id = T.id AND P.area_id = A.id AND A.logradouro_id = L.id", "GROUP BY P.id ORDER BY A.id DESC","1", $SQL_join);
		while($linha1 = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha1["id"];
			$code = $linha1["code"];
			$tipo = $linha1["tipo"];
			$candidato_cotas = $linha1["candidato_cotas"];
			$fis_nome = $linha1["fis_nome"];
			$fis_data = $linha1["fis_data"];
			$fis_doc = $linha1["fis_doc"];
			$jur_nome = $linha1["jur_nome"];
			$jur_data = $linha1["jur_data"];
			$jur_doc = $linha1["jur_doc"];
			$valor_data = $linha1["data"];
			$quadra = $linha1["quadra"];
			$lote = $linha1["lote"];
			$logradouro = $linha1["logradouro"];
			$numero = $linha1["numero"];
			$candidato_leg = "Indefinido";
			if(($fis_nome != "") and ($fis_nome != NULL)){
				$candidato_leg = "<b>$fis_nome</b>, ".calcular_idade($fis_data,1);
				$candidato_leg .= " - CANDIDATO FÍSICA - ".SYS_CONFIG_RM_SIGLA.". $fis_doc";
			}//if(($fis_nome != "") and ($fis_nome != NULL)){
			if(($jur_nome != "") and ($jur_nome != NULL)){
				$candidato_leg = "<b>$jur_nome</b>, ".calcular_idade($jur_data,1);
				$candidato_leg .= " - CANDIDATO JURÍDICA";
				if(($jur_doc != "") and ($jur_doc != NULL)){ $candidato_leg .= " - RCCM. $jur_doc"; }
			}//if(($jur_nome != "") and ($jur_nome != NULL)){
			$endereco_leg = "$logradouro";
			if(($numero != "") and ($numero != NULL)){ $endereco_leg .= " - N° $numero, Qd. $quadra, Lt. $lote"; }else{ $endereco_leg .= " - Qd. $quadra, Lt. $lote"; }
		
			$propriedade_id_n = $cVLogin->popDetalhes("V",$id,"4_pri_propriedades","DETALHES DA PROPRIEDADE")."<b>".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code)."</b> - ".$tipo.', '.$endereco_leg.'<br>'.$candidato_leg;
		}//fim while		
	}//if($propriedade_id_a >= "1"){		
		

	
	
//dados endereço de correspondencia
	$resu1 = fSQL::SQL_SELECT_SIMPLES("*", "cad_candidato_juridico_enderecocorrespondencia", "candidato_juridico_id = '$id_a'", "","1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_end = $linha1["id"];
		$uf_a = $linha1["uf"];
		$cidade_id_a = $linha1["cidade_id"];
		$bairro_a = $linha1["bairro"];
		$logradouro_a = $linha1["logradouro"];
		$quadra_a = $linha1["quadra"];
		$lote_a = $linha1["lote"];
		$numero_a = $linha1["numero"];
		$complemento_a = $linha1["complemento"];
		$bloco_a = $linha1["bloco"];
		$sala_a = $linha1["sala"];
		$cep_a = $linha1["cep"];
	}//fim while

	//busca UF
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("uf_sigla,uf_nome", "combo_uf", "uf_sigla = '$uf_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["uf_sigla"];
		$legenda_i = $linha["uf_nome"];
		$uf_a_n = $legenda_i;
	}//fim while

	//busca CIDADE
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,cidade_nome,uf", "combo_cidades", "id = '$cidade_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$legenda_i = $linha["cidade_nome"];
		$uf_i = $linha["uf"];
		$cidade_id_a_n = $legenda_i.'/'.$uf_i;
	}//fim while	

	

	

	


?>

<script type="text/javascript">
$(document).ready(function(){
	//JQUERY executa com ESC
    $(document).keyup(function(e){
        var tecla = (e.keyCode?e.keyCode:e.which);
        /* verifica se a tecla pressionada foi o ESC */
        if(tecla == 27){ if($('#idFaisher').val() == "<?=$INC_FAISHER["permissao"]?>"){ displayAcao<?=$INC_FAISHER["div"]?>('fecha'); }	}
    });
	//FIM JQUERY executa com ESC
	
	$('#c_id<?=$INC_FAISHER["div"]?>').val('<?=$id_a?>');//alimenta id de abertura
	$('#bt_visual<?=$INC_FAISHER["div"]?>').hide();
	$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('VISUALIZAR DADOS DE CANDIDATO JURÍDICO <?=SYS_CONFIG_RM_SIGLA?> <?=fGERAL::legCode($id_a,$code_a)?>');

});
<?php if(isset($_GET["POP"])){ $anterior="0";$proximo="0"; ?>
	
<?php }else{ //if(isset($_GET["POP"])){ ?>
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); });//TIMER
<?php }//else{ //if(isset($_GET["POP"])){ ?>
</script>

<form nome="<?=$formVisualizaPincipal?>" id="<?=$formVisualizaPincipal?>" method="post" class="form-horizontal form-column form-bordered form-validate" action="export.php" target="_blank">
             <div style="padding-top:1px;" id="formVisualizarMSG<?=$INC_FAISHER["div"]?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosger".$array_temp;//id de controle
						$boxUI_titulo = "Dados Cadastrais";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
										<div class="control-group row-fluid">
										<?php $cont_exib++; $d["content"] = SYS_CONFIG_RM_LEG."[,]".fGERAL::legCode($id_a,$code_a); $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label"><?=SYS_CONFIG_RM_LEG_HTML?></label>
                                                <div class="pagination pagination-large">
                                                    <ul>
                                                        <li><a href="#" id="selc<?=$INC_FAISHER["div"]?>" onclick="SelectText('selc<?=$INC_FAISHER["div"]?>');return false;" style="border:0; font-size:28px;" rel="tooltip" data-placement="bottom" data-original-title="Registro atual (clique para selecionar)"><?=fGERAL::legCode($id_a,$code_a)?></a></li>
                                                    </ul>
                                                </div>
                                            </div>
										</div>
										</div>
                                        <?php if(($tipo_id_a_n != "") or ($natureza_id_a_n != "")){ ?>
                                        <div class="control-group row-fluid">                                        
										<?php if($tipo_id_a_n != ""){ $cont_exib++; $d["content"] = "Tipo de empresa[,]".$tipo_id_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($natureza_id_a_n != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Tipo de empresa</label>
                                                <div class="controls display">
                                                  <?=$tipo_id_a_n?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                            
										<?php if($natureza_id_a_n != ""){ $cont_exib++; $d["content"] = "Natureza jurídica[,]".$natureza_id_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($tipo_id_a_n != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Natureza jurídica</label>
                                                <div class="controls display">
                                                  <?=$natureza_id_a_n?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?> 
										</div>
                                        <?php }//if(($tipo_id_a_n != "") or ($natureza_id_a_n != "")){ ?>
                                        
                                        <?php if(($nome_a != "") or ($fantasia_a != "")){ ?>
                                        <div class="control-group row-fluid">                                        
										<?php if($nome_a != ""){ $cont_exib++; $d["content"] = "Razão social[,]".$nome_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($fantasia_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Razão social</label>
                                                <div class="controls display">
                                                  <?=$nome_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                            
										<?php if($fantasia_a != ""){ $cont_exib++; $d["content"] = "Nome fantasia[,]".$fantasia_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($nome_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Nome fantasia</label>
                                                <div class="controls display">
                                                  <?=$fantasia_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?> 
										</div>
                                        <?php }//if(($nome_a != "") or ($fantasia_a != "")){ ?>
                                        
										<?php if($data_abertura_a != ""){ $cont_exib++; $d["content"] = "Data de abertura[,]".$data_abertura_a.", ".calcular_idade($data_abertura_a)." anos"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="control-group">
                                            <label class="control-label">Data de abertura</label>
                                            <div class="controls display">
                                                <?=$data_abertura_a.", ".calcular_idade($data_abertura_a)." anos"?>
                                            </div>
                                        </div>
                                        <?php }?> 
                                        
          
										<?php if($insc_municipal_a != ""){ $cont_exib++; $d["content"] = "NIF[,]".$insc_municipal_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="control-group">
                                            <label class="control-label">NIF</label>
                                            <div class="controls display">
                                              <?=$insc_municipal_a?>
                                            </div>
                                        </div>
                                        <?php }?>                                           
                                        
										<?php if($insc_junta_a != ""){ $cont_exib++; $d["content"] = "Serviço de Criação[,]".$insc_junta_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="control-group">
                                            <label class="control-label">Serviço de Criação</label>
                                            <div class="controls display">
                                              <?=$insc_junta_a?>
                                            </div>
                                        </div>
                                        <?php }?>                                           
										<?php if($obs_geral_a != ""){ $cont_exib++; $d["content"] = "Observações gerais[,]".imprime_enter($obs_geral_a); $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Observações gerais</label>
											<div class="controls display">
											  <?=imprime_enter($obs_geral_a)?>
											</div>
										</div>
                                        <?php }?>     

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>    





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "ddadoscnae".$array_temp;//id de controle
						$boxUI_titulo = "Classificação Nacional de Atividades Econômicas - CNAE";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                          
										<?php if($cnae_principal_a_n != ""){ $cont_exib++; $d["content"] = "Atividade principal[,]".$cnae_principal_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Atividade principal</label>
											<div class="controls display">
											  <?=$cnae_principal_a_n?>
											</div>
										</div>
                                        <?php }?>   
										<?php if($cnae_objetivo_a != ""){ $cont_exib++; $d["content"] = "Objetivo[,]".imprime_enter($cnae_objetivo_a); $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Objetivo</label>
											<div class="controls display">
											  <?=imprime_enter($cnae_objetivo_a)?>
											</div>
										</div>
                                        <?php }?>   
										<?php if($cnae_secundaria_a_n != ""){ $cont_exib++; $d["content"] = "Atividade(s) secundária(s)[,]".$cnae_secundaria_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Atividade(s) secundária(s)</label>
											<div class="controls display">
											  <?=$cnae_secundaria_a_n?>
											</div>
										</div>
                                        <?php }?>     

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>    

            
            






                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosfoto".$array_temp;//id de controle
						$boxUI_titulo = " Imagem de Logo/Logomarca";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<i class="icon-camera"></i> <?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                                                                
										<div class="control-group" id="listaFiles<?=$boxUI_id?>">
											<label class="control-label">Arquivos recebidos</label>
											<div class="controls">

								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th style="width:150px;">ICO</th>
											<th>Dados/Arquivo</th>
											<th style="width:30px;">Ação</th>
										</tr>
									</thead>
									<tbody>
<?php



//cad_candidato_juridico_logo
if($id_a >= "1"){
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,file,time", "cad_candidato_juridico_logo", "candidato_juridico_id = '$id_a'", "ORDER BY time ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$file_i = $linha1["file"];
		$time_i = $linha1["time"];		
		$caminho_file = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_logo/".$id_i.".".fGERAL::mostraExtensao($file_i);
		if(file_exists($caminho_file)){
			$cont_exib++;
			
	//adiciona no array print
	$d["content"] = '<br><img src="'.$cVLogin->icoFile($caminho_file, "RETORNAURL").'" width="58" />, '.$file_i.', '.fGERAL::tmFile($caminho_file).', ('.date('d/m/Y H:i',$time_i).")"; $d["type"] = "html"; $PRINT_ARRAY[] = $d;
?>        
										<tr id="tb_files<?=$INC_FAISHER["div"]?><?=$id_i?>">
											<td>
											<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="img_<?=$INC_FAISHER["div"]?><?=$id_a?>"><?=$cVLogin->icoFile($caminho_file, "")?></a></td>
											<td><b><?=$file_i?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td>
												<a href="#" onclick="$('#img_<?=$INC_FAISHER["div"]?><?=$id_a?>').click();return false;" class="btn" rel="tooltip" title="Visualizar"><i class="icon-search"></i></a>
												<a href="downloads.php?<?=$cVLogin->varsDownalod($caminho_file, $file_i)?>" class="btn" rel="tooltip" title="Download"><i class="icon-download-alt"></i></a>
                                          </td>
										</tr>
<?php 
		}//fim do if file_exists
	}//fim do while 
}//if($id_a >= "1"){
?>
									</tbody>
								</table>
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>   
            
            





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadssocis".$array_temp;//id de controle
						$boxUI_titulo = "Sócios/Responsável (cotas)";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
<?php
	if($candidato_responsavel_a != ""){ $cont_exib++; $d["content"] = "Responsável[,]".$candidato_responsavel_a." - ".$admin_candidato_cotas_a."%"; $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
										<div class="control-group">
											<label class="control-label">Responsável</label>
											<div class="controls display">
	<table class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th style="width:150px;">Tipo</th>
				<th>Nome Responsável Pessoa Física</th>
				<th style="width:100px;">Cotas %</th>
			</tr>
		</thead>
        <tbody>
            <tr>                
                <td class="display"><?=$candidato_responsavel_a?></td>
                <td class="display"><?=$admin_candidato_id_n?></td>
                <td class="display"><?=$admin_candidato_cotas_a?>%</td>
            </tr>
   
        </tbody>
	</table>
											</div>
										</div> 
<?php }?>
                                        
										<div class="control-group" id="div_sociosFisico<?=$boxUI_id?>">
											<label class="control-label">Sócios pessoa física</label>
											<div class="controls display">
	<table class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th>Nome Sócios Pessoa Física</th>
				<th style="width:100px;">Cotas %</th>
			</tr>
		</thead>
        <tbody>
<?php
$i_cont = "0";
	
	//monta array
	$array = explode(".",$socio_candidato_fisico_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if(($cont_ARRAY >= "1") and ($socio_candidato_fisico_a != "")){
		foreach ($array as $pos => $pos_valor){
			if($pos_valor != ""){
				$arraySUB = explode("-",$pos_valor);
				
				$resu1 = fSQL::SQL_SELECT_SIMPLES("id,code,nome", "cad_candidato_fisico", "id = '".$arraySUB["0"]."'", "");
				while($linha = fSQL::FETCH_ASSOC($resu1)){
					$id_i = $linha["id"];
					$texto = $cVLogin->popDetalhes("V",$id_i,"3_con_candidatofisico","DETALHES DO CANDIDATO").fGERAL::legCode($linha["id"],$linha["code"])." - <b>".$linha["nome"]."</b><br>".SYS_CONFIG_RM_SIGLA.". ".$linha["code"];
				}

				$i_cont++;
		$cont_exib++; $d["content"] = "Sócios pessoa física[,]".$texto." - ".$arraySUB["1"]."%"; $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr>                
                <td class="display"><?=$texto?></td>
                <td class="display"><?=$arraySUB["1"]?>%</td>
            </tr>
<?php

			}//if($pos_valor != ""){
		}//fim foreach
	
	}//fim if($cont_ARRAY >= "1"){
	if($i_cont == "0"){ echo "<script> $(document).ready(function(){ $('#div_sociosFisico".$boxUI_id."').hide(); }); </script>"; }
?>
    
        </tbody>
	</table>
											</div>
										</div>   
                                        
                                        
										<div class="control-group" id="div_sociosJuridico<?=$boxUI_id?>">
											<label class="control-label">Sócios pessoa jurídica</label>
											<div class="controls display">
	<table class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th>Nome Sócios Pessoa Jurídico</th>
				<th style="width:100px;">Cotas %</th>
			</tr>
		</thead>
        <tbody>
<?php
$i_cont = "0";
	
	//monta array
	$array = explode(".",$socio_candidato_juridico_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if(($cont_ARRAY >= "1") and ($socio_candidato_juridico_a != "")){
		foreach ($array as $pos => $pos_valor){
			if($pos_valor != ""){
				$arraySUB = explode("-",$pos_valor);
				
				$resu1 = fSQL::SQL_SELECT_SIMPLES("id,code,nome", "cad_candidato_juridico", "id = '".$arraySUB["0"]."'", "");
				while($linha = fSQL::FETCH_ASSOC($resu1)){
					$id_i = $linha["id"];
					$texto = $cVLogin->popDetalhes("V",$id_i,"3_con_candidatojuridico","DETALHES DO CANDIDATO").fGERAL::legCode($linha["id"],$linha["code"])." - <b>".$linha["nome"]."</b><br>".SYS_CONFIG_RM_SIGLA.". ".$linha["code"];
				}

				$i_cont++;
		$cont_exib++; $d["content"] = "Sócios pessoa jurídica[,]".$texto." - ".$arraySUB["1"]."%"; $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr>                
                <td class="display"><?=$texto?></td>
                <td class="display"><?=$arraySUB["1"]?>%</td>
            </tr>
<?php

			}//if($pos_valor != ""){
		}//fim foreach
	
	}//fim if($cont_ARRAY >= "1"){
	if($i_cont == "0"){ echo "<script> $(document).ready(function(){ $('#div_sociosJuridico".$boxUI_id."').hide(); }); </script>"; }
?>
    
        </tbody>
	</table>
											</div>
										</div>     

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>    
            
            





<?php

//busca lista de procurador
$resu1 = fSQL::SQL_SELECT_SIMPLES("P.id,P.procurador_fisico_id,P.time,P.time_expira,C.code,C.nome", "cad_candidato_juridico_procurador P, cad_candidato_fisico C", "P.candidato_id = '$id_a' AND P.procurador_fisico_id = C.id", "GROUP BY P.id ORDER BY C.nome ASC");
if(fSQL::SQL_CONT($resu1) >= "1"){
?>
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadsprocur".$array_temp;//id de controle
						$boxUI_titulo = "Procurador Físico do Candidato (representante)";// titulo
						$boxUI_status = "1";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
										 
                                        
                                        
										<div class="span12">
	<table class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th>Nome Procurador Pessoa Física</th>
				<th style="width:110px;">Data Expira</th>
			</tr>
		</thead>
        <tbody>
<?php

	//lista procurador carregado anteriormente
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$procurador_fisico_id_i = $linha1["procurador_fisico_id"];
		
		$texto = $cVLogin->popDetalhes("V",$procurador_fisico_id_i,"3_con_candidatofisico","DETALHES DO CANDIDATO").fGERAL::legCode($linha1["procurador_fisico_id"],$linha1["code"])." - <b>".$linha1["nome"]."</b> (".SYS_CONFIG_RM_SIGLA.". ".$linha1["code"].")<br><i>Cadastrado em ".date('d/m/Y H:i', $linha1["time"])."h";

		$i_cont++;
		$cont_exib++; $d["content"] = "Procurador[,]".$texto." - Expira: ".date('d/m/Y', $linha1["time_expira"]); $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr>                
                <td class="display"><?=$texto?></td>
                <td class="display"><?=date('d/m/Y', $linha1["time_expira"])?></td>
            </tr>
<?php
	}//fim while
	
?>
    
        </tbody>
	</table>
											<div style="padding:0px 10px 10px 10px;">
											<span class="help-block"><i class="icon-info-sign"></i> <b>IMPORTANTE!</b> Procurador Físico poderá solicitar serviços no Aplicativo Integrador ou em terminais de auto atendimento.</span>
                                            </div>
										</div> 										     

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
}//if(fSQL::SQL_CONT($resu1) >= "1"){






?>    







            
            





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadscontat".$array_temp;//id de controle
						$boxUI_titulo = "Informações de Contato";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
										<div class="control-group" id="div_celular<?=$boxUI_id?>">
											<label class="control-label">Telefone celular</label>
											<div class="controls display">
	<table class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th style="width:150px;">Tipo</th>
				<th>Nº Telefone Celular</th>
				<th style="width:100px;">Classifica</th>
				<th style="width:40px;">Data</th>
			</tr>
		</thead>
        <tbody>
<?php
$i_cont = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("*", "cad_candidato_juridico_celular", "candidato_juridico_id = '$id_a'", "ORDER BY principal DESC, time ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$tipo_id_i = $linha1["tipo_id"];
		$principal_i = $linha1["principal"];
		$celular_i = $linha1["celular"];
		$time_i = $linha1["time"];
		$linha2 = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_celular_tipo", "id = '$tipo_id_i'");
		$tipo_id_i = $linha2["legenda"];
		if($principal_i >= "1"){ $principal_i = " Principal"; }else{ $principal_i = ""; }
		$i_cont++;
		$cont_exib++; $d["content"] = "Telefone celular ".$i_cont."[,](".$tipo_id_i.") ".$celular_i.$principal_i.", Cad. ".date('d/m/Y',$time_i); $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr>                
                <td><?=$tipo_id_i?></td>
                <td><?=$celular_i?></td>
                <td><?=$principal_i?></td>
                <td><?=date('d/m/Y',$time_i)?></td>
            </tr>
<?php

	}//while
	if($i_cont == "0"){ echo "<script> $(document).ready(function(){ $('#div_celular".$boxUI_id."').hide(); }); </script>"; }
?>
    
        </tbody>
	</table>
											</div>
										</div> 
                                        
                                        
										<div class="control-group" id="div_email<?=$boxUI_id?>">
											<label class="control-label">Email</label>
											<div class="controls display">
	<table class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th style="width:150px;">Tipo</th>
				<th>Endereço de E-mail</th>
				<th style="width:100px;">Classifica</th>
				<th style="width:40px;">Data</th>
			</tr>
		</thead>
        <tbody>
<?php
$i_cont = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("*", "cad_candidato_juridico_email", "candidato_juridico_id = '$id_a'", "ORDER BY principal DESC, time ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$tipo_id_i = $linha1["tipo_id"];
		$principal_i = $linha1["principal"];
		$email_i = $linha1["email"];
		$time_i = $linha1["time"];
		$linha2 = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_email_tipo", "id = '$tipo_id_i'");
		$tipo_id_i = $linha2["legenda"];
		if($principal_i >= "1"){ $principal_i = " Principal"; }else{ $principal_i = ""; }
		$i_cont++;
		$cont_exib++; $d["content"] = "Endereço de e-mail ".$i_cont."[,](".$tipo_id_i.") ".$email_i.$principal_i.", Cad. ".date('d/m/Y',$time_i); $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr>                
                <td><?=$tipo_id_i?></td>
                <td><?=$email_i?></td>
                <td><?=$principal_i?></td>
                <td><?=date('d/m/Y',$time_i)?></td>
            </tr>
<?php

	}//while
	if($i_cont == "0"){ echo "<script> $(document).ready(function(){ $('#div_email".$boxUI_id."').hide(); }); </script>"; }
?>
    
        </tbody>
	</table>
											</div>
										</div>
                                        
										<div class="control-group" id="div_fonefixo<?=$boxUI_id?>">
											<label class="control-label">Telefone fixo</label>
											<div class="controls display">
	<table class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th style="width:150px;">Tipo</th>
				<th>Nº Telefone Fixo</th>
				<th style="width:100px;">Classifica</th>
				<th style="width:40px;">Data</th>
			</tr>
		</thead>
        <tbody>
<?php
$i_cont = "0";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("*", "cad_candidato_juridico_fone", "candidato_juridico_id = '$id_a'", "ORDER BY principal DESC, time ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$tipo_id_i = $linha1["tipo_id"];
		$principal_i = $linha1["principal"];
		$fone_i = $linha1["fone"];
		$time_i = $linha1["time"];
		$linha2 = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_fone_tipo", "id = '$tipo_id_i'");
		$tipo_id_i = $linha2["legenda"];
		if($principal_i >= "1"){ $principal_i = " Principal"; }else{ $principal_i = ""; }
		$i_cont++;
		$cont_exib++; $d["content"] = "Telefone fixo ".$i_cont."[,](".$tipo_id_i.") ".$fone_i.$principal_i.", Cad. ".date('d/m/Y',$time_i); $d["type"] = "text"; $PRINT_ARRAY[] = $d;
?>
            <tr>                
                <td><?=$tipo_id_i?></td>
                <td><?=$fone_i?></td>
                <td><?=$principal_i?></td>
                <td><?=date('d/m/Y',$time_i)?></td>
            </tr>
<?php

	}//while
	if($i_cont == "0"){ echo "<script> $(document).ready(function(){ $('#div_fonefixo".$boxUI_id."').hide(); }); </script>"; }
?>
    
        </tbody>
	</table>
											</div>
										</div>                                              

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>    







                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosendersede".$array_temp;//id de controle
						$boxUI_titulo = "Endereço da Sede do Candidato Jurídico";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                         
										<?php if(($sede_pais_a != "")){ ?>
										<?php $cont_exib++; $d["content"] = "País[,]".$sede_pais_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="control-group">
                                            <label class="control-label">País</label>
                                            <div class="controls display">
                                              <?=$sede_pais_a?>
                                            </div>
                                        </div>
                                        <?php }?>                     
                                        
                                        
										<?php if(($sede_uf_a_n != "") or ($sede_cidade_id_a_n != "")){ ?>
                                        <div class="control-group row-fluid">                                        
										<?php if($sede_uf_a_n != ""){ $cont_exib++; $d["content"] = "Subdivisão[,]".$sede_uf_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Subdivisão/estado</label>
                                                <div class="controls display">
                                                  <?=$sede_uf_a_n?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                     
										<?php if($sede_cidade_id_a_n != ""){ $cont_exib++; $d["content"] = "Prefeitura[,]".$sede_cidade_id_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Prefeitura/cidade</label>
                                                <div class="controls display">
                                                  <?=$sede_cidade_id_a_n?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>    
										</div>
										<?php }//if(($sede_uf_a_n != "") or ($sede_cidade_id_a_n != "")){ ?>
                                        
										<?php if(($sede_logradouro_a != "") or ($sede_bairro_a != "")){ ?>
                                        <div class="control-group row-fluid">                                        
										<?php if($sede_logradouro_a != ""){ $cont_exib++; $d["content"] = "Logradouro[,]".$sede_logradouro_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Logradouro</label>
                                                <div class="controls display">
                                                  <?=$sede_logradouro_a?>
                                                </div>
                                            </div>
										</div>   
                                        <?php }?>                         
										<?php if($sede_bairro_a != ""){ $cont_exib++; $d["content"] = "Setor[,]".$sede_bairro_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Setor</label>
                                                <div class="controls display">
                                                  <?=$sede_bairro_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>    
										</div>
										<?php }//if(($sede_logradouro_a != "") or ($sede_bairro_a != "")){ ?>
                                        
										<?php if(($sede_numero_a != "") or ($sede_complemento_a != "")){ ?>
                                        <div class="control-group row-fluid">            
										<?php if($sede_numero_a != ""){ $cont_exib++; $d["content"] = "Número[,]".$sede_numero_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($sede_complemento_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Número</label>
                                                <div class="controls display">
                                                  <?=$sede_numero_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                                           
										<?php if($sede_complemento_a != ""){ $cont_exib++; $d["content"] = "Complemento[,]".$sede_complemento_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($sede_numero_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Complemento</label>
                                                <div class="controls display">
                                                  <?=$sede_complemento_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>     
										</div>
										<?php }//if(($sede_numero_a != "") or ($sede_complemento_a != "")){ ?>
                                        
										<?php if($sede_quadra_a != ""){ $cont_exib++; $d["content"] = "Tipo de Imóvel[,]".$sede_quadra_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="control-group">
                                            <label class="control-label">Tipo de Imóvel</label>
                                            <div class="controls display">
                                              <?=$sede_quadra_a?>
                                            </div>
                                        </div>
                                        <?php }?>                                           
                                        
										<?php if(($sede_sala_a != "") or ($codigo_energia_a != "")){ ?>
                                        <div class="control-group row-fluid">            
										<?php if($sede_sala_a != ""){ $cont_exib++; $d["content"] = "Sala[,]".$sede_sala_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($codigo_energia_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Sala</label>
                                                <div class="controls display">
                                                  <?=$sede_sala_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                                           
										<?php if($codigo_energia_a != ""){ $cont_exib++; $d["content"] = "Referência[,]".$codigo_energia_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($sede_sala_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Código de Energia</label>
                                                <div class="controls display">
                                                  <?=$codigo_energia_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>     
										</div>
										<?php }//if(($sede_sala_a != "") or ($sede_bloco_a != "")){ ?>
										<?php if($referencia_a != ""){ $cont_exib++; $d["content"] = "Referência[,]".$referencia_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Referência</label>
											<div class="controls display">
											  <?=$referencia_a?>
											</div>
										</div>
                                        <?php }?>     


										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>    







                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosender".$array_temp;//id de controle
						$boxUI_titulo = "Endereço de Correspondência do Candidato Jurídico";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                         
<?php if($endereco_correspondencia_id_a == "0"){ $cont_exib++; $d["content"] = "Usar outro[,]UTILIZAR O MESMO ENDEREÇO DA SEDE"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Usar outro</label>
											<div class="controls display">
											  UTILIZAR O MESMO ENDEREÇO DA SEDE
											</div>
										</div>
<?php }else{//if($endereco_correspondencia_id_a == "0"){?> 
                                        <div class="control-group row-fluid">                                        
										<?php $cont_exib++; $d["content"] = "Subdivisão[,]".$uf_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Subdivisão</label>
                                                <div class="controls display">
                                                  <?=$uf_a_n?>
                                                </div>
                                            </div>
										</div>                        
										<?php $cont_exib++; $d["content"] = "Prefeitura[,]".$cidade_id_a_n; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Prefeitura</label>
                                                <div class="controls display">
                                                  <?=$cidade_id_a_n?>
                                                </div>
                                            </div>
										</div>
										</div>
                                        
                                        <div class="control-group row-fluid">                                        
										<?php $cont_exib++; $d["content"] = "Logradouro[,]".$logradouro_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Logradouro</label>
                                                <div class="controls display">
                                                  <?=$logradouro_a?>
                                                </div>
                                            </div>
										</div>                        
										<?php $cont_exib++; $d["content"] = "Setor[,]".$bairro_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Setor</label>
                                                <div class="controls display">
                                                  <?=$bairro_a?>
                                                </div>
                                            </div>
										</div>
										</div>
                                        
                                        <div class="control-group row-fluid">            
										<?php if($numero_a != ""){ $cont_exib++; $d["content"] = "Número[,]".$numero_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($complemento_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Número</label>
                                                <div class="controls display">
                                                  <?=$numero_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                                           
										<?php if($complemento_a != ""){ $cont_exib++; $d["content"] = "Complemento[,]".$complemento_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($numero_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Complemento</label>
                                                <div class="controls display">
                                                  <?=$complemento_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>     
										</div>
                                        
										<?php if($quadra_a != ""){ $cont_exib++; $d["content"] = "Tipo de Imóvel[,]".$quadra_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="control-group">
                                            <label class="control-label">Tipo de Imóvel</label>
                                            <div class="controls display">
                                              <?=$quadra_a?>
                                            </div>
                                        </div>
                                        <?php }?>                                           
                                        
                                        <div class="control-group row-fluid">            
										<?php if($sala_a != ""){ $cont_exib++; $d["content"] = "Sala[,]".$sala_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($bloco_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Sala</label>
                                                <div class="controls display">
                                                  <?=$sala_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>                                           
										<?php if($bloco_a != ""){ $cont_exib++; $d["content"] = "Referência[,]".$bloco_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
                                        <div class="<?php if($sala_a != ""){echo "span6";}?>">
                                            <div class="control-group">
                                                <label class="control-label">Referência</label>
                                                <div class="controls display">
                                                  <?=$bloco_a?>
                                                </div>
                                            </div>
										</div>
                                        <?php }?>     
										</div>
										<?php if($cep_a != ""){ $cont_exib++; $d["content"] = "Código Postal[,]".$cep_a; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Código Postal</label>
											<div class="controls display">
											  <?=$cep_a?>
											</div>
										</div>
                                        <?php }?>     
<?php }//else//if($endereco_correspondencia_id_a == "0"){?>

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#ac_".$boxUI_id."').hide(); }); </script>"; }else{
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY); }






?>    








                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosdocs".$array_temp;//id de controle
						$boxUI_titulo = "Documentos em Anexo(arquivos)";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="loadDOCs<?=$INC_FAISHER["div"]?>" />
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
										<div class="span12">
												<div id="div_listaDOCs<?=$INC_FAISHER["div"]?>"></div>
<script>
$.doTimeout('vTimerDocsL<?=$INC_FAISHER["div"]?>', 500, function(){ listaDOCs<?=$INC_FAISHER["div"]?>() });//TIMER 

function listaDOCs<?=$INC_FAISHER["div"]?>(){
	faisher_ajax('<?=$formVisualizaPincipal?> #div_listaDOCs<?=$INC_FAISHER["div"]?>', 'loadDOCs<?=$INC_FAISHER["div"]?>', '<?=$AJAX_PAG?>', '<?=$faisherGet?>ajax=listaDOCs&formCadastroPincipal=<?=$formVisualizaPincipal?>&array_temp=<?=$array_temp?>&id_a=<?=$id_a?>&view=1&hide=ac_<?=$boxUI_id?>', 'get', 'ADD');
}//listaDOCs


</script>
										</div>

										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->

            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "infregistro".$array_temp;//id de controle
						$boxUI_titulo = "Informações do Registro";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						$cont_exib = "0";//contador para exibicao dos dados
						?>
  						<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
										
										<?php $cont_exib++; $d["content"] = "Data de cadastro[,]".$user_a.", ".date("d/m/Y H:i",$time_a)."h"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Data de cadastro</label>
											<div class="controls display">
											  <?=$user_a?>, <?=date("d/m/Y H:i",$time_a)?>h
											</div>
										</div>
                                        <?php if(($user_a_a != "") and ($user_a_a != "0")){ $cont_exib++; $d["content"] = "Data de alteração[,]".$user_a_a.", ".date("d/m/Y H:i",$sync_a)."h"; $d["type"] = "text"; $PRINT_ARRAY[] = $d; ?>
										<div class="control-group">
											<label class="control-label">Data de alteração</label>
											<div class="controls display">
											  <?=$user_a_a?>, <?=date("d/m/Y H:i",$sync_a)?>h
											</div>
										</div>
                                        <?php }//if($time_a_a != ""){?>
                                        <?php if($id_a >= "1"){ ?>
										<div class="control-group">
											<label class="control-label">Log</label>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_oculta">
                                            <button type="button" class="btn btn-large" onclick="lerLog('divLerLog<?=$INC_FAISHER["div"]?>','<?=$tabela_lerLog?>','<?=$id_a?>');"><i class="icon-magic"></i> Carregar histórico de alterações do registro <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="divLerLog<?=$INC_FAISHER["div"]?>_load" /></button></div>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_exibe" style="display:none;">
                                            <a href="#" onclick="$('.divLerLog<?=$INC_FAISHER["div"]?>_exibe, #divLerLog<?=$INC_FAISHER["div"]?>').hide();$('.divLerLog<?=$INC_FAISHER["div"]?>_oculta').fadeIn();return false;" class="btn btn-large" rel="tooltip" title="Visualizar"><i class="icon-eye-close"></i> Ocultar</a></div>
											<div class="controls" id="divLerLog<?=$INC_FAISHER["div"]?>"></div>
										</div>
                                        <?php }//if($id_a >= "1"){?>


									  </div><!-- End .accordion-inner -->
									</div>
                            </div>
                                                    <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
                          </div><!-- End .accordion-widget ----------------------------------------------- -->
<?php
//esconde accordion-group acima
unset($d); $d["content"] = $PRINT_ARRAY; $d["titulo"] = $boxUI_titulo; $PRINT_DATA[] = $d; unset($PRINT_ARRAY);





?>  



  									<div class="form-actions">
											<?php if(isset($_GET["POP"])){ ?>
                                            <button type="button" class="btn btn-large" rel="tooltip" data-original-title="Ocultar Janela" onclick="pmodalDisplay('hide');">Fechar Detalhes</button>
											<?php }else{//if(isset($_GET["POP"])){ ?>
                                            <button type="button" class="btn btn-large btn-primary" rel="tooltip" data-original-title="Exportar PDF" onclick="enviaPDF<?=$INC_FAISHER["div"]?>();">Gerar PDF(imprimir)</button>&nbsp;<button type="button" class="btn btn-large btn-primary" rel="tooltip" data-original-title="Exportar CSV" onclick="enviaCSV<?=$INC_FAISHER["div"]?>();">Gerar CSV</button>&nbsp;<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="displayAcao<?=$INC_FAISHER["div"]?>('fecha');">Fechar</button>
											<?php }//if(isset($_GET["POP"])){ ?>
										</div>

  <input name="acao" id="acao" type="hidden" value="print" />
  <input name="nome" id="nome" type="hidden" value="cadastro_candidatojuridico_<?=$id_a?>-<?=date('d-m-Y')?>" />
  <input name="titulo" id="titulo" type="hidden" value="Candidato Jurídico" />
  <input name="dados" id="dados" type="hidden" value="<?=urlencode(serialize($PRINT_DATA))?>" />
  <input name="head" id="head" type="hidden" value="" /><input name="html" id="html" type="hidden" value="" />
</form>
<script type="text/javascript">
//prepara o envio do CSV
function enviaCSV<?=$INC_FAISHER["div"]?>(){
	$('#<?=$formVisualizaPincipal?> #acao').val('csv');
	$('#<?=$formVisualizaPincipal?> #head').val('');
	$('#<?=$formVisualizaPincipal?> #html').val('');
	$('#<?=$formVisualizaPincipal?>').submit();
}
//prepara o envio do PDF
function enviaPDF<?=$INC_FAISHER["div"]?>(){
	$('#<?=$formVisualizaPincipal?> #acao').val('pdf');
	$('#<?=$formVisualizaPincipal?> #head').val('');
	$('#<?=$formVisualizaPincipal?> #html').val('');
	$('#<?=$formVisualizaPincipal?>').submit();
}
</script>
<?php




}//fim ajax  -------------------------------------------- <<<
?>
<?php



















//AJAX QUE EXIBE REGISTRO ------------------------------------------------------------------>>>
if($ajax == "registro"){
	$id_a = $_GET["id_a"];

    //id temp para registro de array
    $array_temp = time().rand(9,99999).$cVLogin->getVarLogin("SYS_USER_ID");
	$formCadastroPincipal = "formCadastroPincipal".$array_temp;
	$tabela_lerLog = "cad_candidato_juridico";

	//faz o proximo e anterior
	if(isset($_GET["anterior"])){ $id_a = "0";
		$anterior = getpost_sql($_GET["anterior"]); if($anterior == ""){ $anterior = "9999999999999999999999"; }
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id < '$anterior'", "ORDER BY id DESC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//anterior
	if(isset($_GET["proximo"])){ $id_a = "0";
		$proximo = getpost_sql($_GET["proximo"]); if($proximo == ""){ $proximo = "0"; }
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id > '$proximo'", "ORDER BY id ASC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//anterior
	if(isset($_GET["code"])){ $id_a = "0";
		$aCode = fGERAL::codeRandRetorno(getpost_sql($_GET["code"]));
		$resu1 = fSQL::SQL_SELECT_SIMPLES("id", $tabela_lerLog, "id = '".$aCode["id"]."'", "ORDER BY id ASC", "1");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){ $id_a = $linha1["id"]; }//fim while
	}//code
	
	//VERIFICA SE CLIENTE TEM O MÓDULO NOS PACOTES: 4.geoprocessamento
	$modulo_geoprocessamento_ver = "4";
	if(!preg_match("/\.".$modulo_geoprocessamento_ver."\./i", SYS_PACOTE_MODULOS)){ $modulo_geoprocessamento_ver = "0"; }//se nao existir no pacote, zera a variavel


if($id_a != "0"){
	$cont = "0";
	$campos = "*";
	$resu1 = fSQL::SQL_SELECT_DUPLO($campos, "cad_candidato_juridico", "id = '$id_a'", "");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
	$id_a = $linha1["id"];
	$code_a = $linha1["code"];
	$propriedade_id_a = $linha1["propriedade_id"];
	$tipo_id_a = $linha1["tipo_id"];
	$natureza_id_a = $linha1["natureza_id"];
	$nome_a = $linha1["nome"];
	$fantasia_a = $linha1["fantasia"];
	$insc_estadual_a = $linha1["insc_estadual"];
	$insc_municipal_a = $linha1["insc_municipal"];
	$data_abertura_a = data_mysql($linha1["data_abertura"]);
	$time_baixa_a = $linha1["time_baixa"];
	$insc_junta_a = $linha1["insc_junta"];
	$data_junta_a = data_mysql($linha1["data_junta"]);
	$endereco_correspondencia_id_a = $linha1["endereco_correspondencia_id"];
	$admin_candidato_fisico_id_a = $linha1["admin_candidato_fisico_id"];
	$admin_candidato_juridico_id_a = $linha1["admin_candidato_juridico_id"];
	$admin_candidato_cotas_a = $linha1["admin_candidato_cotas"];
	$socio_candidato_fisico_a = arrayDB($linha1["socio_candidato_fisico"]);
	$socio_candidato_juridico_a = arrayDB($linha1["socio_candidato_juridico"]);
	$declara_dms_a = $linha1["declara_dms"];
	$simples_time_ini_a = $linha1["simples_time_ini"];
	$simples_time_fim_a = $linha1["simples_time_fim"];
	$cnae_principal_a = $linha1["cnae_principal"];
	$cnae_objetivo_a = $linha1["cnae_objetivo"];
	$obs_geral_a = $linha1["obs_geral"];
	$user_a = $linha1["user"];//quem realizou o cadastro
	$time_a = $linha1["time"]; //quando foi realizado o cadastro
	$user_a_a = $linha1["user_a"];//quel alterou o cadastro
	$sync_a = $linha1["sync"]; //quando foi alterado o cadastro
	$cont++;
	}//fim while
	//verifica se nao encontrou nada
	if($cont == "0"){
		//CRIACAO DE MENSAGEM
		$cMSG->addMSG("ERRO","Erro na localização dos dados, atualize sua janela!<br>Sua permissão foi negada!");
		//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------------- MENSAGENS ------------------------- ||||||||||||||
		$cMSG->imprimirMSG();//imprimir mensagens criadas
		exit(0);
	}//verifica se nao encontrou nada

	

	



	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,legenda", "cad_candidato_juridico_tipo", "id = '$tipo_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$legenda_i = $linha["legenda"];
		$tipo_id_a_data = '{id: "'.$id_i.'", text: "'.$id_i.' - <b>'.$legenda_i.'</b>"}';
	}//fim while



	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,codigo,legenda", "cad_candidato_juridico_natureza", "id = '$natureza_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$codigo = $linha["codigo"];
		$legenda_i = $linha["legenda"];
		$natureza_id_a_data = '{id: "'.$id_i.'", text: "'.$codigo.' - <b>'.$legenda_i.'</b>"}';
	}//fim while
	
	

	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,codigo,legenda", "combo_cnae_subclasse", "id = '$cnae_principal_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$codigo_i = $linha["codigo"];
		$legenda_i = $linha["legenda"];
		$cnae_principal_a_data = '{id: "'.$id_i.'", text: "Código: '.$codigo_i.'<br><b>'.$legenda_i.'</b>"}';
	}//fim while
	

	//monta array de dados
	$cnae_secundaria_a_data = "[";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("S.id,S.codigo,S.legenda", "cad_candidato_juridico_cnae C, combo_cnae_subclasse S", "C.candidato_juridico_id = '$id_a' AND C.cnae_subclasse_id = S.id");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$codigo_i = $linha["codigo"];
		$legenda_i = $linha["legenda"];
		if($cnae_secundaria_a_data != "["){ $cnae_secundaria_a_data .= ","; }
		$cnae_secundaria_a_data .= '{id: "'.$id_i.'", text: "Código: '.$codigo_i.'<br><b>'.$legenda_i.'</b>"}';
	}//fim while
	if($cnae_secundaria_a_data != "["){ $cnae_secundaria_a_data .= "]"; }else{ $cnae_secundaria_a_data = ""; }
	//fim for exibe array

	
	
	if($admin_candidato_fisico_id_a >= "1"){
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES("id,code,nome", "cad_candidato_fisico", "id = '$admin_candidato_fisico_id_a'");
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["id"];
			$code = $linha["code"];
			$legenda = $linha["nome"];
			$html = $cVLogin->popDetalhes("N",$id,"3_con_candidatofisico","DETALHES DO CANDIDATO").fGERAL::legCode($id,$code)." - <b>".$legenda."</b><br>".SYS_CONFIG_RM_SIGLA.". ".$code;
			$admin_candidato_fisico_id_data = '{id: "'.$id.'", text: "'.$html.'</b>"}';
		}//fim while
		$candidato_responsavel_a = "F";
	}//if($admin_candidato_fisico_id_a >= "1"){

	
	
	if($admin_candidato_juridico_id_a >= "1"){
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES("id,code,nome", "cad_candidato_juridico", "id = '$admin_candidato_juridico_id_a'");
		while($linha = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha["id"];
			$code = $linha["code"];
			$legenda = $linha["nome"];
			$html = $cVLogin->popDetalhes("N",$id,"3_con_candidatofisico","DETALHES DO CANDIDATO").fGERAL::legCode($id,$code)." - <b>".$legenda."</b>".$code;
			$admin_candidato_juridico_id_data = '{id: "'.$id.'", text: "'.$html.'</b>"}';
		}//fim while
		$candidato_responsavel_a = "J";
	}//if($admin_candidato_juridico_id_a >= "1"){

	
	
//dados endereço de sede
	$resu1 = fSQL::SQL_SELECT_SIMPLES("*", "cad_candidato_juridico_endereco", "candidato_juridico_id = '$id_a'", "","1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$sede_id_end = $linha1["id"];
		$sede_pais_a = $linha1["pais"];
		$sede_uf_a = $linha1["uf"];
		$sede_cidade_id_a = $linha1["cidade_id"];
		$sede_bairro_a = $linha1["bairro"];
		$sede_logradouro_a = $linha1["logradouro"];
		$sede_quadra_a = $linha1["quadra"];
		$sede_lote_a = $linha1["lote"];
		$sede_numero_a = $linha1["numero"];
		$sede_complemento_a = $linha1["complemento"];
		$sede_bloco_a = $linha1["bloco"];
		$sede_sala_a = $linha1["sala"];
		$sede_cep_a = $linha1["cep"];
	}//fim while

	//preenche campo bairro livre
	if($sede_pais_a != ""){
		$sede_pais_a_data = '{id: "'.$sede_pais_a.'", text: "'.$sede_pais_a.'"}';		
	}//if($sede_bairro_a != ""){

	//busca UF
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("uf_sigla,uf_nome", "combo_uf", "uf_sigla = '$sede_uf_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["uf_sigla"];
		$legenda_i = $linha["uf_nome"];
		$sede_uf_a_data = '{id: "'.$id_i.'", text: "'.$legenda_i.'"}';
	}//fim while

	//busca CIDADE
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,cidade_nome,uf", "combo_cidades", "id = '$sede_cidade_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$legenda_i = $linha["cidade_nome"];
		$uf_i = $linha["uf"];
		$sede_cidade_id_a_data = '{id: "'.$id_i.'", text: "'.$legenda_i.'/'.$uf_i.'"}';
	}//fim while	

	//preenche campo bairro livre
	if($sede_bairro_a != ""){
		$sede_bairro_a_data = '{id: "'.$sede_bairro_a.'", text: "'.$sede_bairro_a.'"}';		
	}//if($sede_bairro_a != ""){

	//preenche campo logradouro livre
	if($sede_logradouro_a != ""){
		$sede_logradouro_a_data = '{id: "'.$sede_logradouro_a.'", text: "'.$sede_logradouro_a.'"}';		
	}//if($sede_logradouro_a != ""){
		
		

	if($modulo_geoprocessamento_ver >= "1"){//VERIFICA SE TEM O MÓDULO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	if($propriedade_id_a >= "1"){
		$campos = "P.id,P.code,P.candidato_cotas,P.sync,T.legenda AS tipo,CF.nome AS fis_nome,CF.datan AS fis_data,CJ.fantasia AS jur_nome,CJ.data_abertura AS jur_data,A.quadra,A.lote,L.legenda AS logradouro,N.numero";
		$SQL_join = "INNER JOIN geo_propriedade_tipo T INNER JOIN geo_area A INNER JOIN geo_area_logradouro L LEFT JOIN cad_candidato_fisico CF ON P.candidato_fisico_id = CF.id LEFT JOIN cad_candidato_juridico CJ ON P.candidato_juridico_id = CJ.id LEFT JOIN geo_propriedade_numerooficial N ON P.id = N.propriedade_id AND N.principal = '1'"; //join
		//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
		$resuM = fSQL::SQL_SELECT_SIMPLES($campos, "geo_propriedade P", "P.id = '$propriedade_id_a' AND P.tipo_id = T.id AND P.area_id = A.id AND A.logradouro_id = L.id", "GROUP BY P.id ORDER BY A.id DESC","1", $SQL_join);
		while($linha1 = fSQL::FETCH_ASSOC($resuM)){
			$id = $linha1["id"];
			$code = $linha1["code"];
			$tipo = $linha1["tipo"];
			$candidato_cotas = $linha1["candidato_cotas"];
			$fis_nome = $linha1["fis_nome"];
			$fis_data = $linha1["fis_data"];
			$fis_doc = $linha1["fis_doc"];
			$jur_nome = $linha1["jur_nome"];
			$jur_data = $linha1["jur_data"];
			$jur_doc = $linha1["jur_doc"];
			$valor_data = $linha1["data"];
			$quadra = $linha1["quadra"];
			$lote = $linha1["lote"];
			$logradouro = $linha1["logradouro"];
			$numero = $linha1["numero"];
			$candidato_leg = "Indefinido";
			if(($fis_nome != "") and ($fis_nome != NULL)){
				$candidato_leg = "<b>$fis_nome</b>, ".calcular_idade($fis_data,1);
				$candidato_leg .= " - CANDIDATO FÍSICA - ".SYS_CONFIG_RM_SIGLA.". $fis_doc";
			}//if(($fis_nome != "") and ($fis_nome != NULL)){
			if(($jur_nome != "") and ($jur_nome != NULL)){
				$candidato_leg = "<b>$jur_nome</b>, ".calcular_idade($jur_data,1);
				$candidato_leg .= " - CANDIDATO JURÍDICA";
				if(($jur_doc != "") and ($jur_doc != NULL)){ $candidato_leg .= " - ".SYS_CONFIG_RM_SIGLA.". $jur_doc"; }
			}//if(($jur_nome != "") and ($jur_nome != NULL)){
			$endereco_leg = "$logradouro";
			if(($numero != "") and ($numero != NULL)){ $endereco_leg .= " - N° $numero, Qd. $quadra, Lt. $lote"; }else{ $endereco_leg .= " - Qd. $quadra, Lt. $lote"; }
		
			$html = $cVLogin->popDetalhes("N",$id,"4_pri_propriedades","DETALHES DA PROPRIEDADE")."<b>".SYS_CONFIG_RM_SIGLA." ".fGERAL::legCode($id,$code)."</b> - ".$tipo.', '.$endereco_leg.'<br>'.$candidato_leg;
			$propriedade_id_data = '{id: "'.$id.'", text: "'.$html.'"}';
		}//fim while		
	}//if($propriedade_id_a >= "1"){*/
	}else{ $propriedade_id_a = "0"; }//if($modulo_geoprocessamento_ver >= "1"){//VERIFICA SE TEM O MÓDULO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		
	
	
//dados endereço de correspondencia
	$resu1 = fSQL::SQL_SELECT_SIMPLES("*", "cad_candidato_juridico_enderecocorrespondencia", "candidato_juridico_id = '$id_a'", "","1");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_end = $linha1["id"];
		$uf_a = $linha1["uf"];
		$cidade_id_a = $linha1["cidade_id"];
		$bairro_a = $linha1["bairro"];
		$logradouro_a = $linha1["logradouro"];
		$quadra_a = $linha1["quadra"];
		$lote_a = $linha1["lote"];
		$numero_a = $linha1["numero"];
		$complemento_a = $linha1["complemento"];
		$bloco_a = $linha1["bloco"];
		$sala_a = $linha1["sala"];
		$cep_a = $linha1["cep"];
	}//fim while

	//busca UF
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("uf_sigla,uf_nome", "combo_uf", "uf_sigla = '$uf_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["uf_sigla"];
		$legenda_i = $linha["uf_nome"];
		$uf_a_data = '{id: "'.$id_i.'", text: "'.$legenda_i.'"}';
	}//fim while

	//busca CIDADE
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,cidade_nome,uf", "combo_cidades", "id = '$cidade_id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$legenda_i = $linha["cidade_nome"];
		$uf_i = $linha["uf"];
		$cidade_id_a_data = '{id: "'.$id_i.'", text: "'.$legenda_i.'/'.$uf_i.'"}';
	}//fim while	

	//preenche campo bairro livre
	if($bairro_a != ""){
		$bairro_a_data = '{id: "'.$bairro_a.'", text: "'.$bairro_a.'"}';		
	}//if($bairro_a != ""){

	//preenche campo logradouro livre
	if($logradouro_a != ""){
		$logradouro_a_data = '{id: "'.$logradouro_a.'", text: "'.$logradouro_a.'"}';		
	}//if($logradouro_a != ""){
		

}//fim do if if($id_a != "0"){




//limpa campos se o registro e novo
if($id_a == "0"){
	$propriedade_id_a = "0";
	$nome_a = "";
	$obs_geral_a = "";
	$cnae_objetivo_a = "";
	$candidato_responsavel_a = "F";
	
	$sede_municipio_a = "1";
	$sede_id_end = "0";
	$sede_pais_a = "";
	$sede_uf_a = "";
	$sede_cidade_id_a = "";
	$sede_bairro_a = "";
	$sede_logradouro_a = "";
	$sede_quadra_a = "";
	$sede_lote_a = "";
	$sede_numero_a = "";
	$sede_complemento_a = "";
	$sede_bloco_a = "";
	$sede_sala_a = "";
	$sede_cep_a = "";
	$endereco_correspondencia_id_a = "0";
	
	$id_end = "0";
	$uf_a = "";
	$cidade_id_a = "";
	$bairro_a = "";
	$logradouro_a = "";
	$quadra_a = "";
	$lote_a = "";
	$numero_a = "";
	$complemento_a = "";
	$bloco_a = "";
	$sala_a = "";
	$cep_a = "";
	
//zera as vars de data
	$user_a = $cVLogin->getVarLogin("SYS_USER_NOME");//quem realizou o cadastro
	$time_a = time(); //quando foi realizado o cadastro
	$user_a_a = "";//quel alterou o cadastro
	$sync_a = time(); //quando foi alterado o cadastro

}//limpa os campos se o registro e novo

?>

<script type="text/javascript">
<?php if(isset($_GET["POP"])){ ?>
	$(document).ready(function(){ $('#<?=$formCadastroPincipal?> #div_idred<?=$INC_FAISHER["div"]?>').html('<b><?php if($id_a >= "1"){ echo fGERAL::legCode($id_a,$code_a); }else{ echo "NOVO REGISTRO";}?></b>'); });
	
<?php }else{ //if(isset($_GET["POP"])){ ?>
	$(document).ready(function(){
		//JQUERY executa com ESC
		/* ao pressionar uma tecla em um campo*/
		$(document).keyup(function(e){
			var tecla = (e.keyCode?e.keyCode:e.which);
			/* verifica se a tecla pressionada foi o ESC */
			if(tecla == 27){ if($('#idFaisher').val() == "<?=$INC_FAISHER["permissao"]?>"){ displayAcao<?=$INC_FAISHER["div"]?>('fecha'); }	}
		});
		//FIM JQUERY executa com ESC
		//JQUERY executa com ENTER
			/* ao pressionar uma tecla em um campo*/
			$("#id_inc<?=$INC_FAISHER["div"]?>").keypress(function(e){
				var tecla = (e.keyCode?e.keyCode:e.which);
				var val = Number($(this).val());
				/* verifica se a tecla pressionada foi o ENTER */
				if((tecla == 13) && (val >= "1")){//codigo a executar	
					janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=0&code='+val);
					return false;/* impede o sumbit caso esteja dentro de um form */
				}
			})
		//FIM JQUERY executa com ENTER
		
		$('#c_id<?=$INC_FAISHER["div"]?>').val('<?=$id_a?>');//alimenta id de abertura
		<?php if($id_a == "0"){ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('CADASTRAR NOVO CANDIDATO JURÍDICO');
		$('#bt_edit<?=$INC_FAISHER["div"]?>, #bt_visual<?=$INC_FAISHER["div"]?>').hide();
		<?php }else{ ?>
		$('#div_displayTitulo<?=$INC_FAISHER["div"]?>').html('EDITAR CADASTRO DE CANDIDATO JURÍDICO <?=SYS_CONFIG_RM_SIGLA?> <?=fGERAL::legCode($id_a,$code_a)?>');
		$('#bt_edit<?=$INC_FAISHER["div"]?>').hide();
		<?php }?>
	
	});
	<?php if($id_a == "0"){ ?>
	$.doTimeout('vTimerCursor<?=$INC_FAISHER["div"]?>', 500, function(){ ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); $("#<?=$formCadastroPincipal?> #tipo_id").focus(); });//TIMER
	<?php }?>
<?php }//else{ //if(isset($_GET["POP"])){ ?>
</script>
<?php

/////////// INCLUDE JS EXCLUSIVO --------------------- 
$INC_JS = ",icheck,";//informar funcao a usar entre VIRGULAS > ,funcao
$INC_JSCSS = $INC_FAISHER["div"];
include "inc/inc_js-exclusivo.php";



?>

<div id="divContent_loader<?=$array_temp?>">
<form id="<?=$formCadastroPincipal?>" name="<?=$formCadastroPincipal?>" action="#" method="POST" class='form-horizontal form-column form-bordered form-validate' enctype='multipart/form-data' onsubmit="sendFormCadastroPincipal<?=$array_temp?>();return false;">

             <input name="id_a" type="hidden" id="id_a" value="<?=$id_a?>" />
             <input name="array_temp" id="array_temp" type="hidden" value="<?=$array_temp?>" />  
             <input name="code" id="code" type="hidden" value="<?=$code_a?>" />  
             <div style="padding-top:1px;" id="formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>"></div>



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadospes".$array_temp;//id de controle
						$boxUI_titulo = "Dados Cadastrais";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                        
										<div class="control-group">
											<label class="control-label"><?=SYS_CONFIG_RM_LEG_HTML?></label>
											<div class="controls" id="div_idred<?=$INC_FAISHER["div"]?>">
												<div class="input-append input-prepend">
													<input type="text" class='input-medium' id="id_inc<?=$INC_FAISHER["div"]?>" placeholder="<?php if($id_a >= "1"){ echo fGERAL::legCode($id_a,$code_a); }else{ echo "NOVO REGISTRO"; }?>" style="text-align:center;" value="<?php if($id_a >= "1"){ echo fGERAL::legCode($id_a,$code_a); }?>" rel="tooltip" data-placement="bottom" data-original-title="Informe para buscar [Enter]">
												</div>
											</div>
										</div>


										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group warning">
                                                <label class="control-label">Tipo de empresa</label>
                                                <div class="controls">
<input type='hidden' value="" name='tipo_id' id='tipo_id' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #tipo_id').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar um tipo >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=tipojuridica&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	<?php if($tipo_id_a_data != ""){?>$("#<?=$formCadastroPincipal?> #tipo_id").select2("data", <?=$tipo_id_a_data?>);<?php }?>
});
</script>
													<span class="help-block"><i class="icon-info-sign"></i> Obrigatório!</span>
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Natureza jurídica </label>
                                                <div class="controls">
<input type='hidden' value="" name='natureza_id' id='natureza_id' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #natureza_id').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar uma natureza >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=naturezajuridica&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	<?php if($natureza_id_a_data != ""){?>$("#<?=$formCadastroPincipal?> #natureza_id").select2("data", <?=$natureza_id_a_data?>);<?php }?>
});
</script>
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group warning">
                                                <label class="control-label">Razão social</label>
                                                <div class="controls">
											  		<input type="text" name="nome" id="nome" value="<?=$nome_a?>" class="span12 cssFonteMai" data-rule-required="true">
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group warning">
                                                <label class="control-label">Nome fantasia</label>
                                                <div class="controls">
                                                  <input type="text" name="fantasia" id="fantasia" value="<?=$fantasia_a?>" class="span12 cssFonteMai" data-rule-required="true">
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group warning">
											<label for="textfield" class="control-label">Data de abertura</label>
											<div class="controls">
                                                  <input type="text" name="data_abertura" id="data_abertura" value="<?=$data_abertura_a?>" class="span12 mask_date datepick" data-rule-required="true">
											</div>
										</div>
										<?php if($time_baixa_a >= "10"){ ?>
										<div class="control-group">
											<label class="control-label">Data da baixa</label>
											<div class="controls display">
											  <?=date('d/m/Y H:i', $time_baixa_a)?>h
											</div>
										</div>
                                        <?php }?>  
                                        <div class="control-group">
                                            <label class="control-label">NIF</label>
                                            <div class="controls">
                                                <input type="text" name="insc_municipal" id="insc_municipal" value="<?=$insc_municipal_a?>" class="span9 cssFonteMai">
                                                <span class="help-block"><i class="icon-info-sign"></i> Nº de Identificação Fiscal</span>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Serviço de Criação</label>
                                            <div class="controls">
                                                <input type="text" name="insc_junta" id="insc_junta" value="<?=$insc_junta_a?>" class="span9 cssFonteMai">
                                            </div>
                                        </div>
										<div class="control-group">
											<label class="control-label">Observações gerais</label>
											<div class="controls">
												<textarea name="obs_geral" id="obs_geral" rows="3" class="input-block-level cssFonteMai" placeholder="Observações"><?=$obs_geral_a?></textarea>
											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            



            



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscnaes".$array_temp;//id de controle
						$boxUI_titulo = "Classificação Nacional de Atividades Econômicas - CNAE";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">

                                        
										<div class="control-group warning">
											<label class="control-label">Atividade principal</label>
											<div class="controls select2-full">
<input type='hidden' value="" name='cnae_principal' id='cnae_principal' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #cnae_principal').select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Adicionar uma Subclasse CNAE >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=cnaeSubclasse&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	
	<?php if($cnae_principal_a_data != ""){?>$("#<?=$formCadastroPincipal?> #cnae_principal").select2("data", <?=$cnae_principal_a_data?>);<?php }?>
});
</script>
	<span class="help-block"><i class="icon-info-sign"></i> (Obrigatório) Informe subclasse CNAE de atividade econômica principal da pessoa jurídica.</span>

											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Objetivo</label>
											<div class="controls">
												<textarea name="cnae_objetivo" id="cnae_objetivo" rows="3" class="input-block-level" placeholder="Objetivos de atividade econômica"><?=$cnae_objetivo_a?></textarea>
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Atividade(s) secundária(s)</label>
											<div class="controls select2-full">
<input type='hidden' value="" name='cnae_secundaria' id='cnae_secundaria' class="css_cnae_codigo" style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #cnae_secundaria').select2({
		multiple: true,//*/
		placeholder: 'Adicionar uma Subclasse CNAE >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=cnaeSubclasse&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});	
	<?php if($cnae_secundaria_a_data != ""){?>$("#<?=$formCadastroPincipal?> #cnae_secundaria").select2("data", <?=$cnae_secundaria_a_data?>);<?php }?>
});
</script>
	<span class="help-block"><i class="icon-info-sign"></i> Obrigatório. Informe subclasse CNAE de atividades econômicas secundárias da pessoa jurídica.</span>

											</div>
										</div>
										
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            




            
            






                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosfoto".$array_temp;//id de controle
						$boxUI_titulo = "Imagem de Logo/Logomarca";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<i class="icon-upload-alt"></i> <?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
										<div class="control-group row-fluid">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Imagem perfil</label>
                                                <div class="controls" style="min-height:100px;">
                                                <?php
                                                //montar IFRAME
                                                $idTemp = $array_temp;//id do retorno
                                                $idIframe = "fotoPerfil".$array_temp;//id do iframe
                                                $arqTipo = "imagens";//tipos de arquivos
                                                $n_arqQtd = "1";//quantidade de arquivos maximo
                                                $desc = "0";//ativar descicao, 1 ligado, 0 desligado
                                                ?>
											  <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/upload_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&arq=<?=$arqTipo?>&n_arq=<?=$n_arqQtd?>&desc=<?=$desc?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Capturar foto</label>
                                                <div class="controls" style="min-height:100px;">
                                                <?php
                                                //montar IFRAME
                                                $idTemp = $array_temp;//id do retorno
                                                $idIframe = "camfotoPerfil".$array_temp;//id do iframe
                                                $tmDISP = "310x200";//tamanho display WxH > 310x200
                                                $tmIMG = "800x600";//tamanho arquivo de img WxH > 800x600
                                                $titu = "0";//ativar titulo, 1 ligado, 0 desligado
                                                ?>
											  <iframe name="<?=$idIframe?>" style="border:0; overflow:hidden;" src="geral/snapshot_iframe.php?idTemp=<?=$idTemp?>&idIframe=<?=$idIframe?>&tmDISP=<?=$tmDISP?>&tmIMG=<?=$tmIMG?>&titu=<?=$titu?>" frameborder="0"  scrolling="no"  id="<?=$idIframe?>" width="100%" height="100%"> </iframe>
                                                </div>
                                            </div>
										</div>
										</div>
                                        
										<div class="control-group" id="listaFiles<?=$boxUI_id?>">
											<label class="control-label">Arquivos já recebidos</label>
											<div class="controls">

								<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th style="width:150px;">ICO</th>
											<th>Dados/Arquivo</th>
											<th style="width:30px;">Ação</th>
										</tr>
									</thead>
									<tbody>
<?php
$cont_exib = "0";

//cad_candidato_juridico_foto
if($id_a >= "1"){
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,file,time", "cad_candidato_juridico_logo", "candidato_juridico_id = '$id_a'", "ORDER BY time ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$file_i = $linha1["file"];
		$time_i = $linha1["time"];		
		$caminho_file = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_logo/".$id_i.".".fGERAL::mostraExtensao($file_i);
		if(file_exists($caminho_file)){
			$cont_exib++;
?>        
										<tr id="tb_files<?=$INC_FAISHER["div"]?><?=$id_i?>">
											<td>
											<a href="img.php?<?=$cVLogin->imgFile($caminho_file, "full")?>" rel="prettyPhoto[gallery<?=$id_a?>]" id="img_<?=$id_i?>"><?=$cVLogin->icoFile($caminho_file, "")?></a></td>
											<td><b><?=$file_i?></b><br><?=fGERAL::tmFile($caminho_file)?></td>
											<td>
												<a href="#" onclick="$('#img_<?=$id_a?>').click();return false;" class="btn" rel="tooltip" title="Visualizar"><i class="icon-search"></i></a>
												<a href="downloads.php?<?=$cVLogin->varsDownalod($caminho_file, $file_i)?>" class="btn" rel="tooltip" title="Download"><i class="icon-download-alt"></i></a>
												<a href="#" onClick="delLinhaFile<?=$INC_FAISHER["div"]?>('<?=$id_i?>');return false;" class="btn" rel="tooltip" title="Remover"><i class="icon-remove"></i></a>
                    							<input id="file_del<?=$id_i?>" name="file_del<?=$id_i?>" type="hidden" value="0" />
                                          </td>
										</tr>
<?php 
		}//fim do if file_exists
	}//fim do while 
}//if($id_a >= "1"){
?>
									</tbody>
								</table>
<input id="contf<?=$INC_FAISHER["div"]?>" name="contf<?=$INC_FAISHER["div"]?>" type="hidden" value="<?=$cont_exib?>" />
<script>
function delLinhaFile<?=$INC_FAISHER["div"]?>(v_id){
	$('#<?=$formCadastroPincipal?> #file_del'+v_id).val('1');
	$('#<?=$formCadastroPincipal?> #tb_files<?=$INC_FAISHER["div"]?>'+v_id).fadeOut();
	$("#<?=$formCadastroPincipal?> #<?=$idIframe?>").fadeIn();
	var cont = Number($('#<?=$formCadastroPincipal?> #contf<?=$INC_FAISHER["div"]?>').val()); cont--;
	if(cont <= 0){ $('#listaFiles<?=$boxUI_id?>').fadeOut(); }
	$('#<?=$formCadastroPincipal?> #contf<?=$INC_FAISHER["div"]?>').val(cont);
}//delLinhaFile
</script>
											</div>
										</div>
<?php if($cont_exib == "0"){ echo "<script> $(document).ready(function(){ $('#listaFiles".$boxUI_id."').hide(); }); </script>"; } ?>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            



            



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosscotas".$array_temp;//id de controle
						$boxUI_titulo = "Sócios/Responsável (cotas, <i class=\"icon-briefcase\"></i> cadastro social)";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">

                                        
										<div class="control-group">
											<label class="control-label">Responsável</label>
											<div class="controls">

	<table class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th style="width:150px;">Tipo</th>
				<th>Nome Responsável <span id="candidato_resp_leg"></span></th>
				<th style="width:110px;">Cotas %</th>
				<th style="width:20px;">&nbsp;</th>
			</tr>
		</thead>
        <tbody>
            <tr>     
                <td>
					<select name="candidato_responsavel" id="candidato_responsavel" class="select2-me span12">
<?php

	if($candidato_responsavel_a == "F"){
		$html_tipo .= '<option value="F" selected="selected">FÍSICO</option>';
	}else{
		$html_tipo .= '<option value="F">FÍSICO</option>';
	}
	if($candidato_responsavel_a == "J"){
		$html_tipo .= '<option value="J" selected="selected">JURÍDICO</option>';
	}else{
		$html_tipo .= '<option value="J">JURÍDICO</option>';
	}
	echo $html_tipo;
	
?>
					</select>
                </td>
                <td class="select2-full">
                <div id="proprietario_p-f"><input type='hidden' value="" name='admin_candidato_fisico_id' id='admin_candidato_fisico_id' class="candidato_fisico" style="width:98%;"/></div>
                <div id="proprietario_p-j"><input type='hidden' value="" name='admin_candidato_juridico_id' id='admin_candidato_juridico_id' class="candidato_juridico" style="width:98%;"/></div>
				</td>
                <td><div class="input-append">
						<input type="text" name="admin_candidato_cotas" id="admin_candidato_cotas" value="<?=$admin_candidato_cotas_a?>" maxlength="6" class='span6 virgula_numero'>
						<span class="add-on">%</span>
					</div>
                </td>
                <td>&nbsp;</td>
            </tr>
    
        </tbody>
	</table>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> .candidato_fisico').select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Adicionar um candidato >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=candidatofisico<?php if(!isset($_GET["POP"])){ echo "&add"; }?>&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});	
	<?php if($admin_candidato_fisico_id_data != ""){?>$("#<?=$formCadastroPincipal?> #admin_candidato_fisico_id").select2("data", <?=$admin_candidato_fisico_id_data?>);<?php }?>
	$("#<?=$formCadastroPincipal?> #admin_candidato_fisico_id").on("change", function(e){
		if($(this).val() == "NOVO"){ $(this).select2("data", '');
			pmodalHtml('<i class=icon-user></i> CADASTRAR NOVO CANDIDATO','<?=$AJAX_PAG?>','get','faisher=3_con_candidatofisico&ajax=registro&id_a=0&POP=<?=fGERAL::cptoFaisher("addNovoContibuinte".$INC_FAISHER["div"]."('{ID}','{TXT}', 'admin_candidato_fisico_id');", "enc")?>');
		}
		if(($(this).val() != "NOVO") && ($(this).val() != "")){ $.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 500, function(){ $("#<?=$formCadastroPincipal?> #admin_candidato_cotas").focus(); }); }
	});	
	
	
	
	//dados de combobox
	$('#<?=$formCadastroPincipal?> .candidato_juridico').select2({
		maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Adicionar um candidato jurídico >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=candidatojuridico<?php if(!isset($_GET["POP"])){ echo "&add"; }?>&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});	
	<?php if($admin_candidato_juridico_id_data != ""){?>$("#<?=$formCadastroPincipal?> #admin_candidato_juridico_id").select2("data", <?=$admin_candidato_juridico_id_data?>);<?php }?>
	$("#<?=$formCadastroPincipal?> #admin_candidato_juridico_id").on("change", function(e){
		if($(this).val() == "NOVO"){ $(this).select2("data", '');
			pmodalHtml('<i class=icon-user></i> CADASTRAR NOVO CANDIDATO JURÍDICO','<?=$AJAX_PAG?>','get','faisher=3_con_candidatojuridico&ajax=registro&id_a=0&POP=<?=fGERAL::cptoFaisher("addNovoContibuinte".$INC_FAISHER["div"]."('{ID}','{TXT}', 'admin_candidato_juridico_id');", "enc")?>');
		}
		if(($(this).val() != "NOVO") && ($(this).val() != "")){ $.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 500, function(){ $("#<?=$formCadastroPincipal?> #admin_candidato_cotas").focus(); }); }
	});	
	
	//verifica pessoa selecionada
	verPPrincipal<?=$INC_FAISHER["div"]?>('OFF');
	$("#<?=$formCadastroPincipal?> #candidato_responsavel").on("change", function(e){ verPPrincipal<?=$INC_FAISHER["div"]?>('ON'); });	
});

function addNovoContibuinte<?=$INC_FAISHER["div"]?>(vid,vtxt,vcampo){
	var dados = JSON.stringify($("#<?=$formCadastroPincipal?> #"+vcampo).select2("data"));
	if((dados != "[]") && (dados != null)){
		dados = dados.replace('}]','},{"id":"'+vid+'", "text":"'+vtxt+'"}]');	
	}else{
		dados = '[{"id":"'+vid+'", "text":"'+vtxt+'"}]';	
	}
	dados = JSON.parse(dados);
	$("#<?=$formCadastroPincipal?> #"+vcampo).select2("data", dados);
}


function verPPrincipal<?=$INC_FAISHER["div"]?>(v_abre){
	if($('#<?=$formCadastroPincipal?> #candidato_responsavel').val() == "J"){
		$('#<?=$formCadastroPincipal?> #admin_candidato_fisico_id').select2("data", '');
		$('#<?=$formCadastroPincipal?> #candidato_resp_leg').html('Jurídico');
		$('#<?=$formCadastroPincipal?> #proprietario_p-f').hide();
		$('#<?=$formCadastroPincipal?> #proprietario_p-j').show();
		if(v_abre != "OFF"){ $('#<?=$formCadastroPincipal?> #admin_candidato_juridico_id').select2('open'); }
	}else{
		$('#<?=$formCadastroPincipal?> #admin_candidato_juridico_id').select2("data", '');
		$('#<?=$formCadastroPincipal?> #candidato_resp_leg').html('Físico');
		$('#<?=$formCadastroPincipal?> #proprietario_p-j').hide();
		$('#<?=$formCadastroPincipal?> #proprietario_p-f').show();
		if(v_abre != "OFF"){ $('#<?=$formCadastroPincipal?> #admin_candidato_fisico_id').select2('open'); }
	}
}//verPPrincipal
</script>
	<span class="help-block"><i class="icon-info-sign"></i> Informe o responsável pela empresa e cotas % de sua participação.</span>

											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Sócios pessoa física</label>
											<div class="controls">

	<table id="tabela_itens_socios_fisico<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th>Nome Sócios Pessoa Física</th>
				<th style="width:110px;">Cotas %</th>
				<th style="width:20px;">Ação</th>
			</tr>
		</thead>
        <tbody>
<?php
$check = "0";
$i_cont = "0";

if($id_a >= "1"){
	
	//monta array
	$array = explode(".",$socio_candidato_fisico_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if(($cont_ARRAY >= "1") and ($socio_candidato_fisico_a != "")){
		foreach ($array as $pos => $pos_valor){
			if($pos_valor != ""){
				$arraySUB = explode("-",$pos_valor);
				
				$resu1 = fSQL::SQL_SELECT_SIMPLES("id,code,nome", "cad_candidato_fisico", "id = '".$arraySUB["0"]."'", "","1");
				while($linha = fSQL::FETCH_ASSOC($resu1)){
					$id_i = $linha["id"];
					$texto = $cVLogin->popDetalhes("V",$id_i,"3_con_candidatofisico","DETALHES DO CANDIDATO").fGERAL::legCode($linha["id"],$linha["code"])." - <b>".$linha["nome"]."</b><br>".SYS_CONFIG_RM_SIGLA.". ".$linha["code"];

				$i_cont++
?>
            <tr id="tr<?=$i_cont?>">                
                <td class="display"><?=$texto?></td>
                <td><div class="input-append">
						<input type="text" name="fisico_cotas<?=$i_cont?>" id="fisico_cotas<?=$i_cont?>" value="<?=$arraySUB["1"]?>" maxlength="6" class='span6 virgula_numero' data-rule-required="true">
						<span class="add-on">%</span>
					</div></td>
                <td><button type="button" class="btn" onclick="delLinhaSocioFisico<?=$INC_FAISHER["div"]?>('<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="fisico_id<?=$i_cont?>" name="fisico_id<?=$i_cont?>" type="hidden" value="<?=$arraySUB["0"]?>" /></td>
            </tr>
<?php
				}//fim while

			}//if($pos_valor != ""){
		}//fim foreach
	
	}//fim if($cont_ARRAY >= "1"){

}//if($id_a >= "1"){
?>

    
<?php $i_cont++; ?>
            <tr id="tr<?=$i_cont?>">
                <td class="select2-full"><input type='hidden' value="" name='fisico_id<?=$i_cont?>' id='fisico_id<?=$i_cont?>' class="candidato_fisico" style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){	
	$("#<?=$formCadastroPincipal?> #fisico_id<?=$i_cont?>").on("change", function(e){
		if($(this).val() == "NOVO"){ $(this).select2("data", '');
			pmodalHtml('<i class=icon-user></i> CADASTRAR NOVO CANDIDATO','<?=$AJAX_PAG?>','get','faisher=3_con_candidatofisico&ajax=registro&id_a=0&POP=<?=fGERAL::cptoFaisher("addNovoContibuinte".$INC_FAISHER["div"]."('{ID}','{TXT}', 'fisico_id".$i_cont."');", "enc")?>');
		}
		if(($(this).val() != "NOVO") && ($(this).val() != "")){ $.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 500, function(){ $("#<?=$formCadastroPincipal?> #fisico_cotas<?=$i_cont?>").focus(); }); }
	});	
});
</script></td>
                <td><div class="input-append">
						<input type="text" name="fisico_cotas<?=$i_cont?>" id="fisico_cotas<?=$i_cont?>" value="" maxlength="6" class='span6 virgula_numero'>
						<span class="add-on">%</span>
					</div>
                </td>
                <td><button type="button" class="btn" onclick="delLinhaSocioFisico<?=$INC_FAISHER["div"]?>('<?=$i_cont?>');"><i class="icon-trash"></i></button></td>
            </tr>
    
        </tbody>
	</table>
<input id="socio_fisico_cont" name="socio_fisico_cont" type="hidden" value="<?=$i_cont?>" />
<div style="display:none;" id="div_oaulta<?=$INC_FAISHER["div"]?>"></div>
<script>
function addLinhaSocioFisico<?=$INC_FAISHER["div"]?>(){
	var cont = Number($('#<?=$formCadastroPincipal?> #socio_fisico_cont').val());
	cont++;
	faisher_ajax('div_oaulta<?=$INC_FAISHER["div"]?>', 'btAddSocioFisico<?=$array_temp?>', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=addLinhaSocioFisico&formCadastroPincipal=<?=$formCadastroPincipal?>&cont='+cont, 'get', 'ON');
	$('#<?=$formCadastroPincipal?> #socio_fisico_cont').val(cont);
}//addLinhaSocioFisico

function delLinhaSocioFisico<?=$INC_FAISHER["div"]?>(v_tr){
	$('#<?=$formCadastroPincipal?> #tabela_itens_socios_fisico<?=$INC_FAISHER["div"]?> #tr'+v_tr).remove();
}//delLinhaSocioFisico
</script>

											<div style="padding-top:10px;">
												<button type="button" class="btn" onclick="addLinhaSocioFisico<?=$INC_FAISHER["div"]?>();"><i class="icon-plus-sign"></i> Adicionar linha de sócios pessoa física<img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btAddSocioFisico<?=$array_temp?>" /></button>
                                            </div>

											</div>
										</div>
                                        
										<div class="control-group">
											<label class="control-label">Sócios pessoa jurídica</label>
											<div class="controls">

	<table id="tabela_itens_socios_juridico<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th>Nome Sócios Pessoa Jurídica</th>
				<th style="width:110px;">Cotas %</th>
				<th style="width:20px;">Ação</th>
			</tr>
		</thead>
        <tbody>
<?php
$check = "0";
$i_cont = "0";

if($id_a >= "1"){
	
	//monta array
	$array = explode(".",$socio_candidato_juridico_a);
	$cont_ARRAY = ceil(count($array));
	//listar item ja cadastrados
	if(($cont_ARRAY >= "1") and ($socio_candidato_juridico_a != "")){
		foreach ($array as $pos => $pos_valor){
			if($pos_valor != ""){
				$arraySUB = explode("-",$pos_valor);
				
				$resu1 = fSQL::SQL_SELECT_SIMPLES("id,code,nome", "cad_candidato_juridico", "id = '".$arraySUB["0"]."'", "","1");
				while($linha = fSQL::FETCH_ASSOC($resu1)){
					$id_i = $linha["id"];
					$texto = $cVLogin->popDetalhes("V",$id_i,"3_con_candidatojuridico","DETALHES DO CANDIDATO").fGERAL::legCode($linha["id"],$linha["code"])." - <b>".$linha["nome"]."</b><br>".SYS_CONFIG_RM_SIGLA.". ".$linha["code"];

				$i_cont++
?>
            <tr id="tr<?=$i_cont?>">                
                <td class="display"><?=$texto?></td>
                <td><div class="input-append">
						<input type="text" name="juridico_cotas<?=$i_cont?>" id="juridico_cotas<?=$i_cont?>" value="<?=$arraySUB["1"]?>" maxlength="6" class='span6 virgula_numero' data-rule-required="true">
						<span class="add-on">%</span>
					</div></td>
                <td><button type="button" class="btn" onclick="delLinhaSocioJuridico<?=$INC_FAISHER["div"]?>('<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="juridico_id<?=$i_cont?>" name="juridico_id<?=$i_cont?>" type="hidden" value="<?=$arraySUB["0"]?>" /></td>
            </tr>
<?php
				}//fim while

			}//if($pos_valor != ""){
		}//fim foreach
	
	}//fim if($cont_ARRAY >= "1"){

}//if($id_a >= "1"){
?>

    
    
        </tbody>
	</table>
<input id="socio_juridico_cont" name="socio_juridico_cont" type="hidden" value="<?=$i_cont?>" />
<div style="display:none;" id="div_oaulta<?=$INC_FAISHER["div"]?>"></div>
<script>
function addLinhaSocioJuridico<?=$INC_FAISHER["div"]?>(){
	var cont = Number($('#<?=$formCadastroPincipal?> #socio_juridico_cont').val());
	cont++;
	faisher_ajax('div_oaulta<?=$INC_FAISHER["div"]?>', 'btAddSocioJuridico<?=$array_temp?>', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=addLinhaSocioJuridico&formCadastroPincipal=<?=$formCadastroPincipal?>&cont='+cont, 'get', 'ON');
	$('#<?=$formCadastroPincipal?> #socio_juridico_cont').val(cont);
}//addLinhaSocioJuridico

function delLinhaSocioJuridico<?=$INC_FAISHER["div"]?>(v_tr){
	$('#<?=$formCadastroPincipal?> #tabela_itens_socios_juridico<?=$INC_FAISHER["div"]?> #tr'+v_tr).remove();
}//delLinhaSocioJuridico
</script>

											<div style="padding-top:10px;">
												<button type="button" class="btn" onclick="addLinhaSocioJuridico<?=$INC_FAISHER["div"]?>();"><i class="icon-plus-sign"></i> Adicionar linha de sócios pessoa jurídica <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btAddSocioJuridico<?=$array_temp?>" /></button>
                                            </div>

											</div>
										</div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            



            


<?php

//busca lista de procurador
$resu1 = fSQL::SQL_SELECT_SIMPLES("P.id,P.procurador_fisico_id,P.time,P.time_expira,C.code,C.nome", "cad_candidato_juridico_procurador P, cad_candidato_fisico C", "P.candidato_id = '$id_a' AND P.procurador_fisico_id = C.id", "GROUP BY P.id ORDER BY C.nome ASC");
$qtd_proc	= fSQL::SQL_CONT($resu1);
?>

                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosprocura".$array_temp;//id de controle
						$boxUI_titulo = "Procurador Físico do Candidato (representante)";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						if($qtd_proc >= "1"){ $boxUI_status = "1"; }//abre caso tenha registro adicionado
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">

										<div class="span12">

	<table id="tabela_itens_procurador_fisico<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th>Nome Procurador Pessoa Física</th>
				<th style="width:110px;">Data Expira</th>
				<th style="width:20px;">Ação</th>
			</tr>
		</thead>
        <tbody>
<?php
$i_cont = "0";

if($qtd_proc >= "1"){	
	//lista procurador carregado anteriormente
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$procurador_fisico_id_i = $linha1["procurador_fisico_id"];
		
		$texto = $cVLogin->popDetalhes("V",$procurador_fisico_id_i,"3_con_candidatofisico","DETALHES DO CANDIDATO").fGERAL::legCode($linha1["procurador_fisico_id"],$linha1["code"])." - <b>".$linha1["nome"]."</b> (".SYS_CONFIG_RM_SIGLA.". ".$linha1["code"].")<br><i>Cadastrado em ".date('d/m/Y H:i', $linha1["time"])."h";

		$i_cont++
		
		
?>
            <tr id="tr<?=$i_cont?>">                
                <td class="display"><?=$texto?></td>
                <td><input type="text" name="procurador_data<?=$i_cont?>" id="procurador_data<?=$i_cont?>" value="<?=date('d/m/Y', $linha1["time_expira"])?>" class="span12 mask_date datepick"></td>
                <td><button type="button" class="btn" onclick="delLinhaProcuradorFisico<?=$INC_FAISHER["div"]?>('<?=$id_i?>','<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="procurador_fisico_id<?=$i_cont?>" name="procurador_fisico_id<?=$i_cont?>" type="hidden" value="<?=$procurador_fisico_id_i?>" />
                    <input id="procurador_id<?=$i_cont?>" name="procurador_id<?=$i_cont?>" type="hidden" value="<?=$id_i?>" />
                    <input id="procurador_del<?=$i_cont?>" name="procurador_del<?=$i_cont?>" type="hidden" value="0" /></td>
            </tr>
<?php
		
	}//fim while

}//if($qtd_proc >= "1"){
?>

    
<?php $i_cont++; ?>
            <tr id="tr<?=$i_cont?>">
                <td class="select2-full"><input type='hidden' value="" name='procurador_fisico_id<?=$i_cont?>' id='procurador_fisico_id<?=$i_cont?>' class="candidato_fisico" style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){	
	$("#<?=$formCadastroPincipal?> #procurador_fisico_id<?=$i_cont?>").on("change", function(e){
		if($(this).val() == "NOVO"){ $(this).select2("data", '');
			pmodalHtml('<i class=icon-user></i> CADASTRAR NOVO CANDIDATO','<?=$AJAX_PAG?>','get','faisher=3_con_candidatofisico&ajax=registro&id_a=0&POP=<?=fGERAL::cptoFaisher("addNovoContibuinte".$INC_FAISHER["div"]."('{ID}','{TXT}', 'procurador_fisico_id".$i_cont."');", "enc")?>');
		}
		if(($(this).val() != "NOVO") && ($(this).val() != "")){ $.doTimeout('vTimerDefalt<?=$INC_FAISHER["div"]?>', 500, function(){ $("#<?=$formCadastroPincipal?> #procurador_data<?=$i_cont?>").focus(); }); }
	});	
});
</script></td>
                <td><input type="text" name="procurador_data<?=$i_cont?>" id="procurador_data<?=$i_cont?>" value="" class="span12 mask_date datepick">
                </td>
                <td><button type="button" class="btn" onclick="delLinhaProcuradorFisico<?=$INC_FAISHER["div"]?>('0','<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="procurador_id<?=$i_cont?>" name="procurador_id<?=$i_cont?>" type="hidden" value="0" />
                    <input id="procurador_del<?=$i_cont?>" name="procurador_del<?=$i_cont?>" type="hidden" value="0" /></td>
            </tr>
    
        </tbody>
	</table>
<input id="procurador_fisico_cont" name="procurador_fisico_cont" type="hidden" value="<?=$i_cont?>" />
<div style="display:none;" id="div_ocultaProcurador<?=$INC_FAISHER["div"]?>"></div>
<script>
function addLinhaProcuradorFisico<?=$INC_FAISHER["div"]?>(){
	var cont = Number($('#<?=$formCadastroPincipal?> #procurador_fisico_cont').val());
	cont++;
	faisher_ajax('div_ocultaProcurador<?=$INC_FAISHER["div"]?>', 'btAddProcuradorFisico<?=$array_temp?>', '<?=$AJAX_PAG?>', '<?=$faisherGet?>&ajax=addLinhaProcuradorFisico&formCadastroPincipal=<?=$formCadastroPincipal?>&cont='+cont, 'get', 'ON');
	$('#<?=$formCadastroPincipal?> #procurador_fisico_cont').val(cont);
}//addLinhaProcuradorFisico

function delLinhaProcuradorFisico<?=$INC_FAISHER["div"]?>(v_id,v_tr){	
	if(v_id == "0"){
		$('#<?=$formCadastroPincipal?> #tabela_itens_procurador_fisico<?=$INC_FAISHER["div"]?> #tr'+v_tr).remove();
	}else{
		$('#<?=$formCadastroPincipal?> #tabela_itens_procurador_fisico<?=$INC_FAISHER["div"]?> #procurador_del'+v_tr).val('1');
		$('#<?=$formCadastroPincipal?> #tabela_itens_procurador_fisico<?=$INC_FAISHER["div"]?> #tr'+v_tr).fadeOut();
	}
}//delLinhaProcuradorFisico
</script>

											<div style="padding:10px;">
												<button type="button" class="btn" onclick="addLinhaProcuradorFisico<?=$INC_FAISHER["div"]?>();"><i class="icon-plus-sign"></i> Adicionar linha de procurador pessoa física<img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btAddProcuradorFisico<?=$array_temp?>" /></button>
                                            </div>
											<div style="padding:0px 10px 10px 10px;">
											<span class="help-block"><i class="icon-info-sign"></i> <b>IMPORTANTE!</b> Procurador Físico poderá solicitar serviços no Aplicativo Integrador ou em terminais de auto atendimento.</span>
											<span class="help-block"><i class="icon-info-sign"></i> <b>AJUDA:</b> A Data Expira, é responsável por desativar automaticamente o procurador na data marcada. Se o procurador tem uma procuração, anexe ela aos documentos do candidato</span>
                                            </div>
										</div>
                                        
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            





            
            



            



                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadoscont".$array_temp;//id de controle
						$boxUI_titulo = "Informações de Contato";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                        

										<div class="control-group">
											<label class="control-label">Telefone celular comercial</label>
											<div class="controls">

	<table id="tabela_itens_celular<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th style="width:150px;">Tipo</th>
				<th>Nº Telefone Celular</th>
				<th style="width:100px;">Classifica</th>
				<th style="width:20px;">Ação</th>
			</tr>
		</thead>
        <tbody>
<?php
$check = "0";
$i_cont = "0";

if($id_a >= "1"){
	$resu1 = fSQL::SQL_SELECT_SIMPLES("*", "cad_candidato_juridico_celular", "candidato_juridico_id = '$id_a'", "ORDER BY principal DESC, time ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$tipo_id_i = $linha1["tipo_id"];
		$principal_i = $linha1["principal"];
		$celular_i = $linha1["celular"];
		$time_i = $linha1["time"];
		if($principal_i >= "1"){ $principal_i = "1"; $check = "1"; }else{ $principal_i = "0"; }
		$i_cont++
?>
            <tr id="tr<?=$i_cont?>">                
                <td>
					<select name="cel_tipo<?=$i_cont?>" id="cel_tipo<?=$i_cont?>" class="select2-me span12">
<?php
	$html_tipo = "";
	$resu2 = fSQL::SQL_SELECT_SIMPLES("id,legenda", "cad_candidato_celular_tipo", "", "ORDER BY legenda ASC");
	while($linha2 = fSQL::FETCH_ASSOC($resu2)){
		$id_ii = $linha2["id"];
		$legenda_ii = $linha2["legenda"];
		if($id_ii == $tipo_id_i){
			$html_tipo .= '<option value="'.$id_ii.'" selected="selected">'.$legenda_ii.'</option>';
		}else{
			$html_tipo .= '<option value="'.$id_ii.'">'.$legenda_ii.'</option>';
		}
	}//fim while
	echo $html_tipo;
	
?>
					</select>
                </td>
                <td><input type="text" name="cel_numero<?=$i_cont?>" id="cel_numero<?=$i_cont?>" value="<?=$celular_i?>" class="span11 mask_phone"></td>
                <td><div class="check-line"><input id="cel_principal<?=$i_cont?>" name="cel_principal" type="radio" value="<?=$i_cont?>" class='<?=$INC_FAISHER["div"]?>-icheck' data-skin="square" data-color="blue" <?php if($principal_i == "1"){ echo 'checked="checked"'; }?> /><label class='inline' for="cel_principal<?=$i_cont?>">Principal</label></div></td>
                <td><button type="button" class="btn" onclick="delLinhaCel<?=$INC_FAISHER["div"]?>('<?=$id_i?>','<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="cel_id<?=$i_cont?>" name="cel_id<?=$i_cont?>" type="hidden" value="<?=$id_i?>" />
                    <input id="cel_del<?=$i_cont?>" name="cel_del<?=$i_cont?>" type="hidden" value="0" /></td>
            </tr>
<?php

	}//while

}//if($id_a >= "1"){
?>

    
<?php $i_cont++; ?>
            <tr id="tr<?=$i_cont?>">
                <td>
					<select name="cel_tipo<?=$i_cont?>" id="cel_tipo<?=$i_cont?>" class="select2-me span12">
<?php
	$html_tipo = "";
	$tipo_id = "1";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,legenda", "cad_candidato_celular_tipo", "", "ORDER BY legenda ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$legenda_i = $linha1["legenda"];
		if($id_i == $tipo_id){
			$html_tipo .= '<option value="'.$id_i.'" selected="selected">'.$legenda_i.'</option>';
		}else{
			$html_tipo .= '<option value="'.$id_i.'">'.$legenda_i.'</option>';
		}
	}//fim while
	echo $html_tipo;
	
?>
					</select>
                </td>
                <td><input type="text" name="cel_numero<?=$i_cont?>" id="cel_numero<?=$i_cont?>" value="" class="span11 mask_phone"></td>
                <td><div class="check-line"><input id="cel_principal<?=$i_cont?>" name="cel_principal" type="radio" value="<?=$i_cont?>" class='<?=$INC_FAISHER["div"]?>-icheck' data-skin="square" data-color="blue" <?php if($check == "0"){ echo 'checked="checked"'; }?> /><label class='inline' for="cel_principal<?=$i_cont?>">Principal</label></div></td>
                <td><button type="button" class="btn" onclick="delLinhaCel<?=$INC_FAISHER["div"]?>('0','<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="cel_id<?=$i_cont?>" name="cel_id<?=$i_cont?>" type="hidden" value="0" />
                    <input id="cel_del<?=$i_cont?>" name="cel_del<?=$i_cont?>" type="hidden" value="0" /></td>
            </tr>
    
        </tbody>
	</table>
<input id="cel_cont" name="cel_cont" type="hidden" value="<?=$i_cont?>" />
<script>
function addLinhaCel<?=$INC_FAISHER["div"]?>(){
	var cont = Number($('#<?=$formCadastroPincipal?> #cel_cont').val());
	cont = cont+1;
    $("#tabela_itens_celular<?=$INC_FAISHER["div"]?> tbody").append('<tr id="tr'+cont+'"><td><select name="cel_tipo'+cont+'" id="cel_tipo'+cont+'" class="span12"><?=$html_tipo?></select></td><td><input type="text" name="cel_numero'+cont+'" id="cel_numero'+cont+'" value="" class="span11"></td><td><div class="check-line"><input id="cel_principal'+cont+'" name="cel_principal" type="radio" value="'+cont+'" data-skin="square" data-color="blue" /><label class="inline" for="cel_principal'+cont+'">Principal</label></div></td><td><button type="button" class="btn" onclick="delLinhaCel<?=$INC_FAISHER["div"]?>(\'0\',\''+cont+'\');"><i class="icon-trash"></i></button><input id="cel_id'+cont+'" name="cel_id'+cont+'" type="hidden" value="0" /><input id="cel_del'+cont+'" name="cel_del'+cont+'" type="hidden" value="0" /></td></tr>');

		$("#<?=$formCadastroPincipal?> #cel_tipo"+cont).select2();
		$("#<?=$formCadastroPincipal?> #cel_numero"+cont).mask("(+999) 999 99 99 99");
		$("#<?=$formCadastroPincipal?> #cel_principal"+cont).each(function(){
			var $el = $(this);
			var skin = ($el.attr('data-skin') !== undefined) ? "_"+$el.attr('data-skin') : "",
			color = ($el.attr('data-color') !== undefined) ? "-"+$el.attr('data-color') : "";
			var opt = {
				checkboxClass: 'icheckbox' + skin + color,
				radioClass: 'iradio' + skin + color,
				increaseArea: "10%"
			}
			$el.iCheck(opt);
		});
	
	$('#<?=$formCadastroPincipal?> #cel_numero'+cont).focus();
	$('#<?=$formCadastroPincipal?> #cel_cont').val(cont);
}//addLinhaCel


function delLinhaCel<?=$INC_FAISHER["div"]?>(v_id,v_tr){
		var isel = $("#<?=$formCadastroPincipal?> #tabela_itens_celular<?=$INC_FAISHER["div"]?> input[name='cel_principal']:checked").val();
		$('#<?=$formCadastroPincipal?> #tabela_itens_celular<?=$INC_FAISHER["div"]?> #cel_principal'+v_tr).attr('name','nomee_off');
		if(isel == v_tr){
			//Executa Loop entre todas as Radio buttons com o name de valor
			$('#<?=$formCadastroPincipal?> #tabela_itens_celular<?=$INC_FAISHER["div"]?> input:radio[name=cel_principal]').each(function() {
				//Verifica qual está selecionado if($(this).is(':checked'))
				$(this).iCheck('check');
				return false;
			});
		}
	if(v_id == "0"){
		$('#<?=$formCadastroPincipal?> #tabela_itens_celular<?=$INC_FAISHER["div"]?> #tr'+v_tr).remove();
	}else{
		$('#<?=$formCadastroPincipal?> #tabela_itens_celular<?=$INC_FAISHER["div"]?> #cel_del'+v_tr).val('1');
		$('#<?=$formCadastroPincipal?> #tabela_itens_celular<?=$INC_FAISHER["div"]?> #tr'+v_tr).fadeOut();
	}
}//delLinhaCel
</script>

											<div style="padding-top:10px;">
												<button type="button" class="btn" onclick="addLinhaCel<?=$INC_FAISHER["div"]?>();"><i class="icon-plus-sign"></i> Adicionar outra linha de telefone celular</button>
                                            </div>

											</div>
										</div>
										<div class="control-group">
											<label class="control-label">E-mail (opcional)</label>
											<div class="controls">

	<table id="tabela_itens_email<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">

		<thead>
			<tr>
				<th style="width:150px;">Tipo</th>
				<th>Endereço de E-mail</th>
				<th style="width:100px;">Classifica</th>
				<th style="width:20px;">Ação</th>
			</tr>
		</thead>
        <tbody>
<?php
$check = "0";
$i_cont = "0";

if($id_a >= "1"){
	$resu1 = fSQL::SQL_SELECT_SIMPLES("*", "cad_candidato_juridico_email", "candidato_juridico_id = '$id_a'", "ORDER BY principal DESC, time ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$tipo_id_i = $linha1["tipo_id"];
		$principal_i = $linha1["principal"];
		$email_i = $linha1["email"];
		$time_i = $linha1["time"];
		if($principal_i >= "1"){ $principal_i = "1"; $check = "1"; }else{ $principal_i = "0"; }
		$i_cont++
?>
            <tr id="tr<?=$i_cont?>">
                <td>
					<select name="ema_tipo<?=$i_cont?>" id="ema_tipo<?=$i_cont?>" class="select2-me span12">
<?php
	$html_tipo = "";
	$resu2 = fSQL::SQL_SELECT_SIMPLES("id,legenda", "cad_candidato_email_tipo", "", "ORDER BY legenda ASC");
	while($linha2 = fSQL::FETCH_ASSOC($resu2)){
		$id_ii = $linha2["id"];
		$legenda_ii = $linha2["legenda"];
		if($id_ii == $tipo_id_i){
			$html_tipo .= '<option value="'.$id_ii.'" selected="selected">'.$legenda_ii.'</option>';
		}else{
			$html_tipo .= '<option value="'.$id_ii.'">'.$legenda_ii.'</option>';
		}
	}//fim while
	echo $html_tipo;
	
?>
					</select>
                </td>
                <td><input type="text" name="ema_email<?=$i_cont?>" id="ema_email<?=$i_cont?>" value="<?=$email_i?>" class="span11 cssFonteMin" data-rule-email="true"></td>
                <td><div class="check-line"><input id="ema_principal<?=$i_cont?>" name="ema_principal" type="radio" value="<?=$i_cont?>" class='<?=$INC_FAISHER["div"]?>-icheck' data-skin="square" data-color="blue" <?php if($principal_i == "1"){ echo 'checked="checked"'; }?> /><label class='inline' for="ema_principal<?=$i_cont?>">Principal</label></div></td>
                <td><button type="button" class="btn" onclick="delLinhaEma<?=$INC_FAISHER["div"]?>('<?=$id_i?>','<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="ema_id<?=$i_cont?>" name="ema_id<?=$i_cont?>" type="hidden" value="<?=$id_i?>" />
                    <input id="ema_del<?=$i_cont?>" name="ema_del<?=$i_cont?>" type="hidden" value="0" /></td>
            </tr>
<?php

	}//while

}//if($id_a >= "1"){
?>

    
<?php $i_cont++; ?>
            <tr id="tr<?=$i_cont?>">
                <td>
					<select name="ema_tipo<?=$i_cont?>" id="ema_tipo<?=$i_cont?>" class="select2-me span12">
<?php
	$html_tipo = "";
	$tipo_id = "1";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,legenda", "cad_candidato_email_tipo", "", "ORDER BY legenda ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$legenda_i = $linha1["legenda"];
		if($id_i == $tipo_id){
			$html_tipo .= '<option value="'.$id_i.'" selected="selected">'.$legenda_i.'</option>';
		}else{
			$html_tipo .= '<option value="'.$id_i.'">'.$legenda_i.'</option>';
		}
	}//fim while
	echo $html_tipo;
	
?>
					</select>
                </td>
                <td><input type="text" name="ema_email<?=$i_cont?>" id="ema_email<?=$i_cont?>" value="" class="span11 cssFonteMin" data-rule-email="true"></td>
                <td><div class="check-line"><input id="ema_principal<?=$i_cont?>" name="ema_principal" type="radio" value="<?=$i_cont?>" class='<?=$INC_FAISHER["div"]?>-icheck' data-skin="square" data-color="blue" <?php if($check == "0"){ echo 'checked="checked"'; }?> /><label class='inline' for="ema_principal<?=$i_cont?>">Principal</label></div></td>
                <td><button type="button" class="btn" onclick="delLinhaEma<?=$INC_FAISHER["div"]?>('0','<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="ema_id<?=$i_cont?>" name="ema_id<?=$i_cont?>" type="hidden" value="0" />
                    <input id="ema_del<?=$i_cont?>" name="ema_del<?=$i_cont?>" type="hidden" value="0" /></td>
            </tr>
    
        </tbody>
	</table>
<input id="ema_cont" name="ema_cont" type="hidden" value="<?=$i_cont?>" />
<script>
function addLinhaEma<?=$INC_FAISHER["div"]?>(){
	var cont = Number($('#<?=$formCadastroPincipal?> #ema_cont').val());
	cont = cont+1;
    $("#tabela_itens_email<?=$INC_FAISHER["div"]?> tbody").append('<tr id="tr'+cont+'"><td><select name="ema_tipo'+cont+'" id="ema_tipo'+cont+'" class="span12"><?=$html_tipo?></select></td><td><input type="text" name="ema_email'+cont+'" id="ema_email'+cont+'" value="" class="span11 cssFonteMin" data-rule-email="true"></td><td><div class="check-line"><input id="ema_principal'+cont+'" name="ema_principal" type="radio" value="'+cont+'" data-skin="square" data-color="blue" /><label class="inline" for="ema_principal'+cont+'">Principal</label></div></td><td><button type="button" class="btn" onclick="delLinhaEma<?=$INC_FAISHER["div"]?>(\'0\',\''+cont+'\');"><i class="icon-trash"></i></button><input id="ema_id'+cont+'" name="ema_id'+cont+'" type="hidden" value="0" /><input id="ema_del'+cont+'" name="ema_del'+cont+'" type="hidden" value="0" /></td></tr>');

		$("#<?=$formCadastroPincipal?> #ema_tipo"+cont).select2();	
		$("#<?=$formCadastroPincipal?> #ema_email"+cont).bind("blur change paste", function(e) {
			 var el = $(this);
			 setTimeout(function(){
			 var text = $(el).val();
			 el.val(text.toLowerCase());
			 }, 100);
		});	
		$("#<?=$formCadastroPincipal?> #ema_principal"+cont).each(function(){
			var $el = $(this);
			var skin = ($el.attr('data-skin') !== undefined) ? "_"+$el.attr('data-skin') : "",
			color = ($el.attr('data-color') !== undefined) ? "-"+$el.attr('data-color') : "";
			var opt = {
				checkboxClass: 'icheckbox' + skin + color,
				radioClass: 'iradio' + skin + color,
				increaseArea: "10%"
			}
			$el.iCheck(opt);
		});
	
	$('#<?=$formCadastroPincipal?> #ema_email'+cont).focus();
	$('#<?=$formCadastroPincipal?> #ema_cont').val(cont);
}//addLinhaEma


function delLinhaEma<?=$INC_FAISHER["div"]?>(v_id,v_tr){
		var isel = $("#<?=$formCadastroPincipal?> #tabela_itens_email<?=$INC_FAISHER["div"]?> input[name='ema_principal']:checked").val();
		$('#<?=$formCadastroPincipal?> #tabela_itens_email<?=$INC_FAISHER["div"]?> #ema_principal'+v_tr).attr('name','nomee_off');
		if(isel == v_tr){
			//Executa Loop entre todas as Radio buttons com o name de valor
			$('#<?=$formCadastroPincipal?> #tabela_itens_email<?=$INC_FAISHER["div"]?> input:radio[name=ema_principal]').each(function() {
				//Verifica qual está selecionado if($(this).is(':checked'))
				$(this).iCheck('check');
				return false;
			});
		}
	if(v_id == "0"){
		$('#<?=$formCadastroPincipal?> #tabela_itens_email<?=$INC_FAISHER["div"]?> #tr'+v_tr).remove();
	}else{
		$('#<?=$formCadastroPincipal?> #tabela_itens_email<?=$INC_FAISHER["div"]?> #ema_del'+v_tr).val('1');
		$('#<?=$formCadastroPincipal?> #tabela_itens_email<?=$INC_FAISHER["div"]?> #tr'+v_tr).fadeOut();
	}
}//delLinhaEma
</script>

											<div style="padding-top:10px;">
												<button type="button" class="btn" onclick="addLinhaEma<?=$INC_FAISHER["div"]?>();"><i class="icon-plus-sign"></i> Adicionar outra linha de e-mail</button>
                                            </div>

											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Telefone fixo</label>
											<div class="controls">

	<table id="tabela_itens_fone<?=$INC_FAISHER["div"]?>" class="table table-hover table-bordered" style="margin-top:0;">
		<thead>
			<tr>
				<th style="width:150px;">Tipo</th>
				<th>Nº Telefone Fixo</th>
				<th style="width:100px;">Classifica</th>
				<th style="width:20px;">Ação</th>
			</tr>
		</thead>
        <tbody>
<?php
$check = "0";
$i_cont = "0";

if($id_a >= "1"){
	$resu1 = fSQL::SQL_SELECT_SIMPLES("*", "cad_candidato_juridico_fone", "candidato_juridico_id = '$id_a'", "ORDER BY principal DESC, time ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$tipo_id_i = $linha1["tipo_id"];
		$principal_i = $linha1["principal"];
		$fone_i = $linha1["fone"];
		$time_i = $linha1["time"];
		if($principal_i >= "1"){ $principal_i = "1"; $check = "1"; }else{ $principal_i = "0"; }
		$i_cont++
?>
            <tr id="tr<?=$i_cont?>">                
                <td>
					<select name="tel_tipo<?=$i_cont?>" id="tel_tipo<?=$i_cont?>" class="select2-me span12">
<?php
	$html_tipo = "";
	$resu2 = fSQL::SQL_SELECT_SIMPLES("id,legenda", "cad_candidato_fone_tipo", "", "ORDER BY legenda ASC");
	while($linha2 = fSQL::FETCH_ASSOC($resu2)){
		$id_ii = $linha2["id"];
		$legenda_ii = $linha2["legenda"];
		if($id_ii == $tipo_id_i){
			$html_tipo .= '<option value="'.$id_ii.'" selected="selected">'.$legenda_ii.'</option>';
		}else{
			$html_tipo .= '<option value="'.$id_ii.'">'.$legenda_ii.'</option>';
		}
	}//fim while
	echo $html_tipo;
	
?>
					</select>
                </td>
                <td><input type="text" name="tel_numero<?=$i_cont?>" id="tel_numero<?=$i_cont?>" value="<?=$fone_i?>" class="span11 mask_phone"></td>
                <td><div class="check-line"><input id="tel_principal<?=$i_cont?>" name="tel_principal" type="radio" value="<?=$i_cont?>" class='<?=$INC_FAISHER["div"]?>-icheck' data-skin="square" data-color="blue" <?php if($principal_i == "1"){ echo 'checked="checked"'; }?> /><label class='inline' for="tel_principal<?=$i_cont?>">Principal</label></div></td>
                <td><button type="button" class="btn" onclick="delLinhaTel<?=$INC_FAISHER["div"]?>('<?=$id_i?>','<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="tel_id<?=$i_cont?>" name="tel_id<?=$i_cont?>" type="hidden" value="<?=$id_i?>" />
                    <input id="tel_del<?=$i_cont?>" name="tel_del<?=$i_cont?>" type="hidden" value="0" /></td>
            </tr>
<?php

	}//while

}//if($id_a >= "1"){
?>

    
<?php $i_cont++; ?>
            <tr id="tr<?=$i_cont?>">
                <td>
					<select name="tel_tipo<?=$i_cont?>" id="tel_tipo<?=$i_cont?>" class="select2-me span12">
<?php
	$html_tipo = "";
	$tipo_id = "1";
	$resu1 = fSQL::SQL_SELECT_SIMPLES("id,legenda", "cad_candidato_fone_tipo", "", "ORDER BY legenda ASC");
	while($linha1 = fSQL::FETCH_ASSOC($resu1)){
		$id_i = $linha1["id"];
		$legenda_i = $linha1["legenda"];
		if($id_i == $tipo_id){
			$html_tipo .= '<option value="'.$id_i.'" selected="selected">'.$legenda_i.'</option>';
		}else{
			$html_tipo .= '<option value="'.$id_i.'">'.$legenda_i.'</option>';
		}
	}//fim while
	echo $html_tipo;
	
?>
					</select>
                </td>
                <td><input type="text" name="tel_numero<?=$i_cont?>" id="tel_numero<?=$i_cont?>" value="" class="span11 mask_phone"></td>
                <td><div class="check-line"><input id="tel_principal<?=$i_cont?>" name="tel_principal" type="radio" value="<?=$i_cont?>" class='<?=$INC_FAISHER["div"]?>-icheck' data-skin="square" data-color="blue" <?php if($check == "0"){ echo 'checked="checked"'; }?> /><label class='inline' for="tel_principal<?=$i_cont?>">Principal</label></div></td>
                <td><button type="button" class="btn" onclick="delLinhaTel<?=$INC_FAISHER["div"]?>('0','<?=$i_cont?>');"><i class="icon-trash"></i></button>
                    <input id="tel_id<?=$i_cont?>" name="tel_id<?=$i_cont?>" type="hidden" value="0" />
                    <input id="tel_del<?=$i_cont?>" name="tel_del<?=$i_cont?>" type="hidden" value="0" /></td>
            </tr>
    
        </tbody>
	</table>
<input id="tel_cont" name="tel_cont" type="hidden" value="<?=$i_cont?>" />
<script>
function addLinhaTel<?=$INC_FAISHER["div"]?>(){
	var cont = Number($('#<?=$formCadastroPincipal?> #tel_cont').val());
	cont = cont+1;
    $("#tabela_itens_fone<?=$INC_FAISHER["div"]?> tbody").append('<tr id="tr'+cont+'"><td><select name="tel_tipo'+cont+'" id="tel_tipo'+cont+'" class="span12"><?=$html_tipo?></select></td><td><input type="text" name="tel_numero'+cont+'" id="tel_numero'+cont+'" value="" class="span11"></td><td><div class="check-line"><input id="tel_principal'+cont+'" name="tel_principal" type="radio" value="'+cont+'" data-skin="square" data-color="blue" /><label class="inline" for="tel_principal'+cont+'">Principal</label></div></td><td><button type="button" class="btn" onclick="delLinhaTel<?=$INC_FAISHER["div"]?>(\'0\',\''+cont+'\');"><i class="icon-trash"></i></button><input id="tel_id'+cont+'" name="tel_id'+cont+'" type="hidden" value="0" /><input id="tel_del'+cont+'" name="tel_del'+cont+'" type="hidden" value="0" /></td></tr>');

		$("#<?=$formCadastroPincipal?> #tel_tipo"+cont).select2();
		$("#<?=$formCadastroPincipal?> #tel_numero"+cont).mask("(+999) 999 99 99 99");
		$("#<?=$formCadastroPincipal?> #tel_principal"+cont).each(function(){
			var $el = $(this);
			var skin = ($el.attr('data-skin') !== undefined) ? "_"+$el.attr('data-skin') : "",
			color = ($el.attr('data-color') !== undefined) ? "-"+$el.attr('data-color') : "";
			var opt = {
				checkboxClass: 'icheckbox' + skin + color,
				radioClass: 'iradio' + skin + color,
				increaseArea: "10%"
			}
			$el.iCheck(opt);
		});
	
	$('#<?=$formCadastroPincipal?> #tel_numero'+cont).focus();
	$('#<?=$formCadastroPincipal?> #tel_cont').val(cont);
}//addLinhaInfoI


function delLinhaTel<?=$INC_FAISHER["div"]?>(v_id,v_tr){
		var isel = $("#<?=$formCadastroPincipal?> #tabela_itens_fone<?=$INC_FAISHER["div"]?> input[name='tel_principal']:checked").val();
		$('#<?=$formCadastroPincipal?> #tabela_itens_fone<?=$INC_FAISHER["div"]?> #tel_principal'+v_tr).attr('name','nomee_off');
		if(isel == v_tr){
			//Executa Loop entre todas as Radio buttons com o name de valor
			$('#<?=$formCadastroPincipal?> #tabela_itens_fone<?=$INC_FAISHER["div"]?> input:radio[name=tel_principal]').each(function() {
				//Verifica qual está selecionado if($(this).is(':checked'))
				$(this).iCheck('check');
				return false;
			});
		}
	if(v_id == "0"){
		$('#<?=$formCadastroPincipal?> #tabela_itens_fone<?=$INC_FAISHER["div"]?> #tr'+v_tr).remove();
	}else{
		$('#<?=$formCadastroPincipal?> #tabela_itens_fone<?=$INC_FAISHER["div"]?> #tel_del'+v_tr).val('1');
		$('#<?=$formCadastroPincipal?> #tabela_itens_fone<?=$INC_FAISHER["div"]?> #tr'+v_tr).fadeOut();
	}
}//delLinhaTel
</script>

											<div style="padding-top:10px;">
												<button type="button" class="btn" onclick="addLinhaTel<?=$INC_FAISHER["div"]?>();"><i class="icon-plus-sign"></i> Adicionar outra linha de telefone fixo</button>
                                            </div>

											</div>
										</div>                                        
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            





                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "dadosendersede".$array_temp;//id de controle
						$boxUI_titulo = "Endereço da Sede do Candidato Jurídico";// titulo
						$boxUI_status = "off";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
							<div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        
                                        
             <input name="sede_id_end" type="hidden" id="sede_id_end" value="<?=$sede_id_end?>" /> 
             <input name="mesmo_sede" type="hidden" id="mesmo_sede" value="1" /> 

									
                                            <div class="control-group">
                                                <label class="control-label">País</label>
                                                <div class="controls">
                            <input type='hidden' value="" name='sede_pais' id='sede_pais' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #sede_pais').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar um país >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=pais&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100 // page size
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	<?php if($sede_pais_a_data != ""){?>$("#<?=$formCadastroPincipal?> #sede_pais").select2("data", <?=$sede_pais_a_data?>);<?php }?>
	$("#<?=$formCadastroPincipal?> #sede_pais").on("change", function(e){ 
		$('#<?=$formCadastroPincipal?> #sede_uf').select2("data", ''); 
		$('#<?=$formCadastroPincipal?> #sede_cidade_id').select2("data", ''); 		
	});	
});
</script>                                        
												</div>
                                        	</div>
										<div class="control-group row-fluid end_sedmun">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Subdivisão/estado</label>
                                                <div class="controls">
<input type='hidden' value="" name='sede_uf' id='sede_uf' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #sede_uf').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar um subdivisão >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=uf&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					add: 1,
					pais: $("#<?=$formCadastroPincipal?> #sede_pais").val()
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	<?php if($sede_uf_a_data != ""){?>$("#<?=$formCadastroPincipal?> #sede_uf").select2("data", <?=$sede_uf_a_data?>);<?php }?>
	$("#<?=$formCadastroPincipal?> #sede_uf").on("change", function(e){ $('#<?=$formCadastroPincipal?> #sede_cidade_id').select2("data", ''); });	
});
</script>
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Prefeitura/cidade</label>
                                                <div class="controls">
<input type='hidden' value="" name='sede_cidade_id' id='sede_cidade_id' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #sede_cidade_id').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar uma cidade >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=cidade&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					uf: $("#<?=$formCadastroPincipal?> #sede_uf").val()
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	<?php if($sede_cidade_id_a_data != ""){?>$("#<?=$formCadastroPincipal?> #sede_cidade_id").select2("data", <?=$sede_cidade_id_a_data?>);<?php }?>
});
</script>
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group row-fluid end_sedmun">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Logradouro</label>
                                                <div class="controls">
<input type='hidden' value="" name='sede_logradouro' id='sede_logradouro' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #sede_logradouro').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar um logradouro >> (comece a digitar para buscar/adicionar)',
		ajax: {
			url: "<?=$AJAX_PAG?>?<?=$faisherGet?>&ajax=selLogradouro&add&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 50, // page size
					cidade: $("#<?=$formCadastroPincipal?> #sede_cidade_id").val()
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	<?php if($sede_logradouro_a_data != ""){?>$("#<?=$formCadastroPincipal?> #sede_logradouro").select2("data", <?=$sede_logradouro_a_data?>);<?php }?>
});
</script>
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Setor</label>
                                                <div class="controls">
<input type='hidden' value="" name='sede_bairro' id='sede_bairro' style="width:98%;"/>
<script type="text/javascript">
$(document).ready(function(){
	//dados de combobox
	$('#<?=$formCadastroPincipal?> #sede_bairro').select2({
		/*maximumSelectionSize: 1,multiple: true,//*/
		placeholder: 'Selecionar um setor >> (comece a digitar para buscar)',
		ajax: {
			url: "geral/combo_ajax.php?ajax=comboBairros&add&scriptoff",
			dataType: 'json',
			quietMillis: 100,
			data: function (term, page) {
				return {
					term: term, //search term
					page_limit: 100, // page size
					cidade: $("#<?=$formCadastroPincipal?> #sede_cidade_id").val()
				};
			},
			results: function (data, page) {
				return { results: data.results };
			}
		},
		formatResult: formatSelect2HTML,
		formatSelection: formatSelect2HTML,
		escapeMarkup: function(m) { return m; }
	});
	<?php if($sede_bairro_a_data != ""){?>$("#<?=$formCadastroPincipal?> #sede_bairro").select2("data", <?=$sede_bairro_a_data?>);<?php }?>
});
</script>
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group row-fluid end_sedmun">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Número</label>
                                                <div class="controls">
                                                  <input type="text" name="sede_numero" id="sede_numero" value="<?=$sede_numero_a?>" class="span6 cssFonteMai">
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Complemento</label>
                                                <div class="controls">
                                                  <input type="text" name="sede_complemento" id="sede_complemento" value="<?=$sede_complemento_a?>" class="span6 cssFonteMai">
                                                </div>
                                            </div>
										</div>
										</div>
										<div class="control-group row-fluid end_sedmun">
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Tipo de Imóvel</label>
                                                <div class="controls">
                                                    <select name="sede_quadra" id="sede_quadra" class="span6 cssFonteMai">
                                                    	<?php $var = "";?><option value="<?=$var?>" <?php if($var == $sede_quadra_a){ echo 'selected'; }?>>Selecione...</option>
                                                    	<?php $var = "ESCRITÓRIO";?><option value="<?=$var?>" <?php if($var == $sede_quadra_a){ echo 'selected'; }?>><?=$var?></option>
                                                    	<?php $var = "EDIFÍCIO";?><option value="<?=$var?>" <?php if($var == $sede_quadra_a){ echo 'selected'; }?>><?=$var?></option>
                                                    </select>                                                 
                                                </div>
                                            </div>
										</div>
                                        <div class="span6">
                                            <div class="control-group">
                                                <label class="control-label">Sala</label>
                                                <div class="controls">
                                                  <input type="text" name="sede_sala" id="sede_sala" value="<?=$sede_sala_a?>" class="span6 cssFonteMai">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Código de Energia</label>
                                            <div class="controls">
                                              <input type="text" name="codigo_energia" id="codigo_energia" value="<?=$codigo_energia_a?>" class="span3">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Referência</label>
                                            <div class="controls">
                                              <textarea name="referencia" id="referencia" rows="3" class="input-block-level cssFonteMai" placeholder="Referência"><?=$referencia_a?></textarea>
                                            </div>
                                        </div>
                                        
										</div><!-- End .accordion-inner -->
									</div>
								</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
							</div><!-- End .accordion-widget ----------------------------------------------- -->
            
            



            
            
                    	<?php // BLOCO DE DADOS -----------------------accordion-widget--------------------------- >>>
                        $boxUI_id = "infcadastrais".$array_temp;//id de controle
						$boxUI_titulo = "Informações do Registro";// titulo
						$boxUI_status = "0";// 1 - aberto, 0 - fechado, off - desligado
						$boxUI_rodape = "- ".$boxUI_titulo;//texto rodape
						?>
  <div class="accordion accordion-widget" id="ac_<?=$boxUI_id?>">
								<div class="accordion-group" style="margin-bottom:0;">
									<div class="accordion-heading">
										<a class="accordion-toggle collapsed" <?php if($boxUI_status != "off"){?>data-toggle="collapse" data-parent="#ac_<?=$boxUI_id?>"<?php }?> href="#acc_<?=$boxUI_id?>" id="a_<?=$boxUI_id?>" onclick="return false;">
											<?=$boxUI_titulo?>
										</a>
									</div>
									<div id="acc_<?=$boxUI_id?>" class="accordion-body collapse <?php if(($boxUI_status == "1") or ($boxUI_status == "off")){?> in" style="height: auto;"<?php }else{ echo '" style="height:0px;"';}?>>
										<div class="accordion-inner" style="padding:0;">
                                        

	
                                        
										<div class="control-group">
											<label class="control-label">Data de cadastro</label>
											<div class="controls display">
											  <?=$user_a?>, <?=date("d/m/Y H:i",$time_a)?>h
											</div>
										</div>
                                        <?php if(($user_a_a != "") and ($user_a_a != "0")){ ?>
										<div class="control-group">
											<label class="control-label">Data de alteração</label>
											<div class="controls display">
											  <?=$user_a_a?>, <?=date("d/m/Y H:i",$sync_a)?>h
											</div>
										</div>
                                        <?php }//if($user_a_a != ""){?>

                                        <?php if($id_a >= "1"){ ?>
										<div class="control-group">
											<label class="control-label">Log</label>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_oculta">
                                            <button type="button" class="btn btn-large" onclick="lerLog('divLerLog<?=$INC_FAISHER["div"]?>','<?=$tabela_lerLog?>','<?=$id_a?>');"><i class="icon-magic"></i> Carregar histórico de alterações do registro <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="divLerLog<?=$INC_FAISHER["div"]?>_load" /></button></div>
                                            <div class="controls divLerLog<?=$INC_FAISHER["div"]?>_exibe" style="display:none;">
                                            <a href="#" onclick="$('.divLerLog<?=$INC_FAISHER["div"]?>_exibe, #divLerLog<?=$INC_FAISHER["div"]?>').hide();$('.divLerLog<?=$INC_FAISHER["div"]?>_oculta').fadeIn();return false;" class="btn btn-large" rel="tooltip" title="Visualizar"><i class="icon-eye-close"></i> Ocultar</a></div>
											<div class="controls" id="divLerLog<?=$INC_FAISHER["div"]?>"></div>
										</div>
                                        <?php }//if($id_a >= "1"){?>
                                        
                                        
									  </div><!-- End .accordion-inner -->
									</div>
	</div>
                            <?php if($boxUI_status != "off"){?><a href="#" onclick="$('#a_<?=$boxUI_id?>').click();return false;" class="btn btn-mini" style="margin-top:0;"><i class="icon-retweet"></i> Expandir/ocultar <?=$boxUI_rodape?></a><?php }?>
  </div><!-- End .accordion-widget ----------------------------------------------- -->                            





  <div class="form-actions">
											<button type="submit" class="btn btn-large btn-primary"><?php if($id_a >= "1"){ echo "Salvar alterações"; }else{?>Adicionar Novo<?php }?> <img src="img/ajax-qloader-preto-p.gif" width="18" height="18" style="display:none;" id="btSalvar<?=$array_temp?>" /></button>
											<button type="button" class="btn btn-large esconder-sendload<?=$INC_FAISHER["div"]?>" onclick="<?php if(isset($_GET["POP"])){ echo "pmodalDisplay('hide');"; }else{?>displayAcao<?=$INC_FAISHER["div"]?>('fecha');<?php }?>">Cancelar</button>
										</div>
									</form>
                                    
</div>
<div id="divContent_oculto<?=$array_temp?>" style="display:none;"></div>                                   
<?php
if(isset($_GET["POP"])){ $loaderFoco = "1"; }else{ $loaderFoco = "0"; }
//VALIDA FORM AJAX
$AJAX_COD_INC = "
	if($('#".$formCadastroPincipal."').validate().form() == false){ valedaform = \"0\"; }
	if(valedaform == \"1\"){
		loaderFoco('divContent_loader".$array_temp."','divContent_loader_load".$array_temp."',' já estamos salvando o registro...','".$loaderFoco."');//cria um loader dinamico	
	}";

//include de script jQuery de envio de forms
//VARIAVEIS DE CONTROLE GERAL DO INCLUDE
$AJAX_METODO_INC = "post";//metodo de envio get, post
$AJAX_GET_INC = "ajax=lista&$faisherGet&'+$('#AJAX_GET".$INC_FAISHER["div"]."').val()+'";//vars GET de envio URL
$AJAX_FORM_INC = $formCadastroPincipal;//id do formulario de trabalho
$AJAX_DADOS_INC = "";//nome dos campos de retorno, {'campo='+$('#campo').val()+'&campo2='+$('#campo2').val()} (opcional)
$AJAX_IDFUNCAO_INC = "sendFormCadastroPincipal".$array_temp;//nome da funcao de retorno [nome funcao]();
$AJAX_URL_INC = $AJAX_PAG; //url de envio
$AJAX_LOAD_INC = "ADD"; //define se esconde o conteudo com load - ADD
$AJAX_CARREGANDO_INC = "btSalvar".$array_temp.", #divContent_loader_load".$array_temp; //div de carregando
$AJAX_HIDE_INC = ".esconder-sendload".$INC_FAISHER["div"];//esconder ao carregar
$AJAX_SHOW_INC = ".esconder-sendload".$INC_FAISHER["div"];//mostrar ao carregar
$AJAX_PAG_DIV_INC = "divAjax_lista".$INC_FAISHER["div"]; //div de dados
$AJAX_COD_SUCESS_INC = "displayAcao".$INC_FAISHER["div"]."('fechaHtml');"; //cod java on sucess
if(isset($_GET["POP"])){ $AJAX_PAG_DIV_INC = "divContent_oculto".$array_temp; $AJAX_GET_INC = "ajax=lista&$faisherGet&POP=".$_GET["POP"]; $AJAX_COD_SUCESS_INC = ""; }
include "../sys/inc_sendForms.php";
?>
<?php




}//fim ajax  -------------------------------------------- <<<
?>
<?php





























//AJAX QUE EXIBE LISTA DE ITENS ------------------------------------------------------------------>>>
if($ajax == "lista"){	
	//VERIFICA SE CLIENTE TEM O MÓDULO NOS PACOTES: 4.geoprocessamento
	$modulo_geoprocessamento_ver = "4";
	if(!preg_match("/\.".$modulo_geoprocessamento_ver."\./i", SYS_PACOTE_MODULOS)){ $modulo_geoprocessamento_ver = "0"; }//se nao existir no pacote, zera a variavel






//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||>
if(isset($_GET["id_excluir"])){
	$id_excluir = getpost_sql($_GET["id_excluir"]);

	if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc")){
		//verifica se já existem registros utilizando o item
		$conta_ver = fSQL::SQL_CONTAGEM("cad_candidato_juridico", "admin_candidato_juridico_id = '$id_excluir' OR socio_candidato_juridico LIKE '%.".$id_excluir."-%'");
		//verifica se existe registros vinculados
		if($conta_ver == "0"){//verifica permissão
	
			//exclue o registro
			$tabela = "cad_candidato_juridico";
			$condicao = "id = '$id_excluir'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			fGERAL::delRegistroLog("cad_candidato_juridico",$id_excluir,$cVLogin->userReg());//salvar/gerar log de exclusao
			
			//exclue o registro
			$tabela = "cad_candidato_juridico_endereco";
			$condicao = "candidato_juridico_id = '$id_excluir'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);

			//exclue o registro
			$tabela = "cad_candidato_juridico_enderecocorrespondencia";
			$condicao = "candidato_juridico_id = '$id_excluir'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);

			//exclue o registro
			$tabela = "cad_candidato_juridico_cnae";
			$condicao = "candidato_juridico_id = '$id_excluir'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);

			//exclue o registro
			$tabela = "cad_candidato_juridico_fone";
			$condicao = "candidato_juridico_id = '$id_excluir'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);

			//exclue o registro
			$tabela = "cad_candidato_juridico_celular";
			$condicao = "candidato_juridico_id = '$id_excluir'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);

			//exclue o registro
			$tabela = "cad_candidato_juridico_email";
			$condicao = "candidato_juridico_id = '$id_excluir'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			
			
			//########################################### EXCLUIR FOTOS ####################################>>>>>>>>>>>
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resuM = fSQL::SQL_SELECT_SIMPLES("id,file", "cad_candidato_juridico_logo", "candidato_juridico_id = '$id_excluir'");
			while($linha = fSQL::FETCH_ASSOC($resuM)){
				$id_i = $linha["id"];
				$file_i = $linha["file"];
				//apaga arquivo
				delete(VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_logo/".$id_i.".".fGERAL::mostraExtensao($file_i));
				fBKP::bkpDelFile(VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_logo/".$id_i.".".fGERAL::mostraExtensao($file_i));//adiciona arquivo em lista de excluídos BACKUP	
	
				//exclue o registro
				$tabela = "cad_candidato_juridico_logo";
				$condicao = "id = '$id_i'";
				fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);			
			}//fim while
			//########################################### EXCLUIR FOTOS ####################################<<<<<<<<<<< 
			
			///////////////////// REMOVER DOCUMENTOS >>>>>>>>>>>
			//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
			$resu1 = fSQL::SQL_SELECT_SIMPLES("id,file", "cad_candidato_juridico_docs", "candidato_juridico_id = '$id_excluir'", "");
			while($linha = fSQL::FETCH_ASSOC($resu1)){
				$id_fi = $linha["id"];
				$file_fi = $linha["file"];
				$caminho_arq = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_docs/";
				$arquivoD = $caminho_arq."doc-".$id_e.".".fGERAL::mostraExtensao($file_fi);
				//exclue o arquivo
				if(($arquivoD != "") and (file_exists($arquivoD))){
					delete($arquivoD);
					fBKP::bkpDelFile($arquivoD);//adiciona arquivo em lista de excluídos BACKUP
				}
				$arquivoD = $caminho_arq."valida-".$id_e;
				//exclue a validação
				if(($arquivoD != "") and (file_exists($arquivoD))){
					delete($arquivoD);
					fBKP::bkpDelFile($arquivoD);//adiciona arquivo em lista de excluídos BACKUP
				}
				//exclue o registro
				$tabela = "cad_candidato_juridico_docs";
				$condicao = "id = '$id_fi'";
				fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
		
				//exclue o registros de validação
				$tabela = "apoio_docs_validacao";
				$condicao = "tabela = 'cad_candidato_juridico_docs' AND docs_id = '$id_fi'";
				fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				//exclue o registros de validação
				$tabela = "apoio_scanner_pla";
				$condicao = "tabela = 'cad_candidato_juridico_docs' AND docs_id = '$id_fi'";
				fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			}//fim while fetch
			///////////////////// REMOVER DOCUMENTOS <<<<<<<<<<<<<<
				
			//GERA AÇÃO DO USUÁRIO NA TABELA
			$cVLogin->addAcaoUser("cad_candidato_juridico", "excluir", $id_excluir);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
			//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
			$cMSG->addMSG("SUCESSO","Registro excluido com sucesso!");
		}else{ $cMSG->addMSG("ERRO","Existem $conta_ver registro(s) vinculados ao item! Não é possível remover. $debug_teste"); }//fim else //excluir
	}else{
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Erro nas permissões de seu usuário!");
	}//if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){//verifica permissão

}//fim if(isset($_GET["id_excluir"])){
//################################### EXCLUIR DO REGISTRO - SQL EXCLUIR ||||||||||||||||<







 







//################################# VARIAVEIS DE VALIDACAO DO REGISTRO ||||||||||||||||>
$verificaRegistro = "0";
if(isset($_POST["id_a"])){
	$verifica_erro = "0"; //zera variavel de verificacao de erros
	//recebe vars - padrao
	$id_a = getpost_sql($_POST["id_a"]);
	$array_temp = getpost_sql($_POST["array_temp"]);
	//recebe vars - geral
	$code_a = getpost_sql($_POST["code"]);
	$tipo_id_a = getpost_sql($_POST["tipo_id"]);
	$natureza_id_a = getpost_sql($_POST["natureza_id"]);
	$nome_a = getpost_sql($_POST["nome"],"MAIUSCULO");
	$fantasia_a = getpost_sql($_POST["fantasia"],"MAIUSCULO");
	$data_abertura_a = getpost_sql($_POST["data_abertura"], "DATA");
	$insc_estadual_a = getpost_sql($_POST["insc_estadual"]);
	$insc_municipal_a = getpost_sql($_POST["insc_municipal"]);
	$insc_junta_a = getpost_sql($_POST["insc_junta"]);
	$data_junta_a = getpost_sql($_POST["data_junta"], "DATA");
	if(isset($_POST["declara_dms"])){ $declara_dms_a = getpost_sql($_POST["declara_dms"]); }else{ $declara_dms_a = "0"; }
	$obs_geral_a = getpost_sql($_POST["obs_geral"],"MAIUSCULO");
	
	$cnae_principal_a = getpost_sql($_POST["cnae_principal"]);
	$cnae_objetivo_a = getpost_sql($_POST["cnae_objetivo"]);
	$cnae_secundaria_a = getpost_sql($_POST["cnae_secundaria"]);
	
	$candidato_responsavel_a = getpost_sql($_POST["candidato_responsavel"]);
	$admin_candidato_fisico_id_a = getpost_sql($_POST["admin_candidato_fisico_id"]);
	$admin_candidato_juridico_id_a = getpost_sql($_POST["admin_candidato_juridico_id"]);
	$admin_candidato_cotas_a = getpost_sql($_POST["admin_candidato_cotas"]);
	$socio_fisico_cont_a = getpost_sql($_POST["socio_fisico_cont"]);
	$socio_juridico_cont_a = getpost_sql($_POST["socio_juridico_cont"]);
	
	$procurador_fisico_cont_a = getpost_sql($_POST["procurador_fisico_cont"]);
	
	$tel_cont_a = getpost_sql($_POST["tel_cont"]);
	$tel_principal_a = getpost_sql($_POST["tel_principal"]);
	$cel_cont_a = getpost_sql($_POST["cel_cont"]);
	$cel_principal_a = getpost_sql($_POST["cel_principal"]);
	$ema_cont_a = getpost_sql($_POST["ema_cont"]);
	$ema_principal_a = getpost_sql($_POST["ema_principal"]);
	
	if(isset($_POST["sede_municipio"])){ $sede_municipio_a = getpost_sql($_POST["sede_municipio"]); }else{ $sede_municipio_a = "0"; }
	$propriedade_id_a = getpost_sql($_POST["propriedade_id"]);
	$sede_id_end_a = getpost_sql($_POST["sede_id_end"]);
	$sede_pais_a = getpost_sql($_POST["sede_pais"]);
	$sede_uf_a = getpost_sql($_POST["sede_uf"]);
	$sede_cidade_id_a = getpost_sql($_POST["sede_cidade_id"]);
	$sede_bairro_a = getpost_sql($_POST["sede_bairro"],"MAIUSCULO");
	$sede_logradouro_a = getpost_sql($_POST["sede_logradouro"],"MAIUSCULO");
	$sede_quadra_a = getpost_sql($_POST["sede_quadra"],"MAIUSCULO");
	$sede_lote_a = getpost_sql($_POST["sede_lote"],"MAIUSCULO");
	$sede_numero_a = getpost_sql($_POST["sede_numero"],"MAIUSCULO");
	$sede_complemento_a = getpost_sql($_POST["sede_complemento"],"MAIUSCULO");
	$sede_bloco_a = getpost_sql($_POST["sede_bloco"],"MAIUSCULO");
	$sede_sala_a = getpost_sql($_POST["sede_sala"],"MAIUSCULO");
	$sede_cep_a = getpost_sql($_POST["sede_cep"]);
	
	if(isset($_POST["mesmo_sede"])){ $mesmo_sede_a = getpost_sql($_POST["mesmo_sede"]); }else{ $mesmo_sede_a = "0"; }
	$id_end_a = getpost_sql($_POST["id_end"]);
	$uf_a = getpost_sql($_POST["uf"]);
	$cidade_id_a = getpost_sql($_POST["cidade_id"]);
	$bairro_a = getpost_sql($_POST["bairro"],"MAIUSCULO");
	$logradouro_a = getpost_sql($_POST["logradouro"],"MAIUSCULO");
	$quadra_a = getpost_sql($_POST["quadra"],"MAIUSCULO");
	$lote_a = getpost_sql($_POST["lote"],"MAIUSCULO");
	$numero_a = getpost_sql($_POST["numero"],"MAIUSCULO");
	$complemento_a = getpost_sql($_POST["complemento"],"MAIUSCULO");
	$bloco_a = getpost_sql($_POST["bloco"],"MAIUSCULO");
	$sala_a = getpost_sql($_POST["sala"],"MAIUSCULO");
	$cep_a = getpost_sql($_POST["cep"]);
		
	$del_docs_a = getpost_sql($_POST["del_docs"]);
	

	if($modulo_geoprocessamento_ver == "0"){ $sede_municipio_a = "0"; }//VERIFICA SE TEM O MÓDULO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::

		


//VALIDAÇÔES ------------------------------**********
	//valida campo tipo_id_a -- XXX
	if(($tipo_id_a == "") or ($tipo_id_a == "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Informe o tipo de empresa, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo nome_a -- XXX
	if($nome_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo razão social não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo fantasia_a -- XXX
	if($fantasia_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo nome fantasia não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	//valida campo datan_a -- XXX
	if($data_abertura_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- Campo data de abertura não pode estar vazio, preencha corretamente!";//msg
	}//fim if valida campo
	
	if($insc_municipal_a != ""){
		//verifica se já existe no sistem
		$sql_complemto = " AND id != '$id_a'";	
		if($id_a == "0"){ $sql_complemto = ""; }//if($id_a == "0"){
		$cont_ = "0";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("nome", "cad_candidato_juridico", "insc_municipal = '$insc_municipal_a' $sql_complemto", "");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$nome_aa = $linha1["nome"];
			$cont_++;
		}//fim while
		if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Inscrição municipal já existe um candidato $nome_aa ($insc_municipal_a) em uso, não pode ser utilizados iguais! Utilize a busca para localizar e editar o cadastro.";//msg
		}//fim if valida campo
	}//if($insc_municipal_a != ""){
	
	if($insc_estadual_a != ""){
		//verifica se já existe no sistem
		$sql_complemto = " AND id != '$id_a'";	
		if($id_a == "0"){ $sql_complemto = ""; }//if($id_a == "0"){
		$cont_ = "0";
		$resu1 = fSQL::SQL_SELECT_SIMPLES("nome", "cad_candidato_juridico", "insc_estadual = '$insc_estadual_a' $sql_complemto", "");
		while($linha1 = fSQL::FETCH_ASSOC($resu1)){
			$nome_aa = $linha1["nome"];
			$cont_++;
		}//fim while
		if($cont_ >= "1"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Inscrição estadual já existe um candidato $nome_aa ($insc_estadual_a) em uso, não pode ser utilizados iguais! Utilize a busca para localizar e editar o cadastro.";//msg
		}//fim if valida campo
	}//if($insc_estadual_a != ""){
	//valida campo cnae_principal_a -- XXX
	if(($cnae_principal_a == "") or ($cnae_principal_a == "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
		$verifica_erro .= "- A atividade principal CNAE deve ser informada, preencha corretamente!";//msg
	}//fim if valida campo	
		
	
	$validar_admin = "0"; $admin_ok = "0"; $validar_cotas = "0";
	//valida campo admin_candidato_fisico_id_a -- XXX
	if(($admin_candidato_fisico_id_a != "") and ($admin_candidato_fisico_id_a != "0") and ($candidato_responsavel_a == "F")){  $validar_admin = "1"; $admin_ok = "1"; }
	//valida campo admin_candidato_juridico_id_a -- XXX
	if(($admin_candidato_juridico_id_a != "") and ($admin_candidato_juridico_id_a == "0") and ($candidato_responsavel_a == "J")){ $validar_admin = "1"; $admin_ok = "1"; }
	//monta dados de lista de sócio e valida ----------------------------------------------------------------------
	$total_cotas = str_replace(",",".",$admin_candidato_cotas_a);
	$socio_candidato_fisico_a = "";//FISICO
	if($socio_fisico_cont_a >= "1"){		
		$cont = "0";
		while($cont <= $socio_fisico_cont_a){
			$cont++;
			if((isset($_POST["fisico_id".$cont])) and ($_POST["fisico_id".$cont] != "") and ($_POST["fisico_cotas".$cont] != "")){
				$fisico_id = $_POST["fisico_id".$cont];
				$fisico_cotas = $_POST["fisico_cotas".$cont];
				if($socio_candidato_fisico_a != ""){ $socio_candidato_fisico_a .= "."; }
				$socio_candidato_fisico_a .= $fisico_id."-".$fisico_cotas;
				$total_cotas = $total_cotas+str_replace(",",".",$fisico_cotas);
				$validar_admin++;
			}//isset
		}//fim while
		if($socio_candidato_fisico_a != ""){ $socio_candidato_fisico_a = "[.".$socio_candidato_fisico_a.".]"; }
	}//if($socio_fisico_cont_a >= "1"){
	$socio_candidato_juridico_a = "";//JURIDICO
	if($socio_juridico_cont_a >= "1"){		
		$cont = "0";
		while($cont <= $socio_juridico_cont_a){
			$cont++;
			if((isset($_POST["juridico_id".$cont])) and ($_POST["juridico_id".$cont] != "") and ($_POST["juridico_cotas".$cont] != "")){
				$juridico_id = $_POST["juridico_id".$cont];
				$juridico_cotas = $_POST["juridico_cotas".$cont];
				if($socio_candidato_juridico_a != ""){ $socio_candidato_juridico_a .= "."; }
				$socio_candidato_juridico_a .= $juridico_id."-".$juridico_cotas;
				$total_cotas = $total_cotas+str_replace(",",".",$juridico_cotas);
				$validar_admin++;
			}//isset
		}//fim while
		if($socio_candidato_juridico_a != ""){ $socio_candidato_juridico_a = "[.".$socio_candidato_juridico_a.".]"; }
	}//if($socio_juridico_cont_a >= "1"){
	if($validar_admin >= "1"){
		if($admin_ok == "0"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Você informou sócios, precisa também informar o sócio responsável pela empresa, preencha corretamente!";//msg
		}
		$validar_cotas = "1";
	}//fim if($validar_admin >= "1"){
	if($validar_cotas == "1"){	
		//valida campo total_cotas -- XXX
		if($total_cotas > "100"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- A soma das % COTAS de sócio/responsável utrapassou 100%, preencha corretamente!";//msg
		}//fim if valida campo	
		//valida campo total_cotas -- XXX
		if($total_cotas < "100"){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- A soma das % COTAS de sócio/responsável devem alcançar 100%, preencha corretamente!";//msg
		}//fim if valida campo	
	}//if($validar_cotas == "1"){
	
	//lista de procurador e valida ----------------------------------------------------------------------
	if($procurador_fisico_cont_a >= "1"){		
		$cont = "0";
		while($cont <= $procurador_fisico_cont_a){
			$cont++;
			if((isset($_POST["procurador_fisico_id".$cont])) and ($_POST["procurador_fisico_id".$cont] != "")){
				$procurador_data = $_POST["procurador_data".$cont];
				//valida campo total_cotas -- XXX
				if(($procurador_data == "") or ($procurador_data == "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
					$verifica_erro .= "- Informe data de expiração para o procurador, preencha corretamente! ($cont)";//msg
				}//fim if valida campo	
			}//isset
		}//fim while
	}//if($procurador_fisico_cont_a >= "1"){
		

	//monta array de tel_cont_a
	$cont = "0"; unset($i_ARRAY);
	while($cont <= $tel_cont_a){
		$cont++;
		if((isset($_POST["tel_numero".$cont])) and ($_POST["tel_numero".$cont] != "") and ($_POST["tel_del".$cont] == "0")){
			$i_ARRAY[] = $_POST["tel_numero".$cont];
		}//isset
	}//fim while
	if(isset($i_ARRAY)){
		if(fGERAL::repetidoItemArray($i_ARRAY)){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Existem telefone fixo repetidos na lista, verifique corretamente!";//msg
		}
	}

	//monta array de cel_cont_a
	$cont = "0"; unset($i_ARRAY);
	while($cont <= $cel_cont_a){
		$cont++;
		if((isset($_POST["cel_numero".$cont])) and ($_POST["cel_numero".$cont] != "") and ($_POST["cel_del".$cont] == "0")){
			$i_ARRAY[] = $_POST["cel_numero".$cont];
		}//isset
	}//fim while
	if(!isset($i_ARRAY)){  
	}else{
		if(fGERAL::repetidoItemArray($i_ARRAY)){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Existem telefone celular repetidos na lista, verifique corretamente!.";//msg
		}
	}
		

	
	if($sede_municipio_a >= "1"){
		//valida campo tipo_id_a -- XXX
		if(($propriedade_id_a == "") or ($propriedade_id_a == "0")){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Informe a propriedade sede ou utilize o endereço, preencha corretamente!";//msg
		}//fim if valida campo
	}else{//if($sede_municipio_a >= "1"){
		$propriedade_id_a = "0";
		//valida campo cidade_id_a -- XXX
		if($sede_cidade_id_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Informe a cidade da sede não pode estar vazio, preencha corretamente!";//msg
		}//fim if valida campo
		//valida campo bairro_a -- XXX
		if($sede_bairro_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Informe o bairro da sede não pode estar vazio, preencha corretamente!";//msg
		}//fim if valida campo
		//valida campo logradouro_a -- XXX
		if($sede_logradouro_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Informe o logradouro da sede não pode estar vazio, preencha corretamente!";//msg
		}//fim if valida campo
		//valida campo quadra_a  lote_a numero_a -- XXX
		if($sede_quadra_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Informe um tipo de imóvel da sede não pode estar vazio, preencha corretamente!";//msg
		}//fim if valida campo
	}//else{//if($sede_municipio_a >= "1"){
	
	if($mesmo_sede_a == "0"){
		//valida campo cidade_id_a -- XXX
		if($cidade_id_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Informe a cidade não pode estar vazio, preencha corretamente!";//msg
		}//fim if valida campo
		//valida campo bairro_a -- XXX
		if($bairro_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Informe o bairro não pode estar vazio, preencha corretamente!";//msg
		}//fim if valida campo
		//valida campo logradouro_a -- XXX
		if($logradouro_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Informe o logradouro não pode estar vazio, preencha corretamente!";//msg
		}//fim if valida campo
		//valida campo quadra_a  lote_a numero_a -- XXX
		if($quadra_a == ""){ if($verifica_erro != "0"){ $verifica_erro .= "<br>"; }else{ $verifica_erro = ""; }
			$verifica_erro .= "- Informe um tipo de imóvel não pode estar vazio, preencha corretamente!";//msg
		}//fim if valida campo
	}//if($mesmo_sede_a == "0"){
		
		
		


	//verifica a existencia de erro ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
	if($verifica_erro != "0"){//verifica se existe erro
		$verificaRegistro = "0";//reabre form
		?>
		<script>
			//TIMER
			$.doTimeout('vTimerOPENList', 500, function(){
				exibMensagem('formPrincipalMSG<?=$INC_FAISHER["div"].$array_temp?>','erro','<i class="icon-ban-circle"></i> <b>Erros encontrados!</b><br><?=$verifica_erro?>',60000);
				<?php if(isset($_GET["POP"])){ ?>$("#pModalConteudo").scrollTop(0);<?php }?>
				<?php if(!isset($_GET["POP"])){ ?>displayAcao<?=$INC_FAISHER["div"]?>('abreHtml');<?php }//fim else if(isset($_GET["POP"])){ ?>
			});//TIMER
		</script>
		<?php
		if(isset($_GET["POP"])){ exit(0); }
	}else{//verificado a existencia de erros ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !ERRO !
		$verificaRegistro = "1";
	}




	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad")){ $verificaRegistro = "0";
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
	}//loginAcesso
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){ $verificaRegistro = "0";
		//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
		$cMSG->addMSG("ERRO","Usuário sem permissão de acesso! Verifique com administrador.");
	}//loginAcesso

}//fim isset if(isset($_POST["id_a"])){
	
//################################################################ VERIFICACOES ALTERA/GRAVA O REGISTRO ||||||||||||||||>
if($verificaRegistro == "1"){



	if($propriedade_id_a == ""){ $propriedade_id_a = "0"; }

	if(preg_match("/NOVO:/",$sede_uf_a)){
		$sede_uf_a = str_replace("NOVO:","",$sede_uf_a);
		
		fSQL::SQL_INSERT_SIMPLES("uf_sigla,uf_nome,pais","combo_uf",array($sede_uf_a,$sede_uf_a,$sede_pais_a));
	}//if(preg_match("/NOVO:/",$cidade_id_a)){


	if(preg_match("/NOVO:/",$sede_cidade_id_a)){
		$sede_cidade_id_aa = str_replace("NOVO:","",$sede_cidade_id_a);
		$sede_cidade_id_a = fSQL::SQL_SELECT_INSERT("combo_cidades");
		
		fSQL::SQL_INSERT_SIMPLES("id,cidade_nome","combo_cidades",array($sede_cidade_id_a,$sede_cidade_id_aa));
	}//if(preg_match("/NOVO:/",$cidade_id_a)){
		
	if(preg_match("/NOVO:/",$sede_bairro_a)){
		$sede_bairro_a = str_replace("NOVO:","",$sede_bairro_a);
		$sede_bairro_aa = fSQL::SQL_SELECT_INSERT("combo_bairros");
		
		fSQL::SQL_INSERT_SIMPLES("id,cidade_id,bairro_nome","combo_bairros",array($sede_bairro_aa,$sede_cidade_id_a,$sede_bairro_a));
	}//if(preg_match("/NOVO:/",$bairro_a)){		
	
	
	
//execulta as ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL ! consultas SQL
unset($ARRAY_LOG);//destroe array de log auditoria
//verifica se grava novo registro
if($id_a == "0"){ //############# IF - GRAVA NOVO REGISTRO |-----> SQL CADASTRO
	$code_a = fGERAL::codeRand(11);

	//insere o registro na tabela do sistema
	//VARS insert simples SQL
	$tabela = "cad_candidato_juridico";
	//busca ultimo id para insert
	$id_a = fSQL::SQL_SELECT_INSERT($tabela, "id");
	$campos = "id,code,origem_id,tipo_id,natureza_id,nome,fantasia,insc_estadual,insc_municipal,data_abertura,insc_junta,data_junta,admin_candidato_fisico_id,admin_candidato_juridico_id,admin_candidato_cotas,socio_candidato_fisico,socio_candidato_juridico,declara_dms,cnae_principal,cnae_objetivo,obs_geral,user,time,user_a,sync";
	$valores = array($id_a,$cVLogin->getVarLogin("SYS_USER_ORIGEM_ID"),$code_a,$tipo_id_a,$natureza_id_a,$nome_a,$fantasia_a,$insc_estadual_a,$insc_municipal_a,$data_abertura_a,$insc_junta_a,$data_junta_a,$admin_candidato_fisico_id_a,$admin_candidato_juridico_id_a,$admin_candidato_cotas_a,$socio_candidato_fisico_a,$socio_candidato_juridico_a,$declara_dms_a,$cnae_principal_a,$cnae_objetivo_a,$obs_geral_a,$cVLogin->userReg(),time(),"0",time());
	if($modulo_geoprocessamento_ver >= "1"){//VERIFICA SE TEM O MÓDULO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$campos .= ",propriedade_id";
		$valores[] = $propriedade_id_a;
	}//if($modulo_geoprocessamento_ver >= "1"){//VERIFICA SE TEM O MÓDULO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	



		
	


//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
	$msg_cont = "";	$cont_arquivo = "0";
	//verifica se existem arquivos temp no sistema
	$upload_dir_temp = VAR_DIR_FILES."files/temp/";
	$campos = "id,titulo,nome,arquivo";
	$tabela = "sys_arquivos_temp";
	$where = "acao = '$array_temp' AND form = 'fotoPerfil".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$titulo_e = $linha["titulo"];
		$nome_e = $linha["nome"];
		$arquivo_e = $linha["arquivo"];
		if(file_exists($upload_dir_temp.$arquivo_e)){
			$cont_arquivo++;//faz contagem de arquivos enviados
			//VARS insert simples SQL
			$tabela = "cad_candidato_juridico_logo";
			//busca ultimo id para insert
			$id_f = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,candidato_juridico_id,file,time";
			$valores = array($id_f,$id_a,$arquivo_e,time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			
			//preparando o envio do arquivo temp para o definitivo
			$upload_dir = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_logo/";
			$pasta_c = fGERAL::criaPasta($upload_dir);
			if($pasta_c == 1){ fBKP::bkpAddFolder($upload_dir); }//(confirma a criação da pasta)adiciona criação de pasta em lista de BACKUP
			$arquivo_n = $id_f.".".fGERAL::mostraExtensao($arquivo_e); //monta nome do novo arquivo
			//move o arquivo para o novo local e exclue o temp
			rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_n);
			fBKP::bkpFile($upload_dir.$arquivo_n);//adiciona arquivo em lista de arquivo BACKUP

			//exclue o registro
			$tabela = "sys_arquivos_temp";
			$condicao = "id = '$id_e'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
		}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
	}//fim while
//########################################### iFRAME TEMP ####################################<<<<<<<<<<<
		
	


//########################################### iFRAME TEMP FOTOCAM ####################################>>>>>>>>>>>
	//verifica se existem arquivos temp no sistema
	$upload_dir_temp = VAR_DIR_FILES."files/temp/snapshot/";
	$campos = "id,titulo,arquivo";
	$tabela = "sys_snapshot_temp";
	$where = "acao = '$array_temp' AND form = 'camfotoPerfil".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$titulo_e = $linha["titulo"];
		$arquivo_e = $linha["arquivo"];
		if(file_exists($upload_dir_temp.$arquivo_e)){
			$cont_arquivo++;//faz contagem de arquivos enviados
			//VARS insert simples SQL
			$tabela = "cad_candidato_juridico_logo";
			//busca ultimo id para insert
			$id_f = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,candidato_juridico_id,file,time";
			$valores = array($id_f,$id_a,$arquivo_e,time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			
			//preparando o envio do arquivo temp para o definitivo
			$upload_dir = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_logo/";
			$pasta_c = fGERAL::criaPasta($upload_dir);
			if($pasta_c == 1){ fBKP::bkpAddFolder($upload_dir); }//(confirma a criação da pasta)adiciona criação de pasta em lista de BACKUP
			$arquivo_n = $id_f.".".fGERAL::mostraExtensao($arquivo_e); //monta nome do novo arquivo
			//move o arquivo para o novo local e exclue o temp
			rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_n);
			fBKP::bkpFile($upload_dir.$arquivo_n);//adiciona arquivo em lista de arquivo BACKUP

			//exclue o registro
			$tabela = "sys_snapshot_temp";
			$condicao = "id = '$id_e'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
		}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
	}//fim while
	if($cont_arquivo >= "1"){ $msg_cont = " $cont_arquivo arquivo(s) recebido(s).";	}
//########################################### iFRAME TEMP FOTOCAM ####################################<<<<<<<<<<<
		



	$rm_a = fRM::getRMCandidato($id_a,"J",1);
	//############### BUSCA OS ANEXOS/DOCS ADICIONADOS-----------------------||||||||||||||>>>
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id", "cad_candidato_juridico_docs", "candidato_juridico_id = '0' AND temp = '$array_temp'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		
		//atualiza dados da tabela no DB
		$campos = "candidato_juridico_id,temp";
		$tabela = "cad_candidato_juridico_docs";
		$valores = array($id_a,"NULL");
		$condicao = "id='$id_i'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);		
		//atualiza dados da tabela no DB
		$campos = "rm";
		$tabela = "apoio_docs_validacao";
		$valores = array($rm_a);
		$condicao = "tabela = 'cad_candidato_juridico_docs' AND docs_id = '$id_i'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);		
		//atualiza dados da tabela no DB
		$campos = "rm";
		$tabela = "apoio_scanner_pla";
		$valores = array($rm_a);
		$condicao = "tabela = 'cad_candidato_juridico_docs' AND docs_id = '$id_i'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	}//while
	//############### BUSCA OS ANEXOS/DOCS ADICIONADOS-----------------------||||||||||||||<<<





///////////////////// GRAVA DADOS CNAE SECUNDARIO >>>>>>>>>>>
	//monta array de dados
	$sql_removecnae = ""; $itens_log = "";
	$array = explode(",", $cnae_secundaria_a);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				//insere o registro na tabela do sistema
				//VARS insert simples SQL
				$tabela = "cad_candidato_juridico_cnae";
				//busca ultimo id para insert
				$id_cn = fSQL::SQL_SELECT_INSERT($tabela, "id");
				$campos = "id,candidato_juridico_id,cnae_subclasse_id,time";
				$valores = array($id_cn,$id_a,$valor,time());
				fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
				//gera log
				$linha = fSQL::SQL_SELECT_ONE("codigo", "combo_cnae_subclasse", "id = '$valor'", "");
				if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["codigo"];
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	//gera log de retorn tabela principal
	if($itens_log != ""){
		$campos = "cnae_secundaria,user_a,sync";
		$tabela = "cad_candidato_juridico_cnae";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){
	//fim for exibe array
///////////////////// GRAVA DADOS CNAE SECUNDARIO <<<<<<<<<<<<<<


	
	//lista de procurador e valida ----------------------------------------------------------------------
	if($procurador_fisico_cont_a >= "1"){
		$cont = "0"; $itens_log = "";
		while($cont <= $procurador_fisico_cont_a){
			$cont++;
			if((isset($_POST["procurador_fisico_id".$cont])) and ($_POST["procurador_fisico_id".$cont] != "")){
				$procurador_fisico_id = $_POST["procurador_fisico_id".$cont];
				$procurador_data = $_POST["procurador_data".$cont];
				$procurador_data_t = time_data_hora("$procurador_data 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
				//VARS insert simples SQL
				$tabela = "cad_candidato_juridico_procurador";
				$campos = "candidato_id,procurador_fisico_id,time,time_expira";
				$valores = array($id_a,$procurador_fisico_id,time(),$procurador_data_t);
				fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
				//gera log
				$linha = fSQL::SQL_SELECT_ONE("nome,code", "cad_candidato_fisico", "id = '$procurador_fisico_id'", "");
				if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["nome"]."(".$linha["code"].") - Expira: ".$procurador_data;
			}//isset
		}//fim while
		//gera log de retorn tabela principal
		if($itens_log != ""){
			$campos = "itens,user_a,sync";
			$tabela = "cad_candidato_juridico_procurador";
			$valores = array($itens_log,$cVLogin->userReg(),time());
			$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
		}//if($itens_log != ""){
	}//if($procurador_fisico_cont_a >= "1"){

	
	


	//GRAVA DADOS DO ENDEREÇO SEDE_--------------------------------------------------------------------------------------------------------
	if($sede_municipio_a == "0"){
		//insere o registro na tabela do sistema
		//VARS insert simples SQL
		$tabela = "cad_candidato_juridico_endereco";
		//busca ultimo id para insert
		$id_s = fSQL::SQL_SELECT_INSERT($tabela, "id");
		$campos = "id,candidato_juridico_id,pais,uf,cidade_id,bairro,logradouro,quadra,lote,numero,complemento,bloco,sala,cep,user,time,user_a,sync";
		$valores = array($id_s,$id_a,$sede_pais_a,$sede_uf_a,$sede_cidade_id_a,$sede_bairro_a,$sede_logradouro_a,$sede_quadra_a,$sede_lote_a,$sede_numero_a,$sede_complemento_a,$sede_bloco_a,$sede_sala_a,$sede_cep_a,$cVLogin->userReg(),time(),"0",time());
		$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($sede_municipio_a == "0"){


	//GRAVA DADOS DO ENDEREÇO CORRESPONDENCIA_--------------------------------------------------------------------------------------------------------
	if($mesmo_sede_a == "0"){
		//insere o registro na tabela do sistema
		//VARS insert simples SQL
		$tabela = "cad_candidato_juridico_enderecocorrespondencia";
		//busca ultimo id para insert
		$id_e = fSQL::SQL_SELECT_INSERT($tabela, "id");
		$campos = "id,candidato_juridico_id,uf,cidade_id,bairro,logradouro,quadra,lote,numero,complemento,bloco,sala,cep,user,time,user_a,sync";
		$valores = array($id_e,$id_a,$uf_a,$cidade_id_a,$bairro_a,$logradouro_a,$quadra_a,$lote_a,$numero_a,$complemento_a,$bloco_a,$sala_a,$cep_a,$cVLogin->userReg(),time(),"0",time());
		$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
		
			
		//atualiza dados da tabela no DB
		$campos = "endereco_correspondencia_id";
		$tabela = "cad_candidato_juridico";
		$valores = array($id_e);
		$condicao = "id='$id_a'";
		fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
	}//if($mesmo_sede_a == "0"){


	/// VARRE LISTAS ------------------------------------------------------------------------------------------|||||||||||||||||||
	
	//verifica lista de telefone fixo
	$cont = "0"; $itens_log = "";
	while($cont <= $tel_cont_a){
		$cont++;
		if((isset($_POST["tel_numero".$cont])) and ($_POST["tel_numero".$cont] != "")){
			$tel_id = $_POST["tel_id".$cont];
			$tel_tipo = $_POST["tel_tipo".$cont];
			$tel_numero = $_POST["tel_numero".$cont];
			if($tel_principal_a == $cont){ $tel_principal = "1"; }else{ $tel_principal = "0"; }
			//VARS insert simples SQL
			$tabela = "cad_candidato_juridico_fone";
			//busca ultimo id para insert
			$tel_id = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,candidato_juridico_id,tipo_id,principal,fone,time";
			$valores = array($tel_id,$id_a,$tel_tipo,$tel_principal,$tel_numero,time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			//gera log
			$linha = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_fone_tipo", "id = '$tel_tipo'", "");
			if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["legenda"]." - ".$tel_numero;
		}//isset
	}//fim while
	//gera log de retorn tabela principal
	if($itens_log != ""){
		$campos = "itens,user_a,sync";
		$tabela = "cad_candidato_juridico_fone";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){
	
	//verifica lista de telefone celular
	$cont = "0"; $itens_log = "";
	while($cont <= $cel_cont_a){
		$cont++;
		if((isset($_POST["cel_numero".$cont])) and ($_POST["cel_numero".$cont] != "")){
			$cel_id = $_POST["cel_id".$cont];
			$cel_tipo = $_POST["cel_tipo".$cont];
			$cel_numero = getpost_sql($_POST["cel_numero".$cont], "CELULAR");
			if($cel_principal_a == $cont){ $cel_principal = "1"; }else{ $cel_principal = "0"; }
			//VARS insert simples SQL
			$tabela = "cad_candidato_juridico_celular";
			//busca ultimo id para insert
			$cel_id = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,candidato_juridico_id,tipo_id,principal,celular,time";
			$valores = array($cel_id,$id_a,$cel_tipo,$cel_principal,$cel_numero,time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			//gera log
			$linha = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_celular_tipo", "id = '$cel_tipo'", "");
			if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["legenda"]." - ".$cel_numero;
		}//isset
	}//fim while
	if($itens_log != ""){
		$campos = "itens,user_a,sync";
		$tabela = "cad_candidato_juridico_celular";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){
	
	//verifica lista de emails
	$cont = "0"; $itens_log = "";
	while($cont <= $ema_cont_a){
		$cont++;
		if((isset($_POST["ema_email".$cont])) and ($_POST["ema_email".$cont] != "")){
			$ema_id = $_POST["ema_id".$cont];
			$ema_tipo = $_POST["ema_tipo".$cont];
			$ema_email = getpost_sql($_POST["ema_email".$cont]);
			if($ema_principal_a == $cont){ $ema_principal = "1"; }else{ $ema_principal = "0"; }
			//VARS insert simples SQL
			$tabela = "cad_candidato_juridico_email";
			//busca ultimo id para insert
			$ema_id = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,candidato_juridico_id,tipo_id,principal,email,time";
			$valores = array($ema_id,$id_a,$ema_tipo,$ema_principal,$ema_email,time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			//gera log				
			$linha = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_email_tipo", "id = '$ema_tipo'", "");
			if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["legenda"]." - ".$ema_email;
		}//isset
	}//fim while
	if($itens_log != ""){
		$campos = "itens,user_a,sync";
		$tabela = "cad_candidato_juridico_email";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){


	/// VARRE LISTAS ------------------------------------------------------------------------------------------|||||||||||||||||||








	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("cad_candidato_juridico", "adicionar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("cad_candidato_juridico",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Candidato jurídico cadastrado com sucesso!$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a> ".SYS_CONFIG_RM_SIGLA.": ".fGERAL::legCode($id_a,$code_a));







}else{  //############# ELSE - ALTERA REGISTRO |-


	
	
	//GRAVA DADOS DO ENDEREÇO SEDE_--------------------------------------------------------------------------------------------------------
	if($sede_municipio_a == "0"){
		$conta_sede_end = fSQL::SQL_CONTAGEM("cad_candidato_juridico_endereco", "id = '$sede_id_end_a' AND candidato_juridico_id = '$id_a'");
		if($conta_sede_end >= "1"){
			//atualiza dados da tabela no DB
			$campos = "pais,uf,cidade_id,bairro,logradouro,quadra,lote,numero,complemento,bloco,sala,cep,user_a,sync";
			$tabela = "cad_candidato_juridico_endereco";
			$valores = array($sede_pais_a,$sede_uf_a,$sede_cidade_id_a,$sede_bairro_a,$sede_logradouro_a,$sede_quadra_a,$sede_lote_a,$sede_numero_a,$sede_complemento_a,$sede_bloco_a,$sede_sala_a,$sede_cep_a,$cVLogin->userReg(),time());
			$condicao = "id='$sede_id_end_a'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
			$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
			
		}else{//if($conta_sede_end >= "1"){
			//insere o registro na tabela do sistema
			//VARS insert simples SQL
			$tabela = "cad_candidato_juridico_endereco";
			//busca ultimo id para insert
			$id_s = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,candidato_juridico_id,pais,uf,cidade_id,bairro,logradouro,quadra,lote,numero,complemento,bloco,sala,cep,user,time,user_a,sync";
			$valores = array($id_s,$id_a,$sede_pais_a,$sede_uf_a,$sede_cidade_id_a,$sede_bairro_a,$sede_logradouro_a,$sede_quadra_a,$sede_lote_a,$sede_numero_a,$sede_complemento_a,$sede_bloco_a,$sede_sala_a,$sede_cep_a,$cVLogin->userReg(),time(),"0",time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
			$sede_id_end_a = $id_s;
		}//else{//if($conta_sede_end >= "1"){
	}else{//if($sede_municipio_a == "0"){
		if($id_a >= "1"){
			//exclue o registro
			$tabela = "cad_candidato_juridico_endereco";
			$condicao = "candidato_juridico_id = '$id_a'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
		}//if($id_a >= "1"){
	}//else{//if($sede_municipio_a == "0"){
	



	
	//GRAVA DADOS DO ENDEREÇO CORRESPONDENCIA_--------------------------------------------------------------------------------------------------------
	if($mesmo_sede_a == "0"){
		$conta_end = fSQL::SQL_CONTAGEM("cad_candidato_juridico_enderecocorrespondencia", "id = '$id_end_a' AND candidato_juridico_id = '$id_a'");
		if($conta_end >= "1"){
			//atualiza dados da tabela no DB
			$campos = "uf,cidade_id,bairro,logradouro,quadra,lote,numero,complemento,bloco,sala,cep,user_a,sync";
			$tabela = "cad_candidato_juridico_enderecocorrespondencia";
			$valores = array($uf_a,$cidade_id_a,$bairro_a,$logradouro_a,$quadra_a,$lote_a,$numero_a,$complemento_a,$bloco_a,$sala_a,$cep_a,$cVLogin->userReg(),time());
			$condicao = "id='$id_end_a'";
			fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
			$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
			
		}else{//if($conta_end >= "1"){
			//insere o registro na tabela do sistema
			//VARS insert simples SQL
			$tabela = "cad_candidato_juridico_enderecocorrespondencia";
			//busca ultimo id para insert
			$id_e = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,candidato_juridico_id,uf,cidade_id,bairro,logradouro,quadra,lote,numero,complemento,bloco,sala,cep,user,time,user_a,sync";
			$valores = array($id_e,$id_a,$uf_a,$cidade_id_a,$bairro_a,$logradouro_a,$quadra_a,$lote_a,$numero_a,$complemento_a,$bloco_a,$sala_a,$cep_a,$cVLogin->userReg(),time(),"0",time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
			$id_end_a = $id_e;
		}//else{//if($conta_end >= "1"){
	}else{//if($mesmo_sede_a == "0"){
		if($conta_end >= "1"){
			//exclue o registro
			$tabela = "cad_candidato_juridico_enderecocorrespondencia";
			$condicao = "id = '$id_end_a'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
		}//if($conta_end >= "1"){
	}//else{//if($mesmo_sede_a == "0"){
	





		
	//atualiza dados da tabela no DB
	$campos = "tipo_id,natureza_id,nome,fantasia,insc_estadual,insc_municipal,data_abertura,insc_junta,data_junta,endereco_correspondencia_id,admin_candidato_fisico_id,admin_candidato_juridico_id,admin_candidato_cotas,socio_candidato_fisico,socio_candidato_juridico,declara_dms,cnae_principal,cnae_objetivo,obs_geral,user_a,sync";
	$tabela = "cad_candidato_juridico";
	$valores = array($tipo_id_a,$natureza_id_a,$nome_a,$fantasia_a,$insc_estadual_a,$insc_municipal_a,$data_abertura_a,$insc_junta_a,$data_junta_a,$id_end_a,$admin_candidato_fisico_id_a,$admin_candidato_juridico_id_a,$admin_candidato_cotas_a,$socio_candidato_fisico_a,$socio_candidato_juridico_a,$declara_dms_a,$cnae_principal_a,$cnae_objetivo_a,$obs_geral_a,$cVLogin->userReg(),time());
	if($modulo_geoprocessamento_ver >= "1"){//VERIFICA SE TEM O MÓDULO :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		$campos .= ",propriedade_id";
		$valores[] = $propriedade_id_a;
	}//if($modulo_geoprocessamento_ver >= "1"){//VERIFICA SE TEM O MÓDULO ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
	fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, "id='$id_a'");
	$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria






///////////////////// GRAVA DADOS CNAE SECUNDARIO >>>>>>>>>>>
	//monta array de dados
	$sql_removecnae = ""; $itens_log = "";
	$array = explode(",", $cnae_secundaria_a);
	$cont_ARRAY = ceil(count($array));
	if($cont_ARRAY >= "1"){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				$cont_gv = fSQL::SQL_CONTAGEM("cad_candidato_juridico_cnae", "candidato_juridico_id = '$id_a' AND cnae_subclasse_id = '$valor'");
				if($cont_gv == "0"){				//insere o registro na tabela do sistema
					//VARS insert simples SQL
					$tabela = "cad_candidato_juridico_cnae";
					//busca ultimo id para insert
					$id_cn = fSQL::SQL_SELECT_INSERT($tabela, "id");
					$campos = "id,candidato_juridico_id,cnae_subclasse_id,time";
					$valores = array($id_cn,$id_a,$valor,time());
					fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
				}//$cont_gv 				
				$sql_removecnae .= " AND cnae_subclasse_id != '$valor'";
				//gera log
				$linha = fSQL::SQL_SELECT_ONE("codigo", "combo_cnae_subclasse", "id = '$valor'", "");
				if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["codigo"];
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
	if(($sql_removecnae != "") or ($cnae_secundaria_a == "")){
		//exclue o registro
		$tabela = "cad_candidato_juridico_cnae";
		$condicao = "candidato_juridico_id = '$id_a' $sql_removecnae";
		fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
	}//if($sql_removecnae != ""){
	//gera log de retorn tabela principal
	if($itens_log != ""){
		$campos = "cnae_secundaria,user_a,sync";
		$tabela = "cad_candidato_juridico_cnae";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){
	//fim for exibe array
///////////////////// GRAVA DADOS CNAE SECUNDARIO <<<<<<<<<<<<<<








	
//########################################### EXCLUIR FOTOS ####################################>>>>>>>>>>>
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,file", "cad_candidato_juridico_logo", "candidato_juridico_id = '$id_a'");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$file_i = $linha["file"];
		if((isset($_POST["file_del".$id_i])) and ($_POST["file_del".$id_i] >= "1")){
			//apaga arquivo
			delete(VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_logo/".$id_i.".".fGERAL::mostraExtensao($file_i));
			fBKP::bkpDelFile(VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_logo/".$id_i.".".fGERAL::mostraExtensao($file_i));//adiciona arquivo em lista de excluídos BACKUP

			//exclue o registro
			$tabela = "cad_candidato_juridico_logo";
			$condicao = "id = '$id_i'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);			
		}//isset
	}//fim while
//########################################### EXCLUIR FOTOS ####################################<<<<<<<<<<< 
		
	


//########################################### iFRAME TEMP ####################################>>>>>>>>>>>
	$msg_cont = "";	$cont_arquivo = "0";
	//verifica se existem arquivos temp no sistema
	$upload_dir_temp = VAR_DIR_FILES."files/temp/";
	$campos = "id,titulo,nome,arquivo";
	$tabela = "sys_arquivos_temp";
	$where = "acao = '$array_temp' AND form = 'fotoPerfil".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$titulo_e = $linha["titulo"];
		$nome_e = $linha["nome"];
		$arquivo_e = $linha["arquivo"];
		if(file_exists($upload_dir_temp.$arquivo_e)){
			$cont_arquivo++;//faz contagem de arquivos enviados
			//VARS insert simples SQL
			$tabela = "cad_candidato_juridico_logo";
			//busca ultimo id para insert
			$id_f = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,candidato_juridico_id,file,time";
			$valores = array($id_f,$id_a,$arquivo_e,time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			
			//preparando o envio do arquivo temp para o definitivo
			$upload_dir = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_logo/";
			$pasta_c = fGERAL::criaPasta($upload_dir);
			if($pasta_c == 1){ fBKP::bkpAddFolder($upload_dir); }//(confirma a criação da pasta)adiciona criação de pasta em lista de BACKUP
			$arquivo_n = $id_f.".".fGERAL::mostraExtensao($arquivo_e); //monta nome do novo arquivo
			//move o arquivo para o novo local e exclue o temp
			rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_n);
			fBKP::bkpFile($upload_dir.$arquivo_n);//adiciona arquivo em lista de arquivo BACKUP

			//exclue o registro
			$tabela = "sys_arquivos_temp";
			$condicao = "id = '$id_e'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
		}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
	}//fim while
	if($cont_arquivo >= "1"){ $msg_cont = " $cont_arquivo arquivo(s) recebido(s).";	}
//########################################### iFRAME TEMP ####################################<<<<<<<<<<<
		
	


//########################################### iFRAME TEMP FOTOCAM ####################################>>>>>>>>>>>
	$msg_cont = "";	$cont_arquivo = "0";
	//verifica se existem arquivos temp no sistema
	$upload_dir_temp = VAR_DIR_FILES."files/temp/snapshot/";
	$campos = "id,titulo,arquivo";
	$tabela = "sys_snapshot_temp";
	$where = "acao = '$array_temp' AND form = 'camfotoPerfil".$array_temp."' AND usuarios_id = '".$cVLogin->getVarLogin("SYS_USER_ID")."'";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resu1 = fSQL::SQL_SELECT_SIMPLES($campos, $tabela, $where, "");
	while($linha = fSQL::FETCH_ASSOC($resu1)){
		$id_e = $linha["id"];
		$titulo_e = $linha["titulo"];
		$arquivo_e = $linha["arquivo"];
		if(file_exists($upload_dir_temp.$arquivo_e)){
			$cont_arquivo++;//faz contagem de arquivos enviados
			//VARS insert simples SQL
			$tabela = "cad_candidato_juridico_logo";
			//busca ultimo id para insert
			$id_f = fSQL::SQL_SELECT_INSERT($tabela, "id");
			$campos = "id,candidato_juridico_id,file,time";
			$valores = array($id_f,$id_a,$arquivo_e,time());
			$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			
			//preparando o envio do arquivo temp para o definitivo
			$upload_dir = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_logo/";
			$pasta_c = fGERAL::criaPasta($upload_dir);
			if($pasta_c == 1){ fBKP::bkpAddFolder($upload_dir); }//(confirma a criação da pasta)adiciona criação de pasta em lista de BACKUP
			$arquivo_n = $id_f.".".fGERAL::mostraExtensao($arquivo_e); //monta nome do novo arquivo
			//move o arquivo para o novo local e exclue o temp
			rename($upload_dir_temp.$arquivo_e, $upload_dir.$arquivo_n);
			fBKP::bkpFile($upload_dir.$arquivo_n);//adiciona arquivo em lista de arquivo BACKUP

			//exclue o registro
			$tabela = "sys_snapshot_temp";
			$condicao = "id = '$id_e'";
			fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
		}//fim if(file_exists($upload_dir_temp.$arquivo_e)){
	}//fim while
	if($cont_arquivo >= "1"){ $msg_cont = " $cont_arquivo arquivo(s) recebido(s).";	}
//########################################### iFRAME TEMP FOTOCAM ####################################<<<<<<<<<<<



	
	//lista de procurador e valida ----------------------------------------------------------------------
	if($procurador_fisico_cont_a >= "1"){
		$cont = "0"; $itens_log = "";
		while($cont <= $procurador_fisico_cont_a){
			$cont++;
			if((isset($_POST["procurador_fisico_id".$cont])) and ($_POST["procurador_fisico_id".$cont] != "")){
				$procurador_id = $_POST["procurador_id".$cont];
				$procurador_fisico_id = $_POST["procurador_fisico_id".$cont];
				$procurador_data = $_POST["procurador_data".$cont];
				$procurador_data_t = time_data_hora("$procurador_data 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
				$leg_i = "";
				if($procurador_id >= "1"){
					$procurador_del = $_POST["procurador_del".$cont];
					if($procurador_del == "0"){
						//atualiza dados da tabela no DB
						$campos = "time_expira";
						$tabela = "cad_candidato_juridico_procurador";
						$valores = array($procurador_data_t);
						$condicao = "id='$procurador_id' AND candidato_id = '$id_a'";
						fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
					}else{//if($procurador_del == "0"){
						//exclue o registro
						$tabela = "cad_candidato_juridico_procurador";
						$condicao = "id = '$procurador_id' AND candidato_id = '$id_a'";
						fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
						$leg_i = " [DEL]";
					}//if($procurador_del == "0"){	
				}else{//if($procurador_id >= "1"){
					//VARS insert simples SQL
					$tabela = "cad_candidato_juridico_procurador";
					$campos = "candidato_id,procurador_fisico_id,time,time_expira";
					$valores = array($id_a,$procurador_fisico_id,time(),$procurador_data_t);
					fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
				}//else{//if($procurador_id >= "1"){
				//gera log
				$linha = fSQL::SQL_SELECT_ONE("nome,code", "cad_candidato_fisico", "id = '$procurador_fisico_id'", "");
				if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["nome"]."(".$linha["code"].") - Expira: ".$procurador_data.$leg_i;
			}//isset
		}//fim while
		//gera log de retorn tabela principal
		if($itens_log != ""){
			$campos = "itens,user_a,sync";
			$tabela = "cad_candidato_juridico_procurador";
			$valores = array($itens_log,$cVLogin->userReg(),time());
			$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
		}//if($itens_log != ""){
	}//if($procurador_fisico_cont_a >= "1"){





	



///////////////////// REMOVER DOCUMENTOS >>>>>>>>>>>
	//monta array de dados
	$array = explode(",", $del_docs_a);
	$cont_ARRAY = ceil(count($array));
	if(($cont_ARRAY >= "1") and ($del_docs_a != "")){
		foreach ($array as $pos => $valor){
			if($valor != ""){
				//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
				$resu1 = fSQL::SQL_SELECT_SIMPLES("id,file", "cad_candidato_juridico_docs", "id = '$valor' AND candidato_juridico_id = '$id_a'", "");
				while($linha = fSQL::FETCH_ASSOC($resu1)){
					$id_fi = $linha["id"];
					$file_fi = $linha["file"];
					$caminho_arq = VAR_DIR_FILES."files/tabelas/cad_candidato_juridico_docs/";
					$arquivoD = $caminho_arq."doc-".$id_fi.".".fGERAL::mostraExtensao($file_fi);
					//exclue o arquivo
					if(($arquivoD != "") and (file_exists($arquivoD))){
						delete($arquivoD);
						fBKP::bkpDelFile($arquivoD);//adiciona arquivo em lista de excluídos BACKUP
					}
					$arquivoD = $caminho_arq."valida-".$id_fi;
					//exclue a validação
					if(($arquivoD != "") and (file_exists($arquivoD))){
						delete($arquivoD);
						fBKP::bkpDelFile($arquivoD);//adiciona arquivo em lista de excluídos BACKUP
					}
					//exclue o registro
					$tabela = "cad_candidato_juridico_docs";
					$condicao = "id = '$id_fi'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
			
					//exclue o registros de validação
					$tabela = "apoio_docs_validacao";
					$condicao = "tabela = 'cad_candidato_juridico_docs' AND docs_id = '$id_fi'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
					//exclue o registros de validação
					$tabela = "apoio_scanner_pla";
					$condicao = "tabela = 'cad_candidato_juridico_docs' AND docs_id = '$id_fi'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				}//fim while fetch
			}//if($valor != ""){
		}//fim foreach
	}//fim if($cont_ARRAY >= "1"){
///////////////////// REMOVER DOCUMENTOS <<<<<<<<<<<<<<





	/// VARRE LISTAS ------------------------------------------------------------------------------------------|||||||||||||||||||
	
	//verifica lista de telefone fixo
	$cont = "0"; $itens_log = "";
	while($cont <= $tel_cont_a){
		$cont++;
		if((isset($_POST["tel_numero".$cont])) and ($_POST["tel_numero".$cont] != "")){
			$tel_id = $_POST["tel_id".$cont];
			$tel_tipo = $_POST["tel_tipo".$cont];
			$tel_numero = $_POST["tel_numero".$cont];
			if($tel_principal_a == $cont){ $tel_principal = "1"; }else{ $tel_principal = "0"; }
			if($tel_id >= "1"){
				$tel_del = $_POST["tel_del".$cont];
				if($tel_del == "0"){
					//atualiza dados da tabela no DB
					$campos = "tipo_id,principal,fone";
					$tabela = "cad_candidato_juridico_fone";
					$valores = array($tel_tipo,$tel_principal,$tel_numero);
					$condicao = "id='$tel_id' AND candidato_juridico_id = '$id_a'";
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
				}else{//if($tel_del == "0"){
					//exclue o registro
					$tabela = "cad_candidato_juridico_fone";
					$condicao = "id = '$tel_id' AND candidato_juridico_id = '$id_a'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				}//if($tel_del == "0"){		
			}else{//if($tel_id >= "1"){
				//VARS insert simples SQL
				$tabela = "cad_candidato_juridico_fone";
				//busca ultimo id para insert
				$tel_id = fSQL::SQL_SELECT_INSERT($tabela, "id");
				$campos = "id,candidato_juridico_id,tipo_id,principal,fone,time";
				$valores = array($tel_id,$id_a,$tel_tipo,$tel_principal,$tel_numero,time());
				$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			}//if($tel_id >= "1"){
			$linha = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_fone_tipo", "id = '$tel_tipo'", "");
			if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["legenda"]." - ".$tel_numero;
		}//isset
	}//fim while
	//gera log de retorn tabela principal
	if($itens_log != ""){
		$campos = "itens,user_a,sync";
		$tabela = "cad_candidato_juridico_fone";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){
	
	//verifica lista de telefone celular
	$cont = "0"; $itens_log = "";
	while($cont <= $cel_cont_a){
		$cont++;
		if((isset($_POST["cel_numero".$cont])) and ($_POST["cel_numero".$cont] != "")){
			$cel_id = $_POST["cel_id".$cont];
			$cel_tipo = $_POST["cel_tipo".$cont];
			$cel_numero = getpost_sql($_POST["cel_numero".$cont], "CELULAR");
			if($cel_principal_a == $cont){ $cel_principal = "1"; }else{ $cel_principal = "0"; }
			if($cel_id >= "1"){
				$cel_del = $_POST["cel_del".$cont];
				if($cel_del == "0"){
					//atualiza dados da tabela no DB
					$campos = "tipo_id,principal,celular";
					$tabela = "cad_candidato_juridico_celular";
					$valores = array($cel_tipo,$cel_principal,$cel_numero);
					$condicao = "id='$cel_id' AND candidato_juridico_id = '$id_a'";
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
				}else{//if($cel_del == "0"){
					//exclue o registro
					$tabela = "cad_candidato_juridico_celular";
					$condicao = "id = '$cel_id' AND candidato_juridico_id = '$id_a'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				}//if($cel_del == "0"){		
			}else{//if($cel_id >= "1"){
				//VARS insert simples SQL
				$tabela = "cad_candidato_juridico_celular";
				//busca ultimo id para insert
				$cel_id = fSQL::SQL_SELECT_INSERT($tabela, "id");
				$campos = "id,candidato_juridico_id,tipo_id,principal,celular,time";
				$valores = array($cel_id,$id_a,$cel_tipo,$cel_principal,$cel_numero,time());
				$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			}//if($cel_id >= "1"){
			$linha = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_celular_tipo", "id = '$cel_tipo'", "");
			if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["legenda"]." - ".$cel_numero;
		}//isset
	}//fim while
	if($itens_log != ""){
		$campos = "itens,user_a,sync";
		$tabela = "cad_candidato_juridico_celular";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){
	
	//verifica lista de emails
	$cont = "0"; $itens_log = "";
	while($cont <= $ema_cont_a){
		$cont++;
		if((isset($_POST["ema_email".$cont])) and ($_POST["ema_email".$cont] != "")){
			$ema_id = $_POST["ema_id".$cont];
			$ema_tipo = $_POST["ema_tipo".$cont];
			$ema_email = getpost_sql($_POST["ema_email".$cont]);
			if($ema_principal_a == $cont){ $ema_principal = "1"; }else{ $ema_principal = "0"; }
			if($ema_id >= "1"){
				$ema_del = $_POST["ema_del".$cont];
				if($ema_del == "0"){
					//atualiza dados da tabela no DB
					$campos = "tipo_id,principal,email";
					$tabela = "cad_candidato_juridico_email";
					$valores = array($ema_tipo,$ema_principal,$ema_email);
					$condicao = "id='$ema_id' AND candidato_juridico_id = '$id_a'";
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
				}else{//if($ema_del == "0"){
					//exclue o registro
					$tabela = "cad_candidato_juridico_email";
					$condicao = "id = '$ema_id' AND candidato_juridico_id = '$id_a'";
					fSQL::SQL_DELETE_SIMPLES($tabela, $condicao);
				}//if($ema_del == "0"){		
			}else{//if($ema_id >= "1"){
				//VARS insert simples SQL
				$tabela = "cad_candidato_juridico_email";
				//busca ultimo id para insert
				$ema_id = fSQL::SQL_SELECT_INSERT($tabela, "id");
				$campos = "id,candidato_juridico_id,tipo_id,principal,email,time";
				$valores = array($ema_id,$id_a,$ema_tipo,$ema_principal,$ema_email,time());
				$result = fSQL::SQL_INSERT_SIMPLES($campos, $tabela, $valores);
			}//if($ema_id >= "1"){
			$linha = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_email_tipo", "id = '$ema_tipo'", "");
			if($itens_log != ""){ $itens_log .= ", "; } $itens_log .= $linha["legenda"]." - ".$ema_email;
		}//isset
	}//fim while
	if($itens_log != ""){
		$campos = "itens,user_a,sync";
		$tabela = "cad_candidato_juridico_email";
		$valores = array($itens_log,$cVLogin->userReg(),time());
		$ARRAY_LOG[] = fGERAL::arrayLog($tabela,$campos,$valores);//gerar array log de auditoria
	}//if($itens_log != ""){


	/// VARRE LISTAS ------------------------------------------------------------------------------------------|||||||||||||||||||







	//GERA AÇÃO DO USUÁRIO NA TABELA
	$cVLogin->addAcaoUser("cad_candidato_juridico", "editar", $id_a);//addAcaoUser($TABELA, $ACAO, $REGISTRO)
	//GERA LOGS DE TABELAS
	if(isset($ARRAY_LOG)){//gerar log de auditoria	
		fGERAL::gravaLog("cad_candidato_juridico",$id_a,$ARRAY_LOG,$cVLogin->userReg());
	}//if(isset($ARRAY_LOG)){
	//ADICIONA MENSAGEM > SUCESSO ALERTA ERRO INFO
	$cMSG->addMSG("SUCESSO","Registro atualizado com sucesso.$msg_cont <a href=\"#\" onclick=\"janelaAcao".$INC_FAISHER["div"]."(\\'visualizar\\',\\'id_a=".$id_a."\\');return false;\" class=\"btn sAcao\" rel=\"tooltip\" title=\"Visualizar\"><i class=\"icon-search\"></i></a>");
	
	
}//fim do else if($id_a == "0"){ //############# FIM ELSE - ALTERA REGISTRO |-

//se veio cadastro de um POPUP para execução do script
if(verPop("isset")){
	$POP = $_GET["POP"];
	if($POP == "1"){ $POP = ""; }else{	
		$id = $id_a;
		$texto = SYS_CONFIG_RM_SIGLA." ".fRM::getRMCandidato($id_a,"J")." - <b>".$nome_a."</b>";
		if($code_a != ""){ $texto = $texto."<br> ($code_a)"; }
		
		//adiciona vars POP
		$POP = fGERAL::cptoFaisher($_GET["POP"], "dec");
		$POP = str_replace("{ID}", $id, $POP);
		$POP = str_replace("{TXT}", $texto, $POP);	
	}//if($POP == "1"){
?>
	<script>
	//TIMER
	$.doTimeout('vTimerOPENListPOP', 500, function(){
		<?=$POP?>
		pmodalDisplay('hide');
	});//TIMER
	</script>
<?php
	exit(0);
}




/*set_time_limit(300);
$cont = "0";
	//SQL_SELECT_SIMPLES($campos, $tabela, $where='', $order='')
	$resuM = fSQL::SQL_SELECT_SIMPLES("id,celular", "cad_candidato_juridico_celular", "");
	while($linha = fSQL::FETCH_ASSOC($resuM)){
		$id_i = $linha["id"];
		$cel_numero_i = getpost_sql($linha["celular"], "CELULAR");
		$cont++;
		
					//atualiza dados da tabela no DB
					$campos = "celular";
					$tabela = "cad_candidato_juridico_celular";
					$valores = array($cel_numero_i);
					$condicao = "id = '$id_i'";
					fSQL::SQL_UPDATE_SIMPLES($campos, $tabela, $valores, $condicao);
		
	}


echo "ATUALIZADOS: ". $cont;//*/







}//fim if($verificaRegistro == "1"){//############################################################### FIM VERIFICACOES||<





























//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||--------------- SQL vars >>>
//vars para consulta no DB referente a paginação abaixo
	$SQL_campos = "J.id,J.code,J.propriedade_id,J.nome,J.fantasia,J.sync,E.uf,I.cidade_nome,T.legenda AS tipo"; //campos da tabela
	$SQL_tabela = "cad_candidato_juridico J"; //tabela
	$SQL_join = "LEFT JOIN cad_candidato_juridico_tipo T ON J.tipo_id = T.id LEFT JOIN cad_candidato_juridico_endereco E ON J.id = E.candidato_juridico_id LEFT JOIN combo_cidades I ON E.cidade_id = I.id"; //join
	//$SQL_where = "J.id = E.candidato_juridico_id AND E.cidade_id = I.id AND J.tipo_id = T.id"; //condição
	$SQL_where = ""; //condição
	$SQL_varEnvio = "ajax=lista&$faisherGet&"; //variaveis para a paginacao
	$ORDEM_C = "J.nome";//campo de ordenar
	$ORDEM = "ASC";// ASC ou DESC
	$SQL_group = "GROUP BY J.id"; // agrupar o resultado GROUP BY

//verifica se recebeu ORDEM_C ou seta ORDER padrao ------------ VARS SQL
	if((isset($_GET["ORDEM_C"])) and ($_GET["ORDEM_C"] != "undefined") and ($_GET["ORDEM_C"] != "")){
		$ORDEM_C = getpost_sql($_GET["ORDEM_C"]);
		$ORDEM = getpost_sql($_GET["ORDEM"]);
	}//fim ORDEM_C
	$SQL_order = $SQL_group." ORDER BY $ORDEM_C $ORDEM"; // ordem do resultado
	$AJAX_GET = $SQL_varEnvio;//vars get para reenvio no paginaçao AJAX
	$AJAX_GET_OR = "ORDEM_C=$ORDEM_C&ORDEM=$ORDEM&";//vars get para reenvio no paginaçao AJAX com ORDER
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL vars <<<




//pega vars de busca
	unset($filtro_b);
	if(isset($_GET["rapida_b"])){   					 $rapida_b = getpost_sql($_GET["rapida_b"]);   						  }else{ $rapida_b = "";    	    }
	if(isset($_GET["code_b"])){       					 $code_b = getpost_sql($_GET["code_b"]);       		     			  }else{ $code_b = "";    		    }
	if(isset($_GET["tipo_b"])){       					 $tipo_b = getpost_sql($_GET["tipo_b"]);       		     			  }else{ $tipo_b = "";    		    }
	if(isset($_GET["nome_b"])){       					 $nome_b = getpost_sql($_GET["nome_b"]);       		     			  }else{ $nome_b = "";    		    }
	if(isset($_GET["datai_b"])){       					 $datai_b = getpost_sql($_GET["datai_b"]);       		   			  }else{ $datai_b = "";    		    }
	if(isset($_GET["dataf_b"])){       					 $dataf_b = getpost_sql($_GET["dataf_b"]);       		   			  }else{ $dataf_b = "";    		    }






//verifica se recebeu uma solicitação de busca por rapida_b
if($rapida_b != ""){ $filtro_marca[] = $rapida_b;
		$aCode = fGERAL::codeRandRetorno($rapida_b);
		$filtro_b["rapida_b"] = "Busca rápida por <b>$rapida_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; } 
		$SQL_where .= " ( J.`id` = '".$aCode["id"]."' OR J.`nome` LIKE '%$rapida_b%' OR J.`fantasia` LIKE '%$rapida_b%' OR J.`code` LIKE '%".fGERAL::limpaCode($rapida_b)."%' OR E.`uf` LIKE '%$rapida_b%' OR I.`cidade_nome` LIKE '%$rapida_b%' OR T.`legenda` LIKE '%$rapida_b%' ) "; //condição 
		$AJAX_GET .= "rapida_b=$rapida_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por rapida_b





//verifica se recebeu uma solicitação de busca por data de cadastro
if(($datai_b != "") or ($dataf_b != "")){ $filtro_marca[] = $datai_b; $filtro_marca[] = $dataf_b;
		if($datai_b == ""){ $datai_b = $dataf_b; } if($dataf_b == ""){ $dataf_b = $datai_b; }
		$timei_a = time_data_hora("$datai_b 0:0"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$timef_a = time_data_hora("$dataf_b 23:59"); //converte data/hora em time UNIX "04/03/2011 10:11"
		$filtro_b["data_b"] = "De <b>$datai_b</b> até <b>$dataf_b</b>";
		if($timei_a > $timef_a){ $timef_a = $timei_a; $filtro_b["data_b"] = "De <b>$datai_b</b> até <b>$datai_b</b> (data foi ajustada)"; }
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " J.time >= '$timei_a' AND J.time <= '$timef_a' "; //condição
		$AJAX_GET .= "datai_b=$datai_b&dataf_b=$dataf_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por data cadastro



//verifica se recebeu uma solicitação de busca por code_b
if($code_b != ""){ $filtro_marca[] = $code_b;
		$aCode = fGERAL::codeRandRetorno($code_b);
		$filtro_b["code_b"] = "Busca ".SYS_CONFIG_RM_SIGLA." <b>$code_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( J.`id` = '".$aCode["id"]."' AND J.`code` = '".$aCode["code"]."' ) "; //condição 
		$AJAX_GET .= "code_b=$code_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por code_b



//verifica se recebeu uma solicitação de busca por tipo_b
if($tipo_b != ""){
		$linha1 = fSQL::SQL_SELECT_ONE("legenda", "cad_candidato_juridico_tipo", "id = '$tipo_b'"); $filtro_marca[] = $linha1["legenda"];
		$filtro_b["tipo_b"] = "Busca tipo <b>".$linha1["legenda"]."</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( J.`tipo_id` = '$tipo_b' ) "; //condição 
		$AJAX_GET .= "tipo_b=$tipo_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por tipo_b



//verifica se recebeu uma solicitação de busca por nome
if($nome_b != ""){ $filtro_marca[] = $nome_b;
		$filtro_b["nome_b"] = "Busca por <b>$nome_b</b>";
		if($SQL_where != ""){ $SQL_where .= " AND "; }
		$SQL_where .= " ( J.`nome` LIKE '%".$nome_b."%' OR J.`fantasia` LIKE '%".$nome_b."%' ) "; //condição 
		$AJAX_GET .= "nome_b=$nome_b&"; //incrementa variaveis para a paginacao AJAX
}//fim da busca por nome











//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados >>
//trata dados do sql paginação abaixo
			//inicia a montagem das consultas ao DB que farão a paginação
			if(isset($_GET["R_PAGINA"])){ //busca o numero de registros por pagina a exibir
				$R_PAGINA_N = $_GET["R_PAGINA"];
				if($R_PAGINA_N <= "100"){ sessoes("REG_PAG",$R_PAGINA_N); }else{ sessoes("REG_PAG","100"); }//cria a variavel
			}
			if(sessoes_v("REG_PAG") == "1"){ $reg_por_pagina = sessoes_p("REG_PAG"); }else{ $reg_por_pagina = "10"; }
			$max = $reg_por_pagina; //busca o padrao do sistema, registros por pagina
			if(isset($_GET['pagina'])){ $pagina = $_GET['pagina']; }
			if($pagina >= "1"){}else{ $pagina = 1; }
			$comeco = ($pagina*$max) - $max;
			
			//SQL_SELECT_SIMPLES($GLOBAL_VARS_DB, $campos, $tabela, $where='', $order='')
			$QueryListaPag 	= fSQL::SQL_SELECT_SIMPLES($SQL_campos, $SQL_tabela, $SQL_where, "$SQL_order", "$comeco,$max", $SQL_join);
			$n_paginas 		= fSQL::SQL_CONTAGEM($SQL_tabela, $SQL_where, "", "$SQL_group", $SQL_join);
			$n_reg_pagina	= fSQL::SQL_CONT($QueryListaPag);
			$paginas_total 	= ceil($n_paginas / $max);
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL trata dados <<<
?>
<?php
//MOSTRAR TODAS AS MENSAGENS CRIADAS -------------------------- CLASSE MENSAGENS ----------------------- ||||||||||||||
$cMSG->imprimirMSG();//imprimir mensagens criadas
?>
<?php
//monta array
$array = $filtro_b;
$cont_ARRAY = ceil(count($array));
//listar item ja cadastrados
if($cont_ARRAY >= "1"){
?>
	<ul class="messages" style="margin-top:0; margin-right:0;">
		<li class="left">
			<div class="image"><img src="img/extras/icoBusca.png" alt=""></div>
			<div class="message"><span class="caret"></span><span class="name">Resultado da busca realizada no(s) iten(s)</span>
				<button type="button" style="float:right; margin:3px 3px;" class="btn btn-mini" onclick="bRapida<?=$INC_FAISHER["div"]?>Remove('all');" rel="tooltip" data-placement="left" data-original-title="Remove Busca"><i class="icon-remove"></i></button>
				<p>
<?php
	$listaIDS_a = $array; //nome do cookie
	foreach ($listaIDS_a as $pos => $valor){
?>
	<div class="bg-shadowb15" style="float:left; margin:0 5px 5px 0; padding:5px;"><span style="float:left; padding-right:5px;"><?=$valor?></span> <button type="button" style="float:right;" class="btn btn-mini" rel="tooltip" data-placement="right" data-original-title="Remover Item" onclick="<?php if($pos == "rapida_b"){?>bRapida<?=$INC_FAISHER["div"]?>Remove('<?=$pos?>');<?php }else{?>bAvancada<?=$INC_FAISHER["div"]?>Remove('<?=$pos?>');<?php }?>"><i class="icon-remove"></i></button></div>
<?php
	}//fim foreach
?>
<div style="clear:both;"></div>
</p>
				<span class="time"> <b><?=$n_paginas?></b> registros encontrados</span>
			</div>
		</li>
	</ul>

<?php
}//fim if($cont_ARRAY >= "1"){
?>
<?php
//paginação
//$REG_TOTAL_INC = "1"; //criar a variavel faz exibir os totais por página
$TIPO_INC = "padraoajax";//tipo de pg
$GET_INC = $AJAX_GET.$AJAX_GET_OR; //vars GET
$PAG_INC = $AJAX_PAG;
$AJAX_PAG_DIV_INC = "divAjax_lista".$INC_FAISHER["div"];
$AJAX_CARREGANDO_INC = "dAjax_lista".$INC_FAISHER["div"]."_load";
$AJAX_APPEND_INC = "ADD";//funcao ADD ajax faisher
include "../inc_paginacao.php";

?>
<script type="text/javascript">
$(document).ready(function(){
<?=fGERAL::marcaBusca($filtro_marca,"datatable_principal".$INC_FAISHER["div"])?>
	$('#contTitu<?=$INC_FAISHER["div"]?>').html(' (<?=$n_paginas?>)');
	$('#datatable_principal<?=$INC_FAISHER["div"]?> tbody tr').click(function() {
		var idClick = $(this).find('.sAcao');
		$(this).find(".sVisu").click(function() {
			if($('#dCentro_acao<?=$INC_FAISHER["div"]?>').is(':visible')){}else{
				idClick.click();
			}
		});

	});
	$('#datatable_principal<?=$INC_FAISHER["div"]?> thead tr th').click(function() {
		var idClick = $(this).attr("id");
		if($('#dCentro_acao<?=$INC_FAISHER["div"]?>').is(':visible')){}else{
			if((idClick != "") && (idClick != null)){ carregaLista<?=$INC_FAISHER["div"]?>($('#AJAX_GET<?=$INC_FAISHER["div"]?>_OR').val()+'&ORDEM_C='+idClick); }
		}

	});
	$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val('<?=$AJAX_GET.$AJAX_GET_OR?>&pagina=<?=$pagina?>');//salva vars get
});





<?php
//ID de controle ---  ########### rolagem faisher ################# ++++
$id_Content = "divAjax_lista".$INC_FAISHER["div"];
$id_Rolagem = "Lista".$INC_FAISHER["div"];
?>
//ao redimencionar a pagina
function resize_Tela<?=$id_Rolagem?>() {
	var v_largura = $("#<?=$id_Content?>").width();	$("#divRol<?=$id_Rolagem?>").css('width',v_largura+'px');
	//atualiza rolagem da caixa
	rolagemFaisher('divRol<?=$id_Rolagem?>','setasH');//rolagem
}//resize_TelaRelato
$(window).resize(function(){ resize_Tela<?=$id_Rolagem?>(); });
$.doTimeout('vTimerRol<?=$id_Rolagem?>', 500, function(){ resize_Tela<?=$id_Rolagem?>(); });//TIMER
$("#acao<?=$INC_FAISHER["div"]?>").click(function(){ resize_Tela<?=$id_Rolagem?>(); });
</script>
<div id="divRol<?=$id_Rolagem?>" style="width:100%; overflow:auto;">
<div id="divRol<?=$id_Rolagem?>Cont" style="width:100%; min-width:980px; padding-top:20px;">
<input id="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" name="AJAX_GET<?=$INC_FAISHER["div"]?>_OR" type="hidden" value="<?=$AJAX_GET?>&pagina=1" />
	<table id="datatable_principal<?=$INC_FAISHER["div"]?>" class="table table-hover table-nomargin table-bordered dataTable">
		<thead>
			<tr>
				<?php $c_or = "J.id"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>"><?=SYS_CONFIG_RM_SIGLA?></th>
				<?php $c_or = "T.legenda"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Tipo</th>
				<?php $c_or = "J.nome"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Razão Social/Fantasia</th>
				<?php $c_or = "J.propriedade_id"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Prefeitura/Subdivisão</th>
				<?php $c_or = "J.sync"; ?><th class="<?=css_ordem($c_or,$ORDEM_C,$ORDEM)?>" id="<?=$c_or?>&ORDEM=<?=alterna_ordem($ORDEM)?>">Data</th>
				<th>Ação</th>
			</tr>
		</thead>
	<tbody>
<?php




///VERIFICA PERMISSÕES DE ACESSO
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"edi")){ $pEdit = "1"; }else{ $pEdit = "0"; }//loginAcesso
if($cVLogin->loginAcesso($INC_FAISHER["permissao"],"exc")){ $pExc = "1"; }else{ $pExc = "0"; }//loginAcesso


	

//vars adicionais ao SQL ----------------------------------- Vars SQL
//|||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||SQL Listagem
//inicia a listagem do SQL de paginação
//se a contagem de zerado nao ativa o if que percorre as linhas
	if($n_paginas >= "1"){
while($linha1 = fSQL::FETCH_ASSOC($QueryListaPag)){
	$id_a = $linha1["id"];
	$code = $linha1["code"];
	$tipo = $linha1["tipo"];
	$nome = $linha1["nome"];
	$fantasia = $linha1["fantasia"];
	$propriedade_id = $linha1["propriedade_id"];
	$uf = $linha1["uf"];
	$cidade_nome = $linha1["cidade_nome"];
	$sync = $linha1["sync"];
	
	$cidade_leg = $cidade_nome."/".$uf;
	if($propriedade_id >= "1"){ $cidade_leg = "NO MUNICÍPIO"; }
?>
										<tr>
											<td class="sVisu font-bebas-p"><b><?=fGERAL::legCode($id_a,$code)?></b></td>
											<td class="sVisu"><?=$tipo?></td>
											<td class="sVisu"><b><?=$fantasia?></b><br><?=$nome?></td>
											<td class="sVisu"><?=$cidade_leg?></td>
											<td class='sVisu'><?=date('d/m/Y H:i',$sync)?>h</td>
											<td>
												<a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('visualizar','id_a=<?=$id_a?>');return false;" class="btn sAcao" rel="tooltip" title="Visualizar"><i class="icon-search"></i></a>
												<?php if($pEdit == "1" and $cVLogin->getVarLogin("SYS_USER_ID") == "1"){?><a href="#" onclick="janelaAcao<?=$INC_FAISHER["div"]?>('registro','id_a=<?=$id_a?>');return false;" class="btn" rel="tooltip" title="Editar"><i class="icon-edit"></i></a><?php }?>
												<?php if($pExc == "1" and $cVLogin->getVarLogin("SYS_USER_ID") == "1"){?><a href="#" onclick="if(confirm('Gostaria realmete de remover \'<?=$nome?>\'?')) { carregaLista<?=$INC_FAISHER["div"]?>('ajax=lista&id_excluir=<?=$id_a?>&'+$('#AJAX_GET<?=$INC_FAISHER["div"]?>').val());ancoraHtml('#ancAcao<?=$INC_FAISHER["div"]?>'); }return false;" class="btn" rel="tooltip" title="Remover"><i class="icon-remove"></i></a><?php }?>
                                          </td>
										</tr>
<?php 

}//fim do while de padinação SQL
	}//fim do if($n_paginas >= "1"){ de paginacao SQL

?>
									</tbody>
								</table>
<?php if($n_paginas <= "0"){?>
	<div style="height:150px; padding:20px 0 0 10px; clear:both;"><i class="icon-info-sign"></i> Não foi encontrado nenhum resultado correspondente à sua pesquisa.</div>
<?php }?>
</div>
</div><!-- #fim rolagem faisher -->
<?php
//paginação
$REG_TOTAL_INC = "1"; //criar a variavel faz exibir os totais por página
$TIPO_INC = "padraoajax";//tipo de pg
$GET_INC = $AJAX_GET.$AJAX_GET_OR; //vars GET
$PAG_INC = $AJAX_PAG;
$AJAX_PAG_DIV_INC = "divAjax_lista".$INC_FAISHER["div"];
$AJAX_CARREGANDO_INC = "dAjax_lista".$INC_FAISHER["div"]."_load";
$AJAX_APPEND_INC = "ADD";//funcao ADD ajax faisher
include "../inc_paginacao.php";

?>
<?php








}//fim ajax  -------------------------------------------- <<<
?>
<?php











































//++++++++++++++++++++++AJAX QUE EXIBE [[HOME]] ----------------------------########################################-------------------------------------->>>
if($ajax == "home"){
	
	
	///VERIFICA PERMISSÕES DE ACESSO
	if(!$cVLogin->loginAcesso($INC_FAISHER["permissao"],"cad")){ $pCadastro = "OFF"; }//loginAcesso
	if($cVLogin->getVarLogin("SYS_USER_ID") != "1"){ $pCadastro = "OFF"; }
	
	//include de padrao
	$INC_VAR["buscaAvancada"] = "ON";//ON - OFF > Busca avançãda, retorno ajax [buscaAvancada]
	include "inc/inc_lista-padrao.php";
	
	
}//fim ajax  -------------------------------------------- <<<














?>