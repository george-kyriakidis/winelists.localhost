// Validation for login form
document.addEventListener('DOMContentLoaded', () => {
	const $email = document.querySelector('#email');

	const $password = document.querySelector('#password');

	const $logInSubmit = document.querySelector('#login');

	const $emailError = document.querySelector('.alert-email');
	const $passwordError = document.querySelector('.alert-password');

	let emailIsValid = false;
	let passwordIsValid = false;

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

	const checkSigninBtn = () => {
		if (emailIsValid && passwordIsValid) {
			$logInSubmit.classList.remove('disabled');
		} else {
			$logInSubmit.classList.add('disabled');
		}
	};

	$email.addEventListener('input', (e) => {
		getEmailIsValid(e.target.value);

		if (emailIsValid) {
			$emailError.classList.add('d-none');
		} else {
			$emailError.classList.remove('d-none');
		}

		checkSigninBtn();
	});

	$password.addEventListener('input', (e) => {
		getPasswordIsValid(e.target.value);

		if (passwordIsValid) {
			$passwordError.classList.add('d-none');
		} else {
			$passwordError.classList.remove('d-none');
		}

		checkSigninBtn();
	});
});
