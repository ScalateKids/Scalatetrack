<?php
class SourcesController {
	public function index() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			$sources = Sources::all();
			require_once('views/sources/index.php');
		}
	}

	public function add() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			require_once('views/sources/add.php');
		}
	}

	public function save() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			$post_data = $_POST;
			Sources::add($post_data);
			return call('sources', 'index');
		}
	}

	public function save_edit() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			if(!isset($_GET['name'])) {
				return call('pages', 'error', 2);
			}
			$post_data = $_POST;
			Sources::save($post_data, $_GET['name']);
			return call('sources', 'index');
		}
	}

	public function remove() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			if(!isset($_GET['name'])) {
				return call('pages', 'error', 2);
			}
			Sources::remove($_GET['name']);
			return call('sources', 'index');
		}
	}

	public function alter() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			if(!isset($_GET['name'])) {
				return call('pages', 'error', 2);
			}
			$source = Sources::get($_GET['name']);
			require_once('views/sources/alter.php');
		}
	}
}
?>
