<?php
App::uses('AcosController', 'IAcl.Controller');

/**
 * AcosController Test Case
 *
 */
class AcosControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.i_acl.aco',
		'plugin.i_acl.aro',
		'plugin.i_acl.permission'
	);

}
