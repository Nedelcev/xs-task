<?php
// Проверка дали файла е инклуднат от index-a или е достъпен директно през URL-a
if(!isset($isIncluded) || !$isIncluded) {
	header("Location: /home");
    exit();
}

$database = new Database();
$db = $database->getConnection();
$book = new Book($db);
$stmt = $book->readAll();

// Функция за проверка дали книгата е в колекцията на потребителя
function isBookInCollection($db, $user_id, $book_id) {
    $query = "SELECT * FROM user_books WHERE user_id = :user_id AND book_id = :book_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':book_id', $book_id);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}
?>

<div class="container table-container">
	<h2 class="text-center"><i title="Books" class="fa-solid fa-book"></i> Books</h2>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Name</th>
				<th>ISBN</th>
				<th>Description</th>
				<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id']) : ?>
					<th>Actions</th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
				<tr>
					<td><?php echo htmlspecialchars($row['name']); ?></td>
					<td><?php echo htmlspecialchars($row['isbn']); ?></td>
					<td><?php echo htmlspecialchars($row['description']); ?></td>
					<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id']) : ?>
						<td>
							<?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) : ?>
								<form action="/edit-book/" method="get" style="display:inline;">
									<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
									<button type="submit" class="btn btn-warning"><i title="Edit" class="fa-solid fa-edit"></i></button>
								</form>
                            <?php endif; ?>
							<?php if (isBookInCollection($db, $_SESSION['user_id'], $row['id'])) : ?>
								<button data-bookId="<?php echo $row['id']; ?>" type="button" class="btn btn-danger remove-book-from-collection"><i title="Remove from My Collection" class="fa-solid fa-heart"></i></button>
							<?php else : ?>
								<button data-bookId="<?php echo $row['id']; ?>" type="button" class="btn btn-success add-book-to-collection"><i title="Remove from My Collection" class="fa-solid fa-heart"></i></button>
							<?php endif; ?>
						</td>
					<?php endif; ?>
				</tr>
			<?php endwhile; ?>
		</tbody>
	</table>
</div>

