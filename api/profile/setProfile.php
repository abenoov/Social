<?php 
	include "../../db.php";
	include "../../config.php";
	session_start();

	if (isset($_SESSION["user_id"])) {

		$user_id = $_SESSION["user_id"];

		$exist = $db->query("SELECT * FROM profile WHERE user_id = '$user_id'");

		if (!$exist->num_rows > 0) {
			if(	isset($_POST["education"])&&
					isset($_POST["family_status"])&&
					isset($_POST["gender"])&&
					isset($_POST["city"])){

					$education = $_POST["education"];
					$family_status = $_POST["family_status"];
					$city = $_POST["city"];
					$gender = $_POST["gender"];

					$img_path = NULL;


					if(isset($_FILES["img"]) && isset($_FILES["img"]["name"])){

						$temp = explode(".", $_FILES["img"]["name"]);
						$file_name = time().'.'.end($temp);
						move_uploaded_file($_FILES["img"]["tmp_name"], "../../images/profile/".$file_name);

						$img_path = "images/profile/".$file_name;

					

						$db->query("INSERT INTO profile(gender, education, family_status, img, user_id, city) VALUES('$gender', '$education', '$family_status', '$img_path', '$user_id', '$city')");

					} else {
						$db->query("INSERT INTO profile(gender, education, family_status, user_id, city) VALUES('$gender', '$education', '$family_status', '$user_id', '$city')");
						// // echo true;
						// echo $education;
						// echo $city;
						// echo $gender;
						// echo $family_status;
						echo $img_path."hi";
					}
					header("Location: $base_url");
				} else {
					
					 header("Location: $base_url"."login.php?error=1");
				}
		}

	}

 ?>