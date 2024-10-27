<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
		<input type="text" name="searchInput">
		<input type="submit" name="searchBtn">
	</form>
	<a href="index.php">Clear Search Query</a>
	<table style="width:100%; margin-top: 20px;">
		<tr>
			<th>ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Gender</th>
			<th>Address</th>
			<th>State</th>
			<th>Nationality</th>
			<th>Car Brand</th>
			<th>Action</th>
		</tr>
		<?php 
		if (isset($_GET['searchBtn'])) { 
			$searchForAUser = searchForAUser($pdo, $_GET['searchInput']);
			foreach ($searchForAUser as $row) {
		?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['first_name']; ?></td>
					<td><?php echo $row['last_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['gender']; ?></td>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['state']; ?></td>
					<td><?php echo $row['nationality']; ?></td>
					<td><?php echo $row['car_brand']; ?></td>
					<td>
						<a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
						<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
					</td>
				</tr>
		<?php }} else { ?>

		<?php
			$getAllUsers = getAllUsers($pdo);
			foreach ($getAllUsers as $row) { 
		?>
				<tr>
					<td><?php echo $row['id']; ?></td>
					<td><?php echo $row['first_name']; ?></td>
					<td><?php echo $row['last_name']; ?></td>
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['gender']; ?></td>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['state']; ?></td>
					<td><?php echo $row['nationality']; ?></td>
					<td><?php echo $row['car_brand']; ?></td>
					<td>
						<a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
						<a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
					</td>
				</tr>

		<?php }} ?>  
	</table>

	<div class="hello">
	</div>

	<script>
		$('.hello').on('click', function (e) {
			alert($(this).text());
		})
	</script>
</body>
</html>