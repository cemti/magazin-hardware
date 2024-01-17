<?php
	if (@is_numeric($_GET['id'])) {
		require '../frag/connect.php';
		$row = $conn->query("SELECT CONCAT('products/', category, '/', id, '.jpg') FROM ProductsView WHERE id = {$_GET['id']}")->fetch_row();
		
		if ($row !== null) {
			header('Content-Type: image/jpeg');
			readfile($row[0]);
		}
		else {
			http_response_code(404);
		}
	}
	elseif (isset($_GET['carousels'])) {
		header('Content-Type: application/json');
		echo json_encode(array_map(function ($x) { return pathinfo($x, PATHINFO_FILENAME); }, glob('carousel/*.jpg')));
	}
	elseif (isset($_GET['carousel'])) {
		$filename = 'carousel/' . basename($_GET['carousel']) . '.jpg';
		
		if (file_exists($filename)) {
			header('Content-Type: image/jpeg');
			readfile($filename);
		}
		else {
			http_response_code(404);
		}
	}
	else {
		header('Location: /');
	}
?>