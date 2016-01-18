<?php
class User {

	private $username;
	private $password;

	public function __construct($username, $password) {
		$this->username = $username;
		$this->password = $password;
	}

	public function username() {
		return $this->username;
	}

    public function password() {
        return $this->password;
    }

	// check if the user exists and return it by given credentials
	public static function checkuser($uname, $passw) {
		if($uname == 'scalatekids' && $passw == 'riccardino') {
			return new User($uname, $passw);
		} else return -1;
	}
	// return a complete user by a given id
	public static function find($id) {
		$db = Db::getInstance();
		$req = $db->prepare('SELECT u.*, l.Username, l.Password FROM Utenti u INNER JOIN Login l ON(u.IdUtente = l.IdUtente) WHERE u.IdUtente = :id');
		$req->execute(array('id' => $id));
		$u = $req->fetch();
		return new User($u['IdUtente'], $u['Nome'], $u['Cognome'], $u['Email'], $u['Username'], $u['Password']);
	}
    // retrieve a user based on username
    public static function findByUsername($uname) {
        $db = Db::getInstance();
        $uname = addslashes($uname);
        $req = $db->prepare('SELECT u.*, l.Username, l.Password FROM Utenti u INNER JOIN Login l ON(u.IdUtente = l.IdUtente) WHERE l.Username = :uname');
		$req->execute(array('uname' => $uname));
		$u = $req->fetch();
        return new User($u['IdUtente'], $u['Nome'], $u['Cognome'], $u['Email'], $u['Username'], $u['Password']);
    }
}
?>
