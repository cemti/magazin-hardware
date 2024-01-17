'use strict';

document.onmousemove = e => {
	const dropdown = cartView.querySelector(':scope > .dropdown');
		
	if (e.clientX > (innerWidth >> 1)) {
		dropdown.dataset.left = '';
	}
	else {
		delete dropdown.dataset.left;
	}
};

document.checkout.onsubmit = e => updateCart(true);

if (cartUpdated !== undefined) {
	cartUpdated.then(async () => {
		const imagesFlex = images.querySelector(':scope > .showcase');
		const tbody = document.cart.querySelector('.cart-table > tbody');
		const arr = [];
		let i = 0;
		
		for (const [id, count] of Object.entries(cartItems)) {	
			const img = document.createElement('img');
			img.alt = 'Imagine produs';
			img.src = `/img?id=${id}`;

			const row = tbody.children[i++];
			
			img.onmouseenter = () => row.style.background = 'yellow';
			img.onmouseleave = () => row.style.background = '';
			
			const div = document.createElement('div');
			div.className = 'showcase-item';
			div.append(img);
			
			imagesFlex.append(div);
			arr.push(`${count} ${id}`);
		}
		
		const products = document.createElement('input');
		products.type = 'hidden';
		products.name = 'cart';
		products.value = arr.join();	
		checkout.append(products);
	});
}

cartView.ontoggle = () => {
	const test = cartView.open;
	document.checkout.submit.hidden = !test;
	formAlert.hidden = test;
}

cartView.open = true;