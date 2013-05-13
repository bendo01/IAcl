<?php
App::uses('IAclAppController', 'IAcl.Controller');
/**
 * 
 *  Controller
 *
 */
class IAclArosController extends IAclAppController {
	
	public function index(){
		$this->set('iAclAros', $this->IAclAro->getAroList());
	}
	
	public function setUserGroup() {
		$aroGroups = $this->IAclAro->getAroGroup();
		$aroUsers = $this->IAclAro->getListUsers();
		$this->set('aroGroups', $aroGroups);
		$this->set('aroUsers', $aroUsers);
	}
	
	public function userPermission() {
		$aroUsers = $this->IAclAro->getListUsers();
		$this->set('aroUsers', $aroUsers);
	}
	
	public function manageUserPermission($userId = null){
		//pr($userId);
		if(!empty($userId)) {
			$userData = $this->IAclAro->getUserData($userId);
			$this->set('userData', $userData);
		}
		else {
			$this->Session->setFlash('User is not Defined', 'flashFailure', array('plugin' => 'IAcl'));
			$this->redirect(array('plugin'=>'i_acl', 'controller'=> 'IAclAros', 'action' => 'userPermission'));
		}
	}
	
	public function manageUserPermissionIndexDataTable(){
		$this->layout = 'ajax';
		$datas = $this->IAclAro->getAcoListApplicationControllerIndexDataTable($this->request->named['userId'], $this->request->query);
		$this->set('datas', $datas);
	}
	
	public function setGroupPermission(){
		$this->IAclAro->setAroAlias();
		$listGroups = $this->IAclAro->getAroGroup();
		$this->set('listGroups', $listGroups);
	}
	
	public function manageGroupPermissionIndexDataTable(){
		$this->layout = 'ajax';
		$listGroups = $this->IAclAro->getAroGroup();
		$datas = $this->IAclAro->getAcoListGroupPermissionIndexDataTable($listGroups, $this->request->query);
		$this->set('datas', $datas);
	}
	
	public function setAroAlias() {
		$this->IAclAro->setAroAlias();
		$this->Session->setFlash('Aro Alias Updated', 'flashSuccess', array('plugin' => 'IAcl'));
		$this->redirect(array('plugin'=>'i_acl', 'controller'=> 'IAclAros', 'action' => 'index'));
	}
	
	public function groupSetAllowedAction() {
		$this->layout = 'ajax';
		$data = $this->request->input('json_decode');
		$response = null;
		$returnValues = '';
		if($data->authorized == 'false'){
			$response = $this->IAclAro->groupAllowAction($data->groupid, $data->alias, null);
		}
		else{
			$response = $this->IAclAro->groupDenyAction($data->groupid, $data->alias, null);
		}
		$this->set('datas', $response);
	}
	
	public function userSetAllowedAction() {
		$this->layout = 'ajax';
		$data = $this->request->input('json_decode');
		$response = null;
		$returnValues = '';
		if($data->authorized == 'false'){
			//pr('run allowed');
			$response = $this->IAclAro->userAllowAction($data->userid, $data->alias, null);
		}
		else{
			$response = $this->IAclAro->userDenyAction($data->userid, $data->alias, null);
		}
		$this->set('datas', $response);
	}
}