<?php
class Component {

    private $name;
    private $requirements;

    public function __construct($name, $requirements) {
        $this->name = $name;
        $this->requirements = $requirements;
    }

    public function getName() {
        return $this->name;
    }

    public function getRequirements() {
        return $this->requirements;
    }

    // get all components
    public static function all() {
        $list = array();
        $db = Db::getInstance();
        $com = $db->query('SELECT * FROM components');
        foreach($com->fetchAll() as $coms) {
            $requirements = array();
            $r = $db->prepare('SELECT r.* FROM requirements r INNER JOIN requirementComponents rc ON(r.code = rc.requirement_code) WHERE rc.component_name = :cname');
            $r->execute(array('cname' => $coms['name']));
            foreach($r->fetchAll() as $s) {
                $requirements[] = new Requirement($s['code'], $s['priority'], $s['type'], $s['satisfied'], $s['description'], []);
            }
            $list[] = new Component($coms['name'], $requirements);
        }
        return $list;
    }

    public static function add($newComponent) {
        $db = Db::getInstance();
        $com = $db->prepare('INSERT INTO components (`name`) VALUES(:name)');
        $com->execute(array('name' => $newComponent['name']));
        if(isset($newComponent['requirements']) && !empty($newComponent['requirements'])) {
            foreach($newComponent['requirements'] as $requirement) {
                $add = $db->prepare('INSERT INTO requirementComponents (`component_name`, `requirement_code`) VALUES(:cn, :rc)');
                $add->execute(array('cn' => $newComponent['name'], 'rc' => $requirement));
            }
        }
    }

    public static function save($newComponent, $code) {
        $db = Db::getInstance();
        $req = $db->prepare('UPDATE components SET `name` = :name WHERE `name` = :id');
        $req->execute(array('name' => $newComponent['name'], 'id' => $code));
        if(isset($newComponent['requirements']) && !empty($newComponent['requirements'])) {
            $rm = $db->prepare('DELETE FROM requirementComponents WHERE `component_name` = :rc');
            $rm->execute(array('rc' => $newComponent['name']));
            foreach($newComponent['requirements'] as $requirement) {
                $add = $db->prepare('INSERT INTO requirementComponents (`component_name`, `requirement_code`) VALUES(:sn, :rc)');
                $add->execute(array('sn' => $newComponent['name'], 'rc' => $requirement));
            }
        }
    }

    public static function get($code) {
        $db = Db::getInstance();
        $req = $db->prepare('SELECT * FROM components WHERE `name` = :name');
        $req->execute(array('name' => $code));
        $component = $req->fetch();
        $requirements = array();
        $r = $db->prepare('SELECT s.* FROM requirements s INNER JOIN requirementComponents sr ON(s.code = sr.requirement_code) WHERE sr.component_name = :rcode');
        $r->execute(array('rcode' => $code));
        foreach($r->fetchAll() as $s) {
            $requirements[] = new Requirement($s['code'], $s['priority'], $s['type'], $s['satisfied'], $s['description'], []);
        }
        return new Component($component['name'], $requirements);
    }

    public static function remove($delComponent) {
        $db = Db::getInstance();
        $req = $db->prepare('DELETE FROM components WHERE `name` = :name');
        $req->execute(array('name' => $delComponent));
    }

    public static function comRequirements() {
        $db = Db::getInstance();
        $list = array();
        $req = $db->query('SELECT DISTINCT component_name FROM requirementComponents');
        foreach($req->fetchAll() as $rq) {
            $src = $db->prepare('SELECT requirement_code FROM requirementComponents WHERE `component_name` = :rq');
            $src->execute(array('rq' => $rq['component_name']));
            $l = array();
            foreach($src->fetchAll() as $s) {
                $l[] = $s['requirement_code'];
            }
            $list[$rq['component_name']] = $l;
        }
        return $list;
    }

    public static function requirementsCom() {
        $db = Db::getInstance();
        $list = array();
        $req = $db->query('SELECT DISTINCT requirement_code FROM requirementComponents');
        foreach($req->fetchAll() as $rq) {
            $src = $db->prepare('SELECT component_name  FROM sourceRequirements WHERE `requirement_code` = :rq');
            $src->execute(array('rq' => $rq['requirement_code']));
            $l = array();
            foreach($src->fetchAll() as $s) {
                $l[] = $s['component_name'];
            }
            $list[$rq['requirement_code']] = $l;
        }
        return $list;
    }
}
?>
