<?php
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: /login");
    exit();
}

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$stmt = $user->getAllUsers();
?>

<div class="container table-container">
	<h2 class="text-center">All Users</h2>
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
					<td>
						<?php 
							if($row['is_admin']) {
								echo '<i title="ADMIN" class="fa-solid fa-star text-warning"></i> ';
							}
							echo htmlspecialchars($row['first_name']);
						?>
					</td>
					<td><?=htmlspecialchars($row['last_name']);?></td>
					<td><?=htmlspecialchars($row['email']);?></td>
					<td>
						<?php 
							// Могат да се изтриват само потребители които не са админи
							if(!$row['is_admin']) {
								echo '
									<button data-userId="' . $row['id'] . '" type="button" class="btn btn-warning promote-user-button"><i title="Make Admin" class="fa-solid fa-star"></i> Make Admin</button>
									<button data-userId="' . $row['id'] . '" type="button" class="btn btn-danger delete-user-button"><i title="Delete" class="fa-solid fa-trash"></i> Delete</button>
								';
							}
						?>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
