<?php
App::uses('Aro', 'IAcl.Model');

/**
 * Aro Test Case
 *
 */
class AroTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.i_acl.aro',
		'plugin.i_acl.aco',
		'plugin.i_acl.permission',
		'plugin.i_acl.aros_aco'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Aro = ClassRegistry::init('IAcl.Aro');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Aro);

		parent::tearDown();
	}

}
