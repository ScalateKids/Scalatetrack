<?php
// homepage
class PagesController {
	// here there will be homepage with login form
	public function home() {
		$session = KidSession::getInstance();
		if(!isset($_SESSION['logged'])) {
			$this->login();
		} else {
			$rs = Requirement::reqSources();
			$sr = Requirement::sourcesReq();
			require_once('views/pages/home.php');
		}
	}
	// redirect to error in case of bad inputs
	public function error($code) {
        $errors = array(
            0 => '',
            1 => '404 page does not exists',
            2 => 'Missing get or post parameters',
            3 => 'Maximum quota for free users reached. Free subscription users are allowed to add a maximum of 50 songs to their collection.',
			4 => 'Upload of a file that\'s not a JPG, nor a PNG or a GIF',
			5 => 'Error with file upload'
        );
        $message = $errors{$code};
		require_once('views/pages/error.php');
	}
	// redirect to login form
	public function login() {
		require_once('views/pages/login.php');
	}
	// check for login credentials and initialize session
	public function checkuser() {
		$uname = $_POST['uname'];
		$passw = $_POST['passw'];
		if($uname == 'scalatekids' && $passw == 'riccardino') {
			$session = KidSession::getInstance();
			$session->__set('logged', 1);
			header('Location:/scalatetrack');
		} else {
			$this->login();
		}
	}
	// logout
	public function logout() {
		$session = KidSession::getInstance();
		$session->destroy();
		header('Location:/scalatetrack');
	}

	public function download_tex() {
		if(!isset($_SESSION['logged'])) {
			$this->login();
		} else {
			$rs = Requirement::reqSources();
			$sr = Requirement::sourcesReq();
            $frq = Requirement::functionalRequirements();
			$tex = "\subsection{Requisiti funzionali}<br>
                    \begin{longtable}[H]{|l|p{2cm}|p{6cm}|p{2cm}|}<br>
                    \hline<br>
                    \\textbf{Requisito} & \\textbf{Tipologia} & \\textbf{Descrizione} & \\textbf{Fonti}\\\\<br>
                    \hline<br>";
            foreach($frq as $funcReq) {
                if($funcReq->getType() == 'F') {
                    $type = 'Funzionale';
                } elseif($funcReq->getType() == 'T') {
                    $type = 'Tecnologico';
                } elseif($funcReq->getType() == 'Q') {
                    $type = 'Qualitativo';
                } elseif($funcReq->getType() == 'B') {
                    $type = 'Vincolo';
                }
                $tex .= $funcReq->getCode() . " & \multiLineCell{" . $type . "\\\\" . $funcReq->getPriority() . "} & " . $funcReq->getDescription() . " & \multiLineCell{";
                foreach($funcReq->getSources() as $sources) {
                    $tex .= $sources->getName() ."\\\\";
                }
                $tex .= "}\\\\<br>
                        \hline<br>";
            }
            $tex .= "\\end{longtable}<br>";

            $tex .= "\subsection{Tracciamento Requisiti-Fonti}<br>
					\begin{longtable}[H]{|p{5cm}|p{5cm}|}<br>
					\hline<br>
					\\textbf{Requisito} & \\textbf{Fonti}\\\\<br>
					\hline<br>";
			foreach($rs as $key => $val) {
				$tex .= $key . " & \multiLineCell[t]{";
				foreach($val as $v) {
					$tex .= $v ."\\\\";
				}
				$tex .= "}\\\\<br>
						\hline<br>";
			}
			$tex .= "\\end{longtable}<br>
					\subsection{Tracciamento Fonti-Requisiti}<br>
					\begin{longtable}[H]{|p{5cm}|p{5cm}|}<br>
					\hline<br>
					\\textbf{Fonte} & \\textbf{Requisiti}\\\\<br>
					\hline<br>";
			foreach($sr as $key => $val) {
				$tex .= $key . " & \multiLineCell[t]{";
				foreach($val as $v) {
					$tex .= $v ."\\\\";
				}
				$tex .= "}\\\\<br>
						\hline<br>";
			}
			$tex .= "\\end{longtable}<br>";
			require_once('views/pages/output.php');
		}
	}
}
?>
