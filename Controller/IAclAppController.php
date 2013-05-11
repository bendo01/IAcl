<?php

App::uses('AppController', 'Controller');

class IAclAppController extends AppController {
	public $helpers = array('Js' => array('Jquery'),'Form','Session','Html','Time','Paginator','Number');
}
