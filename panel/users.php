<?php
	session_start();
	
	if (!isset($_SESSION['privilege'])) {
		header('Location: .');
		exit;
	}
	
	define('isAdmin', $_SESSION['privilege'] >= 2);
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['createupdate'])) {
			if (isAdmin) {
				if (@strlen($_POST['user']) > 0) {
					require '../frag/connect.php';
					$conn->prepare('CALL add_update_enduser(?, SHA1(?), ?)')->execute([
						$_POST['user'], strlen($_POST['password']) > 0 ? salted($_POST['password'], $_POST['user']) : null,
						$_SESSION['user'] !== $_POST['user'] ? $_POST['privilege'] : $_SESSION['privilege']]);
				}
			}
			else {
				require '../frag/connect.php';
				$conn->prepare('UPDATE EndUsers SET Password = COALESCE(SHA1(?), Password) WHERE Name = ?')->execute([
					strlen($_POST['password']) > 0 ? salted($_POST['password'], $_SESSION['user']) : null, $_SESSION['user']]);
			}
		}
		elseif (isset($_POST['delete'])) {
			if (isAdmin) {
				$delSelf = $_POST['user'] === $_SESSION['user'];
			}
			else {
				$_POST['user'] = $_SESSION['user'];
				$delSelf = true;
			}
			
			require '../frag/connect.php';
			
			if ($conn->query('SELECT COUNT(*) FROM EndUsers')->fetch_row()[0] > 1) {
				$conn->prepare('DELETE FROM EndUsers WHERE Name = ?')->execute([$_POST['user']]);
				
				if ($delSelf) {
					header('Location: .?logoff');
					exit;
				}
			}
		}
		
		header('Refresh: 0');
		exit;
	}
	
	$title = 'Acces intern';
	require '../frag/global.php';
?>
<main>
	<article>
		<h1>Utilizatori</h1>
		<a href="/panel">Înapoi</a>
		<section class="column-section" data-basic>
			<form method="post">
				<h2><?= isAdmin ? 'Adaugă/modifică un utilizator' : 'Modifică parola' ?></h2>
				<div class="neat-div">
<?php
	if (isAdmin) {
?>
					<label>Username: <input name="user" required /></label>
<?php
	}
	else {
?>
					<label>Username: <input value="<?= $_SESSION['user'] ?>" readonly /></label>
<?php
	}
?>
					<label>Password: <input name="password" type="password" placeholder="Nemodificat" /></label>
<?php
	if (isAdmin) {
?>
					<label>Privilegiu:
						<select name="privilege">
							<option value="-1">Client</option>
							<option value="0">Secretar</option>
							<option value="1">Vânzător</option>
							<option value="2">Administrator</option>
						</select>
					</label>
<?php
	}
?>
				</div>
				<button name="createupdate">Expediază</button>
			</form>
			<form method="post">
				<h2><?= isAdmin ? 'Șterge un utilizator' : 'Șterge contul' ?></h2>
				<div class="neatDiv">
<?php
	if (isAdmin) {
?>
					<label>Username:
						<select name="user">
<?php
	require '../frag/connect.php';
	$result = $conn->query('SELECT ' . (isAdmin ? 'Name FROM EndUsers' : '\'' . $conn->real_escape_string($_SESSION['user']) . '\''));

	while ($row = $result->fetch_row()) {
?>
							<option><?= htmlspecialchars($row[0]) ?></option>
<?php
	}
	
	$result->close();
	$conn->close();
?>
						</select>
					</label>
<?php
	}
?>
				</div>
				<button name="delete">Șterge</button>
			</form>
		</section>
	</article>
</main>
<?php require '../frag/footer.html'; ?>