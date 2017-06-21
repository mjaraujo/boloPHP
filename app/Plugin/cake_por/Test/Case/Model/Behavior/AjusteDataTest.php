<?php
/**
 * Teste do Behavior AjusteData
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @author        Juan Basso <jrbasso@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

App::uses('Model', 'Model');
App::uses('AjusteData', 'CakePor.Model/Behavior');

/**
 * CakePorNoticia
 *
 */
class CakePorNoticia extends Model {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	public $name = 'Noticia';

/**
 * Usar tabela?
 *
 * @var boolean
 * @access public
 */
	public $useTable = false;

/**
 * Exists
 *
 * @return boolean
 * @access public
 */
	public function exists() {
		return true;
	}
}

/**
 * CakePorNoticiaSemNada
 *
 */
class CakePorNoticiaSemNada extends CakePorNoticia {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	public $name = 'CakePorNoticiaSemNada';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	public $actsAs = array('CakePor.AjusteData');

}

/**
 * CakePorNoticiaString
 *
 */
class CakePorNoticiaString extends CakePorNoticia {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	public $name = 'CakePorNoticiaString';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	public $actsAs = array('CakePor.AjusteData' => 'data');

}

/**
 * CakePorNoticiaArrayVazio
 *
 */
class CakePorNoticiaArrayVazio extends CakePorNoticia {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	public $name = 'CakePorNoticiaArrayVazio';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	public $actsAs = array('CakePor.AjusteData' => array());

}

/**
 * CakePorNoticiaArrayComCampo
 *
 */
class CakePorNoticiaArrayComCampo extends CakePorNoticia {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	public $name = 'CakePorNoticiaArrayComCampo';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	public $actsAs = array('CakePor.AjusteData' => array('data'));

}

/**
 * CakePorNoticiaArrayComCampos
 *
 */
class CakePorNoticiaArrayComCampos extends CakePorNoticia {

/**
 * Nome da model
 *
 * @var string
 * @access public
 */
	public $name = 'CakePorNoticiaArrayComCampos';

/**
 * Lista de Behaviors
 *
 * @var array
 * @access public
 */
	public $actsAs = array('CakePor.AjusteData' => array('data', 'publicado'));
}

/**
 * AjusteData Test Case
 *
 */
class CakePorAjusteData extends CakeTestCase {

/**
 * Envio
 *
 * @var array
 * @access protected
 */
	public $_envio = array(
		'id' => 1,
		'nome' => 'Teste',
		'data' => '20/03/2009',
		'data_falsa' => '30/01/2009',
		'publicado' => '01/01/2010'
	);

/**
 * testSemNada
 *
 * @retun void
 * @access public
 */
	public function testSemNada() {
		$esperado = array(
			'CakePorNoticiaSemNada' => array(
				'id' => 1,
				'nome' => 'Teste',
				'data' => '20/03/2009',
				'data_falsa' => '30/01/2009',
				'publicado' => '01/01/2010'
			)
		);
		$this->_testModel('CakePorNoticiaSemNada', $esperado);
	}

/**
 * testString
 *
 * @retun void
 * @access public
 */
	public function testString() {
		$esperado = array(
			'CakePorNoticiaString' => array(
				'id' => 1,
				'nome' => 'Teste',
				'data' => '2009-03-20',
				'data_falsa' => '30/01/2009',
				'publicado' => '01/01/2010'
			)
		);
		$this->_testModel('CakePorNoticiaString', $esperado);
	}

/**
 * testArrayVazio
 *
 * @retun void
 * @access public
 */
	public function testArrayVazio() {
		$esperado = array(
			'CakePorNoticiaArrayVazio' => array(
				'id' => 1,
				'nome' => 'Teste',
				'data' => '20/03/2009',
				'data_falsa' => '30/01/2009',
				'publicado' => '01/01/2010'
			)
		);
		$this->_testModel('CakePorNoticiaArrayVazio', $esperado);
	}

/**
 * testArrayComCampo
 *
 * @retun void
 * @access public
 */
	public function testArrayComCampo() {
		$esperado = array(
			'CakePorNoticiaArrayComCampo' => array(
				'id' => 1,
				'nome' => 'Teste',
				'data' => '2009-03-20',
				'data_falsa' => '30/01/2009',
				'publicado' => '01/01/2010'
			)
		);
		$this->_testModel('CakePorNoticiaArrayComCampo', $esperado);
	}

/**
 * testArrayComCampos
 *
 * @retun void
 * @access public
 */
	public function testArrayComCampos() {
		$esperado = array(
			'CakePorNoticiaArrayComCampos' => array(
				'id' => 1,
				'nome' => 'Teste',
				'data' => '2009-03-20',
				'data_falsa' => '30/01/2009',
				'publicado' => '2010-01-01'
			)
		);
		$this->_testModel('CakePorNoticiaArrayComCampos', $esperado);
	}

/**
 * Método auxiliar para executar os testes
 *
 * @param string $nomeModel Nome da model
 * @param array $esperado Valor esperado
 * @retun void
 * @access protected
 */
	public function _testModel($nomeModel, $esperado) {
		$Model = new $nomeModel();
		$Model->create();
		$Model->save(array($nomeModel => $this->_envio));
		$this->assertEqual($Model->data, $esperado);
	}

}
