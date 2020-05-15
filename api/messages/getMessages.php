<?php 
	include "../../db.php";
	include "../../config.php";

	session_start();
	if (isset($_SESSION["user_id"]) &&
		isset($_POST["chat_id"])) {

		$user_id = $_SESSION["user_id"];
		$chat_id = $_POST["chat_id"];

		$exist = $db->query("SELECT * FROM messages WHERE chat_id = $chat_id");


		$output = array();


		if ($exist->num_rows > 0) {
			// header("Location: $base_url"."signup.php?error=2");
			while ($row=$exist->fetch_object()) {
					$output[] = array(
						"id"=>$row->id,
						"content"=>$row->content,
						"img"=>$row->img,
						"user_id"=>$row->user_id,
						"date"=>$row->date,
					);
			}
			
			echo json_encode($output);
		} else {
			$output = array(
				"message"=>"no_chat"
			);
			echo json_encode($output);
		}
	}
	else {
			header("Location: $base_url"."signup.php?error=1");
		}

 ?>