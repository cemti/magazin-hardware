<?php
	$description = 'Magazin Hardware este locul potrivit unde poti gasi piese de calcul la preturi avantajoase.';
	$styles = ['carousel'];
	$scripts = ['carousel'];
	require 'frag/global.php';
?>
<main>
	<article>
		<h1 id="produsele-recomandate">Produsele recomandate</h1>
		<section>
			<div class="carousel-container" data-idx="0" data-auto="right"></div>
			<noscript>
				<p>Activați JavaScript pentru a vizualiza produsele recomandate.</p>
			</noscript>
		</section>
	</article>
</main>
<?php require 'frag/footer.html'; ?>