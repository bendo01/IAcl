<?php
App::uses('ArosController', 'IAcl.Controller');

/**
 * ArosController Test Case
 *
 */
class ArosControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.i_acl.aro',
		'plugin.i_acl.aco',
		'plugin.i_acl.permission'
	);

}
