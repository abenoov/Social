<!DOCTYPE html>
<html>
<head>
	<title>My Chats</title>
</head>
<body>

	<style type="text/css">
		.wrapper {
			width: 100%;
			display: flex;
			justify-content: center;
			align-items: flex-start;
			padding-top: 2%;
		}

		.wrapper .chat {
			width: 60%;
			border: 1px solid black;
			margin-bottom: 2%; 
		}

		.wrapper .chat a {
			width: 100%;
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding-left: 2%;
			padding-right: 2%;
		}

		.wrapper .chat .img {
			width: 20%;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		.wrapper .chat .img img {
			width: 100%;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
	</style>


	<?php
     include("./header.php");
     include "./db.php";
	 include "./config.php";

	session_start();
	if (isset($_SESSION["user_id"])) {
		$user_id = $_SESSION["user_id"];
 	?>

		<div class="wrapper">
			<?php 
			$chats = "";
				$exist = $db->query("SELECT * FROM chat WHERE user_id = $user_id OR participant_id = $user_id");
				if ($exist->num_rows > 0) {
					while ($row=$exist->fetch_object()) {
						if ($row->user_id != $user_id) {
							$user = $db->query("SELECT * FROM users WHERE id = $row->participant_id");
							$profile = $db->query("SELECT * FROM profile WHERE user_id = $row->participant_id");
							// echo "yes";
						} elseif ($row->participant_id != $user_id) {
							$user = $db->query("SELECT * FROM users WHERE id = $row->user_id");
							$profile = $db->query("SELECT * FROM profile WHERE user_id = $row->user_id");
							// echo "Yes";
						}

						if ($user->num_rows >0) {
							$userRow=$user->fetch_object();
							$chats .= '
								<div class="chat"><a href="'.$base_url.'im.php?chat='.$row->id.'">';
									if ($profile->num_rows>0) {
										$profileRow=$profile->fetch_object();
									$chats .= '
									<div class="img">
										<img src = "'.$profileRow->img.'">
									</div>';
								} else {
									$chats .= '
									<div class="img">
										<img src = "./images/profile/blank.jpg">
									</div>';
								}
							$chats.='
									<div class="name">
										'.$userRow->first_name.' '.$userRow->second_name.'
									</div>
								</div>';
						}
						echo $chats;	
					}
				}
			 ?>
		</div>

	<?php 
	} else {
		header("Location: $base_url"."login.php?error=1");
	}
	?>
</body>
</html>