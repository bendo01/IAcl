<div class="row-fluid">
	<div class="hero-unit">
		<h1>iAcl Control Panel</h1>
		<p>a website whose access rights are managed through the <a href="http://book.cakephp.org/2.0/en/core-libraries/components/access-control-lists.html">ACL Component</a>.
			<br /> A good introduction on how to use this plugin can be found in the CakePHP <a href="http://book.cakephp.org/2.0/en/tutorials-and-examples/simple-acl-controlled-application/simple-acl-controlled-application.html">ACL Tutorial documentation</a>.
			<br /> This plugin based on <a href="http://mark-story.com/">Mark Story</a>, <a href="https://github.com/markstory/acl_extras">AclExtras Plugin</a> and <a href="http://www.alaxos.net">Nicolas Rod</a>, <a href="http://www.alaxos.net/blaxos/pages/view/plugin_acl_2.0">Alaxos Plugin Acl</a>
			<br /> Credits to <a href="http://cakephp.org/">CakePHP</a> , <a href="http://jquery.com/">jQuery</a> , <a href="http://www.datatables.net/">Datatables JS</a>, <a href="http://twitter.github.io/bootstrap/">Twitter Bootstrap</a>,and <a href="http://fortawesome.github.io/Font-Awesome/">Font Awesome</a>
			<br /> <br /><a rel="license" href="http://creativecommons.org/licenses/by/3.0/deed.en_US"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by/3.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" property="dct:title">iAcl created </span> by <a xmlns:cc="http://creativecommons.org/ns#" href="http://whiteboks.com" property="cc:attributionName" rel="cc:attributionURL">Benny Leonard Enrico Panggabean</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/3.0/deed.en_US">Creative Commons Attribution 3.0 Unported License</a>.
		</p>
	</div>
	<div class="row-fluid">
		<div class="span4">
			<h2>Sync Aco</h2>
			<p>Perform a full sync on the ACO table.Will create new ACOs or missing controllers and actions.Will also remove orphaned entries that no longer have a matching controller/action. </p>
		</div><!--/span-->
		<div class="span4">
			<h2>Verify Aco</h2>
			<p>Verify the tree structure of either your Aco Trees.</p>
		</div><!--/span-->
		<div class="span4">
			<h2>Verify Aro</h2>
			<p>Verify the tree structure of either your Aro Trees.</p>
		</div><!--/span-->
	</div><!--/row-->
	<div class="row-fluid">
		<div class="span4">
			<h2>Recover</h2>
			<p>Recover a corrupted Tree.</p>
		</div><!--/span-->
	</div><!--/row-->
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