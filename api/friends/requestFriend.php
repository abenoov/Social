<?php 
	include "../../db.php";
	include "../../config.php";
	session_start();

	if (isset($_SESSION["user_id"])) {

		$user_id = $_SESSION["user_id"];

			if(isset($_POST["friend_id"])){

				$friend_id = $_POST["friend_id"];

				$exist = $db->query("SELECT * FROM friendRequest WHERE user_id = $user_id AND friend_id = $friend_id OR friend_id = $user_id AND user_id = $friend_id");

				if ($exist->num_rows>0) {
					
				} else {

					$db->query("INSERT INTO friendRequest(user_id, friend_id) VALUES('$user_id', '$friend_id')");
				}
				header('Location: ' . $_SERVER["HTTP_REFERER"] );
				exit;
			} else {
				
				
			}

	} else {
		// header("Location: $base_url"."signup.php?error=1");
	}

 ?>