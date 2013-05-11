<div class="row-fluid">
	<?php
		if(!empty($outMessages)):
			foreach($outMessages as $outMessage):
	?>
		<div class="alert alert-success">
			<button class="close" data-dismiss="alert" type="button">×</button>
			<?php echo $outMessage?>
		</div>
	<?php
			endforeach;
		endif;
	?>
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
            });
        });
";
?>
<?php $this->Html->scriptEnd(); ?>