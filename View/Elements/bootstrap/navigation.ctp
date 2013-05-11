<div class="navbar-inner">
	<div class="container-fluid">
		<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        	<span class="icon-bar"></span>
        	<span class="icon-bar"></span>
        	<span class="icon-bar"></span>
      	</a>
		<a class="brand" href="#">iAcl Control Panel</a>
		<div class="nav-collapse collapse">
			<ul class="nav">
				<li><?php echo $this->Html->link(__('Home'), array('plugin'=>'i_acl','controller'=>'static_pages', 'action'=>'index')); ?></li>	
				<li class="dropdown">
            		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Utilities <b class="caret"></b></a>
            		<ul class="dropdown-menu">
              			<li><?php echo $this->Html->link(__('Sync Aco'), array('plugin'=>'i_acl','controller'=>'utilities', 'action'=>'sync_aco')); ?></li>
              			<li><?php echo $this->Html->link(__('Verify Aco'), array('plugin'=>'i_acl','controller'=>'utilities', 'action'=>'verify_aco')); ?></li>
              			<li><?php echo $this->Html->link(__('Verify Aro'), array('plugin'=>'i_acl','controller'=>'utilities', 'action'=>'verify_aro')); ?></li>
						<li><?php echo $this->Html->link(__('Recover Aco'), array('plugin'=>'i_acl','controller'=>'utilities', 'action'=>'recover_aco')); ?></li>
              			<li><?php echo $this->Html->link(__('Recover Aro'), array('plugin'=>'i_acl','controller'=>'utilities', 'action'=>'recover_aro')); ?></li>
            		</ul>
          		</li>
          		
          		<li><?php echo $this->Html->link(__('Aco'), array('plugin'=>'i_acl','controller'=>'i_acl_acos', 'action'=>'index')); ?></li>	
          		<li><?php echo $this->Html->link(__('Aro'), array('plugin'=>'i_acl','controller'=>'i_acl_aros', 'action'=>'index')); ?></li>
			<li><?php echo $this->Html->link(__('Application'), array('plugin'=>'','controller'=>'pages', 'action'=>'display')); ?></li>
        	</ul>
      	</div><!--/.nav-collapse -->
    </div>
</div>