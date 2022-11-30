// Validation for Modal form
document.addEventListener('DOMContentLoaded', () => {
	const $dataInput = document.querySelector('#customer');
	const $winelistNameInput = document.querySelector('#winelistName');
	const $formToWinelistSubmit = document.querySelector('#formToWinelist');
	const $datalistError = document.querySelector('.alert-datalist');
	const $winelistNameError = document.querySelector('.alert-winelistName');

	let datalistInputIsValid = false;
	let winelistNameInputIsValid = false;

	const getDatalistIsValid = (datalist) => {
		if (datalist !== '0') {
			datalistInputIsValid = true;
		} else {
			datalistInputIsValid = false;
		}
	};

	const getWinelistNameIsValid = (winelistName) => {
		if (winelistName !== '' && /^[A-Za-z]+$/.test(winelistName)) {
			winelistNameInputIsValid = true;
		} else {
			winelistNameInputIsValid = false;
		}
	};

	const formToWinelistBtn = () => {
		if (datalistInputIsValid && winelistNameInputIsValid) {
			$formToWinelistSubmit.classList.remove('disabled');
		} else {
			$formToWinelistSubmit.classList.add('disabled');
		}
	};

	$dataInput.addEventListener('input', (e) => {
		getDatalistIsValid(e.target.value);

		if (datalistInputIsValid) {
			$datalistError.classList.add('d-none');
		} else {
			$datalistError.classList.remove('d-none');
		}

		formToWinelistBtn();
	});

	$winelistNameInput.addEventListener('input', (e) => {
		getWinelistNameIsValid(e.target.value);

		if (winelistNameInputIsValid) {
			$winelistNameError.classList.add('d-none');
		} else {
			$winelistNameError.classList.remove('d-none');
		}

		formToWinelistBtn();
	});
});
