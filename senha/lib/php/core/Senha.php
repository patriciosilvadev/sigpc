<?php



/**
 * Classe Senha
 * 
 * Responsavel pelas informacoes do Senha
 * 
 */
 class Senha {
 	
 	private $sigla;
 	private $numero;
 	private $prioridade = null;
 	private $legenda = '';
 	
 	private static $LENGTH = 4;
 	
 	public function __construct($sigla, $numero, $prioridade=null, $legenda='Senha') {
 		$this->set_sigla($sigla);
 		$this->set_numero($numero);
 		$this->set_prioridade($prioridade);
 		$this->set_legenda($legenda);
 	}
 	
 	/**
 	 * Define a sigla da senha
 	 * @param char $sigla
 	 */
 	public function set_sigla($sigla) {
 		if (is_string($sigla) && strlen($sigla) == 1)
 			$this->sigla = $sigla;
 		else
 			throw new Exception("A sigla da senha deve ser um char");
 	}
 	
 	/**
 	 * Retorna a sigla da senha
 	 * @return char $sigla
 	 */
 	public function get_sigla() {
 		return $this->sigla;
 	}
 	
 	/**
 	 * Define o numero da senha
 	 * @param int $numero
 	 */
 	public function set_numero($numero) {
 		if (is_int($numero) && $numero > 0)
 			$this->numero = $numero;
 		else
 			throw new Exception("O numero da senha deve ser um inteiro maior que zero");
 	}
 	
 	/**
 	 * Retorna o numero da senha
 	 * @return int $numero
 	 */
 	public function get_numero() {
 		return $this->numero;
 	}
 	
 	/**
 	 * Retorna o numero da senha preenchendo com zero (esquerda).
 	 *
 	 * @return String
 	 */
 	public function get_full_numero() {
 	    return str_pad($this->get_numero(),Senha::$LENGTH,'0',STR_PAD_LEFT);
 	}
 	
 	/**
 	 * Define a Prioridade da senha
 	 * @param Prioridade $pri
 	 */
 	public function set_prioridade($pri) {
 		$this->prioridade = $pri; 		
 	}
 	
 	/**
 	 * Retorna a Prioridade da Senha
 	 * @return Prioridade
 	 */
 	public function get_prioridade() {
 		return $this->prioridade;
 	}
 	
 	/**
 	 * Define a legenda da senha
 	 * @param String $legenda
 	 */
 	public function set_legenda($legenda) {
 		if (is_string($legenda))
 			$this->legenda = $legenda;
 		else
 			throw new Exception("A legenda da senha deve ser uma String");
 	}
 	
 	/**
 	 * Retorna a legenda da senha
 	 * @return String
 	 */
 	public function get_legenda() {
 		return $this->legenda;
 	}
 	
 	/**
 	 * Retorna se a senha tem ou nao prioridade
 	 * @return bool
 	 */
 	public function is_prioridade() {
 		return ($this->get_prioridade()->get_peso() > 0)?true:false;
 	}
 	
 	/**
 	 * Retorna a senha formatada para exibicao
 	 * @return String
 	 */
 	public function toString() {
 		return $this->get_sigla() . $this->get_full_numero();
 	}
 	
 	/**
 	 * Retorna resultado do método toString
	 * @return String
 	 */
	public function __tostring() {
		return $this->toString();
	}

}

?>
