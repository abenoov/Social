<?php 
	include "../../db.php";
	include "../../config.php";

	session_start();
	if (isset($_SESSION["user_id"]) &&
		isset($_POST["post_id"])) {

		$user_id = $_SESSION["user_id"];
		$post_id = $_POST["post_id"];


		$exist = $db->query("SELECT * FROM likes WHERE post_id = $post_id");

		$output = array();
		
		if($exist->num_rows > 0){
			$output = array(
				"pressed"=> true
			);
		} else {
			$exist = $db->query("INSERT INTO likes(post_id, user_id) VALUES($post_id, $user_id)");
			$output = array(
				"pressed"=> true
			);
		}
		echo json_encode($output);
	} else {
		header("Location: $base_url"."login.php?error=1");
	}

 ?>