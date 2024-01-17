<?php
	session_start();
	
	if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 0) {
		header('Location: .');
		exit;
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require '../frag/connect.php';
		$conn->query('INSERT INTO ProcessedPurchasers VALUES ' . implode(',', array_map(function ($x) { return "($x)"; }, $_POST['id'])));
		header('Refresh: 0');
		exit;
	}
	
	$title = 'Acces intern';
	require '../frag/global.php';
?>
<main>
	<article>
		<h1>Tranzacții</h1>
		<a href="/panel">Meniu</a>
		<form method="post">
			<table border rules="all">
				<thead>
					<tr>
						<th>ID</th>
						<th>Prenume</th>
						<th>Telefon</th>
						<th>Email</th>
						<th>Adresa de livrare</th>
						<th>Comentarii</th>
					</tr>
				</thead>
				<tbody>
<?php
	require '../frag/connect.php';
	
	$result = $conn->query('SELECT * FROM Purchasers A LEFT JOIN ProcessedPurchasers B ON A.ID = B.PID');

	while ($o = $result->fetch_object()) {
?>
					<tr>
						<td><?php if (isset($o->PID)) { ?><input type="checkbox" disabled checked /><?php
						} else { ?><input type="checkbox" name="id[]" value="<?= $o->ID ?>" /><?php } echo $o->ID; ?></td>
						<td><?= $o->Name ?></td>
						<td><a href="tel:<?= $o->Phone ?>"><?= $o->Phone ?></a></td>
						<td><a href="mailto:<?= $o->Email ?>"><?= $o->Email ?></a></td>
						<td><?= $o->Address ?></td>
						<td><?= empty($o->Comments) ? '<i>nimic</i>' : $o->Comments ?></td>
					</tr>
					<tr style="border-bottom: 2px black dashed">
						<td colspan="6">
							<table style="width: 100%" border rules="all">
								<thead>
									<th>Data</th>
									<th>Produs</th>
									<th>Cantitate</th>
									<th>Pret/unitate</th>
									<th>Total (MDL)</th>
								</thead>
								<tbody>
<?php
		$result1 = $conn->query('SELECT Date, Name, Quantity, Price, Quantity * Price Total
FROM Purchases A INNER JOIN Transactions B ON A.TransactionID = B.ID
INNER JOIN Products C ON B.ProductID = C.ID
WHERE PurchaserID = ' . $o->ID);
		$sum = 0;
	
		while ($assoc = $result1->fetch_assoc()) {
?>
									<tr>
<?php
			foreach ($assoc as $key => $cell) {
?>
										<td><?php if ($key == 'Total') { $sum += $cell; } echo $cell ?></td>
<?php
			}
?>
									</tr>
<?php
		}
?>
								</tbody>
							</table>
							<div style="text-align: right; font-weight: bold">Total: <?= $sum ?></div>
						</td>
					</tr>
<?php
	}
	
	$conn->close();
	$result->close();
?>
				</tbody>
			</table>
			<button>Procesează</button>
		</form>
	</article>
</main>
<?php require '../frag/footer.html'; ?>