<?php
	session_start();
	
	if (!isset($_SESSION['privilege']) || $_SESSION['privilege'] < 1) {
		header('Location: .');
		exit;
	}
	
	define('isAdmin', $_SESSION['privilege'] >= 2);
	
	require '../frag/connect.php';
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		foreach ($_POST as &$field) {
			$field = $conn->real_escape_string(htmlspecialchars($field));
		}
		
		if (isset($_POST['insertupdate'])) {
			if (@is_numeric($_POST['id'])) {
				$o = $conn->query('SELECT * FROM ProductsView WHERE ID = ' . $_POST['id'])->fetch_object();
				
				if (isset($o)) {
					if ($_FILES['image']['type'] == 'image/jpeg') {
						move_uploaded_file($_FILES['image']['tmp_name'], sprintf('../img/products/%s/%s.jpg', $o->category, $o->id));
					}
					else {
						rename(
							sprintf('../img/products/%s/%s.jpg', $o->category, $o->id),
							sprintf('../img/products/%s/%s.jpg', 
								$conn->query('SELECT Name FROM Categories WHERE ID = ' . +$_POST['category'])->fetch_row()[0],
								$o->id)
						);
					}
					
					$conn->prepare('UPDATE Products SET Vendor = ?, Name = ?, Price = ?, Category = ? WHERE ID = ' . $o->id)->execute([
						$_POST['vendor'], $_POST['model'], $_POST['price'], $_POST['category']
					]);
				}
			}
			elseif ($_FILES['image']['type'] == 'image/jpeg') {
				$conn->prepare('INSERT INTO Products VALUES (NULL, ?, ?, ?, ?)')->execute([
					$_POST['vendor'], $_POST['model'], $_POST['price'], $_POST['category']]);

				move_uploaded_file($_FILES['image']['tmp_name'], sprintf('../img/products/%2$s/%1$s.jpg',
					$conn->insert_id,
					$conn->query('SELECT category FROM ProductsView WHERE ID = ' . $conn->insert_id)->fetch_row()[0])
				);
			}
		}
		elseif (isset($_POST['delete'])) {
			$o = $conn->query('SELECT * FROM ProductsView WHERE ID = ' . +$_POST['delete'])->fetch_object();
			unlink(sprintf('../img/products/%s/%s.jpg', $o->category, $o->id));
			$conn->query('DELETE FROM Products WHERE ID = ' . +$_POST['delete']);
		}
		elseif (isAdmin) {
			if (isset($_POST['carouselAdd'])) {
				if ($_FILES['image']['type'] == 'image/jpeg') {
					move_uploaded_file($_FILES['image']['tmp_name'], '../img/carousel/' . basename($_FILES['image']['name']));
				}
			}
			elseif (isset($_POST['carouselDel'])) {
				unlink(sprintf('../img/carousel/%s.jpg', basename($_POST['carouselDel'])));
			}
		}
		
		header('Refresh: 0');
		exit;
	}
	
	$title = 'Acces intern';
	$styles = ['../panel/css/products'];
	$scripts = ['realtimeid'];
	require '../frag/global.php';
?>
<main>
	<article>
		<h1>Produse</h1>
		<a href="/panel">Înapoi</a>
		<section class="column-section" data-basic>
			<datalist id="ids">
<?php
	$conn = db_connect();
	$result = $conn->query('SELECT ID, CONCAT(Vendor, \' \', Name) Name FROM Products');
	
	while ($o = $result->fetch_object()) {
?>
				<option value="<?= $o->ID ?>"><?= $o->Name ?></option>
<?php
	}
?>
			</datalist>
			<datalist id="categories">
<?php
	$result = $conn->query('SELECT * FROM Categories');
	
	while ($o = $result->fetch_object()) {
?>
				<option value="<?= $o->ID ?>"><?= $o->Name ?></option>
<?php
	}
?>
			</datalist>
			<form method="post" name="addUpdate" enctype="multipart/form-data">
				<h2>Adaugă/modifică un produs</h2>
				<div class="neat-div">
					<label>Cod serial: <input list="ids" name="id" pattern="\d+" /><label>
					<label>Furnizor: <input name="vendor" required /></label>
					<label>Model: <input name="model" required /></label>
					<label>Preț: <input name="price" pattern="(\d*\.)?\d+" required /></label>
					<label>Categorie:
						<select name="category" required />
<?php
	$result = $conn->query('SELECT * FROM Categories');
	
	while ($o = $result->fetch_object()) {
?>
							<option value="<?= $o->ID ?>"><?= $o->Name ?></option>
<?php
	}
	
	$result->close();
	$conn->close();
?>
						</select>
					</label>
					<label>Imagine: <input name="image" type="file" accept="image/jpeg" /></label>
				</div>
				<button name="insertupdate">Expediază</button>
			</form>
			<form method="post">
				<h2>Șterge un produs</h2>
				<div class="neat-div">
					<label>Cod serial: <input list="ids" pattern="\d+" name="delete" required /></label>
				</div>
				<button>Șterge</button>
			</form>
<?php
	if (isAdmin) {
?>
			<form enctype="multipart/form-data" method="post">
				<h2>Produsele reclamate</h2>
				<table class="cart-table">
					<thead>
						<tr>
							<th>Denumire</th>
							<th>Acțiune</th>
						</tr>
					</thead>
					<tbody>
<?php
	foreach (glob('../img/carousel/*.jpg') as $name) {
		$name = pathinfo($name, PATHINFO_FILENAME);
?>
						<tr>
							<td><a target="_blank" href="/img?carousel=<?= $name ?>"><?= $name ?></a></td>
							<td><form method="post" style="display: contents"><button name="carouselDel" value="<?= $name ?>">Șterge</button></form></td>
						</tr>
<?php
	}
?>
					</tbody>
					<tfoot>
						<tr>
							<td><input type="file" name="image" accept="image/jpeg" required /></td>
							<td><button name="carouselAdd">Adaugă</button></td>
						</tr>
					</tfoot>
				</table>
			</form>
<?php
	}
?>
		</section>
	</article>
</main>
<?php require '../frag/footer.html'; ?>