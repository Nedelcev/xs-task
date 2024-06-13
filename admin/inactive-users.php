<?php
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: /home");
    exit();
}

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$stmt = $user->getAllInactiveUsers();
?>

<div class="container table-container">
	<h2 class="text-center">Inactive Users</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
				<tr>
					<td><?php echo htmlspecialchars($row['first_name']); ?></td>
					<td><?php echo htmlspecialchars($row['last_name']); ?></td>
					<td><?php echo htmlspecialchars($row['email']); ?></td>
					<td>
						<button data-userId="<?php echo $row['id']; ?>" type="button" class="btn btn-success activate-user-button"><i title="Activate" class="fa-solid fa-check"></i> Activate</button>
						<button data-userId="<?php echo $row['id']; ?>" type="button" class="btn btn-danger delete-user-button"><i title="Delete" class="fa-solid fa-trash"></i> Delete</button>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
