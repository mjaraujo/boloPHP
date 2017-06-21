<?php

/**
 * Classe auxiliar para ajustar as palavras na geração dos templates
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

/**
 * Inflexao
 *
 */
class Inflexao {

	public static $palavrasAcentuadas = array(
		'serie' => 'série',
		'estatistica' => 'estatística',
		'matricula' => 'matrícula',
		'matematica' => 'matemática',
		'academico' => 'acadêmico'
	);
	
	public static $substituicoes = array(
		'/(.*)cao$/'  => 'ção',
		'/(.*)ao(s)$/'   => 'ão',
		'/(.*)coes$/' => 'ções',
		'/(.*)oes$/'  => 'ões',
		'/(.*)aes$/'  => 'ães',
	);
	
	public static $espacamentos = array(' ', '_');

	/**
	 * Ajusta as palavras para por acentos
	 *
	 * @param string $palavra Palavra a ser modificada
	 * @return string Palavra com acento
	 * @access public
	 */
	public static function acentos($palavra) {
		foreach (self::$espacamentos as $espacamento) {
			if (strpos($palavra, $espacamento) !== false) {
				return Inflexao::quebra_palavras($palavra, $espacamento);
			}
		}
		
		if (in_array($palavra, array_keys(self::$palavrasAcentuadas))) {
			return str_replace(array_keys(self::$palavrasAcentuadas), array_values(self::$palavrasAcentuadas), $palavra);
		}
		
		foreach(self::$substituicoes as $regex => $substituto) {
			if (preg_match($regex, $palavra, $matches)) {
				return $matches[1] . $substituto . (isset($matches[2]) ? $matches[2] : '');
			}
		}
		
		return $palavra;
	}

	public static function quebra_palavras($palavras, $espacamento) {

		$palavras = explode($espacamento, $palavras);
		$saida = '';
		foreach ($palavras as $pedaco) {
			$saida .= Inflexao::acentos($pedaco) . $espacamento;
		}
		return rtrim($saida, $espacamento);

	}

}
