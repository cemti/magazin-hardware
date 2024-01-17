<!DOCTYPE html>
<html lang="ro">
<head>
	<meta charset="utf-8" />
	<meta name="author" content="Cristian Cemîrtan" />
	<meta name="description" content="<?= @$description ?>" />
	<meta name="keywords" content="magazin, hardware, cpu, gpu, hdd, ssd, motherboard" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="icon" href="/img/favicon.ico" />
	<link rel="stylesheet" href="/css/cart.css" />
	<script src="/js/cart.js" defer></script>
<?php
	if (isset($styles)) {
		foreach ($styles as $css) {
			echo "	<link rel=\"stylesheet\" href=\"/css/$css.css\" />
";
		}
	}
	
	if (isset($scripts)) {
		foreach ($scripts as $js) {
			echo "	<script src=\"/js/$js.js\" defer></script>
";
		}
	}
?>
	<title><?php if (isset($title)) echo "$title | "; ?>Magazin Hardware</title>
</head>
<body>
