<?php
class ComponentsController {
    public function index() {
        if(!isset($_SESSION['logged'])) {
            return call('pages', 'home');
        } else {
            $components = Component::all();
            sort($components);
            require_once('views/components/index.php');
        }
    }
    public function add() {
        if(!isset($_SESSION['logged'])) {
            return call('pages', 'home');
        } else {
            $requirements = Requirement::all();
            require_once('views/components/add.php');
        }
    }
    public function save() {
        if(!isset($_SESSION['logged'])) {
            return call('pages', 'home');
        } else {
            $post_data = $_POST;
            Component::add($post_data);
            return call('components', 'index');
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
            Component::save($post_data, $_GET['code']);
            return call('components', 'index');
        }
    }
    public function remove() {
        if(!isset($_SESSION['logged'])) {
            return call('pages', 'home');
        } else {
            if(!isset($_GET['code'])) {
                return call('pages', 'error', 2);
            }
            Component::remove($_GET['code']);
            return call('components', 'index');
        }
    }
    public function alter() {
        if(!isset($_SESSION['logged'])) {
            return call('pages', 'home');
        } else {
            if(!isset($_GET['code'])) {
                return call('pages', 'error', 2);
            }
            $requirements = Requirement::all();
            $component = Component::get($_GET['code']);
            require_once('views/components/alter.php');
        }
    }
    public function show() {
        if(!isset($_SESSION['logged'])) {
            return call('pages', 'home');
        } else {
            require_once('views/components/show.php');
        }
    }
}
?>
