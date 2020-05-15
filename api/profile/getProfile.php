<?php 
	include "../../db.php";
	include "../../config.php";

	session_start();
	if (isset($_SESSION["user_id"])) {

		$user_id = $_SESSION["user_id"];

		$exist = $db->query("SELECT * FROM profile WHERE user_id = '$user_id'");


		$output = array();


		if ($exist->num_rows > 0) {
			// header("Location: $base_url"."signup.php?error=2");
			while ($row=$exist->fetch_object()) {
					$output[] = array(
						"id"=>$row->id,
						"bio"=>$row->bio,
						"school"=>$row->school,
						"college"=>$row->college,
						"family_status"=>$row->family_status,
						"favourite"=>$row->favourite,
						"job"=>$row->job,
						"country"=>$row->country,
						"city"=>$row->city,
					);
			}
			
			echo json_encode($output);
		}
	}
	else {
			header("Location: $base_url"."signup.php?error=1");
		}

 ?>