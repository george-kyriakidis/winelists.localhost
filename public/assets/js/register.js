// Validation for register form
document.addEventListener('DOMContentLoaded', () => {
	const $fullName = document.querySelector('#fullName');
	const $email = document.querySelector('#email');
	const $password = document.querySelector('#password');

	const $registerSubmit = document.querySelector('#register');

	const $fullNameError = document.querySelector('.alert-fullName');
	const $emailError = document.querySelector('.alert-email');
	const $passwordError = document.querySelector('.alert-password');

	let fullNameIsValid = false;
	let emailIsValid = false;
	let passwordIsValid = false;

	const getFullNameIsValid = (fullName) => {
		if (fullName !== '' && /^[A-Za-z]+$/.test(fullName)) {
			fullNameIsValid = true;
		} else {
			fullNameIsValid = false;
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

	const getPasswordIsValid = (password) => {
		if (password !== '' && password.length > 8) {
			passwordIsValid = true;
		} else {
			passwordIsValid = false;
		}
	};

	const checkRegisterBtn = () => {
		if (fullNameIsValid && emailIsValid && passwordIsValid) {
			$registerSubmit.classList.remove('disabled');
		} else {
			$registerSubmit.classList.add('disabled');
		}
	};

	$fullName.addEventListener('input', (e) => {
		getFullNameIsValid(e.target.value);

		if (fullNameIsValid) {
			$fullNameError.classList.add('d-none');
		} else {
			$fullNameError.classList.remove('d-none');
		}

		checkRegisterBtn();
	});

	$email.addEventListener('input', (e) => {
		getEmailIsValid(e.target.value);

		if (emailIsValid) {
			$emailError.classList.add('d-none');
		} else {
			$emailError.classList.remove('d-none');
		}

		checkRegisterBtn();
	});

	$password.addEventListener('input', (e) => {
		getPasswordIsValid(e.target.value);

		if (passwordIsValid) {
			$passwordError.classList.add('d-none');
		} else {
			$passwordError.classList.remove('d-none');
		}

		checkRegisterBtn();
	});
});
