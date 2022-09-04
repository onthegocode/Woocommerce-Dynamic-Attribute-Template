const usaMadeInInput = document.querySelector('.made__in--usa-input1');
const madeInTheUSAInput = document.querySelector('.made__in--usa-label1');
const madeInUSACount = document.querySelector('.wpf_item_count');
let usaSwitchFunc = () => {document.querySelector('.iCheck-helper')?.click();
							  };
// 	if(document.querySelector('.woof_checkbox_term_6391').checked) {
// 								  usaMadeInInput.checked = true;
// 							  } else {
// 								    usaMadeInInput.checked = false;
// 							  }
madeInTheUSAInput.addEventListener('click', usaSwitchFunc);
	// Check on load
// window.onload = function() {
//   $(function(){
//     var test = localStorage.usaMadeInInput === 'true'? true: false;
//     $('input').prop('checked', test || false);
// 	});

// 	$('input').on('change', function() {
// 		localStorage.usaMadeInInput = $(this).is(':checked');
// 		console.log($(this).is(':checked'));
// 	});
// };

// 	CHECKBOX
let isUSACheck;
if(window.location.href === 'https://typkup.com/shop/' ) {
  isUSACheck = false;
} else {
  isUSACheck = JSON.parse(localStorage.getItem('isUSACheck')) === true ? true : window.location.href.indexOf('product_tag=usa') > 0 ? true : false;
}
localStorage.setItem('isUSACheck', isUSACheck)
console.log(isUSACheck);
document.querySelector('.made__in--usa-label1').addEventListener('click', () => console.log('clicked'));
let isUSACheck_d = JSON.parse(localStorage.getItem('isUSACheck'));	
	
if (isUSACheck_d && window.location.href.indexOf('product_tag=usa') < 0 ) {
	 window.location.assign(window.location.href+'?swoof=1&product_tag=usa');
}
if (window.location.href.indexOf('product_tag=usa') > 0) {
    document.getElementById('switch').checked = true;
    madeInTheUSAInput.addEventListener('click', () => {
		isUSACheck = false; 
		localStorage.setItem('isUSACheck', isUSACheck);
		if (window.location.href.indexOf('&really_curr_tax=') > 0) {
// 			console.log(true);
			window.location.replace(window.location.href.split('?')[0]);
		} else {
			window.location.assign(window.location.href.split('?')[0]);
		}	
	});
}
	
// if (document.getElementById('switch').checked && window.location.href.indexOf('product_tag=usa') < 0) {
// 	window.location.assign(window.location.href+"/?swoof=1&product_tag=usa");
// 	console.log(window.location.href);
// 	console.log(document.getElementById('switch').checked)
// 	} else {
// 		console.log(window.location.href);
// 		console.log(document.getElementById('switch').checked)
// }
