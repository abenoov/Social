<?php 
	include "../../db.php";
	include "../../config.php";
	session_start();

	if (isset($_SESSION["user_id"])) {

		$user_id = $_SESSION["user_id"];

			if(isset($_POST["friend_id"])){

				$friend_id = $_POST["friend_id"];

				$db->query("DELETE FROM friendRequest WHERE user_id = '$friend_id'");

				$db->query("INSERT INTO friends(user_id, friend_id) VALUES('$user_id', '$friend_id')");
				header('Location: ' . $_SERVER["HTTP_REFERER"] );
				exit;
			} else {
				
				
			}

	} else {
		// header("Location: $base_url"."signup.php?error=1");z
	}
 ?>