<?php
// routing system
function call($controller, $action, $code = 0) {
	require_once('controllers/' . $controller . '_controller.php');
	switch($controller) {
		case 'pages':
			require_once('models/user.php');
			require_once('models/sources.php');
			require_once('models/requirements.php');
			$controller = new PagesController();
	 	break;
		case 'requirements':
			require_once('models/requirements.php');
			require_once('models/sources.php');
			$controller = new RequirementsController();
		break;
		case 'usecases':
			require_once('models/usecases.php');
			$controller = new UsecasesController();
		break;
		case 'sources':
			require_once('models/sources.php');
			$controller = new SourcesController();
		break;
	}
	$controller->{$action}($code);
}
// array containing all action for every controller
$controllers = array(
	'pages' => array('home', 'error', 'login', 'checkuser', 'logout', 'download_tex'),
	'requirements' => array('index', 'show', 'add', 'save', 'alter', 'save_edit', 'remove'),
	'usecases' => array('index', 'show', 'add', 'alter', 'save', 'save_edit', 'remove'),
	'sources' => array('index', 'show', 'alter', 'remove', 'add', 'save', 'save_edit')
);
if(array_key_exists($controller, $controllers)) {
	if(in_array($action, $controllers[$controller])) {
		call($controller, $action);
	} else {
		call('pages', 'error', 1);
	}
} else {
	call('pages', 'error', 1);
}
?>
