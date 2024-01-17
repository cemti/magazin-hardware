<?php
	session_start();

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!isset($_POST['user'], $_POST['password'], $_POST['captcha']) ||
			strlen($_POST['user']) == 0 || strlen($_POST['password']) == 0) {
			header('Location: ?info=0');
			exit;
		}
		
		if ($_POST['password'] !== @$_POST['password2']) {
			header('Location: ?info=1');
			exit;
		}
		
		if ($_POST['captcha'] !== $_SESSION['captcha']->Vendor) {
			header('Location: ?info=2');
			exit;
		}
		
		unset($_SESSION['captcha']);
		
		if (!preg_match('/.{8}/', $_POST['password'])) {
			header('Location: ?info=4');
			exit;
		}
		
		require '../frag/connect.php';
		
		if ($conn->query(sprintf('SELECT NULL FROM EndUsers WHERE Name = \'%s\'', $conn->real_escape_string($_POST['user'])))->num_rows > 0) {
			header('Location: ?info=3');
			exit;
		}
		
		try {
			$conn->prepare('INSERT INTO EndUsers VALUES (?, SHA1(?), -1, NULL)')->execute([$_POST['user'], salted($_POST['password'], $_POST['user'])]);
		}
		catch (mysqli_sql_exception) {
			header('Location: ?info=5');
			exit;
		}
		
		$_SESSION['user'] = $_POST['user'];
		$_SESSION['privilege'] = -1;
		header('Location: .');
		exit;
	}
	
	$title = 'Acces intern';
	require '../frag/global.php';
?>
<main>
	<article>
		<h1>Înregistrare</h1>
		<a href=".?login">Deja aveți cont?</a>
		<section class="column-section" data-basic>
			<form method="post">
				<div class="neat-div">
					<label>Denumire: <input name="user" required /></label>
					<label>Parola: <input name="password" type="password" required /></label>
					<label>Confirmă parola: <input name="password2" type="password" required /></label>
<?php
	require '../frag/connect.php';
	if (!isset($_SESSION['captcha'])) {
		$_SESSION['captcha'] = $conn->query('SELECT Vendor, Name FROM Products WHERE Category = 0 ORDER BY RAND() LIMIT 1')->fetch_object();
		$conn->close();
	}
?>					
					<label>Producătorul <?= $_SESSION['captcha']->Name ?>: <input name="captcha" required /></label>
				</div>
				<button>Expediază</button>
				<style>
#info:empty {
	display: none;
}
				</style>
<?php
	define('infos', [
		'Câmpurile să fie completate.',
		'Parolele nu coincid.',
		'Captcha completat invalid.',
		'Denumirea utilizatorului deja există.',
		'Parola conține mai puțin de 8 simboluri.',
		'Încercați mai târziu.'
	]);
?>				
				<p id="info"><?= @infos[$_GET['info']] ?></p>
			</form>
		</section>
	</article>
</main>
<?php require '../frag/footer.html'; ?>