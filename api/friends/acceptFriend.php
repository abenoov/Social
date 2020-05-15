<?php 
	include "../../db.php";
	include "../../config.php";
	session_start();

	if (isset($_SESSION["user_id"])) {

		$user_id = $_SESSION["user_id"];

			if(isset($_POST["friend_id"])){

				$friend_id = $_POST["friend_id"];

				$db->query("UPDATE friendRequest SET approved = 1, isActive = 0 WHERE friend_id = '$friend_id' AND isActive = 1");
				echo true;

				$db->query("INSERT INTO friends(user_id, friend_id) VALUES('$user_id', '$friend_id')");
				echo true;
			} else {
				
				
			}

	} else {
		// header("Location: $base_url"."signup.php?error=1");z
	}
 ?>