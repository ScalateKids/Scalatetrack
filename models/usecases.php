<?php
class UseCase {
	private $code;
	private $title;
	private $description;
	private $actor;
	private $parent;
	private $pre;
	private $post;
	private $imPath;

	public function __construct($code, $title, $description, $actor, $parent, $pre, $post, $imPath) {
		$this->code = $code;
		$this->title = $title;
		$this->description = $description;
		$this->actor = $actor;
		$this->parent = $parent;
		$this->pre = $pre;
		$this->post = $post;
		$this->imPath = $imPath;
	}

	public function getCode() {
		return $this->code;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getParent() {
		return $this->parent;
	}

	public function getActor() {
		return $this->actor;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getPre() {
		return $this->pre;
	}

	public function getPost() {
		return $this->post;
	}

	public function getImagePath() {
		return $this->imPath;
	}

	// get all requirements
	public static function all() {
		$list = array();
		$db = Db::getInstance();
		$req = $db->query('SELECT * FROM useCases');
		foreach($req->fetchAll() as $uc) {
			$p = $db->prepare('SELECT * FROM images WHERE `image_code` = :ic');
			$p->execute(array('ic' => $uc['code']));
			$image = $p->fetch();
			$list[] = new UseCase($uc['code'], $uc['title'], $uc['description'], $uc['actor'], $uc['parent'], $uc['precondition'], $uc['postcondition'], $image['path']);
		}
		return $list;
	}

	public static function add($newUseCase) {
		if(!isset($newUseCase['parent'])) {
			$newUseCase['parent'] = 'null';
		}
		$db = Db::getInstance();
        $req = $db->prepare('INSERT INTO useCases (`code`, `title`, `actor`, `parent`, `description`, `precondition`, `postcondition`) VALUES(:code, :title, :actor, :parent, :description, :precondition, :postcondition)');
        $req->execute(array('code' => strtoupper($newUseCase['code']), 'title' => $newUseCase['title'], 'actor' => $newUseCase['actor'], 'postcondition' => $newUseCase['postcondition'],
							'parent' => $newUseCase['parent'], 'precondition' => $newUseCase['precondition'], 'description' => $newUseCase['description']));
		$req = $db->prepare('UPDATE images SET `path` = :pth WHERE `image_code` = :ic');
		$req->execute(array('ic' => strtoupper($newUseCase['code']), 'pth' => 'usecases/'.$newUseCase['code'].'-'.$newUseCase['title'].'.jpg'));
	}

	public static function save($newUseCase, $code) {
		if(!isset($newUseCase['parent'])) {
			$newUseCase['parent'] = 'null';
		}
		$db = Db::getInstance();
        $req = $db->prepare('UPDATE useCases SET `code` = :code, `title` = :title, `actor` = :actor, `parent` = :parent, `description` = :description, `precondition` = :precondition, `postcondition` = :postcondition WHERE `code` = :id');
        $req->execute(array('code' => strtoupper($newUseCase['code']), 'title' => $newUseCase['title'], 'actor' => $newUseCase['actor'], 'postcondition' => $newUseCase['postcondition'],
							'parent' => $newUseCase['parent'], 'precondition' => $newUseCase['precondition'], 'description' => $newUseCase['description'], 'id' => $code));
		$req = $db->prepare('UPDATE images  SET `image_code` = :ic, `path` = :pth');
		$req->execute(array('ic' => strtoupper($newUseCase['code']), 'pth' => 'usecases/'.$newUseCase['code'].'-'.$newUseCase['title'].'.jpg'));
	}

	public static function get($code) {
		$db = Db::getInstance();
		$req = $db->prepare('SELECT * FROM useCases WHERE `code` = :code');
		$req->execute(array('code' => $code));
		$uc = $req->fetch();
		$p = $db->prepare('SELECT * FROM images WHERE `image_code` = :ic');
		$p->execute(array('ic' => $uc['code']));
		$image = $p->fetch();
		return new UseCase($uc['code'], $uc['title'], $uc['description'], $uc['actor'], $uc['parent'], $uc['precondition'], $uc['postcondition'], $image['path']);
	}

	public static function getChildren($code) {
		$list = array();
		$db = Db::getInstance();
		$req = $db->prepare('SELECT * FROM useCases WHERE `parent` = :code');
		$req->execute(array('code' => $code));
		foreach($req->fetchAll() as $child) {
			$p = $db->prepare('SELECT * FROM images WHERE `image_code` = :ic');
			$p->execute(array('ic' => $child['code']));
			$image = $p->fetch();
			$list[] = new UseCase($child['code'], $child['title'], $child['description'], $child['actor'], $child['parent'], $child['precondition'], $child['postcondition'], $image['path']);
		}
		return $list;
	}

	public static function remove($delUseCase) {
		$db = Db::getInstance();
        $req = $db->prepare('DELETE FROM useCases WHERE `code` = :code OR `parent` = :code');
        $req->execute(array('code' => $delUseCase));
	}
}
?>
