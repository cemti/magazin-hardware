<?php
	$title = 'Produsele';
	$description = 'Produsele la prețuri atractive.';
	$styles = ['products_page'];
	$scripts = ['products'];
	require 'frag/global.php';
?>
<aside hidden>
	<form id="query" name="query">
		<input name="view" type="hidden" />
		<label>Sortarea:
			<select name="sort">
				<optgroup label="Ordinea adăugării">
					<option value="0_0">Cronologică</option>
					<option value="0_1">Inversă</option>
				</optgroup>
				<optgroup label="Preț">
					<option value="1_0">Crescătoare</option>
					<option value="1_1">Descrescătoare</option>
				</optgroup>
			</select>
		</label>
		<label>După furnizor:
			<select name="vendor">
				<option value="">Toate</option>
			</select>
		</label>
		<label>După model: <input name="search" type="search" /></label>
		<label>Itemi/pagină:
			<span>
				<label><input name="limit" type="radio" value="16" checked /> 16</label>
				<label><input name="limit" type="radio" value="32" /> 32</label>
				<label><input name="limit" type="radio" value="64" /> 64</label>
			</span>
		</label>
		<button style="grid-column: 1 / 3">Filtrează</button>
	</form>
</aside>
<main>
	<article style="margin-bottom: 20px">
		<h1 id="produse">Toate produsele</h1>
		<section class="showcase"></section>
		<template id="itemEntryTemplate">
			<div class="showcase-item">
				<img alt="Imagine produs" />
				<span class="title"></span>
				<button class="add">Adaugă în coș - <span class="price"></span></button>
				<label>Cantitate: <span class="count"><input type="number" min="1" required /></span></label>
				<span class="item-added-indicator">Adăugat în coș</span>
			</div>
		</template>
		<noscript>
			<strong style="color: red">Vă rog să activați Javascript pentru a putea adăuga produsele în coș.</strong>
		</noscript>
	</article>
	<hr style="margin: 15px" />
	<article class="pagination-container">
		<template id="paginationTemplate">
			<button form="query" name="page" class="pagination"></button>
		</template>
	</article>
</main>
<?php require 'frag/footer.html'; ?>