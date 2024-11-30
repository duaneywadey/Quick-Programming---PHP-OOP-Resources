<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php  
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}

$getUserByID = getUserByID($pdo, $_SESSION['user_id']);

if ($getUserByID['is_admin'] == 1) {
	header("Location: admin/index.php");
}

if ($getUserByID['is_suspended'] == 1) {
	header("Location: suspended-account-error.php");
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
	<?php include 'navbar.php'; ?>
	<h1 style="text-align:center;">All Inquiries</h1>
	
	<?php $getAllInquiries = getAllInquiries($pdo);?>
	<?php foreach ($getAllInquiries as $row) { ?>
	<div class="inquiry" style="display: flex; justify-content: center; margin-top: 25px;">
		<div class="inquiryContainer" style="background-color: ghostwhite; border-style: solid; border-color: gray;width: 50%; padding: 25px;">
			<p><?php echo $row['description']; ?></p>
			<a href="see-all-replies.php" style="float: right;">See All Replies</a>
		</div>
	</div>
	<?php } ?>

</body>
</html>