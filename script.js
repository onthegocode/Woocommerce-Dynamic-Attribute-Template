//Optimized Code

const checkout = {
  bill: ["billing_first_name","billing_last_name","billing_address_1","billing_city","billing_state","billing_postcode","billing_phone","billing_email","additional_referral"],
  ship: ["shipping_address_1","shipping_city","shipping_state","shipping_postcode","shipping_phone","shipping_first_name","shipping_last_name"]
}
  checkout.bill.forEach(mov => document.getElementById(mov).value="");
  checkout.ship.forEach(mov => document.getElementById(mov).value="");
  document.getElementById('ship-to-different-address-checkbox').checked = false;


//Old Code
//Variables
//Billing
// const firstName = document.getElementById("billing_first_name");
// const lastName = document.getElementById("billing_last_name");
// const addressOne = document.getElementById("billing_address_1");
// const city = document.getElementById("billing_city");
// const state = document.getElementById("billing_state");
// const zip = document.getElementById("billing_postcode");
// const phone = document.getElementById("billing_phone");
// const email = document.getElementById("billing_email");
// const referral = document.getElementById("additional_referral");

// //Shipping 
// const shipCheck = document.getElementById("ship-to-different-address-checkbox");
// const shipAddress = document.getElementById("shipping_address_1");
// const shipCity = document.getElementById("shipping_city");
// const shipState = document.getElementById("shipping_state");
// const shipZip = document.getElementById("shipping_postcode");
// const shipPhone = document.getElementById("shipping_phone");

// //Actions
// //Billing
// firstName.value = "";
// lastName.value = "";
// addressOne.value = "";
// city.value = "";
// state.value = "";
// zip.value= "";
// phone.value = "";
// email.value = "";

// //Shipping
// shipCheck.checked = false;
// shipAddress.value = "";
// shipCity.value = "";
// shipState.value = "";
// shipZip.value = "";
// shipPhone.value = "";

// //Additional Fields
// referral.value = "";


