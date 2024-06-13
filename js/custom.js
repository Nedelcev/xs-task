$(document).ready(function() {
	// Логиката за админ менюто
	const adminMenuToggle = $('#admin-menu-toggle');
	const adminMenu = $('#admin-menu');

	if(adminMenuToggle.length > 0) {
		adminMenuToggle.on("click", function() {
		  adminMenuToggle.toggleClass("open");
		  adminMenu.toggleClass('open');
		});
	}
	
	// Формата за регистрацията
	const registerForm = $('#register-form');
	if(registerForm.length > 0) {
		console.log(registerForm);
		registerForm.on('submit', function(e) {
			console.log(e);
			e.preventDefault();

			$.ajax({
				type: 'POST',
				url: '../controllers/RegisterController.php',
				data: $(this).serialize(),
				dataType: 'json',
				success: function(response) {
					if (response.success) {
						$("#register-button").prop("disabled", true);
						$('#success-message').text(response.successMessage).show();
						setInterval(function () {
							$("#success-message").fadeOut(500);
							window.location.href = '/home';
						}, 3000);  
					} else {
						$('#error-message').text(response.error).show();
						$("#error-message").delay(3000).fadeOut(500);
					}
				}
			});
		});
	}
	
	// Формата за вход
	const loginForm = $('#login-form');
	loginForm.on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: '../controllers/LoginController.php',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					window.location.href = '/home';
				} else {
					$('#error-message').text(response.error).show();
					$("#error-message").delay(3000).fadeOut(500);
				}
			}
		});
	});
	
	// Форма за добавяне на книга
	const createBookForm = $('#create-book-form');
	createBookForm.on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: '../controllers/CreateBookController.php',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					$("#create-book-button").prop("disabled", true);
					$('#success-message').text(response.successMessage).show();
					setInterval(function () {
						$("#success-message").fadeOut(500);
						window.location.href = '/home';
					}, 3000);  
				} else {
					$('#error-message').text(response.error).show();
					$("#error-message").delay(3000).fadeOut(500);
				}
			}
		});
	});
	
	// Форма за редактиране на книга
	const editBookForm = $('#edit-book-form');
	editBookForm.on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: '../controllers/EditBookController.php',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					$("#edit-book-button").prop("disabled", true);
					$('#success-message').text(response.successMessage).show();
					setInterval(function () {
						$("#success-message").fadeOut(500);
						window.location.href = '/home';
					}, 3000);  
				} else {
					$('#error-message').text(response.error).show();
					$("#error-message").delay(3000).fadeOut(500);
				}
			}
		});
	});
	
	// Форма за редактиране на профила
	const editProfileForm = $('#edit-profile');
	editProfileForm.on('submit', function(e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: '../controllers/EditProfileController.php',
			data: $(this).serialize(),
			dataType: 'json',
			success: function(response) {
				if (response.success) {
					$("#edit-profile-button").prop("disabled", true);
					$('#success-message').text(response.successMessage).show();
					setInterval(function () {
						$("#success-message").fadeOut(500);
						location.reload();
					}, 3000);  
				} else {
					$('#error-message').text(response.error).show();
					$("#error-message").delay(3000).fadeOut(500);
				}
			}
		});
	});
	
	// Връзка със API-то за да се вземе информация за книга по ISBN
	const collectBookInformationButton = $('#collect-book-information');
	collectBookInformationButton.on('click', function(e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: '../controllers/CollectBookInformation.php',
			data: {isbn: $('#isbn').val()},
			dataType: 'json',
			beforeSend: function() {
				$("#result-loader").removeClass('displayNone');
				$("#search-icon").addClass('displayNone');
            },
			success: function(response) {
				$("#result-loader").addClass('displayNone');
				$("#search-icon").removeClass('displayNone');
				if (response && Object.keys(response).length !== 0 && !response.error) {
					$('#book-name').val(response.title);
					const publishers = response.publishers.map(item => `${item}`).toString();
					const bookDescription = 'This book is published by ' + publishers + '. The book is published on ' + response.publish_date;
					$('#book-description').val(bookDescription);
					$('#isbn').removeClass('lightcoralcolorInput');
					$('#book-name').addClass('lightgreencolorInput');
					$('#book-description').addClass('lightgreencolorInput');
				} else {
					$('#book-name').val(' ');
					$('#book-description').val(' ');
					$('#isbn').addClass('lightcoralcolorInput');
					$('#book-name').removeClass('lightgreencolorInput');
					$('#book-description').removeClass('lightgreencolorInput');
				}
			}
		});
	});
	
	// Форма за активиране на потребители
	const ActivateUserButton = $('.activate-user-button');
	ActivateUserButton.on('click', function(e) {
		e.preventDefault();

		if (confirm("Do you want to activate this User?")) {
			$.ajax({
				type: 'POST',
				url: '../controllers/ActivateUserController.php',
				data: {user_id: $(this).data("userid")},
				dataType: 'json',
				success: function(response) {
					location.reload();
				}
			});
		}
	});
	
	// Форма за изтриване на потребители
	const DeleteUserButton = $('.delete-user-button');
	DeleteUserButton.on('click', function(e) {
		e.preventDefault();

		if (confirm("Do you want to DELETE this User?")) {
			$.ajax({
				type: 'POST',
				url: '../controllers/DeleteUserController.php',
				data: {user_id: $(this).data("userid")},
				dataType: 'json',
				success: function(response) {
					location.reload();
				}
			});
		}
	});
	
	// Форма за добавяне на потребител като администратор
	const PromoteUserButton = $('.promote-user-button');
	PromoteUserButton.on('click', function(e) {
		e.preventDefault();

		if (confirm("Do you want to Promote this user to Admin? It is important to emphasize that the user must log out and log in again to see the admin menu!")) {
			$.ajax({
				type: 'POST',
				url: '../controllers/PromoteToAdminController.php',
				data: {user_id: $(this).data("userid")},
				dataType: 'json',
				success: function(response) {
					location.reload();
				}
			});
		}
	});
	
	// Премахване на книга от любими
	const RemoveBookFromCollectionButton = $('.remove-book-from-collection');
	RemoveBookFromCollectionButton.on('click', function(e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: '../controllers/RemoveBookFromCollectionController.php',
			data: {book_id: $(this).data("bookid")},
			dataType: 'json',
			success: function(response) {
				location.reload();
			}
		});
	});
	
	// Добавяне на книга в любими
	const AddBookToCollectionButton = $('.add-book-to-collection');
	AddBookToCollectionButton.on('click', function(e) {
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: '../controllers/AddBookToCollectionController.php',
			data: {book_id: $(this).data("bookid")},
			dataType: 'json',
			success: function(response) {
				location.reload();
			}
		});
	});
});

function checkPasswordStrength() {
	const password = document.getElementById('password').value;
	const strengthBar = document.getElementById('passwordStrengthBar');
	const strongPasswordPattern = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})');
	const mediumPasswordPattern = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})');

	let strength = 0;

	if (strongPasswordPattern.test(password)) {
		strength = 100;
	} else if (mediumPasswordPattern.test(password)) {
		strength = 60;
	} else {
		strength = 30;
	}

	strengthBar.style.width = strength + '%';
	strengthBar.setAttribute('aria-valuenow', strength);

	if (strength == 100) {
		strengthBar.classList.remove('bg-danger', 'bg-warning');
		strengthBar.classList.add('bg-success');
	} else if (strength == 60) {
		strengthBar.classList.remove('bg-danger', 'bg-success');
		strengthBar.classList.add('bg-warning');
	} else {
		strengthBar.classList.remove('bg-warning', 'bg-success');
		strengthBar.classList.add('bg-danger');
	}
}

function checkPasswordMatch() {
	const password = document.getElementById('password').value;
	const confirmPassword = document.getElementById('confirm_password').value;
	const matchIndicator = document.getElementById('passwordMatch');

	if (password === confirmPassword) {
		matchIndicator.innerHTML = '<span class="text-success">Passwords match</span>';
	} else {
		matchIndicator.innerHTML = '<span class="text-danger">Passwords do not match</span>';
	}
}

function checkEditPasswordStrength() {
	const password = document.getElementById('password').value;
	const strengthBar = document.getElementById('passwordEditStrengthBar');
	const confirmPasswordContainer = document.getElementById('confirmPasswordContainer');
	const strongPasswordPattern = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})');
	const mediumPasswordPattern = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{6,})');

	if (password.length > 0) {
		confirmPasswordContainer.style.display = 'block';
	} else {
		confirmPasswordContainer.style.display = 'none';
	}

	let editstrength = 0;

	if (strongPasswordPattern.test(password)) {
		editstrength = 100;
	} else if (mediumPasswordPattern.test(password)) {
		editstrength = 60;
	} else {
		editstrength = 30;
	}

	strengthBar.style.width = editstrength + '%';
	strengthBar.setAttribute('aria-valuenow', editstrength);

	if (editstrength == 100) {
		strengthBar.classList.remove('bg-danger', 'bg-warning');
		strengthBar.classList.add('bg-success');
	} else if (editstrength == 60) {
		strengthBar.classList.remove('bg-danger', 'bg-success');
		strengthBar.classList.add('bg-warning');
	} else {
		strengthBar.classList.remove('bg-warning', 'bg-success');
		strengthBar.classList.add('bg-danger');
	}
}

function checkEditPasswordMatch() {
	const password = document.getElementById('password').value;
	const confirmPassword = document.getElementById('confirm_password').value;
	const matchIndicator = document.getElementById('passwordMatch');

	if (password === confirmPassword) {
		matchIndicator.innerHTML = '<span class="text-success">Passwords match</span>';
	} else {
		matchIndicator.innerHTML = '<span class="text-danger">Passwords do not match</span>';
	}
}