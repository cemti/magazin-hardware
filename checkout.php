<?php
	define('nameRegexI', '/^((?![_\d])\w){1,32}$/u');
	define('phoneRegex', '0[0-9]{8}');

	if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
		preg_match(nameRegexI, @$_POST['prenume']) &&
		preg_match('/^' . phoneRegex . '$/', @$_POST['tel']) &&
		filter_var(@$_POST['email'], FILTER_VALIDATE_EMAIL) !== false &&
		!empty(@$_POST['cart'])) {
		require 'frag/connect.php';
		
		try {
			$conn->begin_transaction();
			
			$stmt = $conn->prepare('INSERT INTO Purchasers VALUES (NULL, ?, ?, ?, ?, ?)');
			$stmt->execute([$_POST['prenume'], $_POST['tel'], $_POST['email'],
				htmlspecialchars($_POST['adr']), htmlspecialchars($_POST['comment'])]);
			
			$pID = $conn->insert_id;
			
			$stmt = $conn->prepare('INSERT INTO Transactions VALUES (NULL, ?, ?, SYSDATE())');
			$stmt1 = $conn->prepare('INSERT INTO Purchases VALUES (NULL, ?, ?)');
			
			foreach (explode(',', $_POST['cart']) as $itemQ) {
				$arr = explode(' ', $itemQ);

				$stmt->execute([$arr[1], $arr[0]]);
				
				$insertId = $conn->insert_id;
				$stmt1->execute([$insertId, $pID]);
			}
			
			$conn->commit();
			header('Location: ?success');
		}
		catch (mysqli_sql_exception) {
			$conn->rollback();
			header('Refresh: 0');
		}
		
		exit;		
	}
	
	$success = isset($_GET['success']);

	if (!$success) {
		$title = 'Plasează comanda';
		$description = 'Aici finalizați cumpărăturile.';
		$styles = ['checkout'];
		$scripts = ['checkout'];
		$readOnly = true;
	} else {
		$title = "Succes";
	}
	
	require 'frag/global.php';
?>
<main>
	<article>
<?php
	if (!$success) {
		define('nameRegex', '((?![_\d\s]).){1,32}');
?>
		<h1 id="plaseaza-comanda">Plasează comanda</h1>
		<section class="column-section">
			<form id="checkout" name="checkout" method="post">
				<h2>Completați formularul</h2>
				<p style="font-size: larger">Comanda vă costă: <strong><span class="cart-total price">0.00</span></strong>.</p>
				<fieldset>
					<legend>Date personale</legend>
					<div class="neat-div">
						<label>Prenume: <input name="prenume" pattern="<?= nameRegex ?>" placeholder="Se acceptă doar literele" required /></label>
						<label>Număr de contact: <input name="tel" type="tel" pattern="<?= phoneRegex ?>" placeholder="cifra 0 si alte 8 cifre" required /></label>
						<label>Poșta electronică: <input name="email" type="email" pattern=".{1,50}" placeholder="cemirtan.cristian@usm.md" required /></label>
					</div>
					<fieldset>
						<legend>Date de livrare</legend>
						<div class="neat-div">
							<label>Adresă de livrare: <input name="adr" placeholder="str. Alexei Mateevici 60, Chișinău" pattern=".{1,200}" required /></label>
							<label>Comentariu: <textarea name="comment" rows="6"></textarea></label>
						</div>
					</fieldset>
					<hr />
					<label style="display: block; margin-bottom: 5px"><input type="checkbox" required /> Am verificat coșul de cumpărături și doresc să plasez comanda</label>
					<button name="submit" class="accept">Expediază</button>
					<strong id="formAlert" hidden>Pentru siguranța dvs., vă rog să afișați coșul de cumpărături.</strong>
				</fieldset>
			</form>
			<div id="images" style="flex-grow: 1">
				<h2>Imaginile produselor</h2>
				<div class="showcase"></div>
			</div>
		</section>
<?php
	} else {
?>
		<h1>Succes</h1>
		<p>Comanda a fost preluată cu succes. Puteți reveni la pagina principală realizând un click <a href="/">aici</a>.</p>
<?php
	}
?>
	</article>
</main>
<?php require 'frag/footer.html'; ?>