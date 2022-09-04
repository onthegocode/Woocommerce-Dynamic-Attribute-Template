// USA Filter Categories if they don't contain USA made products

	let catDescriptionID = document.querySelector('.foldable-link').querySelectorAll('span');
	let nUSA = 'notusa';
	for(let i of catDescriptionID) {
		if (i.querySelector('p') && i.querySelector('p').textContent === nUSA) {
			console.log(i.querySelector('p').textContent);
			let idName = 'cat'+i.classList.value;
			document.getElementById(idName).parentElement.classList.add('usa-remove__cat');
		}
	}
	
// 	Sub Category
	
	let catSubDescriptionID = document.getElementsByClassName(nUSA);
	
	for (let i of catSubDescriptionID) {
		i.parentElement.classList.add('usa-remove__cat');
	}
	let madeUSANONE = document.getElementsByClassName('usa-remove__cat');
	if(usaMadeInInput.checked) {
		for (let i of madeUSANONE) {
			i.style.display = 'none';
		}
	}
