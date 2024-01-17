'use strict';

{
	// Se putea cu JSON, dar este posibil numai cand siteul este rulat pe server
	const products = {
		cpu: [
			{
				vendor: 'Intel',
				name: 'Core i5 9400F',
				price: 3600
			},
			{
				vendor: 'AMD',
				name: 'Ryzen 7 3700X',
				price: 7050
			},
			{
				vendor: 'AMD',
				name: 'Ryzen 5 3600X',
				price: 5500
			},
			{
				vendor: 'Intel',
				name: 'Celeron G5900',
				price: 1164
			},
			{
				vendor: 'Intel',
				name: 'Pentium G5500',
				price: 1500
			},
			{
				vendor: 'AMD',
				name: 'Athlon II X2 240',
				price: 800
			},
			{
				vendor: 'Intel',
				name: 'Core i9-10900',
				price: 99853
			},
			{
				vendor: 'Intel',
				name: 'Xeon Silver 4110',
				price: 14260
			}
		],
		gpu: [
			{
				vendor: 'Palit',
				name: 'GeForce GT 730 2048MB',
				price: 1901
			},
			{
				vendor: 'Gigabyte',
				name:  'GeForce GTX 1650 OC 4096MB',
				price: 6500
			},
			{
				vendor: 'ASUS',
				name: 'Cerberus GTX 1050Ti 4096MB',
				price: 5012
			},
			{
				vendor: 'ZOTAC',
				name: 'GeForce GT 1030 2048MB',
				price: 2500
			},
			{
				vendor: 'Gigabyte',
				name: 'GeForce GTX 1050Ti OC 4096MB',
				price: 4904
			},
			{
				vendor: 'Biostar',
				name: 'GeForce 210 1024MB',
				price: 800
			},
			{
				vendor: 'Sapphire',
				name: 'Radeon R7 240 4096MB',
				price: 1906
			},
			{
				vendor: 'ASUS',
				name: 'Radeon RX 6600 XT Dual OC 8192MB',
				price: 14025
			},
			{
				vendor: 'ASUS',
				name: 'RTX 2060 Dual EVO OC 6144MB',
				price: 11432
			}
		],
		ram: [
			{
				vendor: 'Silicon Power',
				name: '4GB DDR3-1600MHz',
				price: 500
			},
			{
				vendor: 'Corsair',
				name: 'Value Select 4Gb DDR3-1600MHz',
				price: 550
			},
			{
				vendor: 'GOODRAM',
				name: '8GB DDR3-1600MHz',
				price: 951
			},
			{
				vendor: 'HyperX',
				name: 'FURY 4GB DDR4-3200MHz',
				price: 633
			},
			{
				vendor: 'Hynix',
				name: '4GB DDR4-2666MHz',
				price: 549
			},
			{
				vendor: 'Kingston',
				name: 'ValueRam 8GB DDR4-3200MHz',
				price: 970
			},
			{
				vendor: 'G.SKILL',
				name: 'Aegis 16GB DDR4-2666MHz',
				price: 1500
			},
			{
				vendor: 'Transcend',
				name: '8GB DDR4-3200MHz',
				price: 850
			}
		],
		hdd: [
			{
				vendor: 'Western Digital',
				name: '3.5" HDD WD3200AAJS',
				price: 370
			},
			{
				vendor: 'Transcend',
				name: '2.5" SSD SSD230',
				price: 585
			},
			{
				vendor: 'Seagate',
				name: '3.5" HDD ST3500312CS Pipeline HD',
				price: 477
			},
			{
				vendor: 'Intenso',
				name: '2.5" SSD MLC-Flash',
				price: 469
			},
			{
				vendor: 'Western Digital',
				name: '3.5" HDD WD5000AURX',
				price: 480
			},
			{
				vendor: 'Transcend',
				name: 'M.2 830S',
				price: 687
			},
			{
				vendor: 'Western Digital',
				name: '3.5" HDD Caviar Blue WD10EZEX',
				price: 870
			},
			{
				vendor: 'HyperX',
				name: '2.5" SSD FURY 3D',
				price: 870
			},
			{
				vendor: 'Western Digital',
				name: '2.5" HDD WD10SPZX',
				price: 870
			}
		],
		mb: [
			{
				vendor: 'Biostar',
				name: 'A68N-5600E',
				price: 1533
			},
			{
				vendor: 'Biostar',
				name: 'A520MH',
				price: 1153
			},
			{
				vendor: 'ASRock',
				name: 'H310CM-HDV',
				price: 1199
			},
			{
				vendor: 'Biostar',
				name: 'B450MH',
				price: 1284
			},
			{
				vendor: 'Gigabyte',
				name: 'B450M H',
				price: 1343
			},
			{
				vendor: 'MSI',
				name: 'B450M-A PRO MAX',
				price: 1320
			},
			{
				vendor: 'Gigabyte',
				name: 'B365M H',
				price: 1731
			},
			{
				vendor: 'Gigabyte',
				name: 'H510M H',
				price: 1583
			},
			{
				vendor: 'Gigabyte',
				name: 'J4005N D2P',
				price: 1700
			}
		],
		mouse: [
			{
				vendor: 'Logitech',
				name: 'M235',
				price: 420
			},
			{
				vendor: 'Logitech',
				name: 'M570 Trackball',
				price: 1428
			},
			{
				vendor: 'Logitech',
				name: 'G502',
				price: 1440
			},
			{
				vendor: 'Lenovo',
				name: 'M300',
				price: 135
			},
			{
				vendor: 'Logitech',
				name: 'MX518',
				price: 900
			},
			{
				vendor: 'HP',
				name: 'X4000b',
				price: 505
			},
			{
				vendor: 'ASUS',
				name: 'MW202',
				price: 320
			},
			{
				vendor: 'Logitech',
				name: 'MX Master 3',
				price: 2208
			}
		],
		kb: [
			{
				vendor: 'Qumo',
				name: 'Kappa',
				price: 90
			},
			{
				vendor: 'uRage',
				name: 'Lethality',
				price: 144
			},
			{
				vendor: 'Logitech',
				name: 'K120',
				price: 200
			},
			{
				vendor: 'Canyon',
				name: 'Fobos',
				price: 376
			},
			{
				vendor: 'SVEN',
				name: 'KB-E5800W',
				price: 304
			},
			{
				vendor: 'Rapoo',
				name: 'E2710',
				price: 544
			},
			{
				vendor: 'Dell',
				name: 'KB-522',
				price: 538
			},
			{
				vendor: 'Hama',
				name: 'SL720 Slimline Mini',
				price: 250
			}
		],
		cam: [
			{
				vendor: 'Platinet',
				name: 'PCWC1080',
				price: 472
			},
			{
				vendor: 'Logitech',
				name: 'C310',
				price: 830
			},
			{
				vendor: 'SVEN',
				name: 'IC-525',
				price: 336
			},
			{
				vendor: 'A4Tech',
				name: 'PK-910P',
				price: 409
			},
			{
				vendor: 'Tellur',
				name: 'TLL491131',
				price: 553
			},
			{
				vendor: 'SVEN',
				name: 'IC-950 HD',
				price: 525
			}
		],
		pc: [
			{
				vendor: 'Lenovo',
				name: 'V50s-07IMB',
				price: 6798
			},
			{
				vendor: 'Lenovo',
				name: 'ThinkCentre M70c',
				price: 7436
			},
			{
				vendor: 'Dell',
				name: 'Vostro 3471',
				price: 7632
			},
			{
				vendor: 'Dell',
				name: 'Vostro 3681',
				price: 8597
			},
			{
				vendor: 'Lenovo',
				name: 'ThinkCentre M70s',
				price: 8640
			},
			{
				vendor: 'ASRock',
				name: 'DeskMini 470',
				price: 4298
			}
		],
		laptop: [
			{
				vendor: 'Xiaomi',
				name: 'Mi Notebook Air',
				price: 20400
			},
			{
				vendor: 'Dell',
				name: 'Latitude 7300',
				price: 17989
			},
			{
				vendor: 'Acer',
				name: 'Aspire A315-34',
				price: 6034
			},
			{
				vendor: 'Lenovo',
				name: 'IdeaPad 3 15IIL05',
				price: 8865
			},
			{
				vendor: 'Lenovo',
				name: 'IdeaPad 3 15ADA05',
				price: 6480
			},
			{
				vendor: 'ASUS',
				name: 'FX506LH',
				price: 15828
			},
			{
				vendor: 'HP',
				name: '250 G8',
				price: 9453
			},
			{
				vendor: 'Acer',
				name: 'Travel Mate TMP215-53',
				price: 9712
			}
		]
	};

	const param = Object.fromEntries(new URLSearchParams(location.search).entries());

	for (const p in param) {
		if (param[p].trim() == '') {
			delete param[p];
		}
		else {
			param[p] = param[p].toLowerCase();
		}
	}
	
	const items = [];
	
	{
		const predicates = [];
		
		if ('search' in param) {
			const regex = new RegExp(param.search.trim().split(/\s+/).map(x => `(?=.*${x})`).join(''), 'i');
			predicates.push(x => regex.test(x.name));
		}
		
		if ('vendor' in param) {
			predicates.push(x => x.vendor.toLowerCase() == param.vendor);
		}
		
		function assignPushEntry(category, entry, i) {
			entry.id = i + 1;
			entry.category = category;
			entry.img = `img/products/${category}/${i + 1}.jpg`;

			for (const predicate of predicates) {
				if (!predicate(entry)) {
					return;
				}
			}
			
			items.push(entry);
		}
		
		if (param.view in products) {
			document.query.view.value = param.view;
			products[param.view].forEach((x, i) => assignPushEntry(param.view, x, i));
			
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
				laptop: 'Laptopuri'
			};
			
			produse.innerText = titles[param.view];
			document.title = `${titles[param.view]} | Magazin Hardware`;
		}
		else {
			let defaultTitle = produse.innerText;
			let keys = Object.keys(products);
			
			assignTitle: {
				if (param.view == 'hardware') {
					keys = keys.filter(x => x != 'pc' && x != 'laptop');
				}
				else if (param.view == 'computer') {
					keys = keys.filter(x => x == 'pc' || x == 'laptop');
				}
				else {
					break assignTitle;
				}
				
				const titles = {
					hardware: 'Piese',
					computer: 'Calculatoare'
				};
				
				defaultTitle += ` (${titles[param.view]})`;
				
				produse.innerText = defaultTitle;
				document.title = `${defaultTitle} | Magazin Hardware`;
				document.query.view.value = param.view;
			}
			
			for (const category of keys) {
				products[category].forEach((x, i) => assignPushEntry(category, x, i));
			}
		}
		
		{
			const map = new Map();
			const select = document.query.vendor;
			
			items.forEach(x => map.set(x.vendor, map.has(x.vendor) ? map.get(x.vendor) + 1 : 1));

			[...map].sort((a, b) => b[1] - a[1]).forEach(x => {
				const option = new Option(`${x[0]} (${x[1]})`, x[0]);
				
				if (param.vendor === x[0].toLowerCase()) {
					option.selected = true;
				}
				
				select.add(option);
			});
		}
		
		{
			function paging(limit, page) {
				const count = Math.ceil(items.length / limit);

				items.splice(0, limit * page);

				if (items.length > limit) {
					items.length = limit;
				}
				
				const btnTemplate = paginationTemplate.content.querySelector('button.pagination');	
				const container = paginationTemplate.parentNode;
				
				for (let i = 0; i < count; ++i) {
					const btn = btnTemplate.cloneNode(true);
					btn.value = i;
					
					if (page == i) {
						btn.classList.add('selected');
					}
					
					container.append(btn);
				}
			}

			setPaging: {
				if ('limit' in param) {
					for (const x of document.query.limit) {
						if (x.value == param.limit) {
							x.checked = true;
							
							if (param.limit != 'nan') {
								paging(+param.limit, 'page' in param ? +param.page : 0);
							}
						
							break setPaging;
						}
					}
				}
			
				paging(16, 0);
			}
		}
	}
	
	{
		if ('sort' in param) {
			const sortOp = param.sort.split('_').map(x => +x);
			
			if (sortOp.length >= 2) {
				document.query.sort.value = param.sort;

				switch (sortOp[0]) {
					case 0:
						switch (sortOp[1]) {
							case 1:
								items.reverse();
								break;
						}
						break;
						
					case 1:
						switch (sortOp[1]) {
							case 0:
								items.sort((a, b) => a.price - b.price);
								break;
								
							case 1:
								items.sort((a, b) => b.price - a.price);
								break;
						}
						break;
				}
			}
		}

		const template = itemEntryTemplate.content.querySelector('.showcase-item');
		const showcase = document.querySelector('.showcase');
		document.query.search.placeholder = 0 in items ? items[0].name : 'Primul model găsit va apărea aici';

		for (const item of items) {
			const showcaseItem = template.cloneNode(true);
			const btn = showcaseItem.querySelector(':scope > .add');
			
			showcaseItem.querySelector(':scope > img').src = item.img;
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
					updateCart({ ...item, count: input.valueAsNumber });
				}
			};
			
			showcaseItem.onmouseenter = () => input.value = 1;
			
			showcase.append(showcaseItem);
		}
	}
}