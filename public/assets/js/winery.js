document.addEventListener('DOMContentLoaded', () => {
	// A validation for varietes.
	// When a user chooses two or three of the varieties, the "blended" area will be disabled.
	const $varietyOne = document.querySelector('#varietyOne');
	const $varietyTwo = document.querySelector('#varietyTwo');
	const $varietyThree = document.querySelector('#varietyThree');
	const $blended = document.querySelector('#blended');

	var checked = 0;

	$varietyOne.addEventListener('change', (e) => {
		const $varietyOneValue = $varietyOne.value;

		if ($varietyOneValue > 0) {
			checked++;
		} else {
			checked--;
		}
		checkBlended();
	});

	$varietyTwo.addEventListener('change', (e) => {
		const $varietTwoValue = $varietyTwo.value;

		if ($varietTwoValue > 0) {
			checked++;
		} else {
			checked--;
		}
		checkBlended();
	});

	$varietyThree.addEventListener('change', (e) => {
		const $varietThreeValue = $varietyThree.value;

		if ($varietThreeValue > 0) {
			checked++;
		} else {
			checked--;
		}
		checkBlended();
	});

	const checkBlended = () => {
		if (checked >= 2) {
			$blended.setAttribute('disabled', 'disabled');
		} else {
			$blended.removeAttribute('disabled', 'disabled');
		}
	};
});
