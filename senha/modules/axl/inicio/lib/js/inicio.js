


var INICIO_PATH = "?redir=modules/axl/inicio/";

var Inicio = function() {

    var self = this;
    
    this.update = function() {
//        var t1 = new Target(ATEND_PATH + "atend_fila.php", "fila");
//    
//        var ajaxList = new AjaxList();
//        ajaxList.add(new Ajax(t1));
//        
//        ajaxList.loadURLs();
    }
    
    this.refresh = function() {
        Ajax.simpleLoad(INICIO_PATH + "welcome.php", "axl_welcome", "GET", "", true, Inicio.onLoad);
//    	self.updateTime();
//    	setInterval(self.updateTime, 1000);
//        self.update();
//        setInterval(self.update, 3000);
    }
}


Inicio.onLoad = function() {
    Ajax.simpleLoad(INICIO_PATH + "modulos_unidade.php", "unidade_modulos", "POST", '', true);
}

/**
 * Popup que constrói tela de alterar senha
 */
Inicio.alterarSenha = function() {
	//var p = new Object();
	var popup = window.popup('popup_alterar_senha');

	Ajax.simpleLoad(INICIO_PATH + "alterar_senha.php", popup.getAttribute("id"), "POST", '', true, Inicio.seleciona, 'senha_atual');
}

/**
 * Seleciona objeto e coloca foco
 */
Inicio.seleciona = function (id) {
	var variavel = document.getElementById(id);
	if(variavel != null){
		variavel.focus();
	}
}

/**
 * Verificações necessárias antes de alterar senha
 */
Inicio.confirmaAlterarSenha = function() {
	var senhaAtual = document.getElementById('senha_atual');
	var novaSenha = document.getElementById('nova_senha');
	var confirmarNovaSenha = document.getElementById('confirmar_nova_senha');
	var labelSenhaAtual = document.getElementById('id_senha_atual');
	var labelSenhaNova = document.getElementById('id_senha_nova');
	var labelSenhaConfirma = document.getElementById('id_senha_confirma');
	var bool = true;
	
	if (senhaAtual.value != "") {
		AXL.adverte(labelSenhaAtual,false);
	} else {
		AXL.adverte(labelSenhaAtual,true);
		senhaAtual.select();
		bool = false;
	}
	if (novaSenha.value == confirmarNovaSenha.value	&& novaSenha.value != "" && novaSenha.value.length>=6) {
		AXL.adverte(labelSenhaNova,false);
		AXL.adverte(labelSenhaConfirma,false);
	} else {
		if(novaSenha.value == ""  || novaSenha.value.length <6){
			AXL.adverte(labelSenhaNova,true);
			if(bool){
				novaSenha.select();
			}
		}else if(novaSenha.value != confirmarNovaSenha.value){
			AXL.adverte(labelSenhaNova,false);
			AXL.adverte(labelSenhaConfirma,true);
			if(bool){
				confirmarNovaSenha.select();
			}
		}
		bool = false;
	}

	if(bool){
		window.showYesNoDialog('Inicio.alterarSenhaUsu();',
				'Deseja realmente alterar a senha?',
				'confirma alteração de senha');
	}
}

/**
 * Coleta de parâmetros necessários para alterar senha
 */
Inicio.alterarSenhaUsu = function(idUsu) {

	var senhaAtual = document.getElementById('senha_atual').value;
	var novaSenha = document.getElementById('nova_senha').value;
	var idUsu = document.getElementById('input_id_usuario').value;
	var idform = document.getElementById('form_senha');
	
	var popup = window.popup('popup_alterar_senha');
	
	var p = new Object();

	p['id_usu'] = idUsu;
	p['senha_atual'] = senhaAtual;
	p['nova_senha'] = novaSenha;
	
	Ajax.simpleLoad(INICIO_PATH + "confirmar_alterar_senha.php", popup.getAttribute("id"), "POST", Ajax.encodePostParameters(p), true, window.closePopup(idform));
}


