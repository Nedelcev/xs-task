<div class="container">
	<div class="form-container">
		<h2>Create Book</h2>
		<form id="create-book-form" method="post">
			<div class="form-group">
				<div class="input-group mb-3">
					<input type="text" class="form-control" id="isbn" name="isbn" required placeholder="ISBN-10" aria-label="ISBN-10" aria-describedby="basic-addon2" autocomplete="off">
					<div class="input-group-append">
						<button id="collect-book-information" class="btn btn-outline-secondary" type="button">
							<span class="spinner-border spinner-border-sm displayNone" id="result-loader" role="status" aria-hidden="true"></span>
							<i title="Search" id="search-icon" class="fa-solid fa-search"></i> Check
						</button>
					</div>
				</div>
				<small id="isbnHelp" class="form-text text-muted">Provide valid ISBN and click "Check" to get book information. You can use every book from Amazon Books. Or user one of this ISBNs for example: 1338878921 / 1070527718 / 1538704439 / 1635575567</small>
			</div>
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="book-name" name="name" required>
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea class="form-control" id="book-description" name="description" rows="3" required></textarea>
			</div>
			<button type="submit" id="create-book-button" class="btn btn-primary btn-block">Create Book</button>
		</form>
	</div>
</div>
