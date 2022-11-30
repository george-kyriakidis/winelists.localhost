// Calculate discount of current wine and display total price on page
document.addEventListener('DOMContentLoaded', () => {
	const $price = document.querySelectorAll('#price');
	const $discountInput = document.querySelectorAll('.discount-input');
	const $totalPrice = document.querySelectorAll('#totalPrice');

	for (let index = 0; index < $discountInput.length; index++) {
		$discountInput[index].addEventListener('input', (e) => {
			const priceValue = parseFloat($price[index].textContent);
			const discount = e.target.value;
			const totalPrice = priceValue - (priceValue * discount) / 100;
			// Check if discount input is number or not
			if (isNaN(discount)) {
				return;
			} else {
				// Check if discount is over 100% or not
				if (discount <= 100) {
					$totalPrice[index].innerHTML = parseFloat(totalPrice).toFixed(2);
				} else {
					$totalPrice[index].innerHTML = '';
				}
			}
		});
	}
});
