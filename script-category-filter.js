// USA Filter Categories if they don't contain USA made products

	let catDescriptionID = document.querySelector('.foldable-link').querySelectorAll('span');
	
	for(let i of catDescriptionID) {
		if (i.querySelector('p') && i.querySelector('p').textContent === 'usa') {
			console.log(i.querySelector('p').textContent);
			let idName = 'cat'+i.classList.value;
			document.getElementById(idName).parentElement.classList.add('usa-remove__cat');
		}
	}
	let madeUSANONE = document.getElementsByClassName('usa-remove__cat');
	if(usaMadeInInput.checked) {
		for (let i of madeUSANONE) {
			i.style.display = 'none';
		}
	} 
