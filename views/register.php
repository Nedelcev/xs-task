<div class="container">
	<div class="form-container">
		<h2>Register</h2>
		<form id="register-form" action="../controllers/RegisterController.php" method="post">
			<div class="form-group">
				<label for="first_name">First Name</label>
				<input type="text" class="form-control" id="first_name" name="first_name" required>
			</div>
			<div class="form-group">
				<label for="last_name">Last Name</label>
				<input type="text" class="form-control" id="last_name" name="last_name" required>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" required onkeyup="checkPasswordStrength()">
				<small id="passwordHelp" class="form-text text-muted">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</small>
			</div>
			<div class="progress">
				<div id="passwordStrengthBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<div class="form-group mt-2">
				<label for="confirm_password">Confirm Password</label>
				<input type="password" class="form-control" id="confirm_password" name="confirm_password" required onkeyup="checkPasswordMatch()">
				<div id="passwordMatch" class="mt-2"></div>
			</div>
			<button type="submit" id="register-button" class="btn btn-primary btn-block">Register</button>
		</form>
		<div class="text-center mt-3">
			<p>Already have an account? <a href="login">Login here</a></p>
		</div>
	</div>
</div>
