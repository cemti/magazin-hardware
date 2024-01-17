'use strict';

document.querySelectorAll('[data-view]').forEach(x => x.href = `/products.php?view=${x.dataset.view}`);

var cartItems, cartUpdated;

async function updateCart(entry = false) {
	if (entry === true) {
		delete localStorage.cartItems;
		delete cartView.dataset.hasItems;

		cartItems = {};
		document.cart.querySelector('.cart-table > tbody').innerHTML = '';
		
		for (const em of document.getElementsByClassName('cart-count')) {
			em.innerText = 0;
		}
		
		for (const em of document.getElementsByClassName('cart-total')) {
			em.innerText = '0.00';
		}

		return;
	}
	else if (entry !== false) {
		if (entry.id in cartItems) {
			cartItems[entry.id] += entry.count;
		}
		else {
			cartItems[entry.id] = entry.count;
		}
	}
	
	localStorage.cartItems = JSON.stringify(cartItems);

	let count = 0, total = 0;
	
	{
		const rowTemplate = cartBodyRowTemplate.content;
		const fragment = document.createDocumentFragment();
		let i = 0;

		for (const [id, itemCount] of Object.entries(cartItems)) {
			const product = (await (await fetch(`/frag/fetchProducts.php?id=${id}`)).json()).items[0];
			
			const realPrice = itemCount * product.price;
			count += itemCount;
			total += realPrice;

			const row = rowTemplate.cloneNode(true);
			const cells = row.querySelectorAll('td');
			
			{
				const removeItem = cells[0].querySelector('.cart-remove-item');
				
				if (removeItem !== null) {
					cells[0].querySelector('.cart-remove-item').onclick = () => {
						delete cartItems[id];
						updateCart();
					};
				}
			}

			cells[0].prepend(`${product.vendor} ${product.name}`);

			const input = cells[1].children[0];
			input.value = itemCount;
			
			if (input instanceof HTMLInputElement) {
				input.onblur = () => {
					if (input.reportValidity() && cartItems[id] != input.valueAsNumber) {
						cartItems[id] = input.valueAsNumber;
						updateCart();
					}
				};
			}
			
			cells[2].innerText = realPrice.toFixed(2);
			fragment.append(row);
		}
		
		const cartBody = document.cart.querySelector('.cart-table > tbody');
		cartBody.innerHTML = '';
		cartBody.append(fragment);
	}
	
	for (var em of document.getElementsByClassName('cart-count')) {
		em.innerHTML = count;
	}
	
	for (var em of document.getElementsByClassName('cart-total')) {
		em.innerHTML = total.toFixed(2);
	}

	if (Object.keys(cartItems).length > 0) {
		cartView.dataset.hasItems = '';
	} else {
		delete cartView.dataset.hasItems;
	}
}

function saveCart() {
	fetch('/panel/', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json'
		},
		body: JSON.stringify(cartItems)
	});
}

async function loadCart() {
	try {
		cartItems = await (await fetch('/panel?get')).json();
		updateCart();
	}
	catch {
		updateCart(true);
	}
}

if ('localStorage' in window) {
	try {
		cartItems = JSON.parse(localStorage.cartItems);
		cartUpdated = updateCart();
	}
	catch {
		cartItems = {};
	}
	
	if ('cancel' in document.cart) {
		document.cart.cancel.onclick = () => {
			if (confirm('Anulați toată comanda?')) {
				updateCart(true);
			}
		};
	}
}