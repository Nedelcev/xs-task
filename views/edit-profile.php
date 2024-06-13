<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$user->id = $_SESSION['user_id'];
$user->getUserById();

?>

<div class="container">
	<div class="form-container">
		<h2>Edit Profile</h2>
		<form id="edit-profile" method="post">
			<div class="form-group">
				<label for="first_name">First Name</label>
				<input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user->first_name); ?>" required>
			</div>
			<div class="form-group">
				<label for="last_name">Last Name</label>
				<input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user->last_name); ?>" required>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" disabled class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user->email); ?>" required>
			</div>
			<div class="form-group">
				<label for="password">New Password (leave blank if you do not want to change)</label>
				<input type="password" class="form-control" id="password" name="password" onkeyup="checkEditPasswordStrength()">
				<small id="passwordHelp" class="form-text text-muted">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</small>
			</div>
			<div class="progress mb-2">
				<div id="passwordEditStrengthBar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
			</div>
			<div class="form-group mt-2" id="confirmPasswordContainer" style="display: none;">
				<label for="confirm_password">Confirm New Password</label>
				<input type="password" class="form-control" id="confirm_password" name="confirm_password" onkeyup="checkEditPasswordMatch()">
				<div id="passwordMatch" class="mt-2"></div>
			</div>
			<button type="submit" id="edit-profile-button" class="btn btn-primary btn-block">Save Changes</button>
		</form>
	</div>
</div>
