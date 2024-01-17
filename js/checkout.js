'use strict';

document.onmousemove = e => {
	if (!tos.open) {
		const dropdown = cartView.querySelector(':scope > .dropdown');
		
		if (e.clientX > (innerWidth >> 1)) {
			dropdown.dataset.left = '';
		}
		else {
			delete dropdown.dataset.left;
		}
	}
};

{
	const imagesFlex = images.querySelector(':scope > .showcase');
	const tbody = document.cart.querySelector('.cart-table > tbody');
	let i = 0;
	
	for (const item of cartItems) {	
		const img = document.createElement('img');
		img.alt = 'Imagine produs';

		if ('img' in item) {
			img.src = item.img;
		}
		else if (item.name == 'Amendă') {
			img.src = 'http://1.bp.blogspot.com/-Ifwb2wprUu0/Vqa0t019l1I/AAAAAAAABFk/C3qJn_pUWuw/s200/policeofficer.png';
		}
		
		const row = tbody.children[i++];
		
		img.onmouseenter = () => row.style.background = 'yellow';
		img.onmouseleave = () => row.style.background = '';
		
		const div = document.createElement('div');
		div.className = 'showcase-item';
		div.append(img);
		
		imagesFlex.append(div);
	}
}

{
	const checkout = document.checkout;
	
	cartView.ontoggle = () => {
		const test = cartView.open;
		checkout.submit.hidden = !test;
		formAlert.hidden = test;
	}
	
	const elements = checkout.elements;

	for (const entry of new URLSearchParams(location.search).entries()) {
		if (!(entry[0] in elements)) {
			continue;
		}
		
		const input = elements[entry[0]];
		
		if (input instanceof HTMLTextAreaElement) {
			input.innerText = entry[1];
		}
		else if (input.type == 'checkbox') {
			input.checked = true;
		}
		else {
			input.value = entry[1];
		}
	}
	
	if (checkout.checkValidity()) {
		formWarn.children[0].innerText = 'datele introduse în formular';
		formWarn.className = 'importance';
		
		checkout.querySelectorAll('label > *').forEach(x => x.readOnly = true);
		
		checkout.submit.innerText = 'Comandă';
		checkout.action = 'index.html';
		
		checkout.onsubmit = () => {
			if (!('hasItems' in cartView.dataset)) {
				alert('Plasarea comenzii cu coșul gol se consideră vandalism.');
				updateCart({
					name: 'Amendă', 
					count: 1,
					price: 500
				});
			}
			else if (confirm('Doriți să plasați comanda?')) {
				updateCart(true);
				alert('Comanda a fost plasată cu succes.');
			}
			else {
				return false;
			}				
		}
	}
}