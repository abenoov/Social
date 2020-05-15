<?php 
	include "../../db.php";
	include "../../config.php";
	session_start();

	if (isset($_SESSION["user_id"])) {

		$user_id = $_SESSION["user_id"];

		$exist = $db->query("SELECT * FROM profile WHERE user_id = '$user_id'");

		if ($exist->num_rows > 0) {
			if(	isset($_POST["bio"])&&
					isset($_POST["school"])&&
					isset($_POST["college"])&&
					isset($_POST["family_status"])&&
					isset($_POST["favourite"])&&
					isset($_POST["country"])&&
					isset($_POST["city"])&&
					isset($_POST["job"])){

					$bio = $_POST["bio"];
					$school = $_POST["school"];
					$college = $_POST["college"];
					$family_status = $_POST["family_status"];
					$favourite = $_POST["favourite"];
					$job = $_POST["job"];
					$country = $_POST["country"];
					$city = $_POST["city"];

					$img_path = NULL;




					if(isset($_FILES["img"])&&isset($_FILES["img"]["name"])){

						$temp = explode(".", $_FILES["img"]["name"]);
						$file_name = time().'.'.end($temp);
						move_uploaded_file($_FILES["img"]["tmp_name"], "../../images/profile/".$file_name);

						$img_path = "images/profile/".$file_name;

					

						$db->query("UPDATE profile SET bio = '$bio', school = '$school', college = '$college', job = '$job', family_status = '$family_status', favourite = '$favourite', img = '$img_path', country = '$country', city='$city' WHERE user_id = '$user_id'");
						echo true;
					} else {
						$db->query("UPDATE profile SET bio = '$bio', school = '$school', college = '$college', job = '$job', family_status = '$family_status', favourite = '$favourite', country = '$country', city='$city' WHERE user_id = '$user_id'");
						echo true;

					}
				} else {
					
					// header("Location: $base_url"."signup.php?error=1");
				}
		}
		 else{
			if(	isset($_POST["bio"]) &&
					isset($_POST["school"]) &&
					isset($_POST["college"]) &&
					isset($_POST["family_status"]) &&
					isset($_POST["favourite"]) &&
					isset($_POST["job"])){

					$bio = $_POST["bio"];
					$school = $_POST["school"];
					$college = $_POST["college"];
					$family_status = $_POST["family_status"];
					$favourite = $_POST["favourite"];
					$job = $_POST["job"];
					$country = $_POST["country"];
					$city = $_POST["city"];

					$img_path = NULL;


					if(isset($_FILES["img"])&&isset($_FILES["img"]["name"])){

						$temp = explode(".", $_FILES["img"]["name"]);
						$file_name = time().'.'.end($temp);
						move_uploaded_file($_FILES["img"]["tmp_name"], "../../images/profile/".$file_name);

						$img_path = "images/profile/".$file_name;

					

						$db->query("INSERT INTO profile(bio, school, college, job, family_status, favourite, img, user_id, country, city) VALUES('$bio','$school','$college','$job','$family_status', '$favourite', '$img_path', '$user_id', '$country', '$city')");
					} else {
						$db->query("INSERT INTO profile(bio, school, college, job, family_status, favourite, user_id, country, city) VALUES('$bio','$school','$college','$job','$family_status', '$favourite', '$user_id, '$country', '$city'')");

					}

				} else {
					
					header("Location: $base_url");
				}
			}
	

	}

 ?>