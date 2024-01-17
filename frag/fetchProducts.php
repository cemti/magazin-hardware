<?php
	require 'connect.php';
	header('Content-Type: application/json');

	$sql = 'SELECT * FROM ProductsView';
	$predicates = [];
	
	if (@is_numeric($_GET['id'])) {
		array_push($predicates, 'id = ' . $_GET['id']);
	}
	
	if (!empty(@trim($_GET['search']))) {
		array_push($predicates, sprintf('(LOWER(name) LIKE \'%%%s%%\' OR LOWER(vendor) LIKE \'%%%1$s%%\')',
			addcslashes($conn->real_escape_string($_GET['search']), '%_')));
	}
	
	if (!empty($_GET['vendor'])) {
		array_push($predicates, sprintf('LOWER(vendor) = \'%s\'', $conn->real_escape_string(strtolower($_GET['vendor']))));
	}
	
	if (!empty($_GET['view'])) {
		switch ($_GET['view']) {
			case 'hardware':
				array_push($predicates, 'category NOT IN (\'pc\', \'laptop\')');
				break;
			
			case 'computer':
				array_push($predicates, 'category IN (\'pc\', \'laptop\')');
				break;
			
			default:
				array_push($predicates, sprintf('category = \'%s\'', $conn->real_escape_string($_GET['view'])));
		}
	}
	
	if (!empty($predicates)) {
		$sql .= ' WHERE ' . implode(' AND ', $predicates);
	}
	
	$orderBy = 'id';
	
	if (!empty($_GET['sort'])) {
		$sorts = [
			'0_1' => 'id DESC',
			'1_0' => 'price',
			'1_1' => 'price DESC'
		];
		
		if (isset($sorts[$_GET['sort']])) {
			$orderBy = $sorts[$_GET['sort']];
		}
	}

	$page = @+$_GET['page'];
	$limit = 16;
	
	if (isset($_GET['limit'])) {
		$tmp = +$_GET['limit'];
		
		if ($tmp >= 1 && $tmp <= 64) {
			$limit = $tmp;
		}
	}
	
	echo json_encode([
		'count' => +$conn->query(sprintf('SELECT COUNT(*) FROM (%s) t', $sql))->fetch_row()[0],
		'items' => $conn->query("$sql ORDER BY $orderBy LIMIT $limit OFFSET " . $page * $limit)->fetch_all(MYSQLI_ASSOC)
	]);
?>