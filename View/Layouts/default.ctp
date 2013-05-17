<?php
$cakeDescription = __d('BLEP ', 'iAcl');
//$title_for_layout = __d('EFACP');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>
			<?php echo $cakeDescription ?>:
			<?php echo $title_for_layout; ?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Le styles -->
		<?php echo $this->Html->css('IAcl.bootstrap'); ?>
		<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
		</style>
		<?php
			echo $this->Html->css('IAcl.bootstrap-responsive', 'stylesheet', array('media' => 'screen'));
			echo $this->Html->css('IAcl.font-awesome', 'stylesheet', array('media' => 'screen'));
			echo $this->Html->css('IAcl.dataTables.bootstrap', 'stylesheet', array('media' => 'screen'));
		?>
		<?php
			echo $this->fetch('meta');
			echo $this->fetch('css');
		?>
	</head>

	<body>

		<div class="navbar navbar-inverse navbar-fixed-top">
			<?php echo $this->element('bootstrap/navigation'); ?>
		</div>

		<div class="container-fluid">
			<?php echo $this->fetch('content'); ?>
			<?php echo $this->element('bootstrap/footer'); ?>

		</div> <!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster and pointing on plugin asset -->
		<?php echo $this->Html->script('IAcl.require'); ?>
		<?php echo $this->fetch('script'); //echo $scripts_for_layout;?>
		<?php $this->Js->writeBuffer(); // Write cached script ?>
	</body>
</html>
