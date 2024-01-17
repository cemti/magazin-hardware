'use strict';

addUpdate.id.onchange = async x => {
	const target = x.target;
	
	if (!target.validity.valid || target.value === '') {
		return;
	}

	const item = (await (await fetch(`/frag/fetchProducts.php?id=${target.value}`)).json()).items[0];
	
	if (item !== undefined) {
		addUpdate.vendor.value = item.vendor;
		addUpdate.model.value = item.name;
		addUpdate.price.value = item.price;
		addUpdate.category.value = [...addUpdate.category.options].filter(x => x.innerText === item.category)[0].value;
	}
}