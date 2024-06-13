<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst($controller);?> | XS Programming Challenge</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="/css/styles.css" rel="stylesheet">
	<!-- Favicons -->
	<link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
	<link rel="manifest" href="../images/site.webmanifest">
	<link rel="mask-icon" href="../images/safari-pinned-tab.svg" color="#5bbad5">
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top customColorStyle">
        <span class="navbar-brand" href="/home"><?=ucfirst($controller);?> | XS Programming Challenge</span>
		<ul class="navbar-nav ml-auto row">
			<li class="nav-item">
				<a class="nav-link" href="/home"><i title="Home" class="fa-solid fa-home"></i> Home</a>
			</li>
			<?php if (isset($_SESSION['user_id'])) : // USER is Logged IN ?>
				<li class="nav-item">
					<a class="nav-link" href="/edit-profile"><i title="Profile" class="fa-solid fa-user"></i> Profile</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/my-books"><i title="Profile" class="fa-solid fa-heart"></i> My Books</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/logout"><i title="Profile" class="fa-solid fa-sign-out"></i> Logout</a>
				</li>
			<?php endif; ?>
			<?php if (!isset($_SESSION['user_id'])) : // UnAuthorised User ?>
				<li class="nav-item">
					<a class="nav-link" href="/login">Login / Register</a>
				</li>
			<?php endif; ?>
		</ul>
    </nav>
	<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) : ?>
		<i class="fa fa-cog admin-menu-toggle" id="admin-menu-toggle"></i>
		<div class="admin-menu" id="admin-menu">
			<ul>
				<li>
					<a href="/admin/create-book">Create Book</a>
				</li>
				<li>
					<a href="/admin/users-list">All users</a>
				</li>
				<li>
					<a href="/admin/inactive-users">Accounts for activation</a>
				</li>
			</ul>
		</div>
	<?php endif; ?>
	<div id="error-message" class="alert alert-danger" style="display:none;"></div>
	<div id="success-message" class="alert alert-success" style="display:none;"></div>