'use strict';

{
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
				if (container.dataset.idx == container.dataset.mx) {
					container.dataset.idx = 0;
				}
				else {
					++container.dataset.idx;
				}
			}
			else if (newIdx === false) {
				if (container.dataset.idx == 0) {
					container.dataset.idx = container.dataset.mx;
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
		
		for (let i = 0; i <= container.dataset.mx; ++i) {
			const bullet = document.createElement('span');
			bullet.className = 'carousel-bullet';
			bullet.onclick = () => carouselMove(i);
			bullets.append(bullet);
			
			const img = document.createElement('img');
			img.src = `${container.dataset.imgPath}${i}.jpg`;
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
		
		let targetBtn;
		
		if (container.dataset.auto == 'left') {
			targetBtn = left;
		}
		else if (container.dataset.auto == 'right') {
			targetBtn = right;
		}
		else {
			continue;
		}
		
		(async () => {
			for (; ; ) {
				await new Promise(r => setTimeout(r, 7500));
				targetBtn.click();
			}
		})();
	}
}