<?php

/**
 * 
 * Copyright (C) 2009 DATAPREV - Empresa de Tecnologia e Informações da Previdência Social - Brasil
 *
 * Este arquivo é parte do programa AXL Livre - Sistema de Gerenciamento do Atendimento - Versão Livre
 *
 * O AXL é um software livre; você pode redistribuí­-lo e/ou modificá-lo dentro dos termos da Licença Pública Geral GNU como 
 * publicada pela Fundação do Software Livre (FSF); na versão 2 da Licença, ou (na sua opnião) qualquer versão.
 *
 * Este programa é distribuído na esperança que possa ser útil, mas SEM NENHUMA GARANTIA; sem uma garantia implícita
 * de ADEQUAÇÃO a qualquer
 * MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU para maiores detalhes.
 *
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU, sob o título "LICENCA.txt", junto com este programa, se
 * não, escreva para a 
 * Fundação do Software Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA.
 *
**/

AXL::check_login('axl.admin');
/**
 * Constrói janela para gerenciamento dos serviços 
 */
try {
	$id_uni = AXL::get_current_user()->get_unidade()->get_id();
	$servicos = DB::getInstance()->get_servicos_unidade($id_uni);
	TAdmin::exibir_gerenciar_servicos($servicos);
}
catch (Exception $e) {
	Template::display_exception($e);
}
?>