<?php
App::uses('IAclAppController', 'IAcl.Controller');
/**
 * 
 *  Controller
 *
 */
class IAclAcosController extends IAclAppController {
	
	public function index(){
		//$this->set('iAclAcos', $this->IAclAco->getAcoList());
	}
	
	public function indexDataTables(){
		$this->layout = 'ajax';
		$datas = $this->IAclAco->listIndexdataTable($this->request->query);
		$this->set('datas', $datas);
	}
	
}
