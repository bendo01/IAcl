<?php
App::uses('Aco', 'IAcl.Model');

/**
 * Aco Test Case
 *
 */
class AcoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.i_acl.aco',
		'plugin.i_acl.aro',
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
		$this->Aco = ClassRegistry::init('IAcl.Aco');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Aco);

		parent::tearDown();
	}

}
