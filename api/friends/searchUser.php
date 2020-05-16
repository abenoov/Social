<?php 
	include "../../db.php";
	include "../../config.php";

	session_start();
	if (isset($_SESSION["user_id"]) &&
		isset($_POST["search"])) {

		$user_id = $_SESSION["user_id"];
		$search = $_POST["search"];

		$exist = $db->query("SELECT * FROM users WHERE first_name LIKE '$search%' OR second_name LIKE '$search%' OR third_name LIKE '$search%' OR login LIKE '$search%'");


		$output = array();


		if ($exist->num_rows > 0) {
			// header("Location: $base_url"."signup.php?error=2");
			while ($row=$exist->fetch_object()) {
					$output[] = array(
						"id"=>$row->id,
						"first_name"=>$row->first_name,
						"second_name"=>$row->second_name,
					);
			}
			
			echo json_encode($output);
		} else {
			$output = array(
				"message"=>"no_users"
			);
			echo json_encode($output);
		}
	}
	else {
			header("Location: $base_url"."signup.php?error=1");
		}

 ?>