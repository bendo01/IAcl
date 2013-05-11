<!-- Start BootStrap -->
<div class="row-fluid">
	<?php echo $this->element('bootstrap/sub_navigation');?>
	<div class="span10">
		<?php echo $this->Session->flash(); ?>
		<?php //echo $this->Session->flash('auth'); ?>
		<h2><?php echo __('Access Role Object - User Group'); ?></h2>
		<br />
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="iAclAroUserRoleGroups">
			<thead>
				<tr>
					<th><?php echo Inflector::humanize('Username'); ?></th>
					<?php if (!empty($aroGroups)): ?>
						<?php foreach ($aroGroups as $aroGroup): ?>
							<?php if (!empty($aroGroup['Aro']['alias'])): ?>
								<th><?php echo Inflector::humanize($aroGroup['Aro']['alias']); ?></th>
							<?php else: ?>
								<th><?php echo Inflector::humanize($aroGroup['Aro']['id']); ?></th>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($aroUsers as $aroUser): ?>
					<tr>
						<td>
							<?php echo $aroUser['User']['username']; ?>
						</td>
						<?php if (!empty($aroGroups)): ?>
							<?php foreach ($aroGroups as $aroGroup): ?>
								<?php if (!empty($aroGroup['Aro']['foreign_key']) && ($aroGroup['Aro']['foreign_key'] == $aroUser['User']['group_id'])): ?>
									<td><i class="icon-ok"></i></td>
								<?php else: ?>
									<td><i class="icon-remove"></i></td>
									<?php endif; ?>
								<?php endforeach; ?>
							<?php endif; ?>
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
		$(\"table#iAclAroUserRoleGroups\").dataTable({
			'bFilter': false,
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