<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('cake.generic');
		
		echo $this->Html->css('css/bootstrap-cerulean');
		echo $this->Html->css('css/charisma-app');
		echo $this->Html->css('bower_components/fullcalendar/dist/fullcalendar');
		echo $this->Html->css('bower_components/fullcalendar/dist/fullcalendar.print');
		echo $this->Html->css('bower_components/chosen/chosen.min');
		echo $this->Html->css('bower_components/colorbox/example3/colorbox');
		echo $this->Html->css('bower_components/responsive-tables/responsive-tables');
		echo $this->Html->css('bower_components/bootstrap-tour/build/css/bootstrap-tour.min');
		echo $this->Html->css('css/jquery.noty');
		echo $this->Html->css('css/noty_theme_default');
		echo $this->Html->css('css/elfinder.min');
		
		echo $this->Html->css('css/elfinder.theme');
		echo $this->Html->css('css/jquery.iphone.toggle');
		echo $this->Html->css('css/uploadify');
		echo $this->Html->css('css/animate.min');

		echo $this->Html->script('bower_components/jquery/jquery.min');
		echo $this->Html->css('special/jBox');
		echo $this->Html->script('special/jBox.min');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	
  <script> var BaseURL = "<?php echo $this->webroot; ?>"  </script>
  
</head>



<body>

	<?php 
	$good = $this->Session->flash('good'); 
	$bad = $this->Session->flash('bad'); 
	if(!empty($good)){ 
	$content = $good;
	?>
	<script>
                                 new jBox('Notice', {
                                 content: '<?= $content ?>',
								 animation: {open: 'tada', close: 'flip'},
								 color: 'green',
								 position: { x: 'right',y: 'top' },
								 offset: { x: -50, y: 80 }
								 }) ;
   </script>
   <?php } 
   
    if(!empty($bad)){ 
	$content = $bad;
	?>
	<script>
                                new jBox('Notice', {
                                 content: '<?= $content ?>',
								 animation: {open: 'tada', close: 'flip'},
								 color: 'red',
								 position: { x: 'right',y: 'top' },
								 offset: { x: -50, y: 60 }
								 }) ;
   </script>
   <?php } ?>


	<div id="container">
		
		<?php echo $this->element('header'); ?>
         <?php echo $this->element('sidemenu'); ?>	
		
			<div id="content">
			<?php // echo $this->Flash->render(); ?>
    
			<?php echo $this->fetch('content'); ?>
		  </div>
	
			<?php echo $this->element('footer'); ?>
		
	</div>
	
	<?php

		echo $this->Html->script('bower_components/bootstrap/dist/js/bootstrap.min');
		echo $this->Html->script('js/jquery.cookie.js');
		echo $this->Html->script('bower_components/moment/min/moment.min');
		echo $this->Html->script('bower_components/fullcalendar/dist/fullcalendar.min');
		// echo $this->Html->script('js/jquery.dataTables.min');
		echo $this->Html->script('bower_components/chosen/chosen.jquery.min');
		echo $this->Html->script('bower_components/colorbox/jquery.colorbox-min');
		echo $this->Html->script('js/jquery.noty.js');
		echo $this->Html->script('bower_components/responsive-tables/responsive-tables');
		echo $this->Html->script('bower_components/bootstrap-tour/build/js/bootstrap-tour.min');
		echo $this->Html->script('js/jquery.raty.min');
		echo $this->Html->script('js/jquery.iphone.toggle');
		echo $this->Html->script('js/jquery.autogrow-textarea');
		echo $this->Html->script('js/jquery.uploadify-3.1.min');
		echo $this->Html->script('js/jquery.history');
		echo $this->Html->script('js/charisma');
	
	?>
	
	
	
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
