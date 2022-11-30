// Calculate discount of current wine and display total price on page
document.addEventListener('DOMContentLoaded', () => {
	const $price = document.querySelector('#price');
	const $discountInput = document.querySelector('.discount-input');
	const $totalPrice = document.querySelector('#totalPrice');
	const $alert = document.querySelector('.alert');
	const $alertTwo = document.querySelector('#validDiscount');

	const priceValue = parseFloat($price.textContent);

	$discountInput.addEventListener('input', (e) => {
		const discount = parseFloat($discountInput.value);
		const priceWithDiscount = priceValue - (priceValue * discount) / 100;
		// Check if discount input is number or not
		if (isNaN(discount)) {
			$alert.classList.remove('d-none');
			$alertTwo.classList.add('d-none');
			return;
		} else {
			$alert.classList.add('d-none');
			// Check if discount is over 100% or not
			if (discount <= 100) {
				$totalPrice.innerHTML = parseFloat(priceWithDiscount).toFixed(2);
			} else {
				$alert.classList.remove('d-none');
				$alertTwo.classList.remove('d-none');
				$totalPrice.innerHTML = '';
			}
		}
	});
});
