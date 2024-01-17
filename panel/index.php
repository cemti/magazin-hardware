<?php
	session_start();

	if (isset($_GET['logoff'])) {
		session_destroy();
		header('Location: /');
		exit;
	}
	
	if (!isset($_SESSION['user'])) {
		if (!isset($_GET['login'])) {
			header('Location: signup.php');
			exit;
		}
		
		if (isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
			require '../frag/connect.php';
			$stmt = $conn->prepare('SELECT Privilege FROM EndUsers WHERE Name = ? AND Password = SHA1(?)');
			$stmt->execute([$_SERVER['PHP_AUTH_USER'], salted($_SERVER['PHP_AUTH_PW'], $_SERVER['PHP_AUTH_USER'])]);
			$row = $stmt->get_result()->fetch_row();
			
			if (isset($row)) {
				$_SESSION['user'] = $_SERVER['PHP_AUTH_USER'];
				$_SESSION['privilege'] = $row[0];
				http_response_code(401);
				header('Refresh: 0');
				echo ' ';
				exit;
			}
		}

		header('WWW-Authenticate: basic realm="Acces intern"');
		header('Refresh: 0;url=signup.php');
		echo ' ';
		exit;
	}
	
	if (isset($_GET['get'])) {
		require '../frag/connect.php';
		header('Content-Type: application/json');
		echo $conn->query(sprintf('SELECT JSON FROM EndUsers WHERE Name = \'%s\'', $conn->real_escape_string($_SESSION['user'])))->fetch_row()[0];
		exit;
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['CONTENT_TYPE'] == 'application/json') {
		require '../frag/connect.php';
		$json = file_get_contents('php://input');
		$conn->prepare('UPDATE EndUsers SET JSON = ? WHERE Name = ?')->execute([$json == '{}' ? null : $json, $_SESSION['user']]);
		exit;
	}
	
	$title = 'Acces intern';
	require '../frag/global.php';
?>
<main>
	<article>
	<h1>Meniu</h1>
	<form><button name="logoff">Delogare</button></form>
<?php
		if (isset($_SESSION['privilege'])) {
?>
	<ul>
		<li><a href="users.php">Utilizatori</a></li>
		<?php if ($_SESSION['privilege'] >= 1) {?><li><a href="products.php">Produse</a></li><?php }?>
		<?php if ($_SESSION['privilege'] >= 0) {?><li><a href="transactions.php">Tranzacții</a></li><?php }?>
		<li><a href="#" onclick="loadCart();">Recuperă coșul de cumpărături</a></li>
		<li><a href="#" onclick="saveCart();">Salvează coșul de cumpărături</a></li>
	</ul>
<?php
		}
?>
	</article>
</main>
<?php require '../frag/footer.html'; ?>