<?php

	
	Router::connect('/', array('controller' => 'users', 'action' => 'login', 'login'));
	Router::connect('/logout', array('controller' => 'users', 'action' => 'logout'));
	Router::connect('/dashboard', array('controller' => 'users', 'action' => 'index', 'dashboard'));
	Router::connect('/listing', array('controller' => 'users', 'action' => 'listing', 'listing'));
	Router::connect('/event-detail', array('controller' => 'users', 'action' => 'event_detail', 'event_detail'));
	Router::connect('/list-event-detail/*', array('controller' => 'users', 'action' => 'list_event_detail'));
	Router::connect('/event-images/*', array('controller' => 'users', 'action' => 'event_images'));
	Router::connect('/listing-images/*', array('controller' => 'users', 'action' => 'listing_images'));
	Router::connect('/events/*', array('controller' => 'users', 'action' => 'events'));
	Router::connect('/listing-detail/*', array('controller' => 'users', 'action' => 'listing_detail', 'listing_detail'));
	Router::connect('/listing-bulk-upload', array('controller' => 'imports', 'action' => 'listings', 'bulk-file-upload'));
	Router::connect('/logsdata/*', array('controller' => 'imports', 'action' => 'logsdata', 'logsdata'));
	Router::connect('/logs-files/*', array('controller' => 'imports', 'action' => 'logs_files', 'logs-files'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
