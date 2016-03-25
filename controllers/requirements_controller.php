<?php
class RequirementsController {
	public function index() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
#			$requirements = Requirement::all();
			$requirements = Requirement::sorted_all();
			sort($requirements);
			#usort($requirements, function ($item1, $item2) {
			 #	if ( floatval($item1->getCode()) == floatval($item2->getCode()) )
			#		return 0;
			#	return ( floatval($item1->getCode()) > floatval($item2->getCode()) ) ? 1 : -1;
		#	});
			require_once('views/requirements/index.php');
		}
	}
	public function add() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			$sources = Sources::all();
			require_once('views/requirements/add.php');
		}
	}
	public function save() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			$post_data = $_POST;
			Requirement::add($post_data);
			return call('requirements', 'index');
		}
	}
	public function save_edit() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			if(!isset($_GET['code'])) {
				return call('pages', 'error', 2);
			}
			$post_data = $_POST;
			Requirement::save($post_data, $_GET['code']);
			return call('requirements', 'index');
		}
	}
	public function remove() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			if(!isset($_GET['code'])) {
				return call('pages', 'error', 2);
			}
			Requirement::remove($_GET['code']);
			return call('requirements', 'index');
		}
	}
	public function alter() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			if(!isset($_GET['code'])) {
				return call('pages', 'error', 2);
			}
			$sources = Sources::all();
			$requirement = Requirement::get($_GET['code']);
			require_once('views/requirements/alter.php');
		}
	}
	public function show() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			require_once('views/requirements/show.php');
		}
	}
}
?>
