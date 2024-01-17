'use strict';

(async () => {
	const carouselContainers = document.getElementsByClassName('carousel-container');
	
	for (const container of carouselContainers) {
		const carousel = document.createElement('div');
		carousel.className = 'carousel';
		
		const bullets = document.createElement('div');
		bullets.className = 'carousel-bullets';
		
		container.append(carousel, bullets);
		
		const carouselMove = newIdx => {
			bullets.children[container.dataset.idx].classList.remove('selected');
			
			if (newIdx === true) {
				if (container.dataset.idx == carousel.childElementCount - 1) {
					container.dataset.idx = 0;
				}
				else {
					++container.dataset.idx;
				}
			}
			else if (newIdx === false) {
				if (container.dataset.idx == 0) {
					container.dataset.idx = carousel.childElementCount - 1;
				}
				else {
					--container.dataset.idx;
				}
			}
			else {
				container.dataset.idx = newIdx;
			}

			bullets.children[container.dataset.idx].classList.add('selected');
			carousel.style.setProperty('--idx', container.dataset.idx);
		};
		
		const carousels = await (await fetch('/img?carousels')).json();
		
		for (let i = 0; i < carousels.length; ++i) {
			const bullet = document.createElement('span');
			bullet.className = 'carousel-bullet';
			bullet.onclick = () => carouselMove(i);
			bullets.append(bullet);
			
			const img = document.createElement('img');
			img.src = `/img?carousel=${carousels[i]}`;
			carousel.append(img);
		}
		
		bullets.children[0].classList.add('selected');
		
		const left = document.createElement('div');
		left.className = 'left carousel-arrow';
		left.onclick = () => carouselMove(false);
		container.append(left);
	
		const right = document.createElement('div');
		right.className = 'right carousel-arrow';
		right.onclick = () => carouselMove(true);
		container.append(right);
		
		const targetBtn = container.dataset.auto == 'left' ? left : right;
		
		(async () => {
			for (; ; ) {
				await new Promise(r => setTimeout(r, 7500));
				targetBtn.click();
			}
		})();
	}
})();