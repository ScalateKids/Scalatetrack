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
                    \begin{table}[H]<br>
                    \centering<br>
                    \caption{Tabella requisiti funzionali}<br>
                    \begin{tabular}{|c|c|c|c|}<br>
                    \hline<br>
                    \\textbf{Requisito} & \\textbf{Tipologia} & \\textbf{Descrizione} & \\textbf{Fonti}\\\\<br>
                    \hline<br>";
            foreach($frq as $funcReq) {
                $tex .= $funcReq->getCode() . " & \multiLineCell{" . $funcReq->getType() . "\\\\" . $funcReq->getPriority() . "} & " . $funcReq->getDescription() . " & \multiLineCell{";
                foreach($funcReq->getSources() as $sources) {
                    $tex .= $sources['name'] ."\\\\";
                }
                $tex .= "}\\\\<br>
                        \hline<br>";
            }

            $tex .= "\subsection{Tracciamento Requisiti-Fonti}<br>
					\begin{table}[H]<br>
					\centering<br>
					\caption{Tabella Requisiti-Fonti}<br>
					\begin{tabular}{|c|c|}<br>
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
			$tex .= "\\end{tabular}<br>
					\\end{table}<br>
					\subsection{Tracciamento Fonti-Requisiti}<br>
					\begin{table}[H]<br>
					\centering<br>
					\caption{Tabella Fonti-Requisiti}<br>
					\begin{tabular}{|c|c|}<br>
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
			$tex .= "\\end{tabular}<br>
					\\end{table}<br>";
			require_once('views/pages/output.php');
		}
	}
}
?>
