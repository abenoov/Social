<?php 
	include "../../db.php";
	include "../../config.php";

	session_start();
	if (isset($_SESSION["user_id"]) &&
		isset($_POST["participant_id"])) {

		$user_id = $_SESSION["user_id"];
		$participant_id = $_POST["participant_id"];

		$exist = $db->query("SELECT * FROM chat WHERE user_id = $user_id OR participant_id = $user_id");


		$output = array();


		if ($exist->num_rows > 0) {
			// header("Location: $base_url"."signup.php?error=2");
			while ($row=$exist->fetch_object()) {
					$output[] = array(
						"id"=>$row->id,
						"participant_id"=>$row->participant_id,
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