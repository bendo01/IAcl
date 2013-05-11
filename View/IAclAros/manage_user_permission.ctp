<div class="row-fluid">
	<?php echo $this->element('bootstrap/sub_navigation');?>
	<div class="span10">
		<?php echo $this->Session->flash(); ?>
		<?php //echo $this->Session->flash('auth'); ?>
		<h2><?php echo __('Access Role Object - '.$userData['User']['username']); ?></h2>
		<br />
		<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="iAclUserArosPermission">
			
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
		var mainUrl = '" . $this->Html->url('/', true) . "i_acl/i_acl_aros/manageUserPermissionIndexDataTable/userId:".$userData['User']['id']."/';
		var ajaxUrl = '" . $this->Html->url('/', true) . "i_acl/i_acl_aros/userSetAllowedAction/';
		$(\"table#iAclUserArosPermission\").dataTable({
			'bFilter': false,
			\"bProcessing\": true,
			\"bServerSide\": true,
			\"sAjaxSource\": mainUrl+'indexDatatable',
			\"aoColumns\": [
				{ \"sName\": \"id\",\"sTitle\":\"Id\",\"sClass\": \"center\", \"sType\": \"integer\",\"bSearchable\":false },
				{ \"sName\": \"action\",\"sTitle\":\"Action\",\"sClass\": \"center\", \"sType\": \"string\" },
				{ \"sName\": \"authorizhed\",\"sTitle\":\"Authorizhed\",\"sClass\": \"center\", \"sType\": \"string\",\"bSearchable\":false }
			],
			\"sDom\": \"<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>\",
			\"sPaginationType\": \"bootstrap\",
			\"oLanguage\": {
				\"sLengthMenu\": \"_MENU_ records per page\"
			},
			'fnDrawCallback': function (oSettings, oData) {
				$('a.iAclUserauthorized').bind('click', function() {
					anchorId = $(this).attr('id');
					arrId = $(this).attr('id').split('_');
					$.ajax({
						type: 'POST',
						url: ajaxUrl,
						dataType: 'json',
						contentType : 'application/json',
						data: JSON.stringify({ 
							acoId: arrId[1],
							userid: $('a#'+anchorId).attr('data-iacl-userid'),
							authorized: $('a#'+anchorId).attr('data-iacl-authorized'),
							alias: $('a#'+anchorId).attr('data-iacl-alias')
						}),
						success: function(datas){
							//alert(datas);
							if(datas == 'allow'){
								$('a#'+anchorId).removeClass('btn-danger').addClass('btn-success');
								$('a#'+anchorId+' i').removeClass('icon-remove').addClass('icon-ok');
								console.log($('a#'+anchorId).attr('data-iacl-authorized'));
								$('a#'+anchorId).attr('data-iacl-authorized', 'true')
								console.log($('a#'+anchorId).attr('data-iacl-authorized'));
							}
							
							else{
								$('a#'+anchorId).removeClass('btn-success').addClass('btn-danger');
								$('a#'+anchorId+' i').removeClass('icon-ok').addClass('icon-remove');
								//$('a#'+anchorId).data('iacl-authorized', 'false');
								$('a#'+anchorId).attr('data-iacl-authorized', 'false')
							}
						},
						error: function(datas){
							alert('error');
						}
					});
				});
			}
		});
            });
        });
";
?>
<?php $this->Html->scriptEnd(); ?>