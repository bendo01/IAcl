<?php
	class StaticPagesController extends IAclAppController {
		public $uses = array();
		public function index(){
			$this->layout = 'IAcl.Default'; 
		}
	}
?>