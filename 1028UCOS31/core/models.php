<?php 

function insertNewUser($pdo, $username, $first_name, $last_name, $password) {

	$checkUserSql = "SELECT * FROM user_accounts WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO user_accounts (username, first_name, last_name, password) VALUES(?,?,?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $first_name, $last_name, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully inserted";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query";
		}

	}
	else {
		$_SESSION['message'] = "User already exists";
	}

}


function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM user_accounts WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$userIDFromDB = $userInfoRow['user_id']; 
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['user_id'] = $userIDFromDB;
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM user_accounts WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_accounts";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}


function insertNewPost($pdo, $title, $body, $user_id) {

	$sql = "INSERT INTO user_posts (title, body, user_id) VALUES (?,?,?)";
	$stmt = $pdo->prepare($sql);

	if ($stmt) {
		return $stmt->execute([$title,$body,$user_id]);
	}
}

function editAPost($pdo, $title, $body, $user_post_id) {

	$sql = "UPDATE user_posts SET title = ?, body = ? WHERE user_post_id = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt) {
		return $stmt->execute([$title,$body,$user_post_id]);
	}

}

function deleteAPost($pdo, $user_post_id) {

	$sql = "DELETE FROM user_posts WHERE user_post_id = ?";
	$stmt = $pdo->prepare($sql);

	if ($stmt) {
		return $stmt->execute([$user_post_id]);
	}

}

function getAllPosts($pdo) {

	$sql = "SELECT
				user_posts.user_post_id AS user_post_id,
				user_posts.user_id AS user_id,
				CONCAT(user_accounts.first_name, ' ' , 
					user_accounts.last_name) AS userFullName,
				user_posts.title AS title,
				user_posts.body AS body,
				user_posts.date_added AS date_added
			FROM user_posts
			JOIN user_accounts ON
				user_posts.user_id = user_accounts.user_id
			";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute()) {
		return $stmt->fetchAll();
	}
}

function getPostByID($pdo, $user_post_id) {

	$sql = "SELECT
				user_posts.user_post_id AS user_post_id,
				user_posts.user_id AS user_id,
				CONCAT(user_accounts.first_name, ' ' , 
					user_accounts.last_name) AS userFullName,
				user_posts.title AS title,
				user_posts.body AS body,
				user_posts.date_added AS date_added
			FROM user_posts
			JOIN user_accounts ON
				user_posts.user_id = user_accounts.user_id
			WHERE user_post_id = ?
			";
	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$user_post_id])) {
		return $stmt->fetch();
	}
}

function getAllPostsByUser($pdo, $user_id) {

	$sql = "SELECT
				user_posts.user_post_id AS user_post_id,
				user_posts.user_id AS user_id,
				CONCAT(user_accounts.first_name, ' ' , 
					user_accounts.last_name) AS userFullName,
				user_posts.title AS title,
				user_posts.body AS body,
				user_posts.date_added AS date_added
			FROM user_posts
			JOIN user_accounts ON
				user_posts.user_id = user_accounts.user_id
			WHERE user_posts.user_id = ?";

	$stmt = $pdo->prepare($sql);

	if ($stmt->execute([$user_id])) {
		return $stmt->fetchAll();
	}
}



?>