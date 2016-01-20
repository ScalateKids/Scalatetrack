<?php
require_once('sources.php');
class Requirement {

	private $code;
	private $priority;
	private $type;
	private $satisfied;
	private $description;
	private $sources;

	public function __construct($code, $priority, $type, $satisfied, $description, $sources) {
		$this->code = $code;
		$this->priority = $priority;
		$this->type = $type;
		$this->satisfied = $satisfied;
		$this->description = $description;
		$this->sources = $sources;
	}

	public function getCode() {
		return $this->code;
	}

	public function getPriority() {
		return $this->priority;
	}

	public function getType() {
		return $this->type;
	}

	public function getSatisfied() {
		return $this->satisfied;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getSources() {
		return $this->sources;
	}

	// get all requirements
	public static function all() {
		$list = array();
		$db = Db::getInstance();
		$req = $db->query('SELECT * FROM requirements');
		foreach($req->fetchAll() as $reqs) {
			$src = array();
			$r = $db->prepare('SELECT s.* FROM sources s INNER JOIN sourceRequirements sr ON(s.name = sr.source_name) WHERE sr.requirement_code = :rcode');
			$r->execute(array('rcode' => $reqs['code']));
			foreach($r->fetchAll() as $s) {
				$src[] = new Sources($s['name']);
			}
			$list[] = new Requirement($reqs['code'], $reqs['priority'], $reqs['type'], $reqs['satisfied'], $reqs['description'], $src);
		}
		return $list;
	}

	public static function add($newRequirement) {
		if(!isset($newRequirement['satisfied'])) {
			$newRequirement['satisfied'] = 'No';
		}
		$db = Db::getInstance();
        $req = $db->prepare('INSERT INTO requirements (`code`, `priority`, `type`, `satisfied`, `description`) VALUES(:code, :priority, :type, :satisfied, :description)');
        $req->execute(array('code' => strtoupper($newRequirement['code']), 'priority' => $newRequirement['priority'],
							'type' => $newRequirement['type'], 'satisfied' => $newRequirement['satisfied'], 'description' => $newRequirement['description']));
		if(isset($newRequirement['sources']) && !empty($newRequirement['sources'])) {
			foreach($newRequirement['sources'] as $source) {
				$add = $db->prepare('INSERT INTO sourceRequirements (`source_name`, `requirement_code`) VALUES(:sn, :rc)');
				$add->execute(array('rc' => strtoupper($newRequirement['code']), 'sn' => $source));
			}
		}
	}

	public static function save($newRequirement, $code) {
		if(!isset($newRequirement['satisfied'])) {
			$newRequirement['satisfied'] = 'No';
		}
		$db = Db::getInstance();
        $req = $db->prepare('UPDATE requirements SET `code` = :code, `priority` = :priority, `type` = :type, `satisfied` = :satisfied, `description` = :description WHERE `code` = :id');
        $req->execute(array('code' => strtoupper($newRequirement['code']), 'priority' => $newRequirement['priority'],
							'type' => $newRequirement['type'], 'satisfied' => $newRequirement['satisfied'], 'description' => $newRequirement['description'], 'id' => $code));
		if(isset($newRequirement['sources']) && !empty($newRequirement['sources'])) {
			$rm = $db->prepare('DELETE FROM sourceRequirements WHERE `requirement_code` = :rc');
			$rm->execute(array('rc' => $newRequirement['code']));
			foreach($newRequirement['sources'] as $source) {
				$add = $db->prepare('INSERT INTO sourceRequirements (`source_name`, `requirement_code`) VALUES(:sn, :rc)');
				$add->execute(array('rc' => strtoupper($newRequirement['code']), 'sn' => $source));
			}
		}
	}

	public static function get($code) {
		$db = Db::getInstance();
		$req = $db->prepare('SELECT * FROM requirements WHERE `code` = :code');
		$req->execute(array('code' => $code));
		$requirement = $req->fetch();
		$src = array();
		$r = $db->prepare('SELECT s.* FROM sources s INNER JOIN sourceRequirements sr ON(s.name = sr.source_name) WHERE sr.requirement_code = :rcode');
		$r->execute(array('rcode' => $code));
		foreach($r->fetchAll() as $s) {
			$src[] = new Sources($s['name']);
		}
		return new Requirement($requirement['code'], $requirement['priority'], $requirement['type'], $requirement['satisfied'], $requirement['description'], $src);
	}

	public static function remove($delRequirement) {
		$db = Db::getInstance();
        $req = $db->prepare('DELETE FROM requirements WHERE `code` = :code');
        $req->execute(array('code' => $delRequirement));
	}

    public static function functionalRequirements() {
        $db = Db::getInstance();
        $list = array();
        $req = $db->query('SELECT DISTINCT * FROM requirements');
        foreach($req->fetchAll() as $rq) {
            $src = array();
		    $r = $db->prepare('SELECT s.* FROM sources s INNER JOIN sourceRequirements sr ON(s.name = sr.source_name) WHERE sr.requirement_code = :rcode');
		    $r->execute(array('rcode' => $rq['code']));
		    foreach($r->fetchAll() as $s) {
			    $src[] = new Sources($s['name']);
		    }
            $obj = new Requirement($rq['code'], $rq['priority'], $rq['type'], $rq['satisfied'], $rq['description'], $src);
            $list[] = $obj;
        }
        return $list;
    }

	public static function reqSources() {
		$db = Db::getInstance();
		$list = array();
		$req = $db->query('SELECT DISTINCT requirement_code FROM sourceRequirements');
		foreach($req->fetchAll() as $rq) {
			$src = $db->prepare('SELECT source_name FROM sourceRequirements WHERE `requirement_code` = :rq');
			$src->execute(array('rq' => $rq['requirement_code']));
			$l = array();
			foreach($src->fetchAll() as $s) {
				$l[] = $s['source_name'];
			}
			$list[$rq['requirement_code']] = $l;
		}
		return $list;
	}

	public static function sourcesReq() {
		$db = Db::getInstance();
		$list = array();
		$req = $db->query('SELECT DISTINCT source_name FROM sourceRequirements');
		foreach($req->fetchAll() as $rq) {
			$src = $db->prepare('SELECT requirement_code FROM sourceRequirements WHERE `source_name` = :rq');
			$src->execute(array('rq' => $rq['source_name']));
			$l = array();
			foreach($src->fetchAll() as $s) {
				$l[] = $s['requirement_code'];
			}
			$list[$rq['source_name']] = $l;
		}
		return $list;
	}
}
?>
