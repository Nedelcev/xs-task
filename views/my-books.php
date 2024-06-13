<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

$database = new Database();
$db = $database->getConnection();
$user_id = $_SESSION['user_id'];

$query = "SELECT books.id, books.name, books.isbn, books.description FROM user_books JOIN books ON user_books.book_id = books.id WHERE user_books.user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
?>

<div class="container table-container">
	<h2 class="text-center">My Books</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>ISBN</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
				<tr>
					<td><?=htmlspecialchars($row['name']);?></td>
					<td><?=htmlspecialchars($row['isbn']);?></td>
					<td><?=htmlspecialchars($row['description']);?></td>
					<td>
						<button data-bookId="<?=$row['id'];?>" type="button" class="btn btn-danger remove-book-from-collection">Remove</button>
					</td>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>
