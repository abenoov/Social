<?php 
	include "../../db.php";
	include "../../config.php";
	session_start();

	if (isset($_SESSION["user_id"])) {

		$user_id = $_SESSION["user_id"];

			if(	isset($_POST["content"]) && isset($_POST['post_id'])){

				$content = $_POST["content"];
				$post_id = $_POST["post_id"];

				$img_path = NULL;

				if(isset($_FILES["img"])&&isset($_FILES["img"]["name"])){

					$temp = explode(".", $_FILES["img"]["name"]);
					$file_name = time().'.'.end($temp);
					move_uploaded_file($_FILES["img"]["tmp_name"], "../../images/posts/".$file_name);

					$img_path = "images/posts/".$file_name;

				

					$db->query("INSERT INTO comments(content, img, post_id, user_id) VALUES('$content', '$img_path', $post_id, $user_id)");
					// echo true;
				} else {
					$db->query("INSERT INTO comments(content, post_id, user_id) VALUES('$content', $post_id, $user_id)");
					// echo true;
				}
				header("Location: $base_url");
			} else {
				
				
			}

	} else {
		header("Location: $base_url"."login.php?error=1");
	}

 ?>