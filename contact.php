<?php
	$title = 'Contacte';
	$description = 'Datele de contact despre autor.';
	$styles = ['contact'];
	require 'frag/global.php';
?>
<main>
	<article>
		<h1 id="contacte">Contacte</h1>
		<section>
			<div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10881.72311804783!2d28.820932594644884!3d47.01214869720585!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c97c2d03e2c6b1%3A0xd8e8b74ac8c3ef7b!2sMoldova%20State%20University!5e0!3m2!1sen!2s!4v1650929764751!5m2!1sen!2s" height="450" style="border-radius: var(--border-radius); border: 1px var(--main-color) solid; width: 100%" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
			<address>
				<h2>Contactele autorului</h2>
				<ul>
					<li style="list-style-type: square; font-weight: 500; font-size: larger">Cristian Cemîrtan</li>
					<li>
						<dl>
							<dt>Grupa: <b>I-2101</b></dt>
							<dd>Facultatea de Matematică și Informatică, USM</dd>
						</dl>
					</li>
				</ul>
			</address>
		</section>
	</article>
</main>
<?php require 'frag/footer.html'; ?>