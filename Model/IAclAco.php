<?php
App::uses('IAclAppModel', 'IAcl.Model');
App::uses('AclComponent', 'Controller/Component');
/**
 * Comment Model
 *
 * @property Aro $Aro
 */
class IAclAco extends IAclAppModel {
	public $useTable = false; // This model does not use a database table
	public $Acl = null;
	public $Aco = null;
	//public $rootNode = 'controllers';
	
	public function startUp($controller = null){
		if (!$controller) {
			$controller = new Controller(new CakeRequest());
		}
		$collection = new ComponentCollection();
		$this->Acl = new AclComponent($collection);
		$this->Acl->startup($controller);
		$this->Aco = $this->Acl->Aco;
	}
	
	public function getAcoList($controller = null){
		$this->startUp($controller);
		$this->Aco->recursive = 0;
		$dataAcos = $this->Aco->find('all');
		return $dataAcos;
	}
	
	public function checkIfItIsModelObject($modelName = null, $plugin = null){
		$returnValue = false;
		$listModel = array();
		if(!empty($modelName)){
			if(!empty($plugin)){
				$listModel = App::objects($plugin.'.Model');
			}
			else{
				$listModel = App::objects('Model');
			}
		}
		
		if(!empty($listModel) && in_array($modelName, $listModel, true)){
			$returnValue = true;
		}
		return $returnValue;
	}
	
	public function checkIfItIsControllerObject($controllerName = null, $plugin = null){
		$returnValue = false;
		$listController = array();
		if(!empty($controllerName)){
			if(!empty($plugin)){
				$listController = App::objects($plugin.'.Controller');
			}
			else{
				$listController = App::objects('Controller');
			}
		}

		if(!empty($listController) && in_array($controllerName.'Controller', $listController, true)){
			$returnValue = true;
		}
		
		return $returnValue;
	}
	
	public function checkIfIsControllerFunction($controllerName = null, $method = null, $plugin = null){
		$returnValue = false;
		$listMethods = array();
		$pathToFile = null;
		
		if(!empty($plugin)){
			$pathToFile = APP.'Plugin'.DS.$plugin.DS.'Controller'.DS.$controllerName.'Controller.php';
		}
		else{
			$pathToFile = APP.'Controller'.DS.$controllerName.'Controller.php';
		}
		
		if(!empty($controllerName) && !empty($method)){
			$listControllerMethods = get_class_methods($pathToFile);
			if(in_array($method, $listControllerMethods, true)){
				$returnValue = true;
			}
		}
		return $returnValue;
	}
	
	public function listIndexdataTable($dataTableParams = array(), $controller = null) {
		$this->startUp($controller);
		$returnData = array();
		if (!empty($dataTableParams)) {
			$this->Aco->recursive = -1;
			$tempDatas = $this->Aco->find('all', array(
				'order' => array('Aco.id'),
				'limit' => $dataTableParams['iDisplayLength'],
				'offset' => $dataTableParams['iDisplayStart']
			));
			
			if (!empty($tempDatas)) {
				$returnData['sEcho'] = $dataTableParams['sEcho'];
				$returnData['iTotalDisplayRecords'] = $this->Aco->find('count');
				$returnData['iTotalRecords'] = $this->Aco->find('count');
				//pr($returnData['iTotalDisplayRecords']);
				//pr($returnData['iTotalRecords']);
				//exit;
				$i = 0;
				foreach ($tempDatas as $tempData) {
					$returnData['aaData'][$i][0] = $tempData['Aco']['id'];
					if(!empty($tempData['Aco']['parent_id'])){
						$returnData['aaData'][$i][1] = $tempData['Aco']['parent_id'];
					}
					else{
						$returnData['aaData'][$i][1] = '&nbsp';
					}
					
					if(!empty($tempData['Aco']['model'])){
						$returnData['aaData'][$i][2] = $tempData['Aco']['model'];
					}
					else{
						$returnData['aaData'][$i][2] = '&nbsp';
					}
					
					if(!empty($tempData['Aco']['foreign_key'])){
						$returnData['aaData'][$i][3] = $tempData['Aco']['foreign_key'];
					}
					else{
						$returnData['aaData'][$i][3] = '&nbsp';
					}
					
					if(!empty($tempData['Aco']['alias'])){
						$returnData['aaData'][$i][4] = $tempData['Aco']['alias'];
					}
					else{
						$returnData['aaData'][$i][4] = '&nbsp';
					}

					$returnData['aaData'][$i][5] = $tempData['Aco']['lft'];
					$returnData['aaData'][$i][6] = $tempData['Aco']['rght'];
					$i++;
				}
			} else {
				$returnData['sEcho'] = $dataTableParams['sEcho'];
				$returnData['iTotalDisplayRecords'] = 0;
				$returnData['iTotalRecords'] = 0;
				$returnData['aaData'] = array();
			}
		}
		return $returnData;
	}
}
?>