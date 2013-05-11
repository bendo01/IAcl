<div class="span2">
	<!--Sidebar content-->
	<div class="well sidebar-nav">
		<ul class="nav nav-list">
			<li class="nav-header">Aro Module</li>
			<li style="margin-bottom:10px">
				<div class="btn-group">
					<button data-toggle="dropdown" class="btn btn-info dropdown-toggle">
						<i class="icon-list-alt icon-white"></i>&nbsp;Aro Module &nbsp;<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li><?php echo $this->Html->link('<i class="icon-th-list"></i>' . __(' List Aro Data'), array('plugin' => 'i_acl', 'controller' => 'i_acl_aros', 'action' => 'index'), array('escape' => false)) ?></li>
						<li><?php echo $this->Html->link('<i class="icon-user"></i>' . __(' Set User Group'), array('plugin' => 'i_acl', 'controller' => 'i_acl_aros', 'action' => 'setUserGroup'), array('escape' => false)) ?></li>
						<li><?php echo $this->Html->link('<i class="icon-ok-sign"></i>' . __(' Set User Permission'), array('plugin' => 'i_acl', 'controller' => 'i_acl_aros', 'action' => 'userPermission'), array('escape' => false)) ?></li>
						<li><?php echo $this->Html->link('<i class="icon-ok-circle"></i>' . __(' Set Group Permission'), array('plugin' => 'i_acl', 'controller' => 'i_acl_aros', 'action' => 'setGroupPermission'), array('escape' => false)) ?></li>
						<li><?php echo $this->Html->link('<i class="icon-tags"></i>' . __(' Set Aro Alias'), array('plugin' => 'i_acl', 'controller' => 'i_acl_aros', 'action' => 'setAroAlias'), array('escape' => false)) ?></li>
					</ul>
				</div>
			</li>
			<li class="nav-header">Aco Module</li>
			<li style="margin-bottom:10px">
				<div class="btn-group">
					<?php echo $this->Html->link('<i class="icon-list-alt icon-white"></i>' . __(' List Aco'), array('plugin' => 'i_acl', 'controller' => 'i_acl_acos', 'action' => 'index'), array('escape' => false, 'class' => 'btn btn-primary')) ?>
				</div>
			</li>
		</ul>
	</div><!--/.well -->
</div>