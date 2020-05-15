<?php 
	include "../../db.php";
	include "../../config.php";
	session_start();

	if (isset($_SESSION["user_id"])) {

		$user_id = $_SESSION["user_id"];

			if(	isset($_POST["content"])){

				$content = $_POST["content"];

				$img_path = NULL;

				if(isset($_FILES["img"])&&isset($_FILES["img"]["name"])){

					$temp = explode(".", $_FILES["img"]["name"]);
					$file_name = time().'.'.end($temp);
					move_uploaded_file($_FILES["img"]["tmp_name"], "../../images/posts/".$file_name);

					$img_path = "images/posts/".$file_name;

				

					$db->query("INSERT INTO posts(content, img, user_id) VALUES('$content','$img_path', $user_id)");
					echo true;
				} else {
					$db->query("INSERT INTO posts(content, user_id) VALUES('$content', '$user_id')");
					echo true;
				}
			} else {
				
				
			}

	} else {
		// header("Location: $base_url"."signup.php?error=1");
	}

 ?>