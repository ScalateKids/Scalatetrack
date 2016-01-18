<?php
class UsecasesController {
	public function index() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			$usecases = UseCase::all();
			require_once('views/usecases/index.php');
		}
	}
	public function show() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			if(!isset($_GET['code'])) {
				return call('pages', 'error', 2);
			}
			$uc = UseCase::get($_GET['code']);
			$children = UseCase::getChildren($_GET['code']);
			require_once('views/usecases/show.php');
		}
	}
	public function add() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			$usecases = UseCase::all();
			require_once('views/usecases/add.php');
		}
	}
	public function save() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			$post_data = $_POST;
			$usecases = UseCase::add($post_data);
			$uploadDir = "uploads/uml/";
			$targetFile = $uploadDir . 'usecases/' . $post_data['code'] . '-' . $post_data['title'] . '.jpg';
			$uploadOk = 1;
			$imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);
			$check = getimagesize($_FILES["image"] ["tmp_name"]);
			if($check !== false) {
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
					$uploadOk = 0;
					return call('pages', 'error', 4);
				} else {
					$uploadOk = 1;
				}
			} else {
				$uploadOk = 0;
				return call('pages', 'error', 4);
			}
			if($uploadOk == 0) {
				return call('pages', 'error', 5);
			} else {
				if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
					chmod($targetFile, 0755);
					return call('usecases', 'index');
				} else {
					return call('pages', 'error', 5);
				}
			}
			return call('usecases', 'index');
		}
	}
	public function alter() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			if(!isset($_GET['code'])) {
				return call('pages', 'error', 2);
			}
			$usecases = UseCase::all();
			$uc = UseCase::get($_GET['code']);
			require_once('views/usecases/alter.php');
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
			UseCase::save($post_data, $_GET['code']);
			$uploadDir = "uploads/uml/";
			$targetFile = $uploadDir . 'usecases/' . $post_data['code'] . '-' . $post_data['title'] . '.jpg';
			$uploadOk = 1;
			$imageFileType = pathinfo($targetFile, PATHINFO_EXTENSION);
			$check = getimagesize($_FILES["image"] ["tmp_name"]);
			if($check !== false) {
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
					$uploadOk = 0;
					return call('pages', 'error', 4);
				} else {
					$uploadOk = 1;
				}
			} else {
				$uploadOk = 0;
				return call('pages', 'error', 4);
			}
			if($uploadOk == 0) {
				return call('pages', 'error', 5);
			} else {
				if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
					chmod($targetFile, 0755);
					return call('usecases', 'index');
				} else {
					return call('pages', 'error', 5);
				}
			}
			return call('usecases', 'index');
		}
	}
	public function remove() {
		if(!isset($_SESSION['logged'])) {
			return call('pages', 'home');
		} else {
			if(!isset($_GET['code'])) {
				return call('pages', 'error', 2);
			}
			UseCase::remove($_GET['code']);
			return call('usecases', 'index');
		}
	}
}
?>
