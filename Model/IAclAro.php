<?php

App::uses('IAclAppModel', 'IAcl.Model');
App::uses('AclComponent', 'Controller/Component');
App::uses('Group', 'Model');
App::uses('User', 'Model');

/**
 * Comment Model
 *
 * @property Aro $Aro
 */
class IAclAro extends IAclAppModel {

	public $useTable = false; // This model does not use a database table
	public $Acl = null;
	public $Aro = null;
	public $Aco = null;
	public $User = null;
	public $Group = null;

	public function startUp($controller = null) {
		if (!$controller) {
			$controller = new Controller(new CakeRequest());
		}
		$collection = new ComponentCollection();
		$this->Acl = new AclComponent($collection);
		$this->User = new User();
		$this->Group = new Group();
		$this->Acl->startup($controller);
		$this->Aro = $this->Acl->Aro;
		$this->Aco = $this->Acl->Aco;
	}

	public function getAcoList($controller = null) {
		$this->startUp($controller);
		$this->Aco->recursive = 0;
		$dataAcos = $this->Aco->find('all', array(
			'order' => array('Aco.id')
		));
		return $dataAcos;
	}

	public function getAroList($controller = null) {
		$this->startUp($controller);
		$this->Aro->recursive = -1;
		$dataAros = $this->Aro->find('all');
		return $dataAros;
	}

	public function hasChild($child) {
		if ($child && count($child) > 0) {
			return true;
		}
		return false;
	}

	public function generateAcoListManagePermission(&$listAcoDatas = array()) {
		//$pluginLists = App::objects('plugin');
		$tempData = array();
		$i = 0;
		if (!empty($listAcoDatas) && count($listAcoDatas) > 0) {
			foreach ($listAcoDatas as $listAcoData) {
				if ($this->hasChild($listAcoData)) {
					foreach ($listAcoData['children'] as $action) {
						if ($this->hasChild($action['children'])) {
							foreach ($action['children'] as $pluginAction) {
								$tempData[$i]['id'] = $pluginAction['Aco']['id'];
								$tempData[$i]['action'] = $listAcoData['Aco']['alias'] . '/' . $action['Aco']['alias'] . '/' . $pluginAction['Aco']['alias'];
							}
						} else {
							$tempData[$i]['id'] = $action['Aco']['id'];
							$tempData[$i]['action'] = $listAcoData['Aco']['alias'] . '/' . $action['Aco']['alias'];
						}
						$i++;
					}
				}
			}
		}
		return $tempData;
	}

	public function getAcoListApplicationController($userId = null, $controller = null) {
		$this->startUp($controller);
		$tempDatas = array();
		$i = 0;
		$countTempDatas = 0;

		$this->Aco->recursive = -1;
		$dataAcos = $this->Aco->find('threaded', array(
			'fields' => array(
				'Aco.id', 'Aco.alias', 'Aco.parent_id'
			),
			'order' => array('Aco.lft')
		));
		$tempDatas = $this->generateAcoListManagePermission($dataAcos[0]['children']);
		$countTempDatas = count($tempDatas);
		$user = $this->User->find('first', array('conditions' => array('User.id' => $userId), 'recursive' => -1));
		$userAro = $this->Acl->Aro->node($user);
		for ($i = 0; $i < $countTempDatas; $i++) {
			$tempDatas[$i]['authorized'] = $this->Acl->check($user, 'controllers/' . $tempDatas[$i]['action']);
		}
		return $tempDatas;
	}

	public function renameActionIndexDataTable($acoDatas = array(), $controller = null) {
		$this->startUp($controller);
		$plugin = null;
		$pluginId = null;
		$controller = null;
		$i = 0;
		$pluginLists = App::objects('plugin');
		if (!empty($acoDatas)) {
			foreach ($acoDatas as $acoData) {
				//pr($acoData);
				$parent = $this->Aco->getParentNode($acoData['Aco']['id']);
				//pr($parent);
				if ($parent['Aco']['parent_id'] == 1) {
					if (in_array($parent['Aco']['alias'], $pluginLists)) {
						$plugin = $parent['Aco']['alias'] . '/';
						$pluginId = $parent['Aco']['id'];
						//pr($plugin. '     !!!!!!! ini PLUGIN');
					} else {
						//pr($parent['Aco']['alias'].'/'.$acoData['Aco']['alias']. '     !!!!!!! ini App Controller');
						$acoDatas[$i]['Aco']['alias'] = $parent['Aco']['alias'] . '/' . $acoData['Aco']['alias'];
					}
				} else if (!empty($pluginId) && $parent['Aco']['parent_id'] == $pluginId) {
					//pr($plugin.$parent['Aco']['alias'].'/'.$acoData['Aco']['alias']. '     !!!!!!! ini PLUGIN CONTROLLER');
					$acoDatas[$i]['Aco']['alias'] = $plugin . $parent['Aco']['alias'] . '/' . $acoData['Aco']['alias'];
				}
				$i++;
			}
			$i = 0;
			foreach ($acoDatas as $acoData) {
				$temp = explode('/', $acoData['Aco']['alias']);
				if (count($temp) == 1) {
					unset($acoDatas[$i]);
				}
				$i++;
			}
		}
		return array_values($acoDatas);
	}

	public function getAcoListApplicationControllerIndexDataTable($userId = null, $dataTableParams = array(), $controller = null) {
		$this->startUp($controller);
		$tempDatas = array();
		$i = 0;
		$countTempDatas = 0;
		$returnData = array();

		if (!empty($userId) && !empty($dataTableParams)) {
			$this->Aco->recursive = -1;
			$tempDatas = $this->Aco->find('all', array(
				'conditions' => array(
					//'Aco.parent_id !='=>null

					'OR' => array(
						'Aco.parent_id !=' => null,
						'Aco.parent_id !=' => 1
					)
				),
				'fields' => array(
					'Aco.id', 'Aco.alias', 'Aco.parent_id'
				),
				'order' => array('Aco.id'),
				'limit' => $dataTableParams['iDisplayLength'],
				'offset' => $dataTableParams['iDisplayStart']
			));

			$tempDatas = $this->renameActionIndexDataTable($tempDatas);
			$countTempDatas = count($tempDatas);
			$user = $this->User->find('first', array('conditions' => array('User.id' => $userId), 'recursive' => -1));
			$userAro = $this->Acl->Aro->node($user);

			for ($i = 0; $i < $countTempDatas; $i++) {
				$tempDatas[$i]['Aco']['authorized'] = $this->Acl->check($user, 'controllers/' . $tempDatas[$i]['Aco']['alias']);
			}
			if (!empty($tempDatas)) {
				$returnData['sEcho'] = $dataTableParams['sEcho'];
				$returnData['iTotalDisplayRecords'] = $this->Aco->find('count', array(
					'conditions' => array(
						'OR' => array(
							'Aco.parent_id !=' => null,
							'Aco.parent_id !=' => 1
						)
					),
					'fields' => array(
						'Aco.id', 'Aco.alias', 'Aco.parent_id'
					),
					'order' => array('Aco.id')
				));
				$returnData['iTotalRecords'] = $this->Aco->find('count', array(
					'conditions' => array(
						//'Aco.parent_id !='=>null

						'OR' => array(
							'Aco.parent_id !=' => null,
							'Aco.parent_id !=' => 1
						)
					),
					'fields' => array(
						'Aco.id', 'Aco.alias', 'Aco.parent_id'
					),
					'order' => array('Aco.id')
				));
				$i = 0;
				foreach ($tempDatas as $tempData) {
					$returnData['aaData'][$i][0] = $tempData['Aco']['id'];
					$returnData['aaData'][$i][1] = $tempData['Aco']['alias'];
					if ($tempData['Aco']['authorized']) {
						$returnData['aaData'][$i][2] = '<a href="javascript:void(0)" class="iAclUserauthorized btn btn-success" id="acoId_'.$tempData['Aco']['id'].'" data-iacl-alias="'.$tempData['Aco']['alias'].'" data-iacl-authorized="true" data-iacl-userid="'.$user['User']['id'].'"><i class="icon-ok"></i></a>';
					} else {
						$returnData['aaData'][$i][2] = '<a href="javascript:void(0)" class="iAclUserauthorized btn btn-danger" id="acoId_'.$tempData['Aco']['id'].'" data-iacl-alias="'.$tempData['Aco']['alias'].'" data-iacl-authorized="false" data-iacl-userid="'.$user['User']['id'].'"><i class="icon-remove"></i></a>';
					}
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

	public function setAroAlias() {
		$tempData = null;
		$returnValue = false;
		$dataAroLists = $this->getAroList();
		if (!empty($dataAroLists)) {
			foreach ($dataAroLists as $dataAroList) {
				$data = $this->{$dataAroList['Aro']['model']}->find('first', array('conditions' => array($dataAroList['Aro']['model'] . '.id' => $dataAroList['Aro']['foreign_key']), 'recursive' => -1));
				if ($dataAroList['Aro']['model'] == 'Group') {
					$tempData = $data['Group']['name'];
				} else {
					$tempData = $data['User']['username'];
				}
				$this->Aro->id = $dataAroList['Aro']['id'];
				$this->Aro->saveField('alias', $tempData);
			}
			$returnValue = true;
		}
		return $returnValue;
	}

	public function getAroGroup($controller = null) {
		$this->startUp($controller);
		$this->Aro->recursive = -1;
		$dataAroGroups = $this->Aro->find('all', array(
			'conditions' => array(
				'Aro.model' => 'Group'
			)
		));

		return $dataAroGroups;
	}

	public function getUserRoleAroGroup($controller = null) {
		$this->Aro->recursive = -1;
		$dataAroUserRoleGroups = $this->Aro->find('all', array(
			'conditions' => array(
				'Aro.model' => 'Group'
			)
		));

		return $dataAroUserRoleGroups;
	}

	public function getListUsers($controller = null) {
		$this->startUp($controller);
		$userLists = $this->User->find('all', array(
			'fields' => array(
				'User.id', 'User.username', 'User.group_id'),
			'recursive' => -1)
		);
		return $userLists;
	}

	public function getUserData($userId = null, $controller = null) {
		$this->startUp($controller);
		$returnedData = array();
		if (!empty($userId)) {
			$returnedData = $this->User->find('first', array(
				'conditions' => array(
					'User.id' => $userId
				),
				'fields' => array(
					'User.id', 'User.username', 'User.group_id'
				),
				'recursive' => -1
			));
		}
		
		return $returnedData;
	}

	public function getAcoListGroupPermissionIndexDataTable($groups = array(), $dataTableParams = array(), $controller = null) {
		$this->startUp($controller);
		$tempDatas = array();
		$i = 0;
		$countTempDatas = 0;
		$returnData = array();
		$groupAros = array();
		if (!empty($groups) && !empty($dataTableParams)) {
			$this->Aco->recursive = -1;
			$tempDatas = $this->Aco->find('all', array(
				'conditions' => array(
					//'Aco.parent_id !='=>null

					'OR' => array(
						'Aco.parent_id !=' => null,
						'Aco.parent_id !=' => 1
					)
				),
				'fields' => array(
					'Aco.id', 'Aco.alias', 'Aco.parent_id'
				),
				'order' => array('Aco.id'),
				'limit' => $dataTableParams['iDisplayLength'],
				'offset' => $dataTableParams['iDisplayStart']
			));

			$tempDatas = $this->renameActionIndexDataTable($tempDatas);
			$countTempDatas = count($tempDatas);
			$i = 0;

			if (!empty($tempDatas)) {
				$returnData['sEcho'] = $dataTableParams['sEcho'];
				$returnData['iTotalDisplayRecords'] = $this->Aco->find('count', array(
					'conditions' => array(
						'OR' => array(
							'Aco.parent_id !=' => null,
							'Aco.parent_id !=' => 1
						)
					),
					'fields' => array(
						'Aco.id', 'Aco.alias', 'Aco.parent_id'
					),
					'order' => array('Aco.id')
				));
				$returnData['iTotalRecords'] = $this->Aco->find('count', array(
					'conditions' => array(
						//'Aco.parent_id !='=>null

						'OR' => array(
							'Aco.parent_id !=' => null,
							'Aco.parent_id !=' => 1
						)
					),
					'fields' => array(
						'Aco.id', 'Aco.alias', 'Aco.parent_id'
					),
					'order' => array('Aco.id')
				));
				$i = 0;
				foreach ($tempDatas as $tempData) {
					$y = 2;
					$returnData['aaData'][$i][0] = $tempData['Aco']['id'];
					$returnData['aaData'][$i][1] = $tempData['Aco']['alias'];
					foreach ($groups as $group) {
						$authorized = $this->Acl->check($group['Aro'], 'controllers/' . $tempData['Aco']['alias']);
						if($authorized){
							$returnData['aaData'][$i][$y] = '<a href="javascript:void(0)" class="iAclUserauthorized btn btn-success" id="acoId_'.$i.'_'.$y.'" data-iacl-alias="'.$tempData['Aco']['alias'].'" data-iacl-authorized="true" data-iacl-groupid="'.$group['Aro']['foreign_key'].'"><i class="icon-ok"></i></a>';
						}
						else{
							$returnData['aaData'][$i][$y] = '<a href="javascript:void(0)" class="iAclUserauthorized btn btn-danger" id="acoId_'.$i.'_'.$y.'" data-iacl-alias="'.$tempData['Aco']['alias'].'" data-iacl-authorized="false" data-iacl-groupid="'.$group['Aro']['foreign_key'].'"><i class="icon-remove"></i></a>';
						}
						$y++;
					}
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
	
	public function groupAllowAction($groupId = null, $action = null, $controller = null) {
		$this->startUp($controller);
		$group = $this->Group->find('first', array('conditions' => array('Group.id' => $groupId), 'recursive' => -1));
		if($this->Acl->allow($group, 'controllers/' . $action)){
			return 'allow';
		}
		else{
			return 'deny';
		}
	}
	
	public function groupDenyAction($groupId = null, $action = null, $controller = null) {
		$this->startUp($controller);
		$group = $this->Group->find('first', array('conditions' => array('Group.id' => $groupId), 'recursive' => -1));
		if($this->Acl->deny($group, 'controllers/' . $action)){
			return 'deny';
		}
		else{
			return 'allow';
		}
	}
	
	public function userAllowAction($userId = null, $action = null, $controller = null) {
		$this->startUp($controller);
		$user = $this->User->find('first', array('conditions' => array('User.id' => $userId), 'recursive' => -1));
		if($this->Acl->allow($user, 'controllers/' . $action)){
			return 'allow';
		}
		else{
			return 'deny';
		}
	}
	
	public function userDenyAction($userId = null, $action = null, $controller = null) {
		$this->startUp($controller);
		$user = $this->User->find('first', array('conditions' => array('User.id' => $userId), 'recursive' => -1));
		if($this->Acl->deny($user, 'controllers/' . $action)){
			return 'deny';
		}
		else{
			return 'allow';
		}
	}
}

?>