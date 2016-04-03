<!DOCTYPE html>
<?php KidSession::getInstance(); ?>
<html>
<head>
<meta charset='utf-8'>
<title>Scalatetrack</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<img src="img/scalatekidsLogocs.png" alt="">
		<h1>ScalateTrack</h1>
	</header>
	<div class="content">
		<nav>
			<ul>
				<li <?php if($_SERVER['REQUEST_URI'] == '/scalatetrack') { echo 'class="active"'; }?>>
					<a href='/scalatetrack'><img src="img/scalatekidsLogocs.png" alt=""> Home</a>
				</li>
				<?php if(isset($_SESSION['logged'])) { ?>
				<li <?php if(preg_match('/\/\?controller=requirements/i', $_SERVER['REQUEST_URI'])) { echo 'class="active"'; }?>>
					<a href='?controller=requirements&action=index'><img src="img/scalatekidsLogocs.png" alt=""> Requirements</a>
				</li>
                <li <?php if(preg_match('/\/\?controller=components/i', $_SERVER['REQUEST_URI'])) { echo 'class="active"'; }?>>
					<a href='?controller=components&action=index'><img src="img/scalatekidsLogocs.png" alt=""> Components</a>
				</li>
				<li <?php if(preg_match('/\/\?controller=usecases/i', $_SERVER['REQUEST_URI'])) { echo 'class="active"'; }?>>
					<a href='?controller=usecases&action=index'><img src="img/scalatekidsLogocs.png" alt=""> Use Cases</a>
				</li>
				<li <?php if(preg_match('/\/\?controller=sources/i', $_SERVER['REQUEST_URI'])) { echo 'class="active"'; }?>>
					<a href='?controller=sources&action=index'><img src="img/scalatekidsLogocs.png" alt=""> Sources</a>
				</li>
				<?php }?>
			</ul>
		</nav>
		<div class="logout">
                <a href="?controller=pages&action=logout"><button class="exit">Logout &#10144;</button></a>
        </div>
		<main>
		    <?php require_once('routes.php') ?>
		</main>
	</div>
	<footer>
		ScalateKids - Use cases & requirements tracker
	</footer>
</body>
</html>
