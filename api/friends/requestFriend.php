<?php 
	include "../../db.php";
	include "../../config.php";
	session_start();

	if (isset($_SESSION["user_id"])) {

		$user_id = $_SESSION["user_id"];

			if(isset($_POST["friend_id"])){

				$friend_id = $_POST["friend_id"];

				$db->query("INSERT INTO friendRequest(user_id, friend_id) VALUES('$user_id', '$friend_id')");
				echo true;
			} else {
				
				
			}

	} else {
		// header("Location: $base_url"."signup.php?error=1");
	}

 ?>