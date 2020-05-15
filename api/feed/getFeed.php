<!-- <?php 
	include "../../db.php";
	include "../../config.php";

	session_start();
	if (isset($_SESSION["user_id"])) {

		$user_id = $_SESSION["user_id"];

		$exist = $db->query("SELECT * FROM posts");


		$output = array();


		if ($exist->num_rows > 0) {
			// header("Location: $base_url"."signup.php?error=2");
			while ($row=$exist->fetch_object()) {

					$output[] = array(
						"id"=>$row->id,
						"content"=>$row->content,
						"img"=>$row->img,
						"date"=>$row->date,
						"user_id"=>$row->user_id,
					);

			}
			
			echo json_encode($output);
		}
	}
	else {
			header("Location: $base_url"."signup.php?error=1");
		}

 ?> -->