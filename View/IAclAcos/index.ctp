
<!-- Start BootStrap -->
<div class="row-fluid">
	<?php echo $this->element('bootstrap/sub_navigation');?>
	<div class="span10">
		<?php echo $this->Session->flash(); ?>
		<?php //echo $this->Session->flash('auth'); ?>
		<h2><?php echo __('Access Control Object'); ?></h2>
		<br />
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="iAclAcos">

		</table>
	</div>
</div>
<?php $this->Html->scriptStart(array('inline' => false)); ?>
<?php
$stringJavascript = "
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
            $(document).ready(function() {";
$stringJavascript .= "var mainUrl = '" . $this->Html->url('/', true) . "i_acl/i_acl_acos/indexDataTables/';
		$(\"table#iAclAcos\").dataTable({
			'bFilter': false,
			\"bProcessing\": true,
			\"bServerSide\": true,
			\"sAjaxSource\": mainUrl,
			\"aoColumns\": [
				{ \"sName\": \"id\",\"sTitle\":\"Id\",\"sClass\": \"center\", \"sType\": \"string\", 'bSearchable':false, 'bSortable':false },
				{ \"sName\": \"parent_id\",\"sTitle\":\"Parent Id\",\"sClass\": \"center\", \"sType\": \"string\", 'bSearchable':false, 'bSortable':false },
				{ \"sName\": \"model\",\"sTitle\":\"Model\",\"sClass\": \"center\", \"sType\": \"string\", 'bSearchable':false, 'bSortable':false },
				{ \"sName\": \"foreign_key\",\"sTitle\":\"Foreign Key\",\"sClass\": \"center\", \"sType\": \"string\", 'bSearchable':false, 'bSortable':false },
				{ \"sName\": \"alias\",\"sTitle\":\"Alias\",\"sClass\": \"center\", \"sType\": \"string\", 'bSearchable':false, 'bSortable':false },
				{ \"sName\": \"lft\",\"sTitle\":\"Left\",\"sClass\": \"center\", \"sType\": \"string\", 'bSearchable':false, 'bSortable':false },
				{ \"sName\": \"rght\",\"sTitle\":\"Right\",\"sClass\": \"center\", \"sType\": \"string\", 'bSearchable':false, 'bSortable':false },
			],
			\"sDom\": \"<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>\",
			\"sPaginationType\": \"bootstrap\",
			\"oLanguage\": {
				\"sLengthMenu\": \"_MENU_ records per page\"
			}
		});
            });
        });
";
echo $stringJavascript;
?>
<?php $this->Html->scriptEnd(); ?>