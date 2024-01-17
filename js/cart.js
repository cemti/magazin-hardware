'use strict';

document.querySelectorAll('[data-view]').forEach(x => x.href = `products.html?view=${x.dataset.view}`);

var cartItems;

function updateCart(entry = false) {
	if (entry === true) {
		delete localStorage.cartItems;
		delete cartView.dataset.hasItems;

		cartItems = [];
		document.cart.querySelector('.cart-table > tbody').innerHTML = '';
		
		for (var em of document.getElementsByClassName('cart-count')) {
			em.innerText = 0;
		}
		
		for (var em of document.getElementsByClassName('cart-total')) {
			em.innerText = '0.00';
		}

		return;
	}
	else if (entry !== false) {
		const idx = cartItems.findIndex(x => x.name === entry.name);
		
		if (idx != -1) {
			cartItems[idx].count += entry.count;
		}
		else {
			cartItems.push(entry);
		}
	}
	
	localStorage.cartItems = JSON.stringify(cartItems);

	let count = 0, total = 0;
	
	{
		const rowTemplate = cartBodyRowTemplate.content;
		const fragment = document.createDocumentFragment();
		let i = 0;
		
		for (const item of cartItems) {
			const realPrice = item.count * item.price;
			count += item.count;
			total += realPrice;

			const row = rowTemplate.cloneNode(true);
			const cells = row.querySelectorAll('td');
			const idx = i++;

			const cartRemoveItem = cells[0].querySelector('.cart-remove-item');
			
			if (cartRemoveItem != null) {
				if (item.name == 'Amendă') {
					if ('cancel' in document.cart) {
						document.cart.cancel.remove();
					}
					cartRemoveItem.remove();
				}
				else {
					cartRemoveItem.onclick = () => {
						cartItems.splice(idx, 1);
						updateCart();
					};
				}
			}

			if ('vendor' in item) {
				cells[0].prepend(`${item.vendor} ${item.name}`);
			}
			else {
				cells[0].prepend(item.name);
			}

			const input = cells[1].children[0];
			input.value = item.count;
			
			if (input instanceof HTMLInputElement) {
				input.onblur = () => {
					if (input.reportValidity() && cartItems[idx].count != input.valueAsNumber) {
						cartItems[idx].count = input.valueAsNumber;
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

	if (cartItems.length) {
		cartView.dataset.hasItems = '';
	} else {
		delete cartView.dataset.hasItems;
	}
}

if ('localStorage' in window) {
	try {
		cartItems = JSON.parse(localStorage.cartItems);
		updateCart();
	}
	catch {
		cartItems = [];
	}
	
	if ('cancel' in document.cart) {
		document.cart.cancel.onclick = () => {
			if (confirm('Anulați toată comanda?')) {
				updateCart(true);
			}
		};
	}
}