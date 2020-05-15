<?php 
	include "../../db.php";
	include "../../config.php";

	session_start();
	if (isset($_SESSION["user_id"]) &&
		isset($_POST["content"]) &&
		isset($_POST["chat_id"])) {

		$user_id = $_SESSION["user_id"];
		$content = $_POST["content"];
		$chat_id = $_POST["chat_id"];


		if(isset($_FILES["img"]) && isset($_FILES["img"]["name"])){

			$temp = explode(".", $_FILES["img"]["name"]);
			$file_name = time().'.'.end($temp);
			move_uploaded_file($_FILES["img"]["tmp_name"], "../../images/messages/".$file_name);

			$img_path = "images/messages/".$file_name;

		

			$db->query("INSERT INTO messages(content, img, user_id, chat_id) VALUES('$content', '$img_path', $user_id, $chat_id)");
		} else {
			$db->query("INSERT INTO messages(content, user_id, chat_id) VALUES('$content', $user_id, $chat_id')");
		}
	} else {
		header("Location: $base_url"."signup.php?error=1");
	}

 ?>