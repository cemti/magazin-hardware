<?php
	$title = 'Despre noi';
	$description = 'Magazin Hardware este un proiect individual început mult timp în urmă...';
	$styles = ['about'];
	require 'frag/global.php';
?>
<main>
	<article>
		<h1 id="despre-noi">Despre noi</h1>
		<section>
			<h2 id="despre-noi">Despre creator</h2>
			<p>Bună ziua, mă numesc Cristian Cemîrtan.</p>
			<p>Pasiunea vieții mele constă raționalmente în programarea backend. Prefer într-o nemărginită măsură să scriu programe de calitate enterprise, împodobite cu algoritme stabile, bine gândite și chibzuite, cum nu au fost de găsit în rândul concurențiilor mei. Actualmente îmi fac studiile la <a href="http://usm.md/" target="_blank">USM</a>, în specialitatea informaticii. Am învățat trei ani la <a href="http://ceiti.md/" target="_blank">CEITI</a>, în specialitatea programării și elaborarea produselor program, cu intenția de a culege roade ambițioase în domeniul programării calculatorelor.</p>
			<p>Limbajul meu preferat de programare este C++. Acest limbaj mă ajută să-mi exprim complet imaginația de computerizare. Datorită pointerilor și a orientării sale pe obiecte, C++ este, în opinia mea, cel mai puternic limbaj de programare. Când merge vorba despre rapiditate și flexibilitate, atunci Java este limbajul potrivit. Java îmbracă în sine o colecție mare de structuri de date, care îmi permit să-mi reduc extrem numărul de linii și efort de a elabora un program productiv.</p>
		</section>
		<section>
			<h2 id="despre-proiect">Despre proiect</h2>
			<p>Acest proiect a fost demarat în anul 2020 (anul II la <abbr title="Centrul de Excelență în Informatică și Tehnologii Informaționale">CEITI</abbr>), sub denumirea de „IT Hardware” <small>(sau „Magazin Hardware”)</small>, ca o lucrare individuală pentru disciplina „Sisteme de gestiune a bazelor de date”. Diagrama <abbr title="Entitate-Relație">E-R</abbr> a bazei de date a fost concepută inițial pentru a face cunoștință cu conceptele <abbr title="Bazei de date">BD</abbr>, dar ulterior a fost simplificată când am început să învăț la <abbr title="Universitatea de Stat din Moldova">USM</abbr>.</p>
			<figure>
				<div>
					<div><img src="img/about/slide1.jpg" /></div>
					<div><img src="img/about/diagrama1.png" /></div>
				</div>
				<figcaption>Diagrama <abbr title="Entitate-Relație">E-R</abbr> inițială a bazei de date</figcaption>
			</figure>
			<figure>
				<div>
					<div><img src="img/about/slide2.jpg" /></div>
					<div><img src="img/about/diagrama2.png" /></div>
				</div>
				<figcaption>Diagrama avansată a bazei de date</figcaption>
			</figure>
			<h2 id="sgbd">Mini-SGBD</h2>
			<p>Când am ajuns anul III la <abbr title="Centrul de Excelență în Informatică și Tehnologii Informaționale">CEITI</abbr>, proiectul s-a avansat într-un mini-<abbr title="Sistem de gestiune a bazei de date">SGBD</abbr>. Deasemenea este un program vizual scris în limbajul de programare C#, prin intermediul cadrului <a href="https://docs.microsoft.com/en-us/dotnet/desktop/winforms" target="_blank">Windows Forms</a>.</p>
			<figure>
				<div>
					<div><img src="img/about/gui1.jpg" /></div>
					<div><img src="img/about/gui2.png" /></div>
				</div>
				<figcaption>Programul vizual</figcaption>
			</figure>
			<h2 id="ls">Lucrarea științifică</h2>
			<p>Când am început să învăț la <abbr title="Universitatea de Stat din Moldova">USM</abbr>, am publicat primul meu articol științific la <a href="https://utm.md/cts-smd-2022/" target="_blank">conferința tehnico-științifică (ediția 2022)</a> în cadrul <abbr title="Universitatea Tehnică a Moldovei">UTM</abbr>, sub tematica <q style="text-transform: uppercase; font-weight: bold">Interoperabilitatea dintre JDBC și Hibernate prin intermediul Vaadin</q>. Diagrama și aspectul bazei de date au fost simplificate pentru a se conforma limitelor de conținut prevăzute în regulamentul conferinței.</p>
			<p>În lucrarea științifică se demonstrează diferențele nivelelor de lucru al stilurilor JDBC și Hibernate într-o aplicație web <a title="Framework pentru Java" href="https://vaadin.com/" target="_blank">Vaadin</a>.</p>
			<figure>
				<img style="max-width: 848px" src="img/about/articol.jpg" />
				<figcaption>Articolul publicat</figcaption>
			</figure>
			<figure>
				<img src="img/about/gui3.jpg" />
				<figcaption>Aplicația web realizat utilizând cadrul Vaadin</figcaption>
			</figure>
		</section>
	</article>
</main>
<?php require 'frag/footer.html'; ?>