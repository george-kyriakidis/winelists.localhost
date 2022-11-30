// Validation for customers info
document.addEventListener('DOMContentLoaded', () => {
	const $fullName = document.querySelector('#fullName');
	const $phone = document.querySelector('#phone');
	const $email = document.querySelector('#email');
	const $vatNumber = document.querySelector('#vatNumber');
	const $activity = document.querySelector('#activity');
	const $currentCustomer = document.querySelector('#customer_id');

	const $customerSubmit = document.querySelector('#customerSubmit');

	const $fullNameError = document.querySelector('.alert-fullName');
	const $phoneError = document.querySelector('.alert-phone');
	const $emailError = document.querySelector('.alert-email');
	const $vatError = document.querySelector('.alert-vat');
	const $activityError = document.querySelector('.alert-activity');

	let fullNameIsValid = false;
	let phoneIsValid = false;
	let emailIsValid = false;
	let vatIsValid = false;
	let activityIsValid = false;

	const getFullNameIsValid = (fullName) => {
		if (
			fullName !== '' &&
			/^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/.test(fullName)
		) {
			fullNameIsValid = true;
		} else {
			fullNameIsValid = false;
		}
	};

	const getPhoneIsValid = (phone) => {
		if (phone !== '' && /^\d{10}$/.test(phone)) {
			phoneIsValid = true;
		} else {
			phoneIsValid = false;
		}
	};

	const getEmailIsValid = (email) => {
		if (
			email !== '' &&
			/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)
		) {
			emailIsValid = true;
		} else {
			emailIsValid = false;
		}
	};

	const getVatIsValid = (vat) => {
		if (vat !== '' && /^\d{9}$/.test(vat)) {
			vatIsValid = true;
		} else {
			vatIsValid = false;
		}
	};

	const getActivityIsValid = (activity) => {
		if (activity !== '0') {
			activityIsValid = true;
		} else {
			activityIsValid = false;
		}
	};

	const checkForSubmitBtn = () => {
		if (
			fullNameIsValid &&
			phoneIsValid &&
			emailIsValid &&
			vatIsValid &&
			activityIsValid
		) {
			$customerSubmit.classList.remove('disabled');
		} else {
			$customerSubmit.classList.add('disabled');
		}
	};

	// Validation for current customer
	const currentCustomerValue = $currentCustomer.value;
	if (currentCustomerValue != '') {
		$fullNameError.classList.add('d-none');
		$phoneError.classList.add('d-none');
		$emailError.classList.add('d-none');
		$vatError.classList.add('d-none');
		$activityError.classList.add('d-none');

		fullNameIsValid = true;
		phoneIsValid = true;
		emailIsValid = true;
		vatIsValid = true;
		activityIsValid = true;

		checkForSubmitBtn();
	}

	$fullName.addEventListener('input', (e) => {
		getFullNameIsValid(e.target.value);

		if (fullNameIsValid) {
			$fullNameError.classList.add('d-none');
		} else {
			$fullNameError.classList.remove('d-none');
		}

		checkForSubmitBtn();
	});

	$phone.addEventListener('input', (e) => {
		getPhoneIsValid(e.target.value);

		if (phoneIsValid) {
			$phoneError.classList.add('d-none');
		} else {
			$phoneError.classList.remove('d-none');
		}

		checkForSubmitBtn();
	});

	$email.addEventListener('input', (e) => {
		getEmailIsValid(e.target.value);

		if (emailIsValid) {
			$emailError.classList.add('d-none');
		} else {
			$emailError.classList.remove('d-none');
		}

		checkForSubmitBtn();
	});

	$vatNumber.addEventListener('input', (e) => {
		getVatIsValid(e.target.value);

		if (vatIsValid) {
			$vatError.classList.add('d-none');
		} else {
			$vatError.classList.remove('d-none');
		}

		checkForSubmitBtn();
	});

	$activity.addEventListener('input', (e) => {
		getActivityIsValid(e.target.value);

		if (activityIsValid) {
			$activityError.classList.add('d-none');
		} else {
			$activityError.classList.remove('d-none');
		}

		checkForSubmitBtn();
	});
});
