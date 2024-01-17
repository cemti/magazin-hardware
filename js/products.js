'use strict';

{
	const details = document.createElement('details');
	details.className = 'query-box-opener';
	
	details.ontoggle = e => {
		document.querySelector('aside').hidden = !details.open;
		
		if ('sessionStorage' in window) {
			sessionStorage.showQueryBox = details.open;
		}
	};
	
	details.innerHTML = '<summary>Căutarea avansată</summary>';
	document.querySelector('nav').append(details);
	
	if ('sessionStorage' in window && sessionStorage.showQueryBox === 'true') {
		details.open = true;
	}
}

(async () => {
	const {count, items} = await (await fetch('/frag/fetchProducts.php' + location.search)).json();
	
	{
		const param = Object.fromEntries(new URLSearchParams(location.search).entries());

		for (const p in param) {
			if (param[p].trim() == '') {
				delete param[p];
			}
			else {
				param[p] = param[p].toLowerCase();
			}
		}
		
		if ('view' in param) {
			const titles = {
				cpu: 'Procesoare',
				gpu: 'Plăci video',
				ram: 'Module RAM',
				hdd: 'Hard disk-uri',
				mb: 'Plăci de bază',
				mouse: 'Mouse',
				kb: 'Tastiere',
				cam: 'Camere web',
				pc: 'Calculatoare staționare',
				laptop: 'Laptopuri',
				hardware: 'Piese de calcul',
				computer: 'Calculatoare'
			};
			
			produse.innerText = titles[param.view];
			document.title = `${titles[param.view]} | Magazin Hardware`;
			document.query.view.value = param.view;
		}

		{
			const map = new Map();
			const select = query.vendor;
			
			items.forEach(x => map.set(x.vendor, map.has(x.vendor) ? map.get(x.vendor) + 1 : 1));
			[...map].sort((a, b) => b[1] - a[1]).forEach(x => select.add(new Option(`${x[0]} (${x[1]})`, x[0])));
		}
		
		{
			const n = Math.ceil(count / ('limit' in param ? param.limit : 16));
			const btnTemplate = paginationTemplate.content.querySelector('button.pagination');	
			const container = paginationTemplate.parentNode;
			
			for (let i = 0; i < n; ++i) {
				const btn = btnTemplate.cloneNode(true);
				btn.value = i;
				
				if (('page' in param ? param.page : 0) == i) {
					btn.classList.add('selected');
				}
				
				container.append(btn);
			}
		}
	}
	
	{
		const template = itemEntryTemplate.content.querySelector('.showcase-item');
		const showcase = document.querySelector('.showcase');
		document.query.search.placeholder = 0 in items ? items[0].name : 'Primul model găsit va apărea aici';

		for (const item of items) {
			const showcaseItem = template.cloneNode(true);
			const btn = showcaseItem.querySelector(':scope > .add');
			
			const img = showcaseItem.querySelector(':scope > img');
			img.src = `/img?id=${item.id}`;
			img.title = `Cod serial: ${item.id}`;
			
			showcaseItem.querySelector(':scope > .title').innerText = `${item.vendor} ${item.name}`;
			btn.querySelector(':scope > .price').innerText += item.price;
			
			const input = showcaseItem.querySelector(':scope > label > .count > input');
			const indicator = showcaseItem.querySelector('.item-added-indicator');
			
			btn.onclick = () => {
				if (input.reportValidity()) {
					indicator.animate([
						{ visibility: 'visible', opacity: 1 },
						{ opacity: 0 }
					], 2500);
					updateCart({ id: item.id, count: input.valueAsNumber });
				}
			};
			
			showcaseItem.onmouseenter = () => input.value = 1;	
			showcase.append(showcaseItem);
		}
	}
})();