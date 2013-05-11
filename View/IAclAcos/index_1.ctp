<!-- Start BootStrap -->
<div class="row-fluid">
	<div class="span2">
		<!--Sidebar content-->
		<div class="well sidebar-nav">
			<ul class="nav nav-list">
				<li class="nav-header">Aro Module</li>

				<li style="margin-bottom:10px">
					<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-info dropdown-toggle"><i class="icon-list-alt icon-white"></i> Aro Module <span class="caret"></span></button>
						<ul class="dropdown-menu">
							<li><?php echo $this->Html->link('<i class="icon-th-list"></i>' . __(' List Aro Data'), array('plugin' => 'i_acl', 'controller' => 'i_acl_aros', 'action' => 'index'), array('escape' => false)) ?></li>
							<li><?php echo $this->Html->link('<i class="icon-user"></i>' . __(' Set User Group'), array('plugin' => 'i_acl', 'controller' => 'i_acl_aros', 'action' => 'setUserGroup'), array('escape' => false)) ?></li>
							<li><?php echo $this->Html->link('<i class="icon-ok-sign"></i>' . __(' Set User Permission'), array('plugin' => 'i_acl', 'controller' => 'i_acl_aros', 'action' => 'setUserPermission'), array('escape' => false)) ?></li>
							<li><?php echo $this->Html->link('<i class="icon-ok-circle"></i>' . __(' Set Group Permission'), array('plugin' => 'i_acl', 'controller' => 'i_acl_aros', 'action' => 'setGroupPermission'), array('escape' => false)) ?></li>
							<li><?php echo $this->Html->link('<i class="icon-tags"></i>' . __(' Set Aro Alias'), array('plugin' => 'i_acl', 'controller' => 'i_acl_aros', 'action' => 'setAroAlias'), array('escape' => false)) ?></li>
						</ul>
					</div>
				</li>

				<li class="nav-header">Aco Module</li>
				<li style="margin-bottom:10px">
					<div class="btn-group">
						<?php echo $this->Html->link('<i class="icon-list-alt icon-white"></i>' . __(' List Aco'), array('plugin' => 'i_acl', 'controller' => 'i_acl_acos', 'action' => 'index'), array('escape' => false, 'class'=>'btn btn-primary')) ?>
					</div>
				</li>
			</ul>
		</div><!--/.well -->
	</div>
	<div class="span10">
		<?php echo $this->Session->flash(); ?>
		<?php //echo $this->Session->flash('auth'); ?>
		<h2><?php echo __('Access Control Object'); ?></h2>
		<br />
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="iAclAcos">
			<thead>
				<tr>
					<th><?php echo Inflector::humanize('id'); ?></th>
					<th><?php echo Inflector::humanize('parent_id'); ?></th>
					<th><?php echo Inflector::humanize('model'); ?></th>
					<th><?php echo Inflector::humanize('foreign_key'); ?></th>
					<th><?php echo Inflector::humanize('alias'); ?></th>
					<th><?php echo Inflector::humanize('lft'); ?></th>
					<th><?php echo Inflector::humanize('rght'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($iAclAcos as $iAclAco): ?>
					<tr>
						<td><?php echo h($iAclAco['Aco']['id']); ?></td>
						<td><?php echo h($iAclAco['Aco']['parent_id']); ?></td>
						<td><?php echo h($iAclAco['Aco']['model']); ?></td>
						<td><?php echo h($iAclAco['Aco']['foreign_key']); ?></td>
						<td><?php echo h($iAclAco['Aco']['alias']); ?></td>
						<td><?php echo h($iAclAco['Aco']['lft']); ?></td>
						<td><?php echo h($iAclAco['Aco']['rght']); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
<?php echo "
        requirejs.config({
            baseUrl:'" . $this->webroot . "i_acl/js/',
            paths:{
                'jquery':'jquery',
                'bootstrap':'bootstrap/bootstrap.min',
		'jquery.dataTables':'jqueryDataTables/jquery.dataTables',
		'ZeroClipboard':'jqueryDataTables/media/js/ZeroClipboard',
                'TableTools':'jqueryDataTables/media/js/TableTools',
		'dataTables.bootstrap':'jqueryDataTables/dataTables.bootstrap'
            },
            shim:{
                'bootstrap':['jquery'],
		'jquery.dataTables':['jquery','bootstrap'],
                'ZeroClipboard':['jquery.dataTables'],
                'TableTools':['jquery.dataTables'],
                'dataTables.bootstrap':['bootstrap','jquery.dataTables'],
            }
    
        });
        require(['jquery','bootstrap','jquery.dataTables','ZeroClipboard','TableTools','dataTables.bootstrap'],function($){
            $(document).ready(function() {
		$(\"table#iAclAcos\").dataTable({
			\"sDom\": \"<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>\",
			\"sPaginationType\": \"bootstrap\",
			\"oLanguage\": {
				\"sLengthMenu\": \"_MENU_ records per page\"
			}
		});
            });
        });
";
?>
<?php $this->Html->scriptEnd(); ?>