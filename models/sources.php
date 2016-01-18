<?php
class Sources {

	private $name;

	public function __construct($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}
	// get all sources
	public static function all() {
		$list = array();
		$db = Db::getInstance();
		$req = $db->query('SELECT * FROM sources');
		foreach($req->fetchAll() as $sources) {
			$list[] = new Sources($sources['name']);
		}
		return $list;
	}

	public static function add($newSource) {
		$db = Db::getInstance();
        $req = $db->prepare('INSERT INTO sources (`name`) VALUES(:name)');
        $req->execute(array('name' => strtoupper($newSource['name'])));
	}

	public static function remove($delSource) {
		$db = Db::getInstance();
        $req = $db->prepare('DELETE FROM sources WHERE `name` = :name');
        $req->execute(array('name' => $delSource));
	}


	public static function get($name) {
		$db = Db::getInstance();
		$req = $db->prepare('SELECT * FROM sources WHERE `name` = :name');
		$req->execute(array('name' => $name));
		$s = $req->fetch();
		return new Sources($s['name']);
	}

	public static function save($newSource, $name) {
		$db = Db::getInstance();
        $req = $db->prepare('UPDATE sources SET `name` = :name WHERE `name` = :n');
        $req->execute(array('name' => strtoupper($newSource['name']), 'n' => $name));
	}
}
?>
