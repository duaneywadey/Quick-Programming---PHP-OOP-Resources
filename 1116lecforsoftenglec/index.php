<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles/styles.css">
</head>
<body>
	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>

	<div class="greeting">
		<h1>Hello theree! Welcome, <span style="color: blue;"><?php echo $_SESSION['username']; ?></span></h1>
	</div>
	<?php include 'navbar.php'; ?>

	<div class="searchForm">
		<form action="index.php" method="GET">
			<p>
				<input type="text" name="searchQuery" placeholder="Search here">
				<input type="submit" name="searchBtn" value="Search">
				<h3><a href="index.php">Search Again</a></h3>	
			</p>
		</form>
	</div>

	<div class="tableClass">
		<table style="width: 100%;">
			<tr>
				<th>Address</th>
				<th>Head Manager</th>
				<th>Contact Number</th>
				<th>Date Added</th>
				<th>Added By</th>
				<th>Last Updated</th>
				<th>Last Updated By</th>
				<th>Action</th>
			</tr>
			<?php if (!isset($_GET['searchBtn'])) { ?>
				<?php $getAllBranches = getAllBranches($pdo); ?>
				<?php foreach ($getAllBranches as $row) { ?>
				<tr>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['head_manager']; ?></td>
					<td><?php echo $row['contact_number']; ?></td>
					<td><?php echo $row['date_added']; ?></td>
					<td><?php echo $row['added_by']; ?></td>
					<td><?php echo $row['last_updated']; ?></td>
					<td><?php echo $row['last_updated_by']; ?></td>
					<td>
						<a href="updatebranch.php?branch_id=<?php echo $row['branch_id']; ?>">Update</a>
					</td>
				</tr>
				<?php } ?>
			<?php } else { ?>
				<?php $getAllBranchesBySearch = getAllBranchesBySearch($pdo, $_GET['searchQuery']); ?>
				<?php foreach ($getAllBranchesBySearch as $row) { ?>
				<tr>
					<td><?php echo $row['address']; ?></td>
					<td><?php echo $row['head_manager']; ?></td>
					<td><?php echo $row['contact_number']; ?></td>
					<td><?php echo $row['date_added']; ?></td>
					<td><?php echo $row['added_by']; ?></td>
					<td><?php echo $row['last_updated']; ?></td>
					<td><?php echo $row['last_updated_by']; ?></td>
					<td>
						<a href="updatebranch.php?branch_id=<?php echo $row['branch_id']; ?>">Update</a>
					</td>
				</tr>
				<?php } ?>
			<?php } ?>
		</table>
	</div>
	
</body>
</html>