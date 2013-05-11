<!-- Start BootStrap -->
<div class="row-fluid">
	<?php echo $this->element('bootstrap/sub_navigation');?>
	<div class="span10">
		<?php echo $this->Session->flash(); ?>
		<?php //echo $this->Session->flash('auth'); ?>
		<h2><?php echo __('Access Role Object'); ?></h2>
		<br />
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="iAclAros">
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
				<?php foreach ($iAclAros as $iAclAro): ?>
					<tr>
						<td><?php echo h($iAclAro['Aro']['id']); ?></td>
						<td><?php echo h($iAclAro['Aro']['parent_id']); ?></td>
						<td><?php echo h($iAclAro['Aro']['model']); ?></td>
						<td><?php echo h($iAclAro['Aro']['foreign_key']); ?></td>
						<td><?php echo h($iAclAro['Aro']['alias']); ?></td>
						<td><?php echo h($iAclAro['Aro']['lft']); ?></td>
						<td><?php echo h($iAclAro['Aro']['rght']); ?></td>
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
		$(\"table#iAclAros\").dataTable({
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